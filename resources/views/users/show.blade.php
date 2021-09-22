@extends('layouts.app')

@section('content')
      <div class="row">
         <div class="col-4">
            <img src="/storage/{{ $user->image->path }}" class="img-thumbnail avatar">
             {{-- Zo zou het moeten zoals hieronder --}}
            {{-- <img src="{{ $user->image ? $user->image->url() : '' }}" alt="" class="img-thumbnail avatar">  --}}
         </div>
         <div class="col-8">
            <h3>{{ $user->name }}</h3>

            @commentForm(['route' => route('users.comments.store', ['user' => $user->id])])
            @endcommentForm

            @commentList(['comments' => $user->commentsOn])
            @endcommentList
         </div>

         
      </div>
@endsection