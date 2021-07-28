<x-admin-master>


@section('content')


<!-- Blog Post -->


<table class="table table-blue table-striped">
<thead>
<tr>

<th scope="col">Name</th>
<th scope="col">Refer ID</th>
<th scope="col">Refer Name</th>
<th scope="col">Phone Number</th>
<th scope="col">Image</th>
<th scope="col">Date&Time</th>
</tr>
</thead>
<tbody>

    <tr>
    @foreach($guests as $guest)
      <td>{{$guest->name}}</td>
      <td>{{$guest->user_ref_id}}</td>
      <td>{{$guest->user_name}}</td>
      <td>{{$guest->phone_number}}</td>
        <!-- Button trigger modal -->
     

 
      <td><img  class="zoom" width="50" height="50" src="/storage/{{$guest->guest_image}}"></td>

 
     
      <td>{{$guest->created_at}}</td>
     

    </tr>
  @endforeach   

</tbody>
</table>

@endsection
</x-admin-master>