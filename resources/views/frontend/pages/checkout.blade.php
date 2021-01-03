@extends('frontend.layouts.master')
@section('title', config('app.name'))

@section('css')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /**
         * The CSS shown here will not be introduced in the Quickstart guide, but shows
         * how you can use CSS to style your Element's container.
         */
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection

@section('content')
    <header class="fixed-top">
        @include('frontend.partials.secondaryHeader')
    </header>
    <section class="container-lg">
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
            <div class="col-12 col-md-6 pb-3 mb-md-0 pb-md-0">
                <!-- Contact Details -->
                <form action="{{route('order')}}" id="payment-form" method="post">
                @csrf
                <!-- Contact Details -->
                    <h5 class="my-3">Billing Details</h5>

                    {{--                    @if(!auth()->user())--}}

                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="emailAddress" placeholder="Email">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                    {{--                    @endif--}}

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Address" name="address">
                    </div>

                    <div class="row g-2">
                        <div class="col-12 col-md mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" placeholder="city" name="city">
                        </div>
                        <div class="col-12 col-md mb-3">
                            <label for="province" class="form-label">Province</label>
                            <input type="text" class="form-control" id="province" placeholder="Province"
                                   name="province">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-12 col-md mb-3">
                            <label for="postalcode" class="form-label">Postal Code</label>
                            <input type="number" class="form-control" id="postalcode" placeholder="Postal Code"
                                   name="postalcode">
                        </div>
                        <div class="col-12 col-md mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="phone">
                        </div>
                    </div>

                    <div class="row g-2 mt-3">
                        <h5>Payment Details</h5>
                        <div class="mb-3">
                            <label for="name_on_card" class="form-label">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card"
                                   placeholder="Name On Card">
                        </div>
                        <div class="col-12 col-md mb-3">
                            <label for="card-element">

                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>

                    <div class="col-12 text-center mb-4 order-box">
                        <div class="d-flex">
                            <button type="submit"
                                    class="btn btn-warning mx-auto rounded-pill px-5 py-2 elevate-1"
                                    id="complete-order">
                                ORDER NOW
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if($count)
                <div class="col-12 col-md-5 pb-3 mt-3 mt-md-0 ms-auto bg-gray-dark">
                    <div class="affix px-4 py-2">
                        <div class="">
                            <div class="mb-4">
                                <h5 class="f-family-2 text-start fw-normal text-dark">
                                    My Order
                                </h5>
                                <span class="seperator"></span>
                            </div>
                            @if($count)
                                @foreach($items as $key => $item)
                                    <div class="d-flex border-dark border-bottom pb-2 mb-2 align-items-center">
                                        <div class="d-flex flex-grow-1">
                                            <figure class="mb-0">
                                                <img class="img-60 obj-fit-cover" src="{{$item['image']}}">
                                            </figure>
                                            <div class="ms-2">
                                                <h5>{{$item['name']}}</h5>
                                                <span>$ {{$item['price']}}</span>
                                            </div>
                                        </div>
                                        <div class="">
                                            <span class="bg-light p-2 border">{{$item['quantity']}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="d-flex justify-content-between">
                                <p class="font-medium mb-2">{{$count}} {{ \Str::plural('Item', $count) }}</p>
                                <p class="font-medium mb-2">{{$transaction['Subtotal']}}</p>
                            </div>
                            @if(session()->get('coupon'))
                                <div class="d-flex justify-content-between">
                                    <form action="{{route('coupon.delete')}}">
                                        @csrf
                                        <p class="font-medium mb-2">Discount
                                            <button type="submit" class="btn btn-danger p-1 ms-3 ">
                                                <i class="fa fa-trash "></i>
                                            </button>
                                        </p>
                                    </form>
                                    <p class="font-medium mb-2">-${{$discount}}</p>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between">
                                    <p class="font-medium mb-2">Sub Total </p>
                                    <p class="font-medium mb-2">${{$newSubTotal}}</p>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between">
                                <p class="font-medium mb-2">Tax</p>
                                <p class="font-medium mb-2">{{$transaction['Tax']}}</p>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between border-bottom">
                                <p class="font-medium mb-2">TOTAL</p>
                                <p class="font-medium mb-2">${{$payable}}</p>
                            </div>
                        </div>
                        @if(!session()->get('coupon'))
                            <form action="{{route('coupon.store')}}" method="post">
                                @csrf
                                <div class="input-group my-3">
                                    <label for="cuponCode" class="form-label col-12 fw-bold">COUPON CODE</label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control rounded-0"
                                               aria-label="Coupon code input box"
                                               placeholder="Enter Coupon Code" id="cuponCode" name="coupon">
                                        <button type="submit" class="btn btn-dark rounded-0">APPLY</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function () {
            // Create a Stripe client.
            var stripe = Stripe('pk_test_51I4qgBG3cwW9OgFg6qGrwjfqL4pGXhT67QzQUidhvJekmmMnwWPkqVUy2jXkzDonLjd6m8cf0PIY4Y96uqqkC2e4006TtP0OQn');
            // Create an instance of Elements.
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Roboto","Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
            // Create an instance of the card Element.
            var card = elements.create('card',
                {
                    style: style,
                    hidePostalCode: true
                }
            );
            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.on('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            // Handle form submission.
            var form = document.getElementById('payment-form');

            // Disable the submit button to prevent repeated clicks
            document.getElementById('complete-order').disabled = true;


            form.addEventListener('submit', function (event) {
                event.preventDefault();
                var options = {
                    name: document.getElementById('name_on_card').value,
                    address_line1: document.getElementById('address').value,
                    address_city: document.getElementById('city').value,
                    address_state: document.getElementById('province').value,
                    address_zip: document.getElementById('postalcode').value
                }
                stripe.createToken(card, options).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                console.log(hiddenInput)
                // Submit the form
                form.submit();
            }
        })();
    </script>
@endpush
