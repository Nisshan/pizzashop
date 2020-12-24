@extends('adminlte::page')

@section('title', $title ?? 'Order View')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{$title ?? 'Order View'}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('orders.index')}}">Orders</a></li>
                    <li class="breadcrumb-item">Details</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-blue">
                    <h3 class="card-title">{{'Order By '}}{{$order->user->name}}</h3>
                </div>
                <div class="card-body">
                    <h3></h3>
                    <hr>
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>Order Id</td>
                            <td>{{$order->id}}</td>
                        </tr>

                        <tr>
                            <td>Order By</td>
                            <td>{{$order->user->name}}</td>
                        </tr>

                        <tr>
                            <td>Total Amount</td>
                            <td>{{$order->total_amount}}</td>
                        </tr>

                        <tr>
                            <td>Quantity</td>
                            <td>{{$order->quantity}}</td>
                        </tr>

                        <tr>
                            <td>Delivery At</td>
                            <td>{{\Carbon\Carbon::parse($order->delivery_at)->format('m/d/Y g:ia')}}</td>
                        </tr>

                        <tr>
                            <td>Delivered at</td>
                            <td>{{$order->delivered_at ? \Carbon\Carbon::parse($order->delivered_at)->format('m/d/Y g:ia') : 'Not Delivered'}}</td>
                        </tr>

                        <tr>
                            <td>Ordered at</td>
                            <td>{{$order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('m/d/Y g:ia') : 'Not Delivered'}}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>{{$order->status}}</td>
                        </tr>

                        <tr>
                            <td>Note</td>
                            <td>{{$order->note ? $order->note : 'Nothing in note' }}</td>
                        </tr>

                        @if($order->products->count())
                            <td>{{$order->products->count() == 1 ? 'Product Ordered :' : 'Products Ordered :'}}</td>
                            @foreach($order->products as $order)
                                <tr>
                                    <td>
                                        <span>{{'Name : '}}{{$order->pivot->product_name}}</span>
                                    </td>
                                    <td>
                                        <span>{{'Variant : '}}{{$order->pivot->variant}}</span>
                                    </td>
                                    <td>
                                        <span>{{'Price : '}}{{$order->pivot->price}}</span>
                                    </td>
                                    <td>
                                        <span>{{'Quantity : '}}{{$order->pivot->quantity}}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">
                        {{--                        <a href="{{route('orders.edit',[$order->id])}}"--}}
                        {{--                           class="btn btn-info  pull-left">--}}
                        {{--                            {{__('Edit')}}</a>--}}

                        <a href="{{route('orders.index')}}"
                           class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
