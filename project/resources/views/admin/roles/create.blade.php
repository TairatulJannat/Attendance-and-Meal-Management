<x-admin-master>
    @section('content')
    <h3>Create New Role</h3>

    <form action="{{route('role.store')}}" method="post">
   @csrf 
   <div class="form-group">
    <label for="title">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="" placeholder="Enter Name">
   </div>

   <div class="form-group">
    <label for="title">Slug</label>
        <input type="text" name="slug" class="form-control" id="slug" aria-describedby="" placeholder="Enter Slug">
   </div>


   
    
        <button type="submit" class="btn btn-primary">Submit</button> 
    </form>


    @endsection
</x-admin-master>