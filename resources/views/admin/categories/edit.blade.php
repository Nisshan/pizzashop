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
            <form action="{{ route('categories.update',[$category->id])}}" method="POST" enctype=multipart/form-data>
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Category Name <span class="required-form">*</span></label>
                    <input type="text" name="name" id="name" autofocus required
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Category Name" value="{{old('name') ?? $category->name}}">

                    @error('name')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="mb-3">
                        <b>Status</b>
                    </div>
                    <label>
                        <input type="radio" name="status"
                               value="1" checked
                               @if($category->status == true) checked @endif
                        > &nbsp; Active
                    </label> &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="status" value="0"
                               @if($category->status == false) checked @endif
                        > &nbsp; Inactive
                    </label> &nbsp;
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection


