@extends('frontend.layouts.master')
@section('title', config('app.name'))
@section('content')

<header class="fixed-top">
    @include('frontend.partials.topHeader')
    @include('frontend.partials.navbar')
</header>

{{-- Navbar with Profile for Mobile View Only --}}
@auth
@if(auth()->user()->isUser())
<div class="d-flex justify-content-end w-100 border-bottom d-block d-lg-none mt-4 pt-2">
    <div class="dropdown">
        <button class="dropdown-toggle bg-transparent border-0 d-flex align-items-center py-2" type="button"
            id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
            <figure class="circle-medium overflow-hidden mb-0 me-2">
                <img class="img-fluid" src="{{asset('frontend/images/male.png')}}" />
            </figure>
        </button>
        <ul class="dropdown-menu dropdown-menu-end mt-0 px-2" aria-labelledby="navbarDropdown">
            <a href="./profile.html" class="dropdown-item px-3" title="View Profile">
                <div class="d-flex space-between min-w-200 py-2">
                    <figure class="circle-medium overflow-hidden mb-0 me-3">
                        <img class="img-fluid" src="{{asset('frontend/images/male.png')}}" />
                    </figure>
                    <div>
                        <h6 class="mb-0">John Doe</h6>
                        <span class="font-small text-muted">View Profile</span>
                    </div>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item px-3 py-2" href="./checkout.html">
                <div class="d-flex align-items-center">
                    <i class="fa fa-cart-plus font-xl me-3 text-muted"></i>
                    <span class="font-1">My Cart</span>
                </div>
            </a>
            <a class="dropdown-item px-3 py-2" href="./profile.html">
                <div class="d-flex align-items-center">
                    <i class="fa fa-edit me-3 font-xl text-muted"></i>
                    <span class="font-1">Edit My Details</span>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item px-3 py-2" href="">
                <div class="d-flex align-items-center">
                    <i class="fa fa-sign-out me-3 font-xl text-muted"></i>
                    <span class="font-1">Logout</span>
                </div>
            </a>
        </ul>
    </div>
</div>
@endif
@endauth

@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show border-0 border-3 border-start border-danger position-fixed bottom-0 end-0"
    role="alert" data-bs-autohide="true">
    {{ session()->get('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>
@endif

@foreach($categories as $key => $category)
<section class="container mt-2 @if($key == 0) pt-3 pt-lg-5 mt-lg-5 @endif" id="{{$category->slug}}">
    <div class="mb-4 pt-4">
        <h3 class="f-family-2">{{$category->name}}</h3>
        <span class="seperator my-2"></span>
    </div>
    <div class="row">
        @foreach($category->products as $product)
        <div class="col-6 col-md-4 mb-5">
            <div class="elevate-2 rounded h-250 position-relative single-item">
                @if($product->has_offer)
                @if($product->offer_type == 1)
                <div class="ribbon">
                    <span>{{$product->percent_off}}% OFF</span>
                </div>
                @else
                <div class="ribbon">
                    <span>${{$product->amount_off}} OFF</span>
                </div>
                @endif
                @endif
                <a href="{{ route('single',[$category, $product]) }}" title="{{$product->name}}">
                    <figure>
                        <img class="w-100 h-250 obj-fit-cover" src="{{$product->getPath()}}" alt="" />
                    </figure>
                </a>
                <div class="title-box">
                    <h5 class="f-family-2 text-center">{{$product->name}}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endforeach
@endsection