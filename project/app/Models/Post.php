<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }


    public function categories(){
        return $this->belongsTo(Category::class);
    }
}
