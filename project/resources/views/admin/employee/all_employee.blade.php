<x-admin-master>
    @section('content')
    <h3>View All Employees</h3>

    @foreach($employees as $employee)
    <div class="card mb-4">
    <div class="card-body">
        <h5>Employee Name: {{$employee->name}}</h5>
        <h5>Refer ID: {{$employee->emp_ref_id}}</h5>
        <h8>Create at-{{$employee->created_at}}</h8>
        <form method="post" action="">
        @csrf
        <input type="submit" class="btn btn-danger" value="Delete">
        <a href="{{route('emp_data_print', $employee->id)}}" class="btn btn-danger">Print</a>
        <a href="" class="btn btn-dark">Edit</a>
        </form>
        
    </div>

    </div>
    @endforeach
    @endsection
</x-admin-master>