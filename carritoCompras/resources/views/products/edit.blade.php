@extends('layouts.app')
@section('content')
<form action = "{{url('/products/'.$product->ID)}}" method = "post" enctype = "multipart/form-data">
@csrf
{{method_field('PATCH')}}
@include('products.form') 

</form>
@endsection