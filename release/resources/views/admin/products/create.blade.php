@extends('admin.layouts.base-layout')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Order</h3>
                <a href="{{route('products.index')}}" class="btn btn-primary float-right">View Product</a>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @METHOD('POST')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Price</label>
                                <input type="number" class="form-control" id="name" placeholder="Enter product price" name="price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea class="form-control" rows="3" placeholder="Enter description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Stars</label>
                                <input type="number" class="form-control" id="name" placeholder="Enter product stars" name="stars">
                            </div>
                        </div>
                       
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">TypeId</label>
                                <input type="number" class="form-control" id="name" placeholder="Enter TypeId" name="typeId">
                            </div>
                          </div>
                
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection