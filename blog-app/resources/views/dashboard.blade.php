<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog App') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Display Flash Messages -->
            @if (session('status'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Welcome Section -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }}</h1>

                <!-- Button to open the modal -->
                <button
                    type="button"
                    class="btn btn-primary mb-4"
                    data-bs-toggle="modal"
                    data-bs-target="#createPostModal">
                    Create New Post
                </button>

                <!-- Posts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    @forelse ($posts as $post)
                        <div class="bg-gray-100 p-4 rounded shadow">
                            <h3 class="font-semibold text-lg">{{ $post->title }}</h3>
                            <p>{{ Str::limit($post->content, 100) }}</p>
                            <small class="text-gray-600">
                                By: {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}
                            </small>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500">No posts available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for creating a new post -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModalLabel">Create New Blog Post</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Include the form from create.blade.php -->
                    @include('blog.create') <!-- Assuming this contains your form -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
