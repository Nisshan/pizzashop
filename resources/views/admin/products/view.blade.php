@extends('adminlte::page')

@section('title', $title ?? 'Product view')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{$title ?? 'Product View'}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
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
                    <h3 class="card-title">{{$product->name}}</h3>
                </div>
                <div class="card-body">
                    <h3></h3>
                    <hr>
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>Slug</td>
                            <td>{{$product->slug}}</td>
                        </tr>

                        <tr>
                            <td>Cover</td>
                            <td>
                                @if($product->cover)
                                    <img src="{{$product->getCoverThumb()}}">
                                @else
                                    <p>No cover Image</p>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>Created by</td>
                            <td>{{$product->user->name}}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>{{$product->status == 1 ? 'Enabled' : 'Disabled'}}</td>
                        </tr>

                        <tr>
                            <td>Price</td>
                            <td>{{$product->price}}</td>
                        </tr>

                        <tr>
                            <td>Category</td>
                            <td>
                                @foreach($product->categories as $category)
                                    <span class="bg-primary">{{$category->name}}@if(!$loop->last){{","}}@endif</span>

                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <td>Images</td>
                            @if($product->images->count())
                                @foreach($product->images as $image)
                                    <td>
                                        <img src="{{$image->thumbPath()}}">
                                    </td>
                                @endforeach
                            @else
                                <td>No Images To preview</td>
                            @endif
                        </tr>

                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">
                        <a href="{{route('products.edit',[$product->id])}}"
                           class="btn btn-info  pull-left">
                            {{__('Edit')}}</a>

                        <a href="{{route('products.index')}}"
                           class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
