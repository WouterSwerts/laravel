@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="row">
   <div class="col-8">

   <h1>
      {{ $post->title}}
      @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
         Brand New Post!
      @endbadge
   </h1>
   <p>{{ $post->content }}</p>
   
   @updated(['date' => $post->created_at, 'name' => $post->user->name])
   @endupdated

   @updated(['date' => $post->updated_at])
      Updated
   @endupdated

   @tags(['tags' => $post->tags])@endtags

   <p>Currently read by {{ $counter }} people</p>

   <h4>Comments</h4>

   @include('comments.form')

   @forelse($post->comments as $comment)
      <p>
         {{ $comment->content }}
      </p>
      
      @updated(['date' => $comment->created_at, 'name' => $comment->user->name])
      @endupdated

   @empty
      <p>No comments yet!</p>

   @endforelse
   </div>
   <div class="col-4">
      @include('posts.activity')
   </div>
</div>
@endsection
