<nav class="navbar navbar-expand-lg navbar-light bg-white p-0 border-bottom justify-content-end">
    <div class="container-fluid w-100">
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mx-auto" id="main-nav">
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link hoverable-nav py-3 font-medium" aria-current="page"
                           href="#{{$category->slug}}">{{$category->name}}</a>
                    </li>
                @endforeach
            </ul>

            @auth
                @if(auth()->user()->isUser())
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                           role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <figure class="circle-medium overflow-hidden mb-0 me-2">
                                <img class="img-fluid" src="{{asset('frontend/images/male.png')}}"/>
                            </figure>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-0 px-2" aria-labelledby="navbarDropdown">
                            <a href="#" class="dropdown-item px-3" title="View Profile">
                                <div class="d-flex space-between min-w-200 py-2">
                                    <figure class="circle-medium overflow-hidden mb-0 me-3">
                                        <img class="img-fluid" src="{{asset('frontend/images/male.png')}}"/>
                                    </figure>
                                    <div>
                                        <h6 class="mb-0">John Doe</h6>
                                        <span class="font-small text-muted">View Profile</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item px-3 py-2" href="#">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-cart-plus font-xl me-3 text-muted"></i>
                                    <span class="font-1">My Cart</span>
                                </div>
                            </a>
                            <a class="dropdown-item px-3 py-2" href="#">
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
