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
                    <h3 class="card-title">{{$category->name}}</h3>
                </div>
                <div class="card-body">
                    <h3></h3>
                    <hr>
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>Slug</td>
                            <td>{{$category->slug}}</td>
                        </tr>

                        <tr>
                            <td>Created by</td>
                            <td>{{$category->user->name}}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>{{$category->status == 1 ? 'Enabled' : 'Disabled'}}</td>
                        </tr>

                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">
                        <a href="{{route('categories.edit',[$category->id])}}"
                           class="btn btn-info  pull-left">
                            {{__('Edit')}}</a>

                        <a href="{{route('categories.index')}}"
                           class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
