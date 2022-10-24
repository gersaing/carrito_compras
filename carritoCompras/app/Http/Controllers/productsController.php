<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //
     public function index()
     {   
        $user = Auth::user();
        $sql = 'select products.ID, products.PRO_NAME, products.PRO_DESCRIPTION, products.PRO_PRICE, products.PRO_IMG, (SELECT count(item.ITEM_ID)FROM item WHERE item.PRO_ID = products.ID and item.VEN_ID is null) as unidades from products left join item on products.ID = item.PRO_ID group by products.PRO_NAME';
        $products = DB::select($sql);
   
               
        return view('products.shop_adm')->withTitle('E-COMMERCE STORE | SHOP')->with(['products' => $products])->with(['user' => $user]);
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $i=0;
        $lim = $request->unidades;
        $datosProducto = request()->except('_token','unidades');
        if($request->hasFile('PRO_IMG')){
            $datosProducto['PRO_IMG']=$request->file('PRO_IMG')->store('uploads','public');
        }
        Product::insert($datosProducto);
        $sql = 'SELECT products.ID FROM products ORDER by 1 DESC LIMIT 1';
        $us = DB::select($sql);
        
        foreach ($us as $u) {
            $id = $u->ID;
        }
        while($i < $lim){
            Item::create(['PRO_ID' => $id]);
            $i++;
        }
        return redirect ('products');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $sql = "SELECT  COUNT(item.ITEM_ID)as unidades FROM products left join item on products.ID = item.PRO_ID WHERE products.ID ='$id' and item.ven_id is null";
        
        $res = DB::select($sql);
        $res2 = $res[0];
        $cont = $res2;
        return view('products.edit')->with('product',$product)->with('cont',$cont);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $i=0;
        $lim = $request->unidades;
        $datosProducto = request()->except('_token','_method','unidades');
        if($request->hasFile('PRO_IMG')){
            Storage::delete(['public/'.$product->PRO_IMG]);
            $datosProducto['PRO_IMG']=$request->file('PRO_IMG')->store('uploads','public');

        }
        Product::where('id', '=', $id)->update($datosProducto);
        
        while($i < $lim){
            Item::create(['PRO_ID' => $id]);
            $i++;
        }
        $lst = Item::where('PRO_ID','=',$id);
        $cont = $lst->count();
        //dd($cont);
        $product = Product::findOrFail($id);
        return view('products.edit')->with(['product' => $product])->with('cont',$cont);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        Product::where('id', $id)->delete();
        return redirect('products');
    }

}