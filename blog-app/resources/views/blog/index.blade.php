<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font (Cinzel) for a more stylized look -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS for Genshin Impact style -->
    <style>
        /* Background and page layout */
        body {
            font-family: 'Cinzel', serif;
            /* Genshin-style font */
            background: url('https://img.freepik.com/premium-photo/fairy-tale-world-dream-starry-sky-illustration-caring-poster-world-autism-day_432516-5773.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
        }

        h1,
        h2 {
            text-align: center;
            font-weight: 600;
            color: #ffcc00;
            /* Genshin yellow accent */
        }

        .alert-success {
            background-color: rgba(50, 205, 50, 0.8);
            /* Success message in green */
            color: white;
            font-weight: bold;
        }

        .alert-danger {
            background-color: rgba(255, 69, 58, 0.8);
            /* Error message in red */
            color: white;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #ffcc00;
            border-color: #ffcc00;
            color: #333;
            font-weight: 600;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #e6b800;
            border-color: #e6b800;
        }

        .btn-danger {
            background-color: #ff4c4c;
            border-color: #ff4c4c;
        }

        .btn-danger:hover {
            background-color: #ff2a2a;
            border-color: #ff2a2a;
        }

        /* Styling for 3-column layout */
        .posts-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            /* Auto-adjust columns */
            gap: 20px;
            margin-top: 30px;
        }

        .post-card {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        }

        .post-card h3 {
            color: #ffcc00;
        }

        .post-card p {
            color: #f0f0f0;
            font-size: 14px;
        }

        .post-card small {
            color: #dcdcdc;
        }

        /* Ensure content wraps inside each post card */
        .post-card p {
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .modal-content {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
        }

        .modal-header {
            border-bottom: 1px solid #ffcc00;
        }

        .modal-title {
            color: #ffcc00;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>Welcome, {{ session()->get('name', 'Guest') }}</h1>
        <h2>All Blog Posts</h2>

        <!-- Display Success or Error Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Display logout button if user is logged in -->
        @if (session('logged_in'))
            <form action="{{ route('logout') }}" method="POST" class="mb-4 text-end">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        @endif

        <!-- Button to open the modal -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createPostModal">
            Create New Post
        </button>

        <!-- Display all blog posts in 3-column layout -->
        <div class="posts-container">
            @if ($posts->isEmpty())
                <p>No posts available.</p>
            @else
                @foreach ($posts as $post)
                    <div class="post-card">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ \Str::limit($post->content, 100) }}</p> <!-- Truncate content for preview -->
                        <small>By: {{ $post->user->name }}
                            {{ $post->created_at->format('F j, Y') }}</small>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Modal for creating a new post -->
        <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPostModalLabel">Create New Blog Post</h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Include the form from create.blade.php -->
                        @include('blog.create') <!-- This will include the form from create.blade.php -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (required for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
