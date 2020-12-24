@extends('adminlte::page')

@section('title', isset($title) ? $title : '')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{isset($title) ? $title : 'User View'}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @can('view_all_user')
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">User</a></li>
                    @endcan
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
                    <h3 class="card-title">{{$user->name}}</h3>
                </div>
                <div class="card-body">
                    <h3></h3>
                    <hr>
                    <table class="table table-responsive table-striped">

                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $user->status ? 'Active' : 'Disabled' }}</td>
                        </tr>

                        <tr>
                            <td>Role</td>
                            <td>{{ $user->roleName() }}</td>
                        </tr>

                    </table>
                    <hr>
                    <br>
                    <div class="card-footer clearfix" style="">

                            <a href="{{route('users.edit',[$user])}}"
                               class="btn btn-info  pull-left">
                                Edit</a>

                            <a href="{{route('users.index')}}"
                               class="btn  btn-default pull-right">{{__('Back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
