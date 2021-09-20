<div class="form-group">
   <label for="title">Title</label>
   <input id="title" type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}" class="form-control">
</div>

<div class="form-group">
   <label for="content">Content</label>
   <textarea id="content" class="form-control" name="content">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

@errors @enderrors