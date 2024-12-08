<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostController extends Controller
{

    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->with('user')->get();

        // Using Breeze, the authenticated user's name can be accessed via `auth()->user()`
        return view('dashboard', [
            'posts' => $posts,
            'userName' => auth()->user()->name, // Pass the user's name to the view
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|min:10',
            'content' => 'required|min:100',
        ]);

        try {
            // Create and store the new blog post
            BlogPost::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id(), // Get the authenticated user's ID
            ]);

            // Redirect to the dashboard with a success message
            return redirect()->route('dashboard')->with('success', 'Blog post created successfully.');
        } catch (\Exception $e) {
            // Redirect to the dashboard with an error message
            return redirect()->route('dashboard')->with('error', 'Failed to create blog post. Please try again.');
        }
    }
}
