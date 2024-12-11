<form action="{{ url('/news') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="headline" class="form-label">Headline</label>
        <input type="text" class="form-control" id="headline" name="headline" required minlength="10"
            value="{{ old('headline') }}">
        @error('headline')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="4" required minlength="100">{{ old('content') }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author" required
            value="{{ old('author', Auth::user()->name) }}">
        @error('author')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="date_published" class="form-label">Date Published</label>
        <input type="date" class="form-control" id="date_published" name="date_published" required
            value="{{ old('date_published', now()->format('Y-m-d')) }}">
        @error('date_published')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Save News
    </button>
</form>
