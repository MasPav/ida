@extends('layout.app')
@section('page-styles')
<link href="{{asset('js/lightGallery-master/dist/css/lightgallery.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<section style="margin-top: 5em;">
    <div class="container">
        <div class="row">
            <div class="col-12 px-0">
                <button class="btn btn-danger btn-sm text-dark mb-1 back-button" onclick="onGoBack()"> <i class="fa fa-arrow-left fa-sm"></i> back</button>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col-12 col-md-6 text-center shadow">
                <img src="{{asset('images/paper_img/'.$product->images[0])}}" alt="" class="img-fluid">
            </div>
            <div class="col-12 col-md-6 px-5">
                <h1 class="display-6">{{$product->name}}</h1>
                <p class="lead text-muted">{{ $product->description }}</p>
                <p><i class="fas fa-tags text-danger"></i> {{$product->category->title}}</p>
                <div class="row" id="product-gallery">
                    @foreach ($product->images as $image)
                    <div class="col-12 col-md-3" data-src="{{asset('images/paper_img/'.$image)}}">
                        <img src="{{asset('images/paper_img/'.$image)}}" alt="{{$product->name}}" class="img-fluid product-gallery-image" style="transition: transform .5s; height: 6em; object-fit: cover; object-position: center;">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if (!$relatedProducts->isEmpty())
        <div class="row my-5">
            <h4 class="text-center">More From {{$product->category->title}}</h4>
        </div>
        <div class="row products-wrapper">
            @foreach ($relatedProducts as $rProduct)
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{route('productDetails', ['id' => $rProduct->id])}}">
                    <div class="card product-card">
                        <img src="{{asset('images/paper_img/'.$rProduct->images[0])}}" alt="Product image" class="img-fluid card-img-top">
                        <div class="card-body">
                            <p>
                                {{ Str::limit($rProduct->name, 50, '...') }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('js/product-details.js')}}"></script>
<script src=" https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="{{asset('js/lightGallery-master/dist/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('js/lightGallery-master/lib/jquery.mousewheel.min.js')}}"></script>
@endsection
