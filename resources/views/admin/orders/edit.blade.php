@extends('adminlte::page')

@section('title', $title ?? 'Categories' )

@section('content')
    @include('shared.error-bag')
    <div class="card card-primary card-outline col-md-8">
        <div class="card-header">
            <div class="row mb-2">
                <div class="col-sm-6 card-title">
                    <h3 class="m-0 text-dark">Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a>
                        </li>
                        <li class="breadcrumb-item">Update</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('order.update',[$category->id])}}" method="POST" enctype=multipart/form-data>
                @csrf
                @method('PATCH')


                <div class="form-group">
                    <select name="status" id="" class="form"></select> &nbsp;
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection


