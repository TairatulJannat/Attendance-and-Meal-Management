<x-admin-master>


@section('content')


        <!-- Blog Post -->

        
        <table class="table table-blue table-striped">
  <thead>
    <tr>

      
      <!-- <th scope="col">Name</th> -->
      <th scope="col">Emp ID</th>
      <th scope="col">Status</th>
      <th scope="col">Token Status</th>
      <th scope="col">Date</th>
      <th scope="col">Time </th>
   
     
      
    </tr>
  </thead>
  <tbody>
  @foreach( $attendances as $attendance)
    <tr>
    <!-- @method('DELETE') -->
      
      <td>{{ $attendance->user_ref_id }}</td>
      <td>{{ $attendance->status}}</td>
      <td>{{ $attendance->token_status}}</td>
      <td>{{ $attendance->date}}</td>
      <td>{{ $attendance->time}}</td>
      @if($attendance->token_status =='taken')

      <td><button class="btn btn-danger btn-sm">Taken</button></td>
      @else
      <td><a href="{{route('attendance.get_token', $attendance->user_id)}}" class="btn btn-success btn-sm">GET TOKEN</a></td>
      @endif


      


  
      

    </tr>
    @endforeach
</table>
@endsection
</x-admin-master>