@extends('admin.layouts.admin')

@section('title', 'Add Education')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <a href="{{ route('admin.education.index') }}" class="text-primary text-decoration-none small">&larr; Back to Education</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Add Education</h1>
        <p class="text-secondary small mb-0">Insert academic history details.</p>
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
        <form action="{{ route('admin.education.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-12">
                    <label for="school" class="form-label text-secondary small fw-bold">School / University</label>
                    <input type="text" id="school" name="school" class="form-control form-control-admin w-100" placeholder="e.g. Politeknik Negeri Jember" value="{{ old('school') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="degree" class="form-label text-secondary small fw-bold">Degree</label>
                    <input type="text" id="degree" name="degree" class="form-control form-control-admin w-100" placeholder="e.g. Diploma III (D3)" value="{{ old('degree') }}">
                </div>

                <div class="col-md-6">
                    <label for="major" class="form-label text-secondary small fw-bold">Major</label>
                    <input type="text" id="major" name="major" class="form-control form-control-admin w-100" placeholder="e.g. Manajemen Informatika" value="{{ old('major') }}">
                </div>

                <div class="col-md-4">
                    <label for="start_date" class="form-label text-secondary small fw-bold">Start Date</label>
                    <input type="text" id="start_date" name="start_date" class="form-control form-control-admin w-100" placeholder="e.g. 2021" value="{{ old('start_date') }}" required>
                </div>

                <div class="col-md-4">
                    <label for="end_date" class="form-label text-secondary small fw-bold">End Date</label>
                    <input type="text" id="end_date" name="end_date" class="form-control form-control-admin w-100" placeholder="e.g. 2024" value="{{ old('end_date') }}" required>
                </div>

                <div class="col-md-4">
                    <label for="order" class="form-label text-secondary small fw-bold">Display Order</label>
                    <input type="number" id="order" name="order" class="form-control form-control-admin w-100" value="0" required>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label text-secondary small fw-bold">Description / Achievements</label>
                    <textarea id="description" name="description" rows="4" class="form-control form-control-admin w-100" placeholder="Describe major study highlights, GPA details, or final thesis projects...">{{ old('description') }}</textarea>
                </div>

                <div class="col-12 mt-4 d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">Create Record</button>
                    <a href="{{ route('admin.education.index') }}" class="btn-admin btn-admin-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
