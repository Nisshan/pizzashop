@extends('adminlte::page')

@section('title',isset($title) ? $title : '' )

@section('content')
    @include('shared.error-bag')
    <div class="card card-primary card-outline col-md-8">
        <div class="card-header">
            <div class="row mb-2">
                <div class="col-sm-6 card-title">
                    <h3 class="m-0 text-dark">Coupon</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('coupons.index')}}">Coupon</a>
                        </li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sliders.store')}}" method="POST" enctype=multipart/form-data>
                @csrf
                <div class="mb-2">
                    <label for="cover-image">Image: </label>
                    <div class="form-group">
                        <input type="file" class="form control @error('path') is-invalid @enderror"
                               name="path"
                               id="cover-image"
                               required
                               onchange="document.getElementById('path').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <img id="path" src="{{asset("/images/logo.png")}}"
                         height="100px" width="100px"><br>

                    @error('path')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection


