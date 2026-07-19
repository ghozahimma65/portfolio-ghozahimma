@extends('admin.layouts.admin')

@section('title', 'Edit Award')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <a href="{{ route('admin.awards.index') }}" class="text-primary text-decoration-none small">&larr; Back to Awards</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Edit Award</h1>
        <p class="text-secondary small mb-0">Update award details.</p>
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
        <form action="{{ route('admin.awards.update', $award->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-12">
                    <label for="title" class="form-label text-secondary small fw-bold">Award Title</label>
                    <input type="text" id="title" name="title" class="form-control form-control-admin w-100" placeholder="e.g. 1st Place National IoT Contest" value="{{ old('title', $award->title) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="issuer" class="form-label text-secondary small fw-bold">Issuer / Organizer</label>
                    <input type="text" id="issuer" name="issuer" class="form-control form-control-admin w-100" placeholder="e.g. Kementerian Riset dan Teknologi" value="{{ old('issuer', $award->issuer) }}">
                </div>

                <div class="col-md-3">
                    <label for="year" class="form-label text-secondary small fw-bold">Year</label>
                    <input type="text" id="year" name="year" class="form-control form-control-admin w-100" placeholder="e.g. 2024" value="{{ old('year', $award->year) }}" required>
                </div>

                <div class="col-md-3">
                    <label for="order" class="form-label text-secondary small fw-bold">Display Order</label>
                    <input type="number" id="order" name="order" class="form-control form-control-admin w-100" value="{{ old('order', $award->order) }}" required>
                </div>

                @if($award->image_path)
                    <div class="col-12 text-center my-2">
                        <span class="text-secondary small d-block text-start mb-2">Current Award Image</span>
                        <img src="{{ $award->image_path && str_starts_with($award->image_path, 'http') ? $award->image_path : asset($award->image_path) }}" alt="" style="max-height: 120px; object-fit: contain; border: 1px solid var(--border-color); border-radius: 4px; padding: 4px;">
                    </div>
                @endif

                <div class="col-12">
                    <label for="image" class="form-label text-secondary small fw-bold">Change Image</label>
                    <input type="file" id="image" name="image" class="form-control form-control-admin w-100" accept="image/*">
                </div>

                <div class="col-12">
                    <label for="description" class="form-label text-secondary small fw-bold">Description</label>
                    <textarea id="description" name="description" rows="4" class="form-control form-control-admin w-100" placeholder="Describe award context or system implementation details...">{{ old('description', $award->description) }}</textarea>
                </div>

                <div class="col-12 mt-4 d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">Save Changes</button>
                    <a href="{{ route('admin.awards.index') }}" class="btn-admin btn-admin-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
