@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: -20px">
        <nav aria-label="breadcrumb"> 
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="btn btn-light" href="/inicio">Inicio</a></li>
                <li class="breadcrumb-item"><a class="btn btn-light" href="/products">Administrador</a></li>
                <li class="breadcrumb-item"><a class="btn btn-light" href="/history">Historial de compras</a></li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Productos</h4>
                        <div style="background-color: white;">
                            <a class="btn btn-secondary" href="{{ url('/products/create') }}"> Agregar producto </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @auth
                        @foreach ($products as $product)
                            <div class="col-lg-3">
                                <div class="card" style="margin-bottom: 20px; height: auto;">
                                    <img src="/images/{{ $product->PRO_IMG }}" class="card-img-top mx-auto"
                                        style="height: 150px; width: 150px;display: block;" alt="{{ $product->PRO_IMG }}">
                                    <div class="card-body">
                                        <a href="">
                                            <h6 class="card-title">{{ $product->PRO_NAME }}</h6>
                                        </a>
                                        <p>precio: ${{ $product->PRO_PRICE }}</p>
                                        <p>unidades disponibles: {{ $product->unidades }}</p>
                                        <form action="{{ url('/products/' . $product->ID) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" value="{{ $product->ID }}" id="id" name="id">
                                            <input type="hidden" value="{{ $product->PRO_NAME }}" id="name"
                                                name="name">
                                            <input type="hidden" value="{{ $product->PRO_PRICE }}" id="price"
                                                name="price">
                                            <input type="hidden" value="{{ $product->PRO_IMG }}" id="img"
                                                name="img">
                                            <input type="hidden" value="1" id="quantity" name="quantity">

                                           
                                            <div style="background-color: white;">
                                                <input class="btn btn-danger btn-sm" type="submit" onclick="return confirm ('¿quieres borrar el producto?')"
                                                    value="Eliminar">
                                                <a  class="btn btn-warning btn-sm" href="{{ url('/products/' . $product->ID . '/edit') }}"> editar </a>
                                            </div>
                                                          
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endauth

                    @guest
                        <p> Inicia sesion para ver el contenido <a href="/login"> login </p>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
