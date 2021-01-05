@extends('frontend.layouts.master')
@section('title', config('app.name'))
@section('content')

    <header class="fixed-top">
        @include('frontend.partials.secondaryHeader')
    </header>
    @include('shared.error-bag')
    @include('shared.success')
    <section class="container-xl px-4 mx-auto mt-5">
        <div class="row">
            <div class="col-12 col-md-9 pl-3 mb-2 elevate-1 p-0 rounded mx-auto">
                <div class="p-3 bg-primary">
                    <h5 class="mb-0 text-light">Order Number {{$order->id}}</h5>
                </div>
                <div class="px-3 pt-2">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th scope="row">Billing Name</th>
                            <td>{{$order->billing_name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Billing Email</th>
                            <td>{{$order->billing_email}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Billing Address</th>
                            <td>{{$order->billing_address}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Billing City</th>
                            <td>{{$order->billing_city}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Billing Province</th>
                            <td>{{$order->billing_province}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Billing Postalcode</th>
                            <td>{{$order->billing_postalcode}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Billing Phone</th>
                            <td>{{$order->billing_phone}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Billing Name on Card</th>
                            <td>{{$order->billing_name_on_card}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Billing Discount</th>
                            <td>{{$order->billing_discount == 0 ? 'No DIscount' : $order->billing_discount}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Billing Subtotal</th>
                            <td> ${{$order->billing_subtotal}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Billing Tax</th>
                            <td>${{$order->billing_tax}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Service Type</th>
                            <td>{{$order->service_type}}</td>
                        </tr>
                        @if($order->service_type != 'pickup')
                            <tr>
                                <th scope="row">street_address</th>
                                <td>{{$order->street_address}}</td>
                            </tr>
                            <tr>
                                <th scope="row">optional</th>
                                <td>{{$order->optional}}</td>
                            </tr>

                            <tr>
                                <th scope="row">Note</th>
                                <td>{{$order->note}}</td>
                            </tr>
                        @endif

                        <tr>
                            <th scope="row">deliveryTime</th>
                            <td>{{$order->deliveryTime}}</td>
                        </tr>

                        <tr>
                            <th scope="row">delivery_date</th>
                            <td>{{$order->delivery_date}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Error</th>
                            <td>{{isset($order->error) ? $order->error : 'No Error'}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex px-3 py-2 border-top">
                    <a href="{{\url()->previous()}}" class="btn btn-secondary rounded-0 me-2">Back</a>
                    <a href="/" class="btn btn-outline-dark rounded-0">Back to Home</a>

                </div>
            </div>
        </div>
    </section>

@endsection
