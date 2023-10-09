<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = false;


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}

