@extends('admin.layouts.admin')

@section('title', 'Edit Certificate')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <a href="{{ route('admin.certificates.index') }}" class="text-primary text-decoration-none small">&larr; Back to Certificates</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Edit Certificate</h1>
        <p class="text-secondary small mb-0">Update training accomplishment.</p>
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

    <div class="glass-panel p-4" style="max-width: 700px;">
        <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-12">
                    <label for="title" class="form-label text-secondary small fw-bold">Certificate Name</label>
                    <input type="text" id="title" name="title" class="form-control form-control-admin w-100" placeholder="e.g. IQF Level 3 Animation" value="{{ old('title', $certificate->title) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="issuer" class="form-label text-secondary small fw-bold">Issuer</label>
                    <input type="text" id="issuer" name="issuer" class="form-control form-control-admin w-100" placeholder="e.g. LSP / BNSP Indonesia" value="{{ old('issuer', $certificate->issuer) }}">
                </div>

                <div class="col-md-6">
                    <label for="issue_date" class="form-label text-secondary small fw-bold">Issue Date</label>
                    <input type="text" id="issue_date" name="issue_date" class="form-control form-control-admin w-100" placeholder="e.g. 2024" value="{{ old('issue_date', $certificate->issue_date) }}">
                </div>

                <div class="col-12">
                    <label for="credential_url" class="form-label text-secondary small fw-bold">Credential URL (Verification link)</label>
                    <input type="url" id="credential_url" name="credential_url" class="form-control form-control-admin w-100" placeholder="https://example.com/verify/..." value="{{ old('credential_url', $certificate->credential_url) }}">
                </div>

                <div class="col-md-6">
                    <label for="category" class="form-label text-secondary small fw-bold">Classification Category</label>
                    <input type="text" id="category" name="category" class="form-control form-control-admin w-100" placeholder="e.g. Programming, Design" value="{{ old('category', $certificate->category) }}">
                </div>

                <div class="col-md-6">
                    <label for="order" class="form-label text-secondary small fw-bold">Display Order</label>
                    <input type="number" id="order" name="order" class="form-control form-control-admin w-100" value="{{ old('order', $certificate->order) }}" required>
                </div>

                @if($certificate->image_path)
                    <div class="col-12 text-center my-2">
                        <span class="text-secondary small d-block text-start mb-2">Current Image Preview</span>
                        <img src="{{ $certificate->image_path && str_starts_with($certificate->image_path, 'http') ? $certificate->image_path : asset($certificate->image_path) }}" alt="" style="max-height: 120px; object-fit: contain; border: 1px solid var(--border-color); border-radius: 4px; padding: 4px;">
                    </div>
                @endif

                <div class="col-12">
                    <label for="image" class="form-label text-secondary small fw-bold">Change Certificate Image / PDF Thumbnail</label>
                    <input type="file" id="image" name="image" class="form-control form-control-admin w-100" accept="image/*">
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input bg-transparent border-secondary" type="checkbox" name="featured" id="featured" value="1" {{ $certificate->featured ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary small" for="featured">
                            Featured Credential (Show highlighted chip)
                        </label>
                    </div>
                </div>

                <div class="col-12 mt-4 d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">Save Changes</button>
                    <a href="{{ route('admin.certificates.index') }}" class="btn-admin btn-admin-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
