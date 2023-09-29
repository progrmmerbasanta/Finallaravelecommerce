@extends('admin.layouts.base-layout')
@section('content')
<div class="content-wrapper">
    <div class="card mt-3 mx-3">
        <div class="card-header">
            <h2 class="text-center card-title">Products Table</h2>
            <a href="{{route('products.create')}}" class="btn btn-primary float-right">Add Product</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Stars</th>
                        <th>TypeId</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->stars}}</td>
                        <td>{{$product->typeId}}</td>
                        <td>
                            <a href="{{route('products.show',$product->id)}}"><i class="btn-sm btn-primary fas fa-eye"></i></a>
                            <a href="{{route('products.edit',$product->id)}}"><i class="btn-sm btn-success fas fa-edit"></i></a>
                            <form action="{{route('products.destroy',$product->id)}}" method="post" style="display: inline;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection