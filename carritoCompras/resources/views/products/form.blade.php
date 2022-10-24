 <label class="form-label">Nombre del Producto</label>
 <br>
 <input type="text" name="PRO_NAME" value="{{isset($product->PRO_NAME) ?  $product->PRO_NAME:''}}">
 <br>
 <label class="form-label">Descripcion</label>
 <br>
 <input type="text" name="PRO_DESCRIPTION" value="{{ isset( $product->PRO_DESCRIPTION ) ? $product->PRO_DESCRIPTION:''}}">
 <br>
 <label class="form-label">Precio</label>
 <br>
 <input type="double" name="PRO_PRICE" value="{{ isset($product->PRO_PRICE) ? $product->PRO_PRICE:'' }}">
 <br>
 <br>
 <label class="form-label">Unidades :  {{ isset($cont->unidades) ? $cont->unidades:""  }} </label>
 <br>
 <label class="form-label">Unidades a adicionar </label>
 <input type="number" name="unidades" value="0">
 <br>
 <label class="form-label">Imagen producto</label>
 <br>
 @if(isset($product->PRO_IMG))
    <img src="/images/{{( $product->PRO_IMG) }}" class="card-img-top mx-auto"
        style="height: 150px; width: 150px;display: block;" alt="{{ $product->PRO_IMG }}">
 @endif
 <br>
 <input type="file" name="PRO_IMG" value="">
 <br>
 <input class="btn btn-success btn-sm" type="submit" value="Guardar">
 <a  class="btn btn-primary btn-sm" href="{{ url('/products/') }}"> Atras </a>
