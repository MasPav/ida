@extends('layout.admin')
@section('admin.styles')
<link href="{{asset('js/lightGallery-master/dist/css/lightgallery.min.css')}}" rel="stylesheet">
@endsection
@section('admin-content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <span class="text-muted">
                Products
            </span>
            <h5>{{ $products->count() }}</h5>
        </div>
        <div>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="fa fa-plus me-2"></i> Add Product</button>
        </div>
    </div>
    <div class="card card-body">
        @if ($products->isEmpty())
        <h5 class="text-center">No products have been added.</h5>
        @else
        <div class="table-responsive p-1">
            <table class="table table align-middle" id="products-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th style="width: 100px;">Added On</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td id="product-gallery-{{$product->id}}" class="product-gallery" onclick="onShowGallery({{$product}}, $(this))">
                            <img src="{{asset('images/paper_img/'.$product->images[0])}}" alt="" style="width: 3em;">
                        </td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $product->name ?? '--' }}
                        </td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $product->description ?? '--' }}</td>
                        <td class="text-truncate" style="max-width: 10px;">{{ $product->category->title ?? '--' }}</td>
                        <td>{{ $product->created_at ?? '--' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-6 order-1 order-lg-0">
                        <img src="{{asset('images/paper_img/11204666_fc93d358-3e25-4778-b26a-512e3174b822_1600x1200.webp')}}" alt="product image" class="img-fluid">
                    </div>
                    <div class="col-12 col-lg-6 order-0 order-lg-1">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="productName" placeholder="name@example.com">
                            <label for="productName">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option value="">Select Category</option>
                                @foreach ($subCategories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Category</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="productDescription" style="height: 100px"></textarea>
                            <label for="productDescription">Description</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin.scripts')
<script src=" https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="{{asset('js/lightGallery-master/dist/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('js/lightGallery-master/lib/jquery.mousewheel.min.js')}}"></script>
<script>
    const imagesUrl = "{{ URL::asset('/images/paper_img/') }}/"; // take note of trailing /
    $(function() {
        $('#products-table').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }, {
                orderable: false,
                targets: 5
            }],
            aaSorting: [
                [1, 'asc']
            ]
        });
    })
    const onShowGallery = (product, productEl) => {
        const images = [];
        product.images.forEach(image => {
            images.push({
                "src": `${imagesUrl.concat(image)}`,
                'thumb': `${imagesUrl.concat(image)}`,
                'subHtml': `<h4>${product.name}</h4><p>${product.description}</p>`
            })
        })
        productEl.lightGallery({
            dynamic: true,
            dynamicEl: images,
            autoplay: false,
            fullScreen: false,
            pager: false,
            zoom: false,
            hash: false,
            share: false,
            rotate: false,
            download: false,
        })
    }
</script>
@endsection
