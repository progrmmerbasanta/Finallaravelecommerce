@extends('admin.layouts.base-layout')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Order</h3>
                <a href="{{route('users')}}" class="btn btn-primary float-right">View user</a>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @METHOD('POST')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter user name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Phone Number</label>
                                <input type="number" class="form-control" id="name" placeholder="Enter user phone number" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter user email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Order Count</label>
                                <input type="number" class="form-control" id="name" placeholder="Order Count" name="order_count">
                            </div>
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