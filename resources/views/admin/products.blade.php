@extends('layout.admin')
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
            <button class="btn btn-danger"><i class="fa fa-plus me-2"></i> Add Product</button>
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
@endsection

@section('admin.scripts')
<script>
    $(function() {
        $('#products-table').DataTable( {
            columnDefs: [
                { orderable: false, targets: 4 }
            ]
        } );
        })
</script>
@endsection
