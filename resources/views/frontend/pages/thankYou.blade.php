@extends('frontend.layouts.master')
@section('title', config('app.name'))

@section('content')
<header class="fixed-top">
    @include('frontend.partials.secondaryHeader')
</header>

<section class="container" style="height: 60vh">
    <div class="row mt-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check-circle"
            viewBox="0 0 16 16" style="fill: #bb461c">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path
                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
        </svg>
        <h1 class="text-center w-100 text-secondary mt-3 f-family-2">
            Thank You
        </h1>
        <p class="mx-auto col-12 col-md-7 text-center">We have receiced your order. Your order will be delevered soon.
        </p>
        <div class="w-100 text-center ">
            <a href="/" class="btn btn-outline-dark rounded-pill py-2 px-4">Continue Shopping</a>
        </div>
    </div>
</section> @endsection