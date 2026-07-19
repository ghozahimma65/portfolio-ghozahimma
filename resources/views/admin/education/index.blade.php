@extends('admin.layouts.admin')

@section('title', 'Manage Education')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Education</h1>
            <p class="text-secondary small mb-0">Manage degree achievements and academic timelines.</p>
        </div>
        <a href="{{ route('admin.education.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Add Education
        </a>
    </div>

    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th>School / University</th>
                        <th>Degree & Major</th>
                        <th>Start / End Date</th>
                        <th>Description</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($educations as $edu)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $edu->order }}</td>
                            <td class="fw-bold text-white">{{ $edu->school }}</td>
                            <td>
                                <span class="d-block text-primary fw-semibold">{{ $edu->degree }}</span>
                                <span class="d-block text-secondary small">{{ $edu->major }}</span>
                            </td>
                            <td class="text-secondary">{{ $edu->start_date }} — {{ $edu->end_date }}</td>
                            <td class="text-muted small">{{ Str::limit($edu->description, 100) }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.education.edit', $edu->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                        <i class="bi bi-pencil-square text-primary"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.education.destroy', $edu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this education record?');">
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
                            <td colspan="6" class="text-center py-5 text-secondary">
                                <i class="bi bi-mortarboard fs-1 d-block mb-3 opacity-50"></i>
                                No education entries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
