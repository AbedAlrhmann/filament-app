<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $filable = ["name"];

    public function posts(){
        return $this->belongsToMany(Post::class, "post_tag");
    }
}
