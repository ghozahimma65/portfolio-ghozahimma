@extends('admin.layouts.admin')

@section('title', 'Manage Projects')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Projects</h1>
            <p class="text-secondary small mb-0">Create, edit, soft delete, and re-order featured showroom items.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Add New Project
        </a>
    </div>

    <!-- Search & Filter panel -->
    <div class="glass-panel p-3 mb-4">
        <form action="{{ route('admin.projects.index') }}" method="GET" class="row g-2">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control form-control-admin" placeholder="Search by title, details..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-control-admin">
                    <option value="">All Statuses</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published Only</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Drafts Only</option>
                    <option value="deleted" {{ request('status') === 'deleted' ? 'selected' : '' }}>Soft Deleted</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-admin btn-admin-primary w-100 justify-content-center">Apply</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-admin-secondary w-100 justify-content-center">Clear</a>
            </div>
        </form>
    </div>

    <!-- Projects Table -->
    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th style="width: 100px;">Thumbnail</th>
                        <th>Project Details</th>
                        <th>Category / Stack</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th style="width: 180px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $project->order }}</td>
                            <td>
                                @if($project->image_path)
                                    <img src="{{ asset($project->image_path) }}" alt="" style="width: 64px; height: 36px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                                @else
                                    <div class="small text-muted" style="width: 64px; height: 36px; border: 1px dashed var(--border-color); display: flex; align-items: center; justify-content: center; border-radius: 4px;">N/A</div>
                                @endif
                            </td>
                            <td>
                                <span class="d-block fw-bold text-white">{{ $project->title }}</span>
                                <span class="d-block small text-muted text-truncate" style="max-width: 250px;">{{ $project->role }} • {{ $project->duration }}</span>
                            </td>
                            <td>
                                <span class="d-block small text-white-50">{{ $project->slug }}</span>
                                <div class="d-flex flex-wrap gap-1 mt-1">
                                    @foreach(array_slice($project->tech_stack ?? [], 0, 3) as $tech)
                                        <span class="badge bg-dark text-secondary border" style="font-size: 0.65rem; border-color: var(--border-color) !important;">{{ $tech }}</span>
                                    @endforeach
                                    @if(count($project->tech_stack ?? []) > 3)
                                        <span class="badge bg-dark text-muted border" style="font-size: 0.65rem; border-color: var(--border-color) !important;">+{{ count($project->tech_stack) - 3 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($project->featured)
                                    <span class="admin-badge admin-badge-success">🟢 Featured</span>
                                @else
                                    <span class="admin-badge bg-transparent text-secondary border border-secondary" style="opacity: 0.4;">Standard</span>
                                @endif
                            </td>
                            <td>
                                @if($project->trashed())
                                    <span class="admin-badge admin-badge-danger">🔴 Trashed</span>
                                @elseif($project->status === 'published')
                                    <span class="admin-badge admin-badge-success">🟢 Published</span>
                                @else
                                    <span class="admin-badge admin-badge-warning">🟡 Draft</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    @if($project->trashed())
                                        <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-admin btn-admin-primary btn-sm px-2" title="Restore project">
                                                <i class="bi bi-arrow-counterclockwise"></i> Restore
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2" title="Edit project">
                                            <i class="bi bi-pencil-square text-primary"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to soft delete this project?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-admin btn-admin-secondary btn-sm px-2" title="Trash project">
                                                <i class="bi bi-trash-fill text-danger"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <i class="bi bi-folder-x fs-1 d-block mb-3 opacity-50"></i>
                                No projects found.
                                <div class="mt-3">
                                    <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-admin-primary btn-sm mx-auto d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-plus-lg"></i> Create First Project
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination footer link -->
        <div class="p-3 border-top d-flex flex-column flex-md-row align-items-center justify-content-between gap-3" style="border-color: var(--border-color) !important;">
            <span class="text-secondary small">
                Showing {{ $projects->firstItem() ?? 0 }}–{{ $projects->lastItem() ?? 0 }} of {{ $projects->total() }} records
            </span>
            @if($projects->hasPages())
                <div class="m-0">
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
