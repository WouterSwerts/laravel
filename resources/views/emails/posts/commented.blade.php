<style>
   body {
      font-family: Arial, Helvetica, sans-serif;
   }
</style>

<p>Hi {{ $comment->commentable->user->name }}</p>

<p>
   Someone has commented on your blog post
   <a href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">
      {{ $comment->commentable->title }}
   </a>

</p>

<hr/>

<p>
   {{--  url werkt niet.  --}}
   {{--  <img src="{{ $message->embed($comment->user->image->url()) }}" alt="">  --}}
   {{--  <img src="{{ $message->embed('/storage/'.$user->image->path) }}" alt="">  --}}
   <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">
      {{ $comment->user->name }}
   </a> Said:
</p>

<p>
   "{{ $comment->content }}"
</p>