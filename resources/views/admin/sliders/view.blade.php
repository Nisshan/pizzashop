@extends('adminlte::page')

@section('title', $title ?? 'Slider view')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{$title ?? 'Sliders'}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('sliders.index')}}">Products</a></li>
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
                    <h3 class="card-title">{{'Slider Deltails'}}</h3>
                </div>
                <div class="card-body">
                    <h3></h3>
                    <hr>
                    <table class="table table-responsive table-striped">


                        <tr>
                            <td>Image</td>
                            <td>

                                <img src="{{$slider->path()}}">

                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{$slider->status == 1 ? 'Enabled' : 'Disabled'}}</td>
                        </tr>
                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">
                        <a href="{{route('sliders.edit',$slider)}}"
                           class="btn btn-info  pull-left">
                            {{__('Edit')}}</a>

                        <a href="{{route('sliders.index')}}"
                           class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
