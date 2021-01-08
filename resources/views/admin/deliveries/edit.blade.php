@extends('adminlte::page')

@section('title',isset($title) ? $title : '' )

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
                        <li class="breadcrumb-item"><a href="{{route('deliveries.index')}}">Deliveries Types</a>
                        </li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('deliveries.update', $delivery)}}" method="POST">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="name">Delivery Type<span class="required-form">*</span></label>
                    <input type="text" name="delivery_type" id="delivery_type" autofocus required
                           class="form-control  @error('delivery_type') is-invalid @enderror"
                           placeholder="Delivery Type" value="{{$delivery->delivery_type}}">

                    @error('name')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="mb-3">
                        <b>Chargeable: <span class="required-form">*</span></b>
                    </div>
                    <label>
                        <input type="radio" name="chargeable"
                               value="1"   @if($delivery->chargeable == true) checked @endif
                        > &nbsp; Yes
                    </label> &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="chargeable" value="0"  @if($delivery->chargeable == false) checked @endif
                        > &nbsp; No
                    </label> &nbsp;
                </div>

                <div class="form-group charge" id="chargeable">
                    <label for="charge">Price : <span class="required-form">*</span></label>
                    <input type="text" min="1" max="100" class="form-control" name="price"
                           id="charge" value="{{$delivery->price}}">
                </div>


                <div class="form-group">
                    <div class="mb-3">
                        <b>Status</b>
                    </div>
                    <label>
                        <input type="radio" name="status"
                               value="1"
                               @if($delivery->status == true) checked @endif
                        > &nbsp; Active
                    </label> &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="status" value="0"
                               @if($delivery->status == false) checked @endif
                        > &nbsp; Inactive
                    </label> &nbsp;
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        let chargeable =  "{{$delivery->chargeable ? '1' : '0' }}"

        if (chargeable === '1') {
            $('#chargeable').show();
            $('#charge').attr('required', true);
        } else {
            $('#chargeable').hide();
            $('#charge').attr('required', false);

        }

        $(document).ready(function () {
            $("input[name$='chargeable']").click(function () {
                if ($(this).val() === '1') {
                    $('#chargeable').show();
                    $('#charge').attr('required', true);
                } else {
                    $('#chargeable').hide();
                    $('#charge').attr('required', false);
                    $('#charge').val("")
                }
            });
        })
    </script>
@endpush



