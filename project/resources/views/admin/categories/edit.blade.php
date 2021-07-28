<x-admin-master>
    @section('content')
    <h3>UpdateCaterory</h3>

    <form action="{{route('category.update', $category->id)}}" method="post">
   @csrf
   @method('PATCH')
   <div class="form-group">
    <label for="title">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="" value="{{$category->name}}">
   </div>

        <button type="submit" class="btn btn-primary">Update</button> 
    </form>


    @endsection
</x-admin-master>