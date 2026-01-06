<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "category_name" , 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sub_category(){
        return $this->hasMany(SubCategory::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
