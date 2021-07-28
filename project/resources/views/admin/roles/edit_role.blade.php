<x-admin-master>
    @section('content')
    <h3>Edit Role</h3>

    <form action="{{route('role_update', $role)}}" method="post">
   @csrf 
   <div class="form-group">
    <label for="title">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="" value="{{$role->name}}">
   </div>

   <div class="form-group">
    <label for="title">Slug</label>
        <input type="text" name="slug" class="form-control" id="slug" aria-describedby="" value="{{$role->slug}}">
   </div>


   
    
        <button type="Update" class="btn btn-primary">Submit</button> 
    </form>


    @endsection
</x-admin-master>