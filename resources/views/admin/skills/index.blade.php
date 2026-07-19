@extends('admin.layouts.admin')

@section('title', 'Manage Skills')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Skills</h1>
            <p class="text-secondary small mb-0">Group core technical stack competencies into the 7 developer classifications.</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Add Skill
        </a>
    </div>

    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th>Skill Name</th>
                        <th>Category</th>
                        <th>Icon Class</th>
                        <th>Level</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skills as $skill)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $skill->order }}</td>
                            <td class="fw-bold text-white">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }} text-primary me-2"></i>
                                @endif
                                {{ $skill->name }}
                            </td>
                            <td>
                                <span class="badge bg-dark text-secondary border" style="font-size: 0.75rem; border-color: var(--border-color) !important;">{{ $skill->category }}</span>
                            </td>
                            <td class="text-secondary small"><code>{{ $skill->icon ?: 'None' }}</code></td>
                            <td>
                                @if($skill->level === 'Expert')
                                    <span class="admin-badge admin-badge-success">Expert</span>
                                @elseif($skill->level === 'Advanced')
                                    <span class="admin-badge admin-badge-info">Advanced</span>
                                @elseif($skill->level === 'Intermediate')
                                    <span class="admin-badge admin-badge-warning">Intermediate</span>
                                @else
                                    <span class="admin-badge bg-transparent border text-secondary" style="border-color: var(--border-color) !important;">Beginner</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.skills.edit', $skill->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                        <i class="bi bi-pencil-square text-primary"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this skill?');">
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
                                <i class="bi bi-cpu fs-1 d-block mb-3 opacity-50"></i>
                                No skills registered.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
