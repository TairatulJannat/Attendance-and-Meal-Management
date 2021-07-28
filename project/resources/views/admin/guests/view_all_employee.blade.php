<x-admin-master>


@section('content')


        <!-- Blog Post -->

        
        <table class="table table-blue table-striped">
  <thead>
    <tr>

      
      <th scope="col">Name</th>
      <th scope="col">Department</th>
      <th scope="col">Designation</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Employee ID</th>
      <th scope="col">Image</th>
      <th scope="col">Created Time</th>
      <!-- <th scope="col">Total Meal</th>
      <th scope="col">Expense</th> -->
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
     
      
    </tr>
  </thead>
  <tbody>
  @foreach( $users as $user)
    <tr>
    <!-- @method('DELETE') -->
      
      <td>{{ $user->name }}</td>
      <td>{{ $user->department}}</td>
      <td>{{ $user->designation}}</td>
      <td>{{ $user->email}}</td>
      <td>{{ $user->phone_number}}</td>
      <td>{{ $user->user_ref_id}}</td>
      <td><img class="zoom" width="50" height="50" src="/storage/{{$user->emp_image}}" alt=""></td>
       <td>{{ $user->created_at }}</td>
       
      <form method="post" action="{{route('employee.destroy', $user->id)}}">
        @csrf
        @method('DELETE')
        
        <td><a href="{{route('employee.edit', $user->id)}}" class="btn btn-success btn-sm">Edit</a></td>
        <td><input type="submit" class="btn btn-danger btn-sm" value="Delete"></td>
       
        
        
      </form>
     
      

    </tr>
    @endforeach
</table>
@endsection
</x-admin-master>