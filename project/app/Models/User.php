<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Guest;
use App\Models\Attendance;
use App\Models\Account;
use App\Models\Expense;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded  = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function permissions(){
        return $this->belongsToMany(permission::class);
    }

    public function userHasRole($role_name){
        foreach($this->roles as $role){
            if($role_name == $role->name)
            return true;
        }
        return false;
    }

    public function guest(){
        return $this->hasMany(Guest::class);
    }

    
    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function expense(){
        return $this->hasMany(Expense::class);
    }

    public function account(){
        return $this->hasMany(Account::class);
    }
}
