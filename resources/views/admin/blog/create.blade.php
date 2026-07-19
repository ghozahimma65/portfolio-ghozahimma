@extends('admin.layouts.admin')

@section('title', 'Write Post')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <a href="{{ route('admin.blog-posts.index') }}" class="text-primary text-decoration-none small">&larr; Back to Blog</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Write New Post</h1>
        <p class="text-secondary small mb-0">Publish an article or journal entry.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 small mb-4 py-2" style="background-color: rgba(239, 68, 68, 0.1); color: var(--status-danger);">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- Left panel (Post content) -->
            <div class="col-lg-8">
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Post Details</h3>
                    
                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-6">
                            <label for="title" class="form-label text-secondary small fw-bold">Post Title</label>
                            <input type="text" id="title" name="title" class="form-control form-control-admin w-100" placeholder="e.g. Building Scalable APIs in Laravel" value="{{ old('title') }}" required>
                        </div>
                        
                        <!-- Slug -->
                        <div class="col-md-6">
                            <label for="slug" class="form-label text-secondary small fw-bold">Slug (URL identifier)</label>
                            <input type="text" id="slug" name="slug" class="form-control form-control-admin w-100" placeholder="e.g. building-scalable-apis-laravel" value="{{ old('slug') }}">
                        </div>

                        <!-- Content -->
                        <div class="col-12">
                            <label for="content" class="form-label text-secondary small fw-bold">Post Content (Markdown or HTML)</label>
                            <textarea id="content" name="content" rows="12" class="form-control form-control-admin w-100" placeholder="Write article content details here..." required>{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Custom Tags -->
                <div class="glass-panel p-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;"><i class="bi bi-tag-fill text-primary"></i> Tags</h3>
                    <div class="mb-3">
                        <label for="tags" class="form-label text-secondary small fw-bold">Tags (Comma-separated)</label>
                        <input type="text" id="tags" name="tags" class="form-control form-control-admin w-100" placeholder="Laravel, API, Backend, Web Development" value="{{ old('tags') }}">
                        <small class="text-muted" style="font-size: 0.75rem;">Enter tags separated by commas. New tags will be auto-registered.</small>
                    </div>
                </div>
            </div>

            <!-- Right settings panel (Uploads and status flags) -->
            <div class="col-lg-4">
                <!-- Status & Category -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Publishing Controls</h3>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label text-secondary small fw-bold">Status</label>
                        <select name="status" id="status" class="form-select form-control-admin" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label text-secondary small fw-bold">Category</label>
                        <select name="category_id" id="category_id" class="form-select form-control-admin">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="new_category" class="form-label text-secondary small fw-bold">Or Add New Category</label>
                        <input type="text" id="new_category" name="new_category" class="form-control form-control-admin w-100" placeholder="e.g. Telemetry">
                    </div>
                </div>

                <!-- Cover Image -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Cover Image</h3>
                    <div class="mb-3">
                        <label for="image" class="form-label text-secondary small fw-bold">Cover Photo</label>
                        <input type="file" id="image" name="image" class="form-control form-control-admin w-100" accept="image/*">
                    </div>
                </div>

                <!-- SEO Tags -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">SEO Control</h3>
                    
                    <div class="mb-3">
                        <label for="seo_title" class="form-label text-secondary small fw-bold">SEO Title</label>
                        <input type="text" id="seo_title" name="seo_title" class="form-control form-control-admin w-100" placeholder="Search page title override">
                    </div>

                    <div class="mb-3">
                        <label for="seo_description" class="form-label text-secondary small fw-bold">SEO Description</label>
                        <textarea id="seo_description" name="seo_description" rows="3" class="form-control form-control-admin w-100" placeholder="Meta description overrides"></textarea>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">
                        <i class="bi bi-journal-check"></i> Save Article
                    </button>
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn-admin btn-admin-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
