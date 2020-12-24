@extends('layouts.master')
@section('title', config('app.name'))

@section('content')
<header class="fixed-top">
    @include('partials.secondaryHeader')
</header>
<section class="container">
    <div class="row">
        <div class="col-12 col-md-8 mb-5 pb-5 mb-md-0 pb-md-0">
            <!-- Contact Details -->
            <div class="form-group row border-bottom pb-4 mb-3">
                <h4 class="col-md-4 col-form-label font-large fw-bold">
                    Contact Details
                </h4>
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label" for="account">
                                <input class="form-check-input togglerHide" type="radio" name="user-type" id="account"
                                    value="option1" data-toHide="guest" data-toShow="account" data-id="#account"
                                    checked />
                                <span class="font-medium"> Account </span>
                            </label>
                        </div>
                        <div class="account my-3">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Phone Number"
                                    aria-label="Example text with two button addons" />
                                <button class="btn btn-outline-secondary" type="button">
                                    Login
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label" for="guest">
                                <input class="form-check-input togglerHide" type="radio" name="user-type" id="guest"
                                    value="option2" data-toShow="guest" data-toHide="account" data-id="#guest" />
                                <span class="font-medium"> Guest </span>
                            </label>
                        </div>
                        <div class="guest my-3 d-none">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="User Name"
                                    aria-label="Your User Name" />
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Email"
                                    aria-label="Your Email Address" />
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Phone Number"
                                    aria-label="Your Phone Number" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row border-bottom pb-4 mb-3">
                <h4 class="col-md-4 col-form-label font-large fw-bold">
                    Service Type
                </h4>
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label" for="pickup">
                                <input class="form-check-input togglerHide" type="radio" name="serviceType" id="pickup"
                                    value="pickup" data-toShow="pickup" data-toHide="delevery" data-id="#pickup"
                                    checked />
                                <span> Pickup </span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="delevery">
                                <input class="form-check-input togglerHide" type="radio" name="serviceType"
                                    id="delevery" value="option2" data-toShow="delevery" data-toHide="pickup"
                                    data-id="#delevery" />
                                <span> Delevery</span>
                            </label>
                        </div>
                        <!-- Delevery Option -->
                        <div class="delevery my-3 d-none">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter Your Street Address"
                                    aria-label="Your Street Address" />
                            </div>
                            <div class="row">
                                <div class="col-12 col-md mb-3 mb-md-0">
                                    <input type="text" class="form-control" placeholder="Apt #" />
                                </div>
                                <div class="col-12 col-md">
                                    <input type="text" class="form-control" placeholder="Notes, Instruction, etc" />
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
                                <input class="form-check-input togglerHide" type="radio" name="deleveryTime" id="asap"
                                    value="1" data-toHide="scheduledDateTime" data-id="#asap" checked />
                                <span> ASAP </span>
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label" for="scheduled">
                                <input class="form-check-input togglerHide" type="radio" name="deleveryTime"
                                    id="scheduled" value="0" data-toShow="scheduledDateTime" data-id="#scheduled" />
                                <span> Scheduled </span>
                            </label>
                        </div>
                        <div class="scheduledDateTime py-3 d-none">
                            <input id="datePicker" class="dateTimeFlatPicker form-control" type="text"
                                placeholder="Select Date.." data-input />
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
                                    value="option1" checked />
                                <span> Pay in Person </span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="withCard">
                                <input class="form-check-input" type="radio" name="payment" id="withCard"
                                    value="option2" />
                                <span> Pay now with debit or credit card </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row pb-4">
                <h4 for="staticEmail" class="col-md-4 col-form-label font-large fw-bold">
                    My Order
                </h4>
                <div class="col-md-8">
                    <div class="border-bottom pb-4 pt-3">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Cup & Crisp Pepperoni Duo</h5>
                            <h6>$ 24.00</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="#"
                                class="border border-danger circle-30 p-3 d-flex align-items-center justify-content-center me-3 hover-red">
                                <i class="fa fa-minus"></i>
                            </a>
                            <span class="h5 mb-0">5</span>
                            <a href="#"
                                class="border border-danger circle-30 p-3 d-flex align-items-center justify-content-center ms-3 hover-red">
                                <i class="fa fa-plus"></i>
                            </a>
                            <a href="#" class="btn btn-danger p-1 ms-3 px-2">
                                <i class="fa fa-trash pe-2"></i>Delete
                            </a>
                        </div>
                    </div>
                    <div class="border-bottom pb-4 pt-3">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Cheezee Bacon Rolls</h5>
                            <h6>$ 30.00</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="#"
                                class="border border-danger circle-30 p-3 d-flex align-items-center justify-content-center me-3 hover-red">
                                <i class="fa fa-minus"></i>
                            </a>
                            <span class="h5 mb-0">2</span>
                            <a href="#"
                                class="border border-danger circle-30 p-3 d-flex align-items-center justify-content-center ms-3 hover-red">
                                <i class="fa fa-plus"></i>
                            </a>
                            <a href="#" class="btn btn-danger p-1 ms-3 px-2">
                                <i class="fa fa-trash pe-2"></i>Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 pb-3 mt-3 mt-md-0 d-none d-md-block">
            <div class="affix p-4 elevate-2 bg-gray-dark">
                <div class="mb-4">
                    <h3 class="f-family-2 text-center fw-normal text-dark">
                        Order Detail
                    </h3>
                    <span class="seperator text-center mx-auto"></span>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="font-medium mb-2">24 Items</p>
                    <p class="font-medium mb-2">240.00</p>
                </div>
                <div class="d-flex justify-content-between border-bottom mb-2">
                    <p class="font-medium mb-2">Discount</p>
                    <p class="font-medium mb-2">240.00</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="font-medium mb-2">Tax</p>
                    <p class="font-medium mb-2">-</p>
                </div>
                <div class="d-flex justify-content-between border-bottom">
                    <p class="font-medium mb-2">TOTAL</p>
                    <p class="font-medium mb-2">$ 300</p>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-warning mx-auto rounded-pill px-4 py-2 elevate-1">
                        ORDER NOW
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="col-8 text-center mb-4 order-box">
    <button class="btn btn-warning mx-auto rounded-pill px-5 py-2 elevate-1">
        ORDER NOW
    </button>
</div>

@endsection
