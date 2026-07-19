@extends('admin.layouts.admin')

@section('title', 'Edit Skill')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <a href="{{ route('admin.skills.index') }}" class="text-primary text-decoration-none small">&larr; Back to Skills</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Edit Skill</h1>
        <p class="text-secondary small mb-0">Update core stack technology.</p>
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
        <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label text-secondary small fw-bold">Skill Name</label>
                    <input type="text" id="name" name="name" class="form-control form-control-admin w-100" placeholder="e.g. PHP / Laravel" value="{{ old('name', $skill->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="category" class="form-label text-secondary small fw-bold">Category</label>
                    <select name="category" id="category" class="form-select form-control-admin" required>
                        <option value="Backend" {{ $skill->category === 'Backend' ? 'selected' : '' }}>Backend</option>
                        <option value="Frontend" {{ $skill->category === 'Frontend' ? 'selected' : '' }}>Frontend</option>
                        <option value="Mobile" {{ $skill->category === 'Mobile' ? 'selected' : '' }}>Mobile</option>
                        <option value="Database" {{ $skill->category === 'Database' ? 'selected' : '' }}>Database</option>
                        <option value="API" {{ $skill->category === 'API' ? 'selected' : '' }}>API</option>
                        <option value="IoT" {{ $skill->category === 'IoT' ? 'selected' : '' }}>IoT</option>
                        <option value="Tools" {{ $skill->category === 'Tools' ? 'selected' : '' }}>Tools</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="icon" class="form-label text-secondary small fw-bold">Bootstrap Icon Class</label>
                    <input type="text" id="icon" name="icon" class="form-control form-control-admin w-100" placeholder="e.g. bi bi-server" value="{{ old('icon', $skill->icon) }}">
                </div>

                <div class="col-md-3">
                    <label for="level" class="form-label text-secondary small fw-bold">Skill Level</label>
                    <select name="level" id="level" class="form-select form-control-admin" required>
                        <option value="Beginner" {{ $skill->level === 'Beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="Intermediate" {{ $skill->level === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Advanced" {{ $skill->level === 'Advanced' ? 'selected' : '' }}>Advanced</option>
                        <option value="Expert" {{ $skill->level === 'Expert' ? 'selected' : '' }}>Expert</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="order" class="form-label text-secondary small fw-bold">Display Order</label>
                    <input type="number" id="order" name="order" class="form-control form-control-admin w-100" value="{{ old('order', $skill->order) }}" required>
                </div>

                <div class="col-12 mt-4 d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">Save Changes</button>
                    <a href="{{ route('admin.skills.index') }}" class="btn-admin btn-admin-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
