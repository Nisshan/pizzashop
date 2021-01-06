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
                <div class="mt-4 text-end">
                    <a href="{{route('cart.view')}}" class="btn btn-outline-dark rounded-0"><i
                            class="fa fa-chevron-left me-2"></i> Back to
                        cart</a>
                </div>
                <!-- Contact Details -->
                <form action="{{route('order')}}" id="payment-form" method="post">
                @csrf
                <!-- Contact Details -->
                    <h5 class="my-3">Billing Details</h5>

                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="emailAddress" placeholder="Email" required
                               name="email" value="{{old('email')}}">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" required
                               name="{{old('name')}}">
                    </div>


                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Address" name="address"
                               required value="{{old('address')}}">
                    </div>

                    <div class="row g-2">
                        <div class="col-12 col-md mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" placeholder="city" name="city" required
                                   value="{{old('city')}}">
                        </div>
                        <div class="col-12 col-md mb-3">
                            <label for="province" class="form-label">Province</label>
                            <input type="text" class="form-control" id="province" placeholder="Province" name="province"
                                   required value="{{old('province')}}">
                        </div>
                    </div>
                    <div class="row g-2 border-bottom">
                        <div class="col-12 col-md mb-3">
                            <label for="postalcode" class="form-label">Postal Code</label>
                            <input type="number" class="form-control" id="postalcode" placeholder="Postal Code"
                                   name="postalcode" required value="{{old('postalcode')}}">
                        </div>
                        <div class="col-12 col-md mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="phone" required
                                   name="phone" value="{{old('phone')}}">
                        </div>
                    </div>
                    <div class="form-group row border-bottom pb-4 mb-3">
                        <h4 class="col-md-4 col-form-label font-large fw-bold">
                            Service Type
                        </h4>
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="form-check col-md-4">
                                    <label class="form-check-label" for="pickup">
                                        <input class="form-check-input togglerHide" type="radio" name="serviceType"
                                               id="pickup" value="pickup" data-toShow="pickup" data-toHide="delivery"
                                               data-id="#pickup" checked/>
                                        <span> Pickup </span>
                                    </label>
                                </div>
                                <div class="form-check col-md-4">
                                    <label class="form-check-label" for="delivery">
                                        <input class="form-check-input togglerHide" type="radio" name="serviceType"
                                               id="delivery" value="delivery" data-toShow="delivery"
                                               data-toHide="pickup"
                                               data-id="#delivery"/>
                                        <span> Delivery</span>
                                    </label>
                                </div>
                                <!-- Delevery Option -->
                                <div class="delivery my-3 d-none">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Your Street Address"
                                               aria-label="Your Street Address" name="street_address"
                                               value="{{old('street_address')}}"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md mb-3 mb-md-0">
                                            <input type="text" class="form-control" placeholder="Optional"
                                                   name="optional" value="{{old('optional')}}"/>
                                        </div>
                                        <div class="col-12 col-md">
                                            <input type="text" class="form-control"
                                                   placeholder="Notes, Instruction, etc"
                                                   name="note" value="{{old('note')}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row border-bottom pb-4 mb-3">
                        <h4 for="staticEmail" class="col-md-4 col-form-label font-large fw-bold">
                            Delivery At
                        </h4>
                        <div class="col-md-8 ">
                            <div class="form-group row">
                                <div class="form-check col-md-4">
                                    <label class="form-check-label" for="asap">
                                        <input class="form-check-input togglerHide" type="radio" name="deliveryTime"
                                               id="asap" value="asap" data-toHide="scheduledDateTime" data-id="#asap"
                                               checked/>
                                        <span> ASAP </span>
                                    </label>
                                </div>

                                <div class="form-check col-md-4">
                                    <label class="form-check-label" for="scheduled">
                                        <input class="form-check-input togglerHide" type="radio" name="deliveryTime"
                                               id="scheduled" value="scheduled" data-toShow="scheduledDateTime"
                                               data-id="#scheduled"/>
                                        <span> Scheduled </span>
                                    </label>
                                </div>
                                <div class="scheduledDateTime py-3 d-none">
                                    <input id="datePicker" class="dateTimeFlatPicker form-control" type="text"
                                           placeholder="Select Date.." data-input name="delivery_date"
                                           value="{{old('delivery_date')}}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 mt-3">
                        <h5>Payment Details</h5>
                        <div class="mb-3">
                            <label for="name_on_card" class="form-label">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card"
                                   placeholder="Name On Card" value="{{old('name_on_card')}}">
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
                            <button type="submit" class="btn btn-warning mx-auto rounded-pill px-5 py-2 elevate-1"
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
                                <p class="font-medium mb-2">Total</p>
                                <p class="font-medium mb-2">{{$transaction['Subtotal']}}</p>
                            </div>
                            @if(session()->get('coupon'))
                                <div class="d-flex justify-content-between">
                                    <p class="font-medium mb-2">Discount

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
                                <p class="font-medium mb-2">Payable</p>
                                <p class="font-medium mb-2">${{$payable}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (function () {

            var stripe = Stripe('{{ config('services.stripe.key') }}');
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
                    hidePostalCode: true,
                }
            );

            card.mount('#card-element');


            card.on('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                    document.getElementById('complete-order').disabled = false;
                } else {
                    displayError.textContent = '';
                }
                {
                    empty: true
                }
            });

            card.on('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                    document.getElementById('complete-order').disabled = false;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');

            // Disable the submit button to prevent repeated clicks

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                document.getElementById('complete-order').disabled = true;

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
