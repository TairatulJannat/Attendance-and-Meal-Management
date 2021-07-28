<x-admin-master>
    @section('content')
    <h3>create</h3>

    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
   @csrf 
   <div class="form-group">
    <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter Title">
   </div>


    <div class="form-group">
    <label for="category">Category</label>
    <select name="category_id" id="">
    @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    </div>
  



   <div class="form-group"> 
    <label for="file" >File</label>
        <input type="file" name="post_image" class="form-control-file" id="post_image">
   </div>
    
   <div class="form-group">
    <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>
   </div>

   
    
        <button type="submit" class="btn btn-primary">Submit</button> 
    </form>


    @endsection
</x-admin-master>