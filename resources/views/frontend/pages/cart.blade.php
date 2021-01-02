@extends('frontend.layouts.master')
@section('title', config('app.name'))

@section('content')
<header class="fixed-top">
    @include('frontend.partials.secondaryHeader')
</header>
<section class="container-xl">
    <div class="row">
        <h5 class="text-center py-3">Shopping Cart</h5>
        <div class="col-12">
            <div class="border-top pt-3">
                <table class="table overflow-x">
                    <tbody>
                        <tr>
                            <th scope="row" class="d-flex">
                                <figure class="mb-0 me-2">
                                    <img class="img-small obj-fit-cover" src="https://picsum.photos/800/800" alt="" />
                                </figure>
                                <div>
                                    <h6>Curry Veggie Delight</h6>
                                    <div>
                                        <button type="submit" class="btn btn-danger p-1 px-2 rounded-0">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </th>
                            <td>$ 10.00</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button
                                        class="border circle-30 p-2 d-flex align-items-center justify-content-center me-1 border-danger hover-red ">
                                        <i class="fa fa-minus"></i>
                                    </button>

                                    <span class="h5 mb-0 px-3">5</span>
                                    <button
                                        class="border border-danger circle-30 p-2 d-flex align-items-center justify-content-center ms-1 hover-red">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td>$ 50</td>
                        </tr>
                        <tr>
                            <th scope="row" class="d-flex">
                                <figure class="mb-0 me-2">
                                    <img class="img-small obj-fit-cover" src="https://picsum.photos/800/800" alt="" />
                                </figure>
                                <div>
                                    <h6>Curry Veggie Delight</h6>

                                    <div>
                                        <button type="submit" class="btn btn-danger p-1 px-2 rounded-0">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </th>
                            <td>$ 10.00</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button type="submit"
                                        class="border circle-30 p-2 d-flex align-items-center justify-content-center me-1 border-danger hover-red ">
                                        <i class="fa fa-minus"></i>
                                    </button>

                                    <span class="h5 mb-0 px-3">5</span>
                                    <button type="submit"
                                        class="border border-danger circle-30 p-2 d-flex align-items-center justify-content-center ms-1 hover-red">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td>$ 30</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div
            class="col-12 col-md-6 pb-3 mt-3 mt-md-0 bg-gray-dark border p-2 mx-auto border-top border-secondary border-1 border-0">
            <div class="">
                <div class="col-6 d-flex ms-auto">
                    <p class="flex-grow-1 fw-bold mb-1">SUBTOTAL</p>
                    <p class="flex-shrink-1 mb-1"> $ 1000</p>
                </div>
                <div class="col-6 d-flex ms-auto">
                    <p class="flex-grow-1 fw-bold mb-1">TAX(13%)</p>
                    <p class="flex-shrink-1 mb-1"> $ 1000</p>
                </div>
                <div class="col-6 d-flex ms-auto">
                    <p class="flex-grow-1 fw-bold mb-1">TOTAL</p>
                    <p class="flex-shrink-1 mb-1"> $ 1300</p>
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