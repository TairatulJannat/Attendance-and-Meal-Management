<x-admin-master>


@section('content')


        <!-- Blog Post -->
        <div class="form-group" style="color:black;">
        <a href="{{route('expense.create')}}" class="btn btn-dark btn-sm">Add Accounts</a>
        </div>
      
        <table class="table table-blue table-striped">
  <thead>
    <tr>

      
      <th scope="col">Name</th>
      <th scope="col">Employee ID</th>
      <th scope="col">Total Meal</th>
      <th scope="col">Total Expense</th>
      <th scope="col">Paid</th>
      <th scope="col">Due</th>
      
    </tr>
  </thead>
  <tbody>
  <tr>

      @foreach( $accounts as $account)
      
        <td>{{ $account->name}}</td>
        <td>{{ $account->user_ref_id}}</td>
        <td>{{ $account->total_meal}}</td>
        <td>{{ $account->total_expense}}</td>
        <td>{{ $account->paid_amount}}</td>
        <td>{{ $account->due_amount}}</td>
     
<!--       
        <td>Due</button></td> -->
        
        
    </tr>
@endforeach
</table>

@endsection
</x-admin-master>