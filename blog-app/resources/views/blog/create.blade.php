<!-- resources/views/blog/create.blade.php -->

<form action="{{ url('/blog') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required minlength="10">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="4" required minlength="100"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Post</button>
</form>
