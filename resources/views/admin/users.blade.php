@extends('layout.admin')
@section('admin-content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <span class="text-muted">
                Users
            </span>
            <h5>{{ $users->count() }}</h5>
        </div>
        <div>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addUserModal"><i
                    class="fa fa-plus me-2"></i> Add User</button>
        </div>
    </div>
    <div class="card card-body">
        @if ($users->isEmpty())
        <h5 class="text-center">No users have been added.</h5>
        @else
        <div class="table-responsive p-1">
            <table class="table table align-middle" id="users-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="text-truncate" style="max-width: 150px;">{{ $user->name ?? '--' }}
                        </td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $user->email ?? '--' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-danger" onclick="onRemoveUser({{ $user }})"><i
                                        class="fa fa-trash"></i></button>
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

{{-- Delete User Form --}}
<form action="{{ route('admin.deleteUser', ':id') }}" method="POST" id="deleteUserForm">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.users') }}" method="POST" id="addUserForm">
                @csrf
                <input name="_method" type="hidden" value="POST" class="method">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger text-center userExistsMsg"></p>
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="userName" placeholder="name"
                            value="{{old('name')}}" required>
                        <label for="userName">Name*</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="userEmail" placeholder="email"
                            value="{{old('email')}}" required>
                        <label for="userEmail">Email*</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success addUserFormSubmitBtn">Save
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
    $(function() {
        const userAdded = "{{ Session::get('userAdded') }}";
        if(userAdded) {
            Swal.fire({
                title:'User Added',
                text:`Password: ${userAdded}`,
                icon:'success',
            });
        }
        const userValidation = "{{ Session::get('userValidation') }}";
        if(userValidation) {
            $('.userExistsMsg').text(userValidation);
            const modal = $('#addUserModal');
            modal.modal('show');
        }
        $('#users-table').DataTable({
            responsive: true,
            columnDefs: [{
                orderable: false,
                targets: 2
            }]
        });
        $('#addUserForm').on('submit', function() {
            $('.addUserFormSubmitBtn').attr('disabled', true);
            $('.addUserFormSubmitBtn .fa-spinner').show();
        });
        $('#addUserModal').on('hidden.bs.modal', function() {
            $('#userName').val('');
            $('#userEmail').val('');
            $('.userExistsMsg').text('');
        });
    });
    const onRemoveUser = (user) => {
        Swal.fire({
            text:`Do you want to remove ${user.name}?`,
            icon:'question',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showCancelButton: true,
            showCloseButton: true
        }).then(res => {
            if(res.isConfirmed) {
                const url = $('#deleteUserForm').attr('action').replace(':id', user.id)
                $('#deleteUserForm').attr('action', url);
                $('#deleteUserForm').submit();
            }
        });
    }
</script>
@endsection
