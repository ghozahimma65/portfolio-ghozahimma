@extends('admin.layouts.admin')

@section('title', 'Edit Social Link')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <a href="{{ route('admin.social-links.index') }}" class="text-primary text-decoration-none small">&larr; Back to Social Links</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Edit Social Link</h1>
        <p class="text-secondary small mb-0">Update dynamic external profile reference.</p>
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

    <div class="glass-panel p-4" style="max-width: 600px;">
        <form action="{{ route('admin.social-links.update', $social_link->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="platform" class="form-label text-secondary small fw-bold">Platform Name</label>
                    <input type="text" id="platform" name="platform" class="form-control form-control-admin w-100" placeholder="e.g. GitHub" value="{{ old('platform', $social_link->platform) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="icon" class="form-label text-secondary small fw-bold">Bootstrap Icon Class</label>
                    <input type="text" id="icon" name="icon" class="form-control form-control-admin w-100" placeholder="e.g. bi bi-github" value="{{ old('icon', $social_link->icon) }}">
                </div>

                <div class="col-md-9">
                    <label for="url" class="form-label text-secondary small fw-bold">Profile URL</label>
                    <input type="url" id="url" name="url" class="form-control form-control-admin w-100" placeholder="https://github.com/username" value="{{ old('url', $social_link->url) }}" required>
                </div>

                <div class="col-md-3">
                    <label for="order" class="form-label text-secondary small fw-bold">Display Order</label>
                    <input type="number" id="order" name="order" class="form-control form-control-admin w-100" value="{{ old('order', $social_link->order) }}" required>
                </div>

                <div class="col-12 mt-4 d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">Save Changes</button>
                    <a href="{{ route('admin.social-links.index') }}" class="btn-admin btn-admin-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
