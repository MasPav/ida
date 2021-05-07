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
            <button class="btn btn-danger"><i class="fa fa-plus me-2"></i> Add User</button>
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
        $('#users-table').DataTable( {
            columnDefs: [
                { orderable: false, targets: 4 }
            ]
        } );
        })
</script>
@endsection
