<x-admin-master>
    @section('content')
    <h3>Create New Caterory</h3>

    <form action="{{route('category.store')}}" method="post">
   @csrf 
   <div class="form-group">
    <label for="title">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="" placeholder="Enter Name">
   </div>

        <button type="submit" class="btn btn-primary">Submit</button> 
    </form>


    @endsection
</x-admin-master>