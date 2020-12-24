@extends('frontend.layouts.master')
@section('title', config('app.name'))
@section('content')

    <header class="fixed-top">
        @include('frontend.partials.topHeader')
        @include('frontend.partials.navbar')
    </header>

    {{-- Navbar with Profile for Mobile View Only --}}
    <div class="d-flex justify-content-end w-100 border-bottom d-block d-lg-none">
        <div class="dropdown">
            <button class="dropdown-toggle bg-transparent border-0 d-flex align-items-center py-2" type="button"
                    id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                <figure class="circle-medium overflow-hidden mb-0 me-2">
                    <img class="img-fluid" src="{{asset('frontend/images/male.png')}}"/>
                </figure>
            </button>
            <ul class="dropdown-menu dropdown-menu-end mt-0 px-2" aria-labelledby="navbarDropdown">
                <a href="./profile.html" class="dropdown-item px-3" title="View Profile">
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



    @foreach($categories as $key => $category)

            <section class="container mt-2 @if($key == 0) mt-lg-5 @endif" id="{{$category->slug}}">
                <div class="mb-4 pt-4">
                    <h3 class="f-family-2">{{$category->name}}</h3>
                    <span class="seperator my-2"></span>
                </div>
                <div class="row">
                    @foreach($category->products as  $product)
                    <div class="col-6 col-md-4 mb-5">
                        <div class="elevate-2 rounded h-250 overflow-hidden">
                            <a href="{{ route('single',[$category, $product]) }}" title="{{$product->name}}">
                                <figure>
                                    <img class="w-100 h-250 obj-fit-cover"
                                         src="{{$product->getPath()}}"
                                         alt=""/>
                                </figure>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
    @endforeach
    {{--    <section id="pizza" class="container mt-3 ">--}}
    {{--        <div class="mb-4 pt-2">--}}
    {{--            <h3 class="f-family-2">Pizza</h3>--}}
    {{--            <span class="seperator my-2"></span>--}}
    {{--        </div>--}}

    {{--        <div class="row">--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}" title="Pizza">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://c1.tchpt.com/admin/aux?b=c1~4066c4e45b62c35f92d362574ab3a0c91&a=c1~839&f=BaconRoll_TPMenuImage_400x300__2020-10-15_21-14-13.jpg"--}}
    {{--                                 alt="" />--}}
    {{--                        </figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://c1.tchpt.com/admin/aux?b=c1~4066c4e45b62c35f92d362574ab3a0c91&a=c1~748&f=BaconChickenSupreme_TPImage_400x300__2020-11-30_18-41-06.jpg"--}}
    {{--                                 alt="" />--}}
    {{--                        </figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://hedgersabroad.com/wp-content/uploads/2013/10/001-1800x1350.jpg" alt="" />--}}
    {{--                        </figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="http://res.heraldm.com/content/image/2020/11/17/20201117000739_0.jpg" alt="" />--}}
    {{--                        </figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXdc8JwIMX6CxJxYOMpHNaDKSUFc1uF_arjg&usqp=CAU"--}}
    {{--                                 alt="" /></figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/delish-keto-pizza-073-1544039876.jpg?crop=0.668xw:1.00xh;0.233xw,0.00255xh&resize=768:*"--}}
    {{--                                 alt="" /></figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    {{--    <section id="flatbreads" class="container mt-3">--}}
    {{--        <div class="mb-4 pt-2">--}}
    {{--            <h3 class="f-family-2">Flatbreads</h3>--}}
    {{--            <span class="seperator my-2"></span>--}}
    {{--        </div>--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}" title="Pizza">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/delish-190606-flatbread-pizza-419-landscape-pf-1560544301.jpg?crop=0.668xw:1.00xh;0.0731xw,0.00255xh&resize=768:*"--}}
    {{--                                 alt="" />--}}
    {{--                        </figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://www.heinens.com/wp-content/uploads/2017/06/365-Spring-Artisan-Grilled-Flatbreads-Modern-Farmette_feature.jpg"--}}
    {{--                                 alt="" />--}}
    {{--                        </figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://www.heinens.com/wp-content/uploads/2017/06/SpringFlatbread.jpg" alt="" />--}}
    {{--                        </figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://www.eatwell101.com/wp-content/uploads/2020/02/Garlic-Herb-Butter-Flatbread-1.jpg"--}}
    {{--                                 alt="" /></figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://144f2a3a2f948f23fc61-ca525f0a2beaec3e91ca498facd51f15.ssl.cf3.rackcdn.com/uploads/food_portal_data/recipes/recipe/hero_article_image/2564/letterbox_ChickenFlatBread_593x426.jpg"--}}
    {{--                                 alt="" /></figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-6 col-md-4 mb-5">--}}
    {{--                <div class="elevate-2 rounded h-250 overflow-hidden">--}}
    {{--                    <a href="{{ route('single') }}">--}}
    {{--                        <figure>--}}
    {{--                            <img class="w-100 h-250 obj-fit-cover"--}}
    {{--                                 src="https://realfood.tesco.com/media/images/RFO-1400x919-FLSNaan-0ca4cbdb-e628-4c47-81f9-ace059baec46-0-1400x919.jpg"--}}
    {{--                                 alt="" /></figure>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
@endsection
