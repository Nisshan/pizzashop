@extends('adminlte::page')

@section('title', $title ?? 'Categories')

@section('content')
    @include('shared.success')
    <div class="card">
        <div class="card-header card-primary">
            <div class="row">
                <div class="col-sm-11 card-title">
                    <h5 class="m-0 text-dark">{{ $title ?? 'Categories'}}</h5>
                </div>
                <div class="col-sm-1 float-sm-right">
                        <span class="breadcrumb-item float-sm-right"><a href="{{route('categories.create')}}"><button
                                    class="btn btn-sm btn-primary">Create</button></a></span>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            {!! $dataTable->table(['class'=>'display','style'=>'width:100%']) !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('admin/js/delete.js')}}"></script>
    {!! $dataTable->scripts() !!}
@endpush
