<?php


namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        if (session('logged_in')) {
            $userName = session('name');
            $posts = BlogPost::orderBy('created_at', 'desc')->with('user')->get();
            return view('blog.index', compact('posts'));
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in first.');
        }
    }

    // Store the submitted blog post
    public function store(Request $request)
    {
        if (session('logged_in')) {
            // Validate the request data
            $validated = $request->validate([
                'title' => 'required|min:10',
                'content' => 'required|min:100',
            ]);

            try {
                // Create and store the new blog post
                BlogPost::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'user_id' => session('user_id'), // Assuming the user is logged in
                ]);

                // Flash success message to session and redirect to blog index
                return redirect()->route('blog.index')->with('success', 'Blog post created successfully.');
            } catch (\Exception $e) {
                // Flash error message in case of an exception
                return redirect()->route('blog.index')->with('error', 'Failed to create blog post. Please try again.');
            }
        } else {
            // If not logged in, redirect to login page
            return redirect()->route('login')->with('error', 'You need to be logged in first.');
        }
    }
}
