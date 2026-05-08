<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display all blogs on home page.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(9);

        $categories = Blog::select('category')
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('home', compact('blogs', 'categories'));
    }

    /**
     * Display single blog detail page.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        $relatedBlogs = Blog::where('category', $blog->category)
            ->where('id', '!=', $id)
            ->latest()
            ->limit(3)
            ->get();

        return view('blog_detail', compact('blog', 'relatedBlogs'));
    }

    /**
     * Filter blogs by category via AJAX.
     */
    public function filterByCategory(Request $request)
    {
        try {

            $category = $request->input('category');

            if (empty($category) || $category === 'all') {

                $blogs = Blog::latest()->get();

            } else {

                $blogs = Blog::where('category', $category)
                    ->latest()
                    ->get();
            }

            return response()->json([
                'html' => view('partials.blog_cards', compact('blogs'))->render()
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Filter blogs by date range via AJAX.
     */
    public function filterByDate(Request $request)
    {
        try {

            $startDate = $request->input('start_date');

            $endDate = $request->input('end_date');

            $blogs = Blog::whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->latest()->get();

            return response()->json([
                'html' => view('partials.blog_cards', compact('blogs'))->render()
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search blogs via AJAX.
     */
    public function search(Request $request)
    {
        try {

            $query = $request->input('q');

            $blogs = Blog::where('title', 'like', "%{$query}%")
                ->orWhere('short_description', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->latest()
                ->get();

            return response()->json([
                'html' => view('partials.blog_cards', compact('blogs'))->render()
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}