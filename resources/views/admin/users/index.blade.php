@extends('adminlte::page')

@section('title', isset($title) ? $title : 'Users')



@section('content')
    @include('shared.success')
    <div class="card">
        <div class="card-header card-primary">
            <div class="row">
                <div class="col-sm-11 card-title">
                    <h5 class="m-0 text-dark">Users</h5>
                </div>
                <div class="col-sm-1 float-sm-right">
                    @if(auth()->user()->isAdmin())
                        <a href="{{route('users.create')}}">
                            <button class="btn btn-md btn-primary">Create</button>
                        </a>
                    @endif
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
