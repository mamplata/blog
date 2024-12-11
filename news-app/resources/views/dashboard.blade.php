<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display Flash Messages -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Welcome Section -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }}</h1>

                    <!-- Button to open the Create News modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createNewsModal">
                        <i class="fas fa-plus-circle"></i> Create News Post
                    </button>
                </div>

                <!-- News Grid -->
                <div class="row g-4 mt-4">
                    @forelse ($news as $item)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="bg-light p-4 rounded shadow"
                                style="height: 300px; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    <!-- Headline Section -->
                                    <label class="text-primary fw-bold">Headline:</label>
                                    <h3 class="font-weight-bold text-truncate" title="{{ $item->headline }}">
                                        {{ $item->headline }}
                                    </h3>

                                    <!-- Content Section -->
                                    <label class="text-secondary fw-bold mt-2 d-block">Content:</label>
                                    <p style="max-width: 100%; word-wrap: break-word; white-space: normal; overflow: hidden;"
                                        title="{{ $item->content }}">
                                        {{ Str::limit($item->content, 100) }}
                                    </p>
                                </div>

                                <!-- Author and Date Section -->
                                <small class="text-muted">
                                    <div class="text-gray-500 text-sm">
                                        <p><i class="fas fa-user"></i> By: {{ $item->author }}</p>
                                        <p><i class="fas fa-calendar-alt"></i> Published:
                                            {{ $item->date_published_formatted }}
                                        </p>
                                    </div>
                                </small>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-warning btn-sm w-100 me-4"
                                        data-bs-toggle="modal" data-bs-target="#editNewsModal-{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger btn-sm w-100" data-bs-toggle="modal"
                                        data-bs-target="#deleteNewsModal-{{ $item->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Edit News Modal -->
                        <div class="modal fade" id="editNewsModal-{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editNewsModalLabel-{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editNewsModalLabel-{{ $item->id }}">Edit News
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('news.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="headline" class="form-label">Headline</label>
                                                <input type="text" name="headline" id="headline"
                                                    class="form-control" value="{{ $item->headline }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Content</label>
                                                <textarea name="content" id="content" class="form-control" rows="4" required>{{ $item->content }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="author" class="form-label">Author</label>
                                                <input type="text" name="author" id="author" class="form-control"
                                                    value="{{ $item->author }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date_published" class="form-label">Date Published</label>
                                                <input type="date" name="date_published" id="date_published"
                                                    class="form-control"
                                                    value="{{ $item->date_published->format('Y-m-d') }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Save Changes
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete News Modal -->
                        <div class="modal fade" id="deleteNewsModal-{{ $item->id }}" tabindex="-1"
                            aria-labelledby="deleteNewsModalLabel-{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteNewsModalLabel-{{ $item->id }}">
                                            Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this news post?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('news.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i> Yes, Delete
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No news posts available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Create News Modal -->
    <div class="modal fade" id="createNewsModal" tabindex="-1" aria-labelledby="createNewsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewsModalLabel">Create News Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('news.create') <!-- Assuming this contains your form -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
