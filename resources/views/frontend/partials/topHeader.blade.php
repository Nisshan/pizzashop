<div class="d-flex justify-content-between align-items-center py-2 px-3 bg-white border-bottom">
    <div class="col d-none d-md-block">
        <h6><a href="/login">Login</a> or <a href="/register">Sign-up</a></h6>
    </div>
    <figure class="m-0 col">
        <a href="/">
            <img class="logo img-fluid logo-large" src="{{asset('frontend/images/logo.jpg')}}"/>
        </a>
    </figure>
    <div class="position-relative">
        <a href="{{route('checkout')}}"
           class="btn btn-outline-dark d-flex align-items-center rounded-pill position-absolute checkout">
            Checkout
            <span class="bg-dark text-white ms-2">{{\Cart::count() ?: ""}}</span>
        </a>
    </div>
</div>
