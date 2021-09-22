<?php

namespace App\Models;


use App\Models\Tag;
use App\Models\User;
use App\Models\BlogPost;
use App\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use SoftDeletes;
    use Taggable;

    protected $fillable = ['user_id', 'content'];

    use HasFactory;

    public function commentable() {
        return $this->morphTo();
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
            if ($comment->commentable_type === BlogPost::class) {
                Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
                Cache::tags(['blog-post'])->forget('mostCommented');
            }
            
        });

        // static::addGlobalScope(new LatestScope);


    }
}
