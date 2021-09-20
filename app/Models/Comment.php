<?php

namespace App\Models;


use App\Models\User;
use App\Scopes\LatestScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'content'];

    use HasFactory;

    public function blogPost() {

        // return $this->belongsTo(BlogPost::class, 'post_id', 'blog_post_id');
        return $this->belongsTo(BlogPost::class);

    }

    public function User () {
        return $this->belongsTo(User::class);
    }

    public function scopeLatest(Builder $query) {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function(Comment $comment) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
            Cache::tags(['blog-post'])->forget('mostCommented');
        });

        // static::addGlobalScope(new LatestScope);


    }
}
