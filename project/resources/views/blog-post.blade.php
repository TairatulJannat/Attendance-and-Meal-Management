<x-home-master>
@section('content')
<!-- Title -->
<h1 class="mt-4">{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
  by
  <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p>Posted on {{$post->created_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-fluid rounded" src="/storage/{{$post->post_image}}" alt="">

<hr>

<!-- Post Content -->


<p>{{$post->body}}</p>

<hr>

<!-- Comments Form -->
<div class="card my-4">

<?php

//  dd($like);

?>

  <h5>{{$likes->count()}} Likes || {{$comments->count()}} Comments</h5>
  
  @if($like_status === 1)
    <a href="{{route('post.unlike', $post)}}">Unlike</a>
  @else
    <a href="{{route('post.like', $post)}}">Like</a>
  @endif

  <h5 class="card-header">Leave a Comment:</h5>
  <div class="card-body">
    <form action="{{route('comment.store', $post)}}" method="post">
      @csrf
      <div class="form-group">
        <textarea name="comment_body" class="form-control" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<!-- Single Comment -->
@foreach($comments as $comment)
<div class="media mb-4">
  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
  <div class="media-body">
    <h5 class="mt-0">{{$comment->user->name}}</h5>
    {{$comment->comment_body}}
  </div>
  <p>On {{$comment->created_at->diffForHumans()}}</p>
</div>
@endforeach
<!-- Comment with nested comments -->
<!-- <div class="media mb-4">
  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
  <div class="media-body">
    <h5 class="mt-0">Commenter Name</h5>
    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

    <div class="media mt-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0">Commenter Name</h5>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
    </div>

    <div class="media mt-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0">Commenter Name</h5>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
    </div>

  </div>
</div> -->



    @endsection
</x-home-master>