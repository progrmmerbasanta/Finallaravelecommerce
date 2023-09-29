@extends('admin.layouts.base-layout')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12">
                    <img src="{{asset('images/products/'.$product->img)}}" height="300px" width="300px">
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12">
                    <h2>Name: {{$product->name}}
                    <a href="{{route('products.edit',$product->id)}}"><i class="btn-sm btn-success fas fa-edit float-right"></i></a>

                    </h2>
                    <hr>
                    <p>Price: {{$product->price}}</p>
                    <p>Description: {{$product->description}}</p>
                    <p>Stars: {{$product->stars}}</p>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection