<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        "subCategory_name" , 'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
