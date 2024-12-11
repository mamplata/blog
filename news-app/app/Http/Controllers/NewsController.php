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

    public function home(Request $request)
    {
        // Check if it is an AJAX request for search
        if ($request->ajax()) {
            $search = urldecode($request->input('search')); // Decode the search string

            // Fetch filtered news based on the search query
            $news = News::with('user')
                ->orderBy('date_published', 'desc')
                ->get();

            // Append the formatted date_published to each news item
            $news->each(function ($item) {
                $item->date_published_formatted = $item->date_published->format('F j, Y');
            });

            // Filter the news items based on the search query, including the formatted date
            $filteredNews = $news->filter(function ($item) use ($search) {
                // Search within headline, author, or formatted date
                return stripos($item->headline, $search) !== false ||
                    stripos($item->author, $search) !== false ||
                    stripos($item->date_published_formatted, $search) !== false;
            });

            // Ensure the filtered results are always an array, even if only one item matches
            $filteredNews = $filteredNews->values();

            // Return JSON response for AJAX
            return response()->json($filteredNews);
        }

        // Default non-AJAX request handling
        $news = News::orderBy('date_published', 'desc')->with('user')->get();

        // Append the formatted date_published to each news item
        $news->each(function ($item) {
            $item->date_published_formatted = $item->date_published->format('F j, Y');
        });

        return view('welcome', ['news' => $news]);
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
