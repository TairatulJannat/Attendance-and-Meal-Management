<x-admin-master>
    @section('content')
    <h3>create</h3>
 

    <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
   @csrf 
   @method('PUT')
   <div class="form-group" >
    <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="" value="{{$post->title}}">
   </div>

   <div class="form-group"> 
   <img class="card-img-top" src="/storage/{{$post->post_image}}" width="900" height="300" alt="Card image cap">
    <label for="file" >File</label>
        <input type="file" name="post_image" class="form-control-file" id="post_image">
   </div>
    
   <div class="form-group">
    <textarea name="body" id="body" class="form-control" cols="30" rows="10" >{{$post->body}}</textarea>
   </div>

   
    
        <button type="submit" class="btn btn-primary">Update</button> 
    </form>


    @endsection
</x-admin-master>