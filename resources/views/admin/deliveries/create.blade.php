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
            <form action="{{ route('deliveries.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="delivery_type">Delivery Type<span class="required-form">*</span></label>
                    <input type="text" name="delivery_type" id="delivery_type" autofocus required
                           class="form-control  @error('delivery_type') is-invalid @enderror"
                           placeholder="Delivery Type" value="{{old('delivery_type')}}">

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
                               value="1" checked
                        > &nbsp; Yes
                    </label> &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="chargeable" value="0"
                        > &nbsp; No
                    </label> &nbsp;
                </div>

                <div class="form-group charge"  id="chargeable">
                    <label for="charge">Price : <span class="required-form">*</span></label>
                    <input type="text"  class="form-control" name="price"
                           id="charge" value="{{old('price')}}" required>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            $("input[name$='chargeable']").click(function () {
                console.log($(this).val())
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



