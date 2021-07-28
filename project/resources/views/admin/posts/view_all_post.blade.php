<x-admin-master>
    @section('content')
    <?php
    // dd($posts);
    ?>
        @foreach($posts as $post)
            <!-- Blog Post -->
            <div class="card mb-4">
            <img class="card-img-top" src="/storage/{{$post->post_image}}" width="900" height="300" alt="Card image cap">
            <div class="card-body"> 
                <h2 class="card-title">{{$post->title}}</h2>
                <p class="card-text">{{Str::limit($post->body, '50', '.....')}}</p>
                <a href="{{route('post', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
                <a href="{{route('post_delete', $post->id)}}" class="btn btn-danger">Delete Post</a>
                <a href="{{route('post_edit', $post->id)}}" class="btn btn-info">Edit Post</a>
            </div>
            <div class="card-footer text-muted">
                Posted on {{$post->created_at->diffForHumans()}}
               
            </div>
            </div>
        @endforeach


    @endsection
</x-admin-master>