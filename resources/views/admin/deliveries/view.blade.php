@extends('adminlte::page')

@section('title', $title ?? 'Category view')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{$title ?? 'Category View'}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categories</a></li>
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
                    <h3 class="card-title">{{'Coupon Code'}}</h3>
                </div>
                <div class="card-body">
                    <h3></h3>
                    <hr>
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>Delivery Type</td>
                            <td>{{$delivery->delivery_type}}</td>
                        </tr>

                        <tr>
                            <td>Chargeable</td>
                            <td>{{$delivery->chargeable == 1 ? 'True' : 'False'}}</td>
                        </tr>

                        @if($delivery->chargeable == 1)
                            <tr>
                                <td>Price</td>
                                <td>{{$delivery->price }}</td>
                            </tr>
                        @endif

                        <tr>
                            <td>Status</td>
                            <td>{{$delivery->status == 1 ? 'Active' : 'InActive'}}</td>
                        </tr>

                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">
                        <a href="{{route('deliveries.edit',[$delivery])}}"
                           class="btn btn-info  pull-left">
                            {{__('Edit')}}</a>
                        <a href="{{route('deliveries.index')}}"
                           class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
