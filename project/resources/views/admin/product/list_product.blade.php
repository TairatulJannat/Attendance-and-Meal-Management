<x-admin-master>


@section('content')


        <!-- Blog Post -->
<form  method="post" action="{{route('product.add_product')}}">
@csrf

<div class="row">
  <div class="col-sm-6">
    <div class="form-group" style="color:black;">
        <label for="title"><b>Name of Expense Head</b></label>
        <input type="text" class="form-control" style="width:70%"  name="p_name" value=""  id="title" aria-describedby="" placeholder="enter product name">
    </div>

    <div class="form-group">
    <button type="submit" name="submit" class="btn btn-primary">ADD</button>
    </div>
 </div>
 <div class="col-sm-6">
    <div class="form-group" style="color:black;">
        <label for="title"><b>Unit</b></label>
        <input type="text" class="form-control" style="width:70%"  name="p_unit" value=""  id="title" aria-describedby="" placeholder="ex:gm/kg/ltr">
    </div>
  

</div> 
</div>   
</form>



        
        <table class="table table-blue table-striped">
  <thead>
    <tr>

      
      <th scope="col">Name</th>
      <th scope="col">Unit</th>
      <th scope="col">Delete</th>
     
      
    </tr>
  </thead>
  <tbody>
  @foreach( $products as $product)
    <tr>
    <!-- @method('DELETE') -->
      
      <td>{{ $product->p_name }}</td>
      <td>{{ $product->p_unit}}</td>
      <form method="post" action="{{route('product.destroy',$product->id)}}">
        @csrf
        @method('DELETE')
        
        <td><input type="submit" class="btn btn-danger btn-sm" value="Delete"></td>
        
      </form>
     
      

    </tr>
    @endforeach
</table>
@endsection
</x-admin-master>