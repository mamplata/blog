<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog News App') }}
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

                    <!-- Button to open the modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createPostModal">
                        Create New Post
                    </button>
                </div>

                <!-- Posts Grid -->
                <!-- Posts Grid -->
                <div class="row g-4 mt-4">
                    @forelse ($posts as $post)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="bg-light p-4 rounded shadow"
                                style="height: 250px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden;">
                                <div>
                                    <h3 class="font-weight-bold text-truncate" title="{{ $post->title }}">
                                        {{ $post->title }}
                                    </h3>
                                    <!-- Apply word wrap and overflow control -->
                                    <p style="max-width: 100%; word-wrap: break-word; white-space: normal; overflow: hidden;"
                                        title="{{ $post->content }}">
                                        {{ Str::limit($post->content, 150) }}
                                    </p>
                                </div>
                                <small class="text-muted">
                                    By: {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No posts available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModalLabel">Create New Blog Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Include the form from create.blade.php -->
                    @include('blog.create') <!-- Assuming this contains your form -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
