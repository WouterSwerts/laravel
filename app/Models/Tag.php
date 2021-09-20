<?php

namespace App\Models;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public function blogPosts() 
    {
        return $this->belongsToMany(BlogPost::class)->withTimestamps()->as('tagged');
    }
}
