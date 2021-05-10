@extends('layout.admin')
@section('admin-content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <span class="text-muted">
                Categories
            </span>
            <div class="d-flex">
                <h5>{{ $categories->count() }}</h5>
            </div>

        </div>
        <div>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i
                    class="fa fa-plus me-2"></i> Add Category</button>
        </div>
    </div>
    <div class="card card-body">
        @if ($categories->isEmpty())
        <h5 class="text-center">No categories have been added.</h5>
        @else
        <div class="table-responsive p-1">
            <div class="row">
                <div class="col-12 d-flex">
                    <h6 class="me-3">Main: <span
                            class="text-muted">{{ $categories->count() - $subCategoriesCount }}</span></h6>
                    <h6>Sub: <span class="text-muted">{{ $subCategoriesCount }}</span></h6>
                </div>
            </div>
            <table class="table table align-middle" id="categories-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Description</th>
                        <th style="width: 100px;">Added On</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="text-truncate" style="max-width: 150px;">{{ $category->title ?? '--' }}
                        </td>
                        <td class="text-truncate" style="max-width: 10px;">
                            {{ $category->parentCategory->title ?? '--' }}</td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $category->description ?? '--' }}</td>
                        <td>{{ $category->created_at ?? '--' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary"><i class="fa fa-pen"
                                        onclick="onEditCategory({{ $category }})"></i></button>
                                <button type="button" class="btn btn-danger"
                                    onclick="onRemoveCategory({{ $category }})"><i class="fa fa-trash"></i></button>
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

{{-- Delete Category Form --}}
<form action="{{ route('admin.deleteCategory', ':id') }}" method="POST" id="deleteCategoryForm">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>
<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.categories') }}" method="POST" id="addCategoryForm">
                @csrf
                <input name="_method" type="hidden" value="POST" class="method">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="title" class="form-control" id="categoryTitle" placeholder="title"
                            required>
                        <label for="categoryTitle">Title*</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Floating label select example" id="categoryType">
                            <option value="main">Main</option>
                            <option value="sub">Sub</option>
                        </select>
                        <label for="categoryType">Type</label>
                    </div>
                    <div class="form-floating mb-3 parentCategoryWrapper" style="display: none;">
                        <select class="form-select" aria-label="Floating label select example" name="parent_id"
                            id="parentCategory">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            @if (is_null($category->parentCategory))
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endif
                            @endforeach
                        </select>
                        <label for="parentCategory">Parent</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="categoryDescription"
                            style="height: 100px" name="description"></textarea>
                        <label for="categoryDescription">Description</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success addCategoryFormSubmitBtn">Save
                        <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('admin.scripts')
<script>
    const categoriesUrl = "{{ route('admin.categories') }}";
    $(function() {
        $('#categories-table').DataTable( {
            responsive: true,
            columnDefs: [
                { orderable: false, targets: 4 }
            ]
        } );
        $('#categoryType').on('change', function() {
            if($(this).val() === 'main') {
                $('#parentCategory').attr('required', false);
                $('#parentCategory').val('');
                $('.parentCategoryWrapper').hide();
            } else {
                $('#parentCategory').attr('required', true);
                $('.parentCategoryWrapper').show();
            }
        });
        $('#addCategoryForm').on('submit', function() {
            $('.addCategoryFormSubmitBtn').attr('disabled', true);
            $('.addCategoryFormSubmitBtn .fa-spinner').show();
        });
        $('#addCategoryModal').on('hidden.bs.modal', function() {
            $('#addCategoryForm').trigger('reset');
            $(this).find('.modal-title').text('Add Category');
            $(this).find('#categoryType').val('main');
            $(this).find('#categoryType').trigger('change');
            $('#addCategoryForm').attr('action', categoriesUrl);
            $(this).find('.method').val('POST');
        });
    });
    const onEditCategory = (category) => {
        const modal = $('#addCategoryModal');
        modal.find('.modal-title').text('Edit Category');
        modal.find('#categoryTitle').val(category.title);
        modal.find('#categoryType').val(category.parent_id ? 'sub' : 'main');
        modal.find('#categoryType').trigger('change');
        modal.find('#parentCategory').val(category.parent_id || '');
        modal.find('#parentCategory').attr('required', modal.find('#categoryType').val() === 'sub' ? true : false);
        modal.find('#categoryDescription').text(category.description || '');
        const url = $('#addCategoryForm').attr('action').concat(`/${category.id}`);
        $('#addCategoryForm').attr('action', url);
        modal.find('.method').val('PATCH');
        modal.modal('show');
    }
    const onRemoveCategory = (category) => {
        const html = `<p>Do you want to remove ${category.title}?</p>${!category.parent_id ? '<p>All sub categories under it will be removed!</p>' : ''}`
        Swal.fire({
            html:html,
            icon:'question',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showCancelButton: true,
            showCloseButton: true
        }).then(res => {
            if(res.isConfirmed) {
                const url = $('#deleteCategoryForm').attr('action').replace(':id', category.id)
                $('#deleteCategoryForm').attr('action', url);
                $('#deleteCategoryForm').submit();
            }
        });
    }

</script>
@endsection
