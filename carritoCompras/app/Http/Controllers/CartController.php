<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{   
    public function index(){

        return redirect('/inicio');
    }
    public function shop()
    {
      
        $user = Auth::user();
        $sql = 'select products.ID, products.PRO_NAME, products.PRO_DESCRIPTION, products.PRO_PRICE, products.PRO_IMG, (SELECT count(item.ITEM_ID)FROM item WHERE item.PRO_ID = products.ID and item.VEN_ID is null) as unidades from products left join item on products.ID = item.PRO_ID group by products.PRO_NAME';
        $products = DB::select($sql);                  
        return view('shop')->withTitle('E-COMMERCE STORE | SHOP')->with(['products' => $products])->with(['user' => $user]);
    }
    public function cart()  {
        $cartCollection = \Cart::getContent();
       
        return view('cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);;
    }
    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function add(Request$request){
        $it = Item::where("item.pro_id", "=", $request->id)
        ->whereNull("item.ven_id")
        ->limit(1)
        ->get('item.item_id'); 
        if(!$it->isEmpty()){
            \Cart::add(array(
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $request->img,
                    'slug' => $request->slug
                )
            ));
            return redirect()->route('cart.index')->with('success_msg', 'Item Agregado a sú Carrito!');
           
        }else{
            
            return redirect()->route('shop')->with('success_msg', 'No hay Items de ese producto!');
        }
       
    }

    public function update(Request $request){

        $sql = "SELECT  COUNT(item.ITEM_ID)as unidades FROM products left join item on products.ID = item.PRO_ID WHERE products.ID ='$request->id' and item.ven_id is null";
        
        $res = DB::select($sql);
        $res2 = $res[0];
        $cont = $res2;
        if(($cont->unidades - $request->quantity) >=0 ){
            \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
            ));
           return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
        }
        return redirect()->route('cart.index')->with('success_msg', 'No se pude actulizar, no existen más unidades!');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }

    public function checkout(){
        $user = Auth::user();
        $venta = Venta::create(['US_ID' => $user->id]);
        $items = \Cart::getContent();
        foreach($items as $row) {
            $i=0;
            while($i < $row->quantity){
                $sql = "UPDATE item SET item.VEN_ID = '$venta->id' WHERE item.PRO_ID =' $row->id'  and item.VEN_ID IS NULL limit 1";
                $it = DB::select($sql);      
                $i++;
            }            
        }
        \Cart::clear();
        return redirect('/inicio')->with('Grecias por su compra!');
    }

    public function history(){
        
        $user = Auth::user();
        $sql = "SELECT products.ID, products.PRO_NAME, products.PRO_DESCRIPTION, products.PRO_PRICE, products.PRO_IMG, count(ITEM_ID)as unidades, sum(products.PRO_PRICE) as total FROM venta join item on venta.VEN_ID = item.VEN_ID join products on products.ID = item.PRO_ID WHERE venta.US_ID = $user->id GROUP by products.ID";
        $products = DB::select($sql);  
        
        return view('Historial')->withTitle('E-COMMERCE STORE | SHOP')->with(['products' => $products])->with(['user' => $user]);
    }

}
