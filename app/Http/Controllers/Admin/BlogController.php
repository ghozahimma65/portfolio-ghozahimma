<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogPostRequest;
use App\Http\Requests\Admin\UpdateBlogPostRequest;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }
    public function index(Request $request)
    {
        $query = BlogPost::query()->with('category');

        // 1. Search Filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // 2. Status Filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'deleted') {
                $query->onlyTrashed();
            } else {
                $query->where('status', $status);
            }
        }

        $posts = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
            
        $categories = BlogCategory::withCount('posts')->get();

        return view('admin.blog.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(StoreBlogPostRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $path = $this->cloudinary->upload($request->file('image'), 'blog');
            $validated['image_path'] = $path;
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $post = BlogPost::create($validated);

        // Sync Tags (Comma-separated string)
        if ($request->filled('tags')) {
            $tagNames = explode(',', $request->tags);
            $tagIds = [];
            foreach ($tagNames as $name) {
                $trimmed = trim($name);
                if ($trimmed !== '') {
                    $tag = BlogTag::firstOrCreate(
                        ['slug' => Str::slug($trimmed)],
                        ['name' => $trimmed]
                    );
                    $tagIds[] = $tag->id;
                }
            }
            $post->tags()->sync($tagIds);
        }

        // Handle category creation if custom value input
        if ($request->filled('new_category')) {
            $catName = trim($request->new_category);
            $category = BlogCategory::firstOrCreate(
                ['slug' => Str::slug($catName)],
                ['name' => $catName]
            );
            $post->update(['category_id' => $category->id]);
        }

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(BlogPost $blog_post)
    {
        $post        = $blog_post->load('tags');
        $categories  = BlogCategory::all();
        $tagsString  = $post->tags->pluck('name')->implode(', ');

        return view('admin.blog.edit', compact('post', 'categories', 'tagsString'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(UpdateBlogPostRequest $request, BlogPost $blog_post)
    {
        $post      = $blog_post;
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                $this->cloudinary->delete($post->image_path);
            }
            $path = $this->cloudinary->upload($request->file('image'), 'blog');
            $validated['image_path'] = $path;
        }

        if ($validated['status'] === 'published' && ! $post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        // Sync Tags (Comma separated string)
        if ($request->filled('tags')) {
            $tagNames = explode(',', $request->tags);
            $tagIds = [];
            foreach ($tagNames as $name) {
                $trimmed = trim($name);
                if ($trimmed !== '') {
                    $tag = BlogTag::firstOrCreate(
                        ['slug' => Str::slug($trimmed)],
                        ['name' => $trimmed]
                    );
                    $tagIds[] = $tag->id;
                }
            }
            $post->tags()->sync($tagIds);
        } else {
            $post->tags()->sync([]);
        }

        // Handle category creation if custom value input
        if ($request->filled('new_category')) {
            $catName = trim($request->new_category);
            $category = BlogCategory::firstOrCreate(
                ['slug' => Str::slug($catName)],
                ['name' => $catName]
            );
            $post->update(['category_id' => $category->id]);
        }

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(BlogPost $blog_post)
    {
        if ($blog_post->image_path) {
            $this->cloudinary->delete($blog_post->image_path);
        }
        $blog_post->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }
}
