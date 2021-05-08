@extends('layout.admin')
@section('admin-content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <span class="text-muted">
                Categories
            </span>
            <h5>{{ $categories->count() }}</h5>
        </div>
        <div>
            <button class="btn btn-danger"><i class="fa fa-plus me-2"></i> Add Category</button>
        </div>
    </div>
    <div class="card card-body">
        @if ($categories->isEmpty())
        <h5 class="text-center">No categories have been added.</h5>
        @else
        <div class="table-responsive p-1">
            <table class="table table align-middle" id="categories-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Parent</th>
                        <th style="width: 100px;">Added On</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="text-truncate" style="max-width: 150px;">{{ $category->title ?? '--' }}
                        </td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $category->description ?? '--' }}</td>
                        <td class="text-truncate" style="max-width: 10px;">
                            {{ $category->parentCategory->title ?? '--' }}</td>
                        <td>{{ $category->created_at ?? '--' }}</td>
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
        $('#categories-table').DataTable( {
            responsive: true,
            columnDefs: [
                { orderable: false, targets: 4 }
            ]
        } );
        })
</script>
@endsection
