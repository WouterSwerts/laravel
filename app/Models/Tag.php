<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public function blogPosts() 
    {
        // return $this->belongsToMany(BlogPost::class)->withTimestamps()->as('tagged');
        return $this->morphedByMany(BlogPost::class, 'taggable')->withTimestamps()->as('tagged');
    }

    public function comments() 
    {
        return $this->morphedByMany(Comment::class, 'taggable')->withTimestamps()->as('tagged');
    }
}
