@extends('layout.admin')
@section('admin.styles')
<link href="{{asset('js/lightGallery-master/dist/css/lightgallery.min.css')}}" rel="stylesheet">
<style>
    .addProductImageUpload:hover,
    .product-gallery img:hover {
        cursor: pointer;
    }
</style>
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
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addProductModal"><i
                    class="fa fa-plus me-2"></i> Add Product</button>
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
                        <th>Category</th>
                        <th>Description</th>
                        <th style="width: 100px;">Added On</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <div id="product-gallery-{{$product->id}}" class="product-gallery"
                                onclick="onShowGallery({{$product}}, $(this))">
                                <img src="{{empty($product->images[0]) ? asset('images/product-placeholder.png') : asset('storage/images/'.$product->images[0])}}"
                                    alt="" style="width:5em; height:5em; object-fit:cover">
                            </div>
                        </td>
                        <td class="text-truncate" style="max-width: 150px;">{{ $product->name ?? '--' }}
                        </td>
                        <td class="text-truncate" style="max-width: 10px;">{{ $product->category->title ?? '--' }}</td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $product->description ?? '--' }}</td>
                        <td>{{ $product->created_at ?? '--' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" onclick="onEditProduct({{ $product }})"><i
                                        class="fa fa-pen"></i></button>
                                <button type="button" class="btn btn-danger"
                                    onclick="onRemoveProduct({{ $product }})"><i class="fa fa-trash"></i></button>
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

{{-- Delete Product Form --}}
<form action="{{ route('admin.deleteProducts', ':id') }}" method="POST" id="deleteProductForm">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>
<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.products') }}" method="POST" enctype="multipart/form-data"
                id="addProductForm">
                @csrf
                <input name="_method" type="hidden" value="POST" class="method">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="productName" placeholder="name"
                                    required>
                                <label for="productName">Name*</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="productCategory"
                                    aria-label="Floating label select example" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($subCategories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                                <label for="productCategory">Category</label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here"
                                    id="productDescription" style="height: 100px" name="description"></textarea>
                                <label for="productDescription">Description</label>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6 text-center">
                            <button class="btn btn-primary addProductImageBtn" type="button"><i
                                    class="fas fa-images"></i></button>
                            <input type="file" name="images[]" multiple class="addProductImagesUpload"
                                style="display: none;" accept="image/*" onchange="onAddImagesChange(event)">
                            <button class="btn btn-danger removeProductImagesUpload" type="button"
                                style="display: none;"><i class="fa fa-trash"></i></button>
                            <div class="uploadedImages mt-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success addProductFormSubmitBtn">Save
                        <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('admin.scripts')
<script src=" https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="{{asset('js/lightGallery-master/dist/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('js/lightGallery-master/lib/jquery.mousewheel.min.js')}}"></script>
<script>
    const productsUrl = "{{ route('admin.products') }}";
    const imagesUrl = "{{ URL::asset('storage/images/') }}/"; // take note of trailing /
    $(function() {
        $('#products-table').DataTable({
            responsive: true,
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
        $('.addProductImageBtn').on('click', function() {
            $('.addProductImagesUpload').click();
        })
        $('.removeProductImagesUpload').on('click', function() {
            $('.addProductImagesUpload').val('')
            $('.uploadedImages').empty();
            $('#existingImages').val('');
            $(this).hide();
        })
        $('#addProductForm').on('submit', function() {
            $('.addProductFormSubmitBtn').attr('disabled', true);
            $('.addProductFormSubmitBtn .fa-spinner').show();
        });
        $('#addProductModal').on('hidden.bs.modal', function() {
            $('#addProductForm').trigger('reset');
            $('.uploadedImages').empty();
            $('.removeProductImagesUpload').hide();
            $(this).find('.modal-title').text('Add Product');
            $('#addProductForm').attr('action', productsUrl);
            $(this).find('.method').val('POST');
        });
    });
    const onAddImagesChange = (e) => {
        if(e.target.files.length <= 0) {
            return;
        };
        const files = e.target.files;
        let imagesToDisplay = '';
        for (let index = 0; index < files.length; index++) {
            const file = files[index];
            const reader = new FileReader();
            reader.onload = function(re) {
                $('.uploadedImages').append(`<img class='img-thumbnail me-2 mb-2 shadow-sm' style='width:5em; height:5em; object-fit:cover' src='${re.target.result}' alt='uploaded image'>`);
                $('.removeProductImagesUpload').show();
            }
            reader.readAsDataURL(file);

        }
    }
    const onEditProduct = (product) => {
        const modal = $('#addProductModal');
        modal.find('.modal-title').text('Edit Product');
        modal.find('#productName').val(product.name);
        modal.find('#productCategory').val(product.category_id);
        modal.find('#productDescription').text(product.description || '');
        modal.find('.modal-body').append(`<input type='hidden' name='existing_images' id='existingImages'>`);
        $('#existingImages').val(product.images);
        let imagesEl = '';
        if(product.images.length > 0) {
            product.images.forEach(link => {
            imagesEl+=`<img class='img-thumbnail me-2 mb-2 shadow-sm' style='width:5em; height:5em; object-fit:cover' src='${imagesUrl.concat(link)}' alt='uploaded image'>`;
            });
            $('.uploadedImages').append(imagesEl);
            $('.removeProductImagesUpload').show();
        }
        const url = $('#addProductForm').attr('action').concat(`/${product.id}`);
        $('#addProductForm').attr('action', url);
        modal.find('.method').val('PATCH');
        modal.modal('show');
    }
    const onRemoveProduct = (product) => {
        Swal.fire({
            text:`Do you want to remove ${product.name}?`,
            icon:'question',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showCancelButton: true,
            showCloseButton: true
        }).then(res => {
            if(res.isConfirmed) {
                const url = $('#deleteProductForm').attr('action').replace(':id', product.id)
                $('#deleteProductForm').attr('action', url);
                $('#deleteProductForm').submit();
            }
        });
    }
    const onShowGallery = (product, productEl) => {
        if(product.images.length > 0) {
            const images = [];
        product.images.forEach(image => {
            images.push({
                "src": `${imagesUrl.concat(image)}`,
                'thumb': `${imagesUrl.concat(image)}`,
                'subHtml': `<h4>${product.name}</h4><p>${product.description || ''}</p>`
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
    }
</script>
@endsection
