@extends('frontend.layouts.master')
@section('title', config('app.name'))

@section('content')
    <header class="fixed-top">
        @include('frontend.partials.secondaryHeader')
    </header>
    <section class="container-xl">
        @if(session()->has('success'))
            <div
                class="alert alert-primary alert-dismissible fade show border-0 border-3 border-start border-danger position-fixed bottom-0 end-0"
                role="alert" data-bs-autohide="true">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        <div class="row">
            <h5 class="text-center py-3">Shopping Cart</h5>
            <div class="col-12">
                <div class="border-top pt-3 overflow-x">
                    <table class="table overflow-x">
                        <tbody>
                        @if($count)
                            @foreach($items as $key => $item)
                                <tr>
                                    <th scope="row" class="d-flex">
                                        <figure class="mb-0 me-2">
                                            <img class="img-small obj-fit-cover" src="{{$item['image']}}" alt=""/>
                                        </figure>
                                        <div>
                                            <h6>{{$item['name']}}</h6>

                                            <div>
                                                <form action="{{route('remove.cart.item',$key)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger p-1 px-2">
                                                        <i class="fa fa-trash pe-2"></i>Remove
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </th>
                                    {{-- @if(session()->get('coupon')) --}}
                                    {{-- @endif --}}

                                    <td>$ {{$item['price']}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <form action="{{route('decrease.cart.quantity')}}" method="post">
                                                @csrf
                                                <input type="text" value="{{$key}}" name="index" hidden>
                                                <button type="submit"
                                                        class="border  circle-30 p-3 d-flex align-items-center justify-content-center me-3 @if($item['quantity'] > 1) border-danger hover-red @endif "
                                                        @if($item['quantity'] < 2) disabled @endif>
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </form>

                                            <span class="h5 mb-0 px-3">{{$item['quantity']}}</span>
                                            <form action="{{route('increase.cart.quantity')}}" method="post">
                                                @csrf
                                                <input type="text" value="{{$key}}" name="index" hidden>
                                                <button type="submit"
                                                        class="border border-danger circle-30 p-3 d-flex align-items-center justify-content-center ms-3 hover-red">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>$ {{ $item['quantity'] * $item['price']}}</td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-6 mx-auto">
                @if(!session()->get('coupon'))
                    <form action="{{route('coupon.store')}}" method="post">
                        @csrf
                        <div class="input-group my-3">
                            <label for="cuponCode" class="form-label col-12 fw-bold">COUPON CODE</label>
                            <div class="d-flex">
                                <input type="text" class="form-control rounded-0" aria-label="Coupon code input box"
                                       placeholder="Enter Coupon Code" id="cuponCode" name="coupon">
                                <button type="submit" class="btn btn-dark rounded-0">APPLY</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>

            <div class="col-12 pb-3 mt-3 mt-md-0">
                <div class="col-md-6 bg-gray-dark border p-2 mx-auto border-top border-secondary border-1 border-0">
                    <div class="col-6 d-flex ms-auto">
                        <p class="flex-grow-1 fw-bold mb-1">Total</p>
                        <p class="flex-shrink-1 mb-1"> {{$transaction['Subtotal']}}</p>
                    </div>
                    <div class="col-6 d-flex ms-auto">
                        <p class="flex-grow-1 fw-bold mb-1">TAX(13%)</p>
                        <p class="flex-shrink-1 mb-1"> {{$transaction['Tax']}}</p>
                    </div>
                    @if(session()->get('coupon'))
                        <div class="col-6 ms-auto mb-3">
                            <form action="{{route('coupon.delete')}}" class="d-flex ">
                                @csrf
                                <p class="flex-grow-1 fw-bold mb-1">Discount
                                    <button type="submit"
                                            class="btn btn-danger p-1 ms-3 flex-shrink-1">
                                        <i class="fa fa-trash "></i>
                                    </button>
                                </p>
                                <p class="font-medium mb-2">-${{$discount}}</p>
                            </form>
                        </div>
                        <hr class="my-2">
                        <div class="col-6 d-flex ms-auto">
                            <p class="flex-grow-1 fw-bold mb-1">Sub Total </p>
                            <p class="flex-shrink-1 mb-1">${{$newSubTotal}}</p>
                        </div>
                    @endif
                    <div class="col-6 d-flex ms-auto">
                        <p class="flex-grow-1 fw-bold mb-1">Payable</p>
                        <p class="flex-shrink-1 mb-1">${{$payable}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/" class="btn btn-outline-dark rounded-0">Continue Shopping</a>
                        <a href="{{route('checkout')}}" class="btn btn-secondary rounded-0">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
