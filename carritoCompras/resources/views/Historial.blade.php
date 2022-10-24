@extends('layouts.app')

@section('content')
    <div>
        <h3>Historial de compras</h3>
        @foreach($products as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/images/{{ $item->PRO_IMG }}" class="img-thumbnail" width="200" height="200">
                        </div>
                        <div class="col-lg-5">
                            <p> <b>Nombre: </b>${{ $item->PRO_NAME }}<br>
                                <b>Precio: </b>${{ $item->PRO_PRICE }}<br>
                                <b>Unidades: </b>${{ $item->unidades }}<br>
                                <b>Total pagado: </b>${{ $item->total }}<br>
                            </p>
                        </div>
                    </div>
                    <hr>
                @endforeach
                

        </div>
        <br><a href="/inicio" class="btn btn-dark">Continue en la tienda</a>
        </div>
    </div>
@endsection

