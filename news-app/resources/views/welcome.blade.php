<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Newsletter</title>

    <!-- Fonts and Styles -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body class="font-sans antialiased bg-cover bg-no-repeat"
    style="background-image: url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center;">
    <div class="min-h-screen bg-opacity-80">
        <!-- Header -->
        <header class="bg-white shadow-md py-4">
            <div class="container mx-auto flex justify-between items-center px-4">
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/news.png') }}" alt="Logo" class="h-12 w-auto" />
                    </a>
                    <div class="ml-4 text-2xl font-serif font-bold text-gray-800">
                        NewsLetter
                    </div>
                </div>
                @if (Route::has('login'))
                    <nav class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                                <i class="fas fa-sign-in-alt"></i> Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-md shadow-md hover:bg-gray-600">
                                    <i class="fas fa-user-plus"></i> Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main class="py-10">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Latest News</h2>

                <!-- Search Bar -->
                <div class="mb-6">
                    <input type="text" id="searchInput"
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Search news by keyword...">
                </div>

                <!-- News Listing -->
                <div id="newsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($news as $item)
                        <div class="news-card bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 truncate" title="{{ $item->headline }}">
                                    {{ $item->headline }}
                                </h3>
                                <p class="text-gray-700 mb-4">{{ Str::limit($item->content, 100, '...') }}</p>
                                <div class="text-gray-500 text-sm">
                                    <p><i class="fas fa-user"></i> By: {{ $item->author }}</p>
                                    <p><i class="fas fa-calendar-alt"></i> Published:
                                        {{ $item->date_published_formatted }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-4 mt-10">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Newsletter. All rights reserved.</p>
            </div>
        </footer>

        <!-- AJAX Search Script -->
        <script>
            $(document).ready(function() {
                $('#searchInput').on('keyup', function() {
                    const searchValue = $(this).val();

                    // Perform AJAX request
                    $.ajax({
                        url: "{{ url('/') }}", // URL to the home route
                        method: "GET",
                        data: {
                            search: searchValue
                        },
                        success: function(response) {

                            let newsHtml = '';

                            // Generate HTML for filtered news
                            response.forEach(news => {
                                newsHtml += `
                            <div class="news-card bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 truncate" title="${news.headline}">
                                        ${news.headline}
                                    </h3>
                                    <p class="text-gray-700 mb-4">${news.content.substring(0, 100)}...</p>
                                    <div class="text-gray-500 text-sm">
                                        <p><i class="fas fa-user"></i> By: ${news.author}</p>
                                        <p><i class="fas fa-calendar-alt"></i> Published: ${news.date_published_formatted}</p>
                                    </div>
                                </div>
                            </div>
                            `;
                            });

                            // Update the news container
                            $('#newsContainer').html(newsHtml);
                        },
                        error: function(err) {
                            console.error("Search error:", err);
                        }
                    });
                });
            });
        </script>
    </div>
</body>

</html>
