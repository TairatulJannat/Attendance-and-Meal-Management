<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;
use App\Models\Guest;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    //

    public function store(Request $request)
    {
        $inputs = request()->validate([
            'name'=>'required',
            'phone_number' => 'required'
        ]);

        $guest = new Guest($inputs);
        
        $guest->save();


    }
}
