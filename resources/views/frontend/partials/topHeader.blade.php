<div class="d-flex justify-content-between align-items-center py-2 px-3 bg-white border-bottom">

    <div class="col d-none d-md-block">
        @guest
        <h6>
            <a class="btn btn-primary" href="/login">Login</a>
            <a class="btn btn-outline-dark" href="/register">Sign up</a>
        </h6>
        @endguest
    </div>

    <figure class="m-0 col">
        <a href="/">
            <img class="logo img-fluid logo-large" src="{{asset("/images/logo.png")}}" />
        </a>
    </figure>
    @if(count( cart()->items()))
    <div class="position-relative">
        <a href="{{route('cart.view')}}"
            class="btn btn-outline-dark d-flex align-items-center rounded-pill position-absolute checkout">
            Checkout
            <span class="bg-dark text-white ms-2">{{count( cart()->items()) ?: ""}}</span>
        </a>
    </div>
    @endif
</div>
