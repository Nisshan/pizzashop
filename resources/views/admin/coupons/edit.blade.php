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
                        <li class="breadcrumb-item">Update</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('coupons.update',[$coupon])}}" method="POST">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="name">Coupon Code: <span class="required-form">*</span></label>
                    <input type="text" name="code" id="code" autofocus required
                           class="form-control  @error('code') is-invalid @enderror"
                           placeholder="Coupon code" value="{{$coupon->code}}">

                    @error('name')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="mb-3">
                        <b>Type: <span class="required-form">*</span></b>
                    </div>
                    <label>
                        <input type="radio" name="type"
                               value="fixed" {{$coupon->type == 'fixed' ? 'checked' : ''}}
                        > &nbsp; Fixed
                    </label> &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="type" value="percent" {{$coupon->type == 'percent' ? 'checked' : ''}}
                        > &nbsp; Percentage
                    </label> &nbsp;
                </div>

                <div class="form-group percentage" style="display:none;" id="percentage">
                    <label for="percent_off">Percent Off: <span class="required-form">*</span></label>
                    <input type="number" min="1" max="100" class="form-control" name="percent_off"
                           id="percentage_reset" value="{{$coupon->percent_off}}">
                </div>

                <div class="form-group amount" style="display:none;" id="amount">
                    <label for="value">Value: <span class="required-form">*</span></label>
                    <input type="number" min="1" class="form-control" name="value" id="value" required
                           value="{{$coupon->value}}">
                </div>


                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let type = "{{$coupon->type}}"

        if (type === 'fixed') {
            $('#amount').show();
            $('#percentage').hide()
            $('#value').attr('required', true);
            $('#percentage_reset').attr('required', false);
        } else {
            $('#percentage').show();
            $('#amount').hide();
            $('#value').attr('required', false);
            $('#percentage_reset').attr('required', true);
        }


        $(document).ready(function () {
            $("input[name$='type']").click(function () {
                if ($(this).val() === 'fixed') {
                    $('#amount').show();
                    $('#percentage').hide()
                    $('#value').attr('required', true);
                    $('#percentage_reset').attr('required', false);
                    $('#percentage_reset').val("")
                } else {
                    $('#percentage').show();
                    $('#amount').hide();
                    $('#value').attr('required', false);
                    $('#percentage_reset').attr('required', true);
                    $('#value').val("")

                }
            });
        })
    </script>
@endpush


