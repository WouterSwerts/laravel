<p class="text-muted">
  {{ empty(trim($slot)) ? 'Added ' : $slot }} {{ $date->diffForHumans() }}
   @if(isset($name))
      by {{ $name }}
   @endif
</p>


{{-- <p class="text-muted">
   Added {{ $post->created_at->diffForHumans() }}
    by @if($post->user) {{ $post->user->name }}
</p> @else @endif --}}