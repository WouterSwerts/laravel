<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable =  [
        'title', 
        'content', 
        'user_id'
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LatestScope);

        static::deleting(function (BlogPost $blogPost){
            $blogPost->comments()->delete();
        });

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }


    use HasFactory;
}
