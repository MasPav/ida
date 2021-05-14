@extends('layout.app')
@section('content')
<section>
    <img src="{{asset('images/paper_img/mike-petrucci-c9FQyqIECds-unsplash.jpg')}}" alt="" class="img-fluid w-100"
        style="height: 600px; object-fit: cover;">
</section>
@if ($categories)
<section class="py-5">
    <div class="mb-5 text-center current-category-wrapper" style="display: none;">
        <h1></h1>
        <hr class="header-hr">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 d-block d-lg-none mb-3">
                <button class="btn btn-danger text-dark" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#categoriesOffcanvas" aria-controls="categoriesOffcanvas">
                    <i class="fas fa-angle-double-right align-middle" data-bs-toggle="offcanvas"
                    data-bs-target="#categoriesOffcanvas" aria-controls="categoriesOffcanvas"></i>
                </button>
            </div>
            <div class="col-lg-3 mb-5 mb-sm-0 shadow d-none d-lg-block">
                <div class="accordion accordion-flush" id="categoriesAccordion">
                    @foreach ($categories as $categoryKey => $category)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$category->id}}">
                            <button class="accordion-button {{ $categoryKey !== 0 ? 'collapsed' : '' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{$category->id}}"
                                aria-expanded="{{ $categoryKey === 0 ? 'true' : 'false' }}"
                                aria-controls="collapse{{$category->id}}">
                                {{ $category->title }}
                            </button>
                        </h2>
                        <div id="collapse{{$category->id}}"
                            class="accordion-collapse collapse {{ $categoryKey === 0 ? 'show' : '' }} heading{{$category->id}}"
                            data-bs-parent="#categoriesAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled sub-categories-list">
                                    @foreach ($category->subCategories as $subCategoryKey => $subCategory)
                                    <li class="mb-2 p-2" id="categoryEl-{{ $subCategory->id }}"
                                        onclick="onSelectCategory({{ $subCategory }})">
                                        {{ $subCategory->title }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="row align-items-center justify-content-center h-100 products-loader" style="display: none;">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="row align-items-center text-center h-100 no-products-msg mt-3 mt-lg-0"
                    style="{{!$products->isEmpty() ? 'display:none' : ''}};">
                    <div>
                        <h1 class="display-6">There are no products available</h1>
                    </div>
                </div>
                @if (!$products->isEmpty())
                <div class="row products-wrapper">
                    @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{route('productDetails', ['id' => $product->id])}}">
                            <div class="card product-card">
                                <img src="{{asset('storage/images/'.$product->images[0])}}" alt="Product image"
                                    class="img-fluid card-img-top">
                                <div class="card-body">
                                    <p>
                                        {{ Str::limit($product->name, 50, '...') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<div class="offcanvas offcanvas-start d-block d-lg-none" tabindex="-1" id="categoriesOffcanvas"
    aria-labelledby="categoriesOffcanvasLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion accordion-flush" id="categoriesAccordion">
            @foreach ($categories as $categoryKey => $category)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{$category->id}}">
                    <button class="accordion-button {{ $categoryKey !== 0 ? 'collapsed' : '' }}" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{$category->id}}"
                        aria-expanded="{{ $categoryKey === 0 ? 'true' : 'false' }}"
                        aria-controls="collapse{{$category->id}}">
                        {{ $category->title }}
                    </button>
                </h2>
                <div id="collapse{{$category->id}}"
                    class="accordion-collapse collapse {{ $categoryKey === 0 ? 'show' : '' }} heading{{$category->id}}"
                    data-bs-parent="#categoriesAccordion">
                    <div class="accordion-body">
                        <ul class="list-unstyled sm-sub-categories-list">
                            @foreach ($category->subCategories as $subCategoryKey => $subCategory)
                            <li class="mb-2 p-2" id="sm-categoryEl-{{ $subCategory->id }}"
                                onclick="onSelectCategory({{ $subCategory }})">
                                {{ $subCategory->title }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
@section('scripts')
<script>
    const imagesUrl = "{{ URL::asset('storage/images/') }}/"; // take note of trailing /
    const productDetailsUrl = "{{ route('productDetails', ['id' => 'id']) }}";
</script>
<script src="{{asset('js/products.js')}}">
</script>
@endsection
