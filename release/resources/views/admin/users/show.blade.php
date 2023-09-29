@extends('admin.layouts.base-layout')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            {{$product->name}}
        </div>
        <div class="card-body">
            <div>
                <img src="{{asset('images/products/'.$product->img)}}">
            </div>
            <p>{{$product->price}}</p>

        </div>
    </div>
</div>
@endsection