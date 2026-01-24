<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Dba\Connection;
use Dom\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    public function role(){
        return $this->hasOne(role::class);
    }

    public function otps(){
        return $this->hasMany(Otp::class);
    }
    public function updateUser(){
        return $this->hasOne(UpdateUser::class);
    }

    public function governorate(){
        return $this->hasMany(Governorate::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function FavoritePost(){
        return $this->hasMany(FavoritePost::class , 'post_id' , 'id');
    }

    public function connectionUserRequest(){
        return $this->hasMany(Connection::class , 'requester_user_id' , 'id');
    }

    public function connectionUserReceiver(){
        return $this->hasMany(Connection::class , 'receiver_user_id' , 'id');
    }

    public function comment(){
        return $this->hasMany(Comment::class , 'user_id' , 'id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
