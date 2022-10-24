@extends('partials.Headforms')
@section('content')
    <div class="container" style="margin-top: 10px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Inicio de sesión</h4>
                    </div>
                </div>
                <hr>
                <div >
                <form action="/login" method="POST">
                    @csrf
                    <label class="form-label">Nombre de usuario</label>
                    <br>
                    <input type = "text" name = "name">
                    <br>
                    <label class="form-label">Clave</label>
                    <br>
                    <input type = "password" name = "password"> 
                    <br>
                    <br>
                    <input class = "btn btn-success" type = "submit" value = "Iniciar Sesión">
                    <a class = "btn btn-primary" href="{{ url('/register/') }}"> Registrarse </a>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection