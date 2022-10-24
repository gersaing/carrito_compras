@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <form action="{{ url('/products') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('products.form')
    </form>
@endsection
