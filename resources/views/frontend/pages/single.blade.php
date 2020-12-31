@extends('frontend.layouts.master')
@section('title', config('app.name'))

@section('content')
    <header class="fixed-top">
        @include('frontend.partials.topHeader')
    </header>

    @if(session()->has('success'))
        <div
            class="alert alert-primary alert-dismissible fade show border-0 border-3 border-start border-primary position-fixed bottom-0 end-0"
            role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <section class="container mt-5 pb-4">
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <ul id="imageGallery">
                    @if($product->images_count > 0)
                        @foreach($product->images as $image)
                            <li class="text-center" data-thumb="{{$image->thumbPath()}}" data-src="{{$image->path()}}">
                                <img class="img-fluid h-400 mx-auto" src="{{$image->path()}}"/>
                            </li>
                        @endforeach
                    @else
                        <li class="text-center" data-thumb="{{$product->getPath()}}" data-src="{{$product->getPath()}}">
                            <img class="img-fluid h-400" src="{{$product->getPath()}}"/>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-7">
                <h3 class="fw-light text-dark mb-4">{{$product->name}}</h3>

                @if($product->has_offer)
                    <h2 class="mb-3">
                        <strike>$ <span id="price" class="weight-400">{{$product->price}}</span></strike>
                        $ <span id="price" class="weight-400">{{$product->getPrice()}}</span>
                    </h2>
                @else
                    <h2 class="mb-3">
                        $ <span id="price" class="weight-400">{{$product->price}}</span>
                    </h2>
                @endif

                <p class="mb-2 text-secondary font-medium fw-light">
                    {{$product->description}}
                </p>
                <form action="{{route('cart')}}" method="post">
                    @csrf
                    <input type="number" hidden value="{{$product->id}}" name="product_id">
                    <hr/>

                    <div class="w-100">
                        <button type="submit" class="btn btn-danger dark-red  font-1 fw-bold border-0 elevate-1 "
                                style="padding: 0.6em 3em">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                 style="fill: #fff">
                                <path
                                    d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 18l1.529-13h2.222v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h2.222l1.529 13h-15.502z"/>
                            </svg>
                            Add to Cart
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
