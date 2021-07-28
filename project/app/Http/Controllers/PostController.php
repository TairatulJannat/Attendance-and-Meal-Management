<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Redirect;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function show(Post $post){
        // $data['post'] = Post::find($id);
        // return view('blog-post')->with($data);

        // $comments = Comment::where('post_id', $post->id)->get();
        $comments = $post->comments;
        $likes = $post->likes;
        
         $user = Auth()->user()->id;
         $likes_user = Like::where('post_id', $post->id)
                        ->where('user_id',  $user)->first();

         if($likes_user == null){
             $like_status = 0;
          
         }else{
             $like_status = 1;
           
         }
        
        return view('blog-post', ['post'=> $post, 'comments' => $comments, 'likes' => $likes , 'like_status' => $like_status]);
    }

    public function create(){
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(){
        $inputs = request()->validate([
            'title'=>'required|min:8|max:225',
            'category_id'=>'required',
            'post_image'=>'file',
            'body'=>'required'
        ]);


         if(request('post_image')){
             $inputs['post_image'] = request('post_image')->store('images');
         }

         auth()->user()->posts()->create($inputs);
         return back();
    }

    public function view_all_post(){
        $user_id = auth()->id();    
        // $data['posts'] = Post::where('user_id', $user_id )->get();
        $posts = Post::whereUserId($user_id)->get();
    
        // return view('admin.posts.view_all_post')->with($data);
        return view('admin.posts.view_all_post', ['posts'=>$posts]);
    }



    public function view_all_users_post(){ 
        // $data['posts'] = Post::where('user_id', $user_id )->get();
        $posts = Post::all();
    
        // return view('admin.posts.view_all_post')->with($data);
        return view('admin.posts.view_all_post', ['posts'=>$posts]);
    }

    public function edit_post($post_id){
        $post = Post::find($post_id);
        return view('admin.posts.update', compact('post'));
    }


    public function update(Request $request, $id){

        $post = Post::find($id);

        $this->validate( $request, [
            'title' => 'required',
            'body' =>'required'
        ]);

        $post->update($request->all());

        return redirect()->route('user.posts');
            
    }


    public function delete_post(Post $post){

        $post->delete();
        return redirect()->route('user.posts');

    }


    public function search_post(Request $request){
        // dd($request['search_post']);
        $search_post = $request['search_post'];
        $posts = Post::where('title', 'LIKE', "%$search_post%")->get();
        return view('home', ['posts'=>$posts]);
        // dd($posts);
    }   
}
