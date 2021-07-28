<x-admin-master>
    @section('content')

   

    <h3>Create New Employee</h3>

    <form action="{{route('employee.store')}}" method="post">
   @csrf 
   <div class="form-group">
    <label for="title">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="" placeholder="Enter Name">
   </div>
   <div class="form-group">
    <label for="title">Email</label>
        <input type="email" name="email" class="form-control" id="name" aria-describedby="" placeholder="Enter Email">
   </div>
   <div class="form-group">
    <label for="title">Refer ID</label>
        <input type="text" name="emp_ref_id" class="form-control" id="name" aria-describedby="" placeholder="Enter Refer ID">
   </div>
   <div class="form-group">
    <label for="title">Image</label>
        <input type="file" name="emp_image" class="form-control" id="name" aria-describedby="">
   </div>
   <div class="form-group">
    <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="name" aria-describedby="" placeholder="Enter Password">
   </div>

   
   <!-- <div class="form-group"> 
    <label for="file" >File</label>
        <input type="file" name="image" class="form-control-file" id="image">
   </div> -->
   
    <button type="submit" class="btn btn-primary">Submit</button> 
    </form>



   


    @endsection
</x-admin-master>