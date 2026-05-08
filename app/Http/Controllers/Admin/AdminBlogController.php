<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    /**
     * Display all blogs
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dashboard', compact('blogs'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store blog
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => 'required|string|max:255',

            'short_description' => 'required|string|max:500',

            'content' => 'required|string',

            'category' => 'required|string|max:100',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /**
         * Image Upload
         */
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store inside storage/app/public/blogs
            $image->storeAs(
                'blogs',
                $imageName,
                'public'
            );

            // Save public path in DB
            $validated['image'] = 'storage/blogs/' . $imageName;
        }

        Blog::create($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Blog created successfully!');
    }

    /**
     * Edit blog form
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update blog
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([

            'title' => 'required|string|max:255',

            'short_description' => 'required|string|max:500',

            'content' => 'required|string',

            'category' => 'required|string|max:100',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /**
         * Image Upload
         */
        if ($request->hasFile('image')) {

            /**
             * Delete old image
             */
            if ($blog->image) {

                $oldImage = str_replace(
                    'storage/',
                    '',
                    $blog->image
                );

                Storage::disk('public')
                    ->delete($oldImage);
            }

            /**
             * Upload new image
             */
            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->storeAs(
                'blogs',
                $imageName,
                'public'
            );

            $validated['image'] = 'storage/blogs/' . $imageName;
        }

        $blog->update($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Blog updated successfully!');
    }

    /**
     * Delete blog
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        /**
         * Delete image
         */
        if ($blog->image) {

            $imagePath = str_replace(
                'storage/',
                '',
                $blog->image
            );

            Storage::disk('public')
                ->delete($imagePath);
        }

        $blog->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Blog deleted successfully!');
    }
}