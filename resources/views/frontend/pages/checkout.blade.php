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
            <div class="col-12 col-md-8 pb-3 mb-md-0 pb-md-0">
                <!-- Contact Details -->
                <form action="#"  id="payment_form">

                    @if(!auth()->user())
                        <div class="form-group row border-bottom pb-4 mb-3">
                            <h4 class="col-md-4 col-form-label font-large fw-bold">
                                Contact Details
                            </h4>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label" for="account">
                                            <input class="form-check-input togglerHide" type="radio" name="user-type"
                                                   id="account"
                                                   value="option1" data-toHide="guest" data-toShow="account"
                                                   data-id="#account"
                                                   checked/>
                                            <span class="font-medium"> Account </span>
                                        </label>
                                    </div>
                                    <div class="account my-3">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Enter your Email"
                                                   aria-label="Example text with two button addons" name="email"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label" for="guest">
                                            <input class="form-check-input togglerHide" type="radio" name="user-type"
                                                   id="guest"
                                                   value="option2" data-toShow="guest" data-toHide="account"
                                                   data-id="#guest"/>
                                            <span class="font-medium"> Guest </span>
                                        </label>
                                    </div>
                                    <div class="guest my-3 d-none">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="User Name"
                                                   aria-label="Your User Name"/>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Email"
                                                   aria-label="Your Email Address"/>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Phone Number"
                                                   aria-label="Your Phone Number"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row border-bottom pb-4 mb-3">
                        <h4 class="col-md-4 col-form-label font-large fw-bold">
                            Service Type
                        </h4>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="pickup">
                                        <input class="form-check-input togglerHide" type="radio" name="serviceType"
                                               id="pickup"
                                               value="pickup" data-toShow="pickup" data-toHide="delivery"
                                               data-id="#pickup"
                                               checked/>
                                        <span> Pickup </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="delivery">
                                        <input class="form-check-input togglerHide" type="radio" name="serviceType"
                                               id="delivery" value="option2" data-toShow="delivery" data-toHide="pickup"
                                               data-id="#delivery"/>
                                        <span> Delivery</span>
                                    </label>
                                </div>
                                <!-- Delevery Option -->
                                <div class="delivery my-3 d-none">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Your Street Address"
                                               aria-label="Your Street Address"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md mb-3 mb-md-0">
                                            <input type="text" class="form-control" placeholder="Apt #"/>
                                        </div>
                                        <div class="col-12 col-md">
                                            <input type="text" class="form-control"
                                                   placeholder="Notes, Instruction, etc"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row border-bottom pb-4 mb-3">
                        <h4 for="staticEmail" class="col-md-4 col-form-label font-large fw-bold">
                            Time
                        </h4>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="asap">
                                        <input class="form-check-input togglerHide" type="radio" name="deleveryTime"
                                               id="asap"
                                               value="1" data-toHide="scheduledDateTime" data-id="#asap" checked/>
                                        <span> ASAP </span>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label" for="scheduled">
                                        <input class="form-check-input togglerHide" type="radio" name="deleveryTime"
                                               id="scheduled" value="0" data-toShow="scheduledDateTime"
                                               data-id="#scheduled"/>
                                        <span> Scheduled </span>
                                    </label>
                                </div>
                                <div class="scheduledDateTime py-3 d-none">
                                    <input id="datePicker" class="dateTimeFlatPicker form-control" type="text"
                                           placeholder="Select Date.." data-input/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row border-bottom pb-4 mb-3">
                        <h4 for="staticEmail" class="col-md-4 col-form-label font-large fw-bold">
                            Payment
                        </h4>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" for="inPerson">
                                        <input class="form-check-input" type="radio" name="payment" id="inPerson"
                                               value="option1" checked/>
                                        <span> Pay in Person </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="withCard">
                                        <input class="form-check-input" type="radio" name="payment" id="withCard"
                                               value="option2"/>
                                        <span> Pay now with debit or credit card </span>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label for="card-element">

                                    </label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit"> submit</button>
                </form>

                <div class="form-group row pb-4">
                    <h4 for="staticEmail" class="col-md-4 col-form-label font-large fw-bold">
                        {{($count != 1)? 'My Orders' : 'My Order' }}
                    </h4>
                    <div class="col-md-8">
                        @if($count)
                            @foreach($items as $key => $item)
                                <div class="border-bottom pb-4 pt-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5>{{$item['name']}}</h5>
                                        <h6>$ {{ $item['quantity'] * $item['price']}}</h6>
                                    </div>
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
                                        <span class="h5 mb-0">{{$item['quantity']}}</span>
                                        <form action="{{route('increase.cart.quantity')}}" method="post">
                                            @csrf
                                            <input type="text" value="{{$key}}" name="index" hidden>
                                            <button type="submit"
                                                    class="border border-danger circle-30 p-3 d-flex align-items-center justify-content-center ms-3 hover-red">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </form>

                                        <form action="{{route('remove.cart.item',$key)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger p-1 ms-3 px-2">
                                                <i class="fa fa-trash pe-2"></i>Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Browse <a href="{{route('home')}}">Menu</a> to Order</p>
                        @endif
                    </div>
                </div>
            </div>
            @if($count)
                <div class="col-12 col-md-4 pb-3 mt-3 mt-md-0 ">
                    <div class="affix p-4 elevate-2 bg-gray-dark">
                        <div class="">
                            <div class="mb-4">
                                <h3 class="f-family-2 text-center fw-normal text-dark">
                                    {{\Str::plural('Order', $count)}} Detail
                                </h3>
                                <span class="seperator text-center mx-auto"></span>
                            </div>
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
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <p class="font-medium mb-2">Sub Total </p>
                                    <p class="font-medium mb-2">${{$newSubTotal}}</p>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between">
                                <p class="font-medium mb-2">Tax</p>
                                <p class="font-medium mb-2">{{$transaction['Tax']}}</p>
                            </div>
                            <hr>
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
    <div class="col-8 text-center mb-4 order-box">
        <div class="d-flex">
            <button type="submit" form="payment_form" class="btn btn-warning mx-auto rounded-pill px-5 py-2 elevate-1">
                ORDER NOW
            </button>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
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
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
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
            // form.submit();
        }
    </script>
@endpush
