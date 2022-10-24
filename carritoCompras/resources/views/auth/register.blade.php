@extends('partials.Headforms')
@section('content')
    <div class="container" style="margin-top: 10px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Registro de usuario</h4>
                    </div>
                </div>
                <hr>
                <div >
                <form action="/register" method="POST">
                    @csrf
                    <label class="form-label">Nombre de usuario</label>
                    <br>
                    <input type = "text" name = "name">
                    <br>
                    <label class="form-label">Correo</label>
                    <br>
                    <input type = "email" name = "email">
                    <br>
                    <label class="form-label">Contraseña</label>
                    <br>
                    <input type = "password" name = "password"> 
                    <br>
                    <label class="form-label">Confirmar contraseña</label>
                    <br>
                    <input type = "password" name = "password_confirmation">
                    <br>
                    <input name="rol" type="hidden" value="no-admin">
                    <br>
                    <a class = "btn btn-primary" href="{{ url('/login/') }}"> Atras </a>
                    <input class = "btn btn-success" type = "submit" value = "Registrarse">                     
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection