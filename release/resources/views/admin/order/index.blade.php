@extends('admin.layouts.base-layout')
@section('content')
<div class="content-wrapper">
    <div class="card mt-3 mx-3">
        <div class="card-header">
            <h2 class="text-center card-title">Order Table</h2>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Product</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{++$i}} </td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->time}}</td>
                        <td>
                            @if($order->status==1)
                            <button class="btn btn-success">Approved</button>
                            @elseif($order->status==2)
                            <button class="btn btn-danger">Cancelled</button>
                            @elseif($order->status==3)
                            <button class="btn btn-primary">Delivered</button>
                            @else
                            <button class="btn btn-danger">UnApproved</button>
                            @endif
                        </td>
                        <td>
                            @foreach($order->product as $pro)

                            <?php $prod = \App\Models\products::find($pro); ?>
                            @if($prod)
                            {{ $prod->name }} ,
                            @endif
                            @endforeach
                        </td>

                        <td>
                            <!-- <a href=""><i class="btn-sm btn-primary fas fa-edit"></i></a> -->
                            <a href="{{route('order.delete',$order->id)}}"><i class="btn-sm btn-danger fas fa-trash"></i></a>
                            @if($order->status==0)
                            <div class="mt-2">
                                <form action="{{route('order.approve',$order->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" value="1" name="status">
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                            </div>
                            @elseif($order->status==1)
                            <div class="mt-2">
                                <form action="{{route('order.cancel',$order->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" value="2" name="status">
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            </div>
                            <div class="mt-2">
                                <form action="{{route('order.delivered',$order->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" value="3" name="status">
                                    <button type="submit" class="btn btn-success">Delivered</button>
                                </form>
                            </div>
                            @endif
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