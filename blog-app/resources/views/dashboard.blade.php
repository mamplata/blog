<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News App') }}
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
                        data-bs-target="#createNewsModal">
                        Create News Post
                    </button>
                </div>

                <!-- News Grid -->
                <div class="row g-4 mt-4">
                    @forelse ($news as $item)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="bg-light p-4 rounded shadow"
                                style="height: 250px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden;">
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
                                        {{ Str::limit($item->content, 150) }}
                                    </p>
                                </div>

                                <!-- Author and Date Section -->
                                <small class="text-muted">
                                    <span class="d-block">By: {{ $item->author }}</span>
                                    <span>Published on: {{ $item->date_published->format('F j, Y') }}</span>
                                </small>
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

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="createNewsModal" tabindex="-1" aria-labelledby="createNewsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewsModalLabel">Create News Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Include the form from create.blade.php -->
                    @include('news.create') <!-- Assuming this contains your form -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
