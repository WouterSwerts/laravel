@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="row">
   <div class="col-8">
      @if($post->image)
         <div style="background-image: url('/storage/{{ $post->image->path }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
            <h1 style="padding-top: 100px; text-shadow: 1px 2px #000;">
         
      @else
         <h1>
      @endif

      {{ $post->title}}
      @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
         Brand New Post!
      @endbadge
 

   @if($post->image)
      </h1>
      </div>
   @else
      </h1>
   @endif  


   <p>{{ $post->content }}</p>

   {{--  <img src="/storage/{{ $post->image->path }}" />  --}}
   
   {{--  beste manier hieronder maar werkt niet; uitzoeken nog  --}}
   {{--  <img src="{{ Storage::url($post->image->path) }}" />  --}}
   {{--  <img src="{{ $post->image->url() }}" />  --}}
   
   @updated(['date' => $post->created_at, 'name' => $post->user->name])
   @endupdated

   @updated(['date' => $post->updated_at])
      Updated
   @endupdated

   @tags(['tags' => $post->tags])@endtags

   <p>Currently read by {{ $counter }} people</p>

   <h4>Comments</h4>

   @commentForm(['route' => route('posts.comments.store', ['post' => $post->id])])

   @endcommentForm

   @commentList(['comments' => $post->comments])
   @endcommentList

   </div>
   <div class="col-4">
      @include('posts.activity')
   </div>
</div>
@endsection
