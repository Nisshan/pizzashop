@extends('adminlte::page')

@section('title', $title ?? 'Orders')

@section('content')
    @include('shared.success')
    <div class="card">
        <div class="card-header card-primary">
            <div class="row">
                <div class="col-sm-11 card-title">
                    <h5 class="m-0 text-dark">{{ $title ?? 'Orders'}}</h5>
                </div>

            </div>
        </div>
        <div class="card-body table-responsive">
            {!! $dataTable->table(['class'=>'display','style'=>'width:100%']) !!}
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('changeStatus')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" hidden name="order_id" id="order_id">
                        <div class="form-group">
                            <select class="form-control" name="status" id="status">
                                @foreach(config('deliverystatus.status') as $key => $status)
                                    <option value="{{$key}}">{{str_replace('-', ' ', $key)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="priorityModal" tabindex="-1" role="dialog" aria-labelledby="priorityModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="priorityModalLabel">Change Priority</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('changePriority')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" hidden name="order" id="order">
                        <div class="form-group">
                            <select class="form-control" name="priority" id="priority">
                                @foreach(config('deliverystatus.priority') as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('admin/js/delete.js')}}"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $(document).ready(function () {

            $(document).on('click', '.change-status', function () {
                $('#status').val($(this).data('status'));
                $('#order_id').val($(this).data('id'));
            });

            $(document).on('click', '.change-priority', function () {
                $('#priority').val($(this).data('status'));
                $('#order').val($(this).data('id'));
            });

        });
    </script>
@endpush
