<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        // Fetch all news items, ordered by the most recent, including the related user data
        $news = News::orderBy('date_published', 'desc')->with('user')->get();

        // Pass the news and authenticated user's name to the dashboard view
        return view('dashboard', [
            'news' => $news,
            'userName' => auth()->user()->name,
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'headline' => 'required|min:10',
            'content' => 'required|min:100',
            'author' => 'required|string|max:255',
            'date_published' => 'required|date',
        ]);

        try {
            // Create and store the new news item
            News::create([
                'headline' => $request->headline,
                'content' => $request->content,
                'author' => $request->author,
                'date_published' => $request->date_published,
                'user_id' => auth()->id(),
            ]);

            // Redirect to the dashboard with a success message
            return redirect()->route('dashboard')->with('success', 'News post created successfully.');
        } catch (\Exception $e) {
            // Redirect to the dashboard with an error message
            return redirect()->route('dashboard')->with('error', 'Failed to create news post. Please try again.');
        }
    }

    public function edit($id)
    {
        // Fetch the news item by ID
        $news = News::findOrFail($id);

        // Pass the news item to the edit view
        return view('edit-news', compact('news'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'headline' => 'required|min:10',
            'content' => 'required|min:100',
            'author' => 'required|string|max:255',
            'date_published' => 'required|date',
        ]);

        try {
            // Find the news item by ID and update it
            $news = News::findOrFail($id);
            $news->update([
                'headline' => $request->headline,
                'content' => $request->content,
                'author' => $request->author,
                'date_published' => $request->date_published,
            ]);

            // Redirect to the dashboard with a success message
            return redirect()->route('dashboard')->with('success', 'News post updated successfully.');
        } catch (\Exception $e) {
            // Redirect to the dashboard with an error message
            return redirect()->route('dashboard')->with('error', 'Failed to update news post. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            // Find the news item by ID and delete it
            $news = News::findOrFail($id);
            $news->delete();

            // Redirect to the dashboard with a success message
            return redirect()->route('dashboard')->with('success', 'News post deleted successfully.');
        } catch (\Exception $e) {
            // Redirect to the dashboard with an error message
            return redirect()->route('dashboard')->with('error', 'Failed to delete news post. Please try again.');
        }
    }
}
