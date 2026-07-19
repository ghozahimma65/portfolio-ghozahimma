@extends('admin.layouts.admin')

@section('title', 'Manage Blog')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Blog Module</h1>
            <p class="text-secondary small mb-0">Publish developer journals, technical tutorials, and release updates.</p>
        </div>
        <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Write Post
        </a>
    </div>

    <div class="row g-4">
        <!-- Left Column: Posts Table List -->
        <div class="col-lg-8">
            <!-- Search & Filter panel -->
            <div class="glass-panel p-3 mb-4">
                <form action="{{ route('admin.blog-posts.index') }}" method="GET" class="row g-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control form-control-admin" placeholder="Search by title..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select form-control-admin">
                            <option value="">All Statuses</option>
                            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">Apply</button>
                            <a href="{{ route('admin.blog-posts.index') }}" class="btn-admin btn-admin-secondary" title="Clear Filters"><i class="bi bi-x-lg"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="glass-panel">
                <div class="table-responsive">
                    <table class="table admin-table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Cover</th>
                                <th>Post Details</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th style="width: 150px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>
                                        @if($post->image_path)
                                            <img src="{{ asset($post->image_path) }}" alt="" style="width: 80px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                                        @else
                                            <div class="small text-muted" style="width: 80px; height: 45px; border: 1px dashed var(--border-color); display: flex; align-items: center; justify-content: center; border-radius: 4px;"><i class="bi bi-file-text"></i></div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-block fw-bold text-white">{{ $post->title }}</span>
                                        <span class="d-block small text-muted text-truncate" style="max-width: 250px;">{{ $post->slug }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark text-secondary border" style="font-size: 0.7rem; border-color: var(--border-color) !important;">
                                            {{ $post->category ? $post->category->name : 'Uncategorized' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($post->status === 'published')
                                            <span class="admin-badge admin-badge-success">🟢 Published</span>
                                            <span class="d-block text-muted" style="font-size: 0.65rem; margin-top: 2px;">{{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</span>
                                        @else
                                            <span class="admin-badge admin-badge-warning">🟡 Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.blog-posts.edit', $post->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                                <i class="bi bi-pencil-square text-primary"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.blog-posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-admin btn-admin-secondary btn-sm px-2">
                                                    <i class="bi bi-trash text-danger"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-secondary">
                                        <i class="bi bi-journal-x fs-1 d-block mb-3 opacity-50"></i>
                                        No blog posts found.
                                        <div class="mt-3">
                                            <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin btn-admin-primary btn-sm mx-auto d-inline-flex align-items-center gap-1">
                                                <i class="bi bi-plus-lg"></i> Create First Post
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-3 border-top d-flex flex-column flex-md-row align-items-center justify-content-between gap-3" style="border-color: var(--border-color) !important;">
                    <span class="text-secondary small">
                        Showing {{ $posts->firstItem() ?? 0 }}–{{ $posts->lastItem() ?? 0 }} of {{ $posts->total() }} records
                    </span>
                    @if($posts->hasPages())
                        <div class="m-0">
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Categories Overview List -->
        <div class="col-lg-4">
            <div class="glass-panel p-4 mb-4">
                <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;"><i class="bi bi-tags text-primary"></i> Categories</h3>
                <ul class="list-unstyled mb-0 d-flex flex-column gap-2" style="font-size: 0.9rem;">
                    @forelse($categories as $cat)
                        <li class="d-flex align-items-center justify-content-between py-1 border-bottom" style="border-color: var(--border-color) !important;">
                            <span class="text-white">{{ $cat->name }}</span>
                            <span class="badge bg-dark text-secondary border" style="border-color: var(--border-color) !important;">{{ $cat->posts_count }} posts</span>
                        </li>
                    @empty
                        <li class="text-center text-secondary small py-2">No categories defined yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
