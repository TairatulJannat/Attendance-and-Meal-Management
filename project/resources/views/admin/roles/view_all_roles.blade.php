<x-admin-master>
    @section('content')
    <h3>All Roles</h3>

    @foreach($roles as $role)
    <div class="card mb-4">
    <div class="card-body">
        <h5>Role Name: {{$role->name}}</h5>
        <a href="{{route('role_delete', $role->id)}}" class="btn btn-danger">Delete Role</a>
        <a href="{{route('role_edit', $role->id)}}" class="btn btn-info">Edit Role</a>
    </div>

    </div>
    @endforeach
    @endsection
</x-admin-master>