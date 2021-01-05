@extends('frontend.layouts.master')
@section('title', config('app.name'))
@section('content')

<header class="fixed-top">
    @include('frontend.partials.secondaryHeader')
</header>
@include('shared.error-bag')
@include('shared.success')
<section class="container-xl px-4 mx-auto mt-5">
    <div class="row">
        <div class="col-12 col-md-9 pl-3 mb-2 elevate-1 p-0 rounded mx-auto">
            <div class="p-3 bg-primary">
                <h5 class="mb-0 text-light">Pizza</h5>
            </div>
            <div class="px-3 pt-2">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Order Id</th>
                            <td>Mark</td>
                        </tr>
                        <tr>
                            <th scope="row">Windows World</th>
                            <td>Jacob</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td colspan="2">Larry the Bird</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex px-3 py-2 border-top">
                <a href="" class="btn btn-secondary rounded-0 me-2">Back</a>
                <a href="" class="btn btn-outline-dark rounded-0">View Product</a>

            </div>
        </div>
    </div>
</section>

@endsection