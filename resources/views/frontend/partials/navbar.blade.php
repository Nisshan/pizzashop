<nav class="navbar navbar-expand-lg navbar-light bg-white p-0 border-bottom justify-content-end">
    <div class="container-fluid w-100">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto col-11 overflow-hidden text-center justify-content-center custom-scrollbar">
                <div class="nav-scroller bg-transparent">
                    <nav class="nav-scroller-nav mx-auto custom-scrollbar" id="main-nav">
                        <div class="nav-scroller-content mx-auto align-items-center">
                            @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link nav-scroller-item hoverable-nav py-3 m-0 font-medium border-right-0"
                                       aria-current="page" href="#{{$category->slug}}">{{$category->name}}</a>
                                </li>
                            @endforeach
                        </div>
                    </nav>

                    <button class="nav-scroller-btn nav-scroller-btn--left elevate-1" aria-label="Scroll left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </button>

                    <button class="nav-scroller-btn nav-scroller-btn--right elevate-1" aria-label="Scroll right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>
            </ul>

            @auth
                @if(auth()->user()->isUser())
                    <div class="nav-item dropdown col">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                           role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <figure class="circle-medium overflow-hidden mb-0 me-2">
                                <img class="img-fluid" src="{{asset('frontend/images/male.png')}}"/>
                            </figure>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-0 px-2" aria-labelledby="navbarDropdown">
                            <a href="{{route('user.profile')}}" class="dropdown-item px-3" title="View Profile">
                                <div class="d-flex space-between min-w-200 py-2">
                                    <figure class="circle-medium overflow-hidden mb-0 me-3">
                                        <img class="img-fluid" src="{{asset('frontend/images/male.png')}}"/>
                                    </figure>
                                    <div>
                                        <h6 class="mb-0">{{auth()->user()->name}}</h6>
                                        <span class="font-small text-muted">View Profile</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            @if(count( cart()->items()))
                                <a class="dropdown-item px-3 py-2" href="{{route('cart.view')}}">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-cart-plus font-xl me-3 text-muted"></i>
                                        <span class="font-1">My Cart</span>
                                    </div>
                                </a>
                            @endif
                            <a class="dropdown-item px-3 py-2" href="{{route('user.profile')}}">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-edit me-3 font-xl text-muted"></i>
                                    <span class="font-1">Edit My Details</span>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{'/logout'}}" method="post">
                                @csrf
                                <a class="dropdown-item px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-sign-out me-3 font-xl text-muted"></i>
                                        <button class="btn btn-primary font-1">Logout</button>
                                    </div>
                                </a>
                            </form>

                        </ul>
                    </div>
                @endif
            @endauth
        </div>
        @auth
            @if(auth()->user()->isUser())
                <ul class="navbar-nav ml-auto"></ul>
            @endif
        @endauth
    </div>
</nav>
