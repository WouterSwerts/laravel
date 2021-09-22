<div class="mb-2 mt-2">
   @auth
      <form action="{{ $route }}" method="POST">
       @csrf

         <div class="form-group">
            <textarea type="text" class="form-control" name="content"></textarea>
         </div>
  
         <div>
            <input type="submit" value="Add Comment" class="btn btn-primary btn-block">
         </div>
      </form>
      @errors @enderrors
   @else
      <a href="{{ route('login') }}">Sign-in </a>to post comments!
   @endauth
</div>
<hr>