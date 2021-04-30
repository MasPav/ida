@extends('layout.app')
@section('content')
<div class="carousel slide" data-bs-ride="carousel" id="pageHeaderCarousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#pageHeaderCarousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#pageHeaderCarousel" data-bs-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('images/paper_img/freestocks-BStW5kYXw4E-unsplash.jpg')}}" class="d-block w-100" alt="carousel image" style="height: 600px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h1>First slide label</h1>
                <h5>Some representative placeholder content for the first slide.</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('images/paper_img/daniel-romero-gSXTcpFlVqA-unsplash.jpg')}}" class="d-block w-100" alt="carousel image" style="height: 600px; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h1>First slide label</h1>
                <h5>Some representative placeholder content for the first slide.</h5>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#pageHeaderCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#pageHeaderCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<section class="text-center py-5">
    <div class="container">
        <div class="mb-5">
            <h1>
                Featured
            </h1>
            <hr class="header-hr">
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="" style="text-decoration: none; color: inherit;">
                    <div class="card  product-card bg-transparent">
                        <img src="{{asset('images/paper_img/X-Star_Hardshell_Carry_Case__64869.1500595144.webp')}}" alt="" class=" img-fluid card-img-top ">
                        <div class="card-body">
                            <p>
                                LARQ Bottle Movement PureVis™
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="" style="text-decoration: none; color: inherit;">
                    <div class="card  product-card bg-transparent">
                        <img src="{{asset('images/paper_img/Zik_Headphones_1__56739.1500596032.webp')}}" alt="" class="img-fluid card-img-top ">
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="" style="text-decoration: none; color: inherit;">
                    <div class="card  mr-0 product-card bg-transparent">
                        <img src="{{asset('images/paper_img/Phantom_Series_-_Multifunctional_Backpack_1__90352.1500596370.webp')}}" alt="" class="img-fluid card-img-top ">
                        <div class="card-body ">
                            <p>Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</section>
<section class="text-center py-5 bg-dark text-white">
    <div class="container">
        <div class="mb-5">
            <h1>
                Fresh Off The Boat
            </h1>
            <hr class="header-hr">
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="{{route('productDetails', ['id' => 1])}}" style="text-decoration: none; color: inherit;">
                    <div class="card  product-card bg-transparent">
                        <img src="{{asset('images/paper_img/built_on_glass.jpg')}}" alt="" class=" img-fluid card-img-top ">
                        <div class="card-body">
                            <p>Bebop</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="" style="text-decoration: none; color: inherit;">
                    <div class="card  product-card bg-transparent">
                        <img src="{{asset('images/paper_img/placeholder.jpg')}}" alt="" class=" img-fluid card-img-top ">
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <a href="" style="text-decoration: none; color: inherit;">
                    <div class="card  product-card bg-transparent">
                        <img src="{{asset('images/paper_img/Ar.Drone_2.0_Elite_Edition_Jungle_1__70880.1500595971.webp')}}" alt="" class="img-fluid card-img-top ">
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="p-5">
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <img src="{{asset('images/paper_img/jan-losert-hmeOlcJ_GAk-unsplash-2.jpg')}}" class="img-fluid" alt="">
        </div>
        <div class="col-12 col-md-6 p-5 text-center">
            <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
            </p>
            <a class="btn btn-danger px-5 py-2 shadow text-dark" href="{{route('products')}}">Explore Our Products</a>
        </div>
    </div>
</section>

@endsection
