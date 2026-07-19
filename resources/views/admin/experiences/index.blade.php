@extends('admin.layouts.admin')

@section('title', 'Manage Experiences')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Experiences</h1>
            <p class="text-secondary small mb-0">Manage work history, internship records, and responsibilities.</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Add Experience
        </a>
    </div>

    <!-- Search & Filter panel -->
    <div class="glass-panel p-3 mb-4">
        <form action="{{ route('admin.experiences.index') }}" method="GET" class="row g-2">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control form-control-admin" placeholder="Search by role, company, location..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-admin btn-admin-primary w-100 justify-content-center">Apply</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.experiences.index') }}" class="btn-admin btn-admin-secondary w-100 justify-content-center" title="Clear Filters">Clear</a>
            </div>
        </form>
    </div>

    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th style="width: 100px;">Logo</th>
                        <th>Role & Company</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Responsibilities</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($experiences as $exp)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $exp->order }}</td>
                            <td>
                                @if($exp->logo)
                                    <img src="{{ $exp->logo && str_starts_with($exp->logo, 'http') ? $exp->logo : asset($exp->logo) }}" alt="" style="width: 48px; height: 48px; object-fit: contain; border-radius: 6px; border: 1px solid var(--border-color); background: #ffffff; padding: 4px;">
                                @else
                                    <div class="small text-muted" style="width: 48px; height: 48px; border: 1px dashed var(--border-color); display: flex; align-items: center; justify-content: center; border-radius: 6px;"><i class="bi bi-briefcase"></i></div>
                                @endif
                            </td>
                            <td>
                                <span class="d-block fw-bold text-white">{{ $exp->role }}</span>
                                <span class="d-block small text-primary">{{ $exp->company }}</span>
                            </td>
                            <td class="text-secondary">{{ $exp->location }}</td>
                            <td>
                                <span class="d-block small text-white-50">{{ $exp->start_date }} — {{ $exp->end_date }}</span>
                                @if($exp->current_position)
                                    <span class="admin-badge admin-badge-success mt-1 d-inline-block" style="font-size: 0.6rem;">🟢 Active</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-muted small">{{ count($exp->responsibilities ?? []) }} bullet points</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.experiences.edit', $exp->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                        <i class="bi bi-pencil-square text-primary"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.experiences.destroy', $exp->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this experience record?');">
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
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <i class="bi bi-briefcase fs-1 d-block mb-3 opacity-50"></i>
                                No experience entries found.
                                <div class="mt-3">
                                    <a href="{{ route('admin.experiences.create') }}" class="btn-admin btn-admin-primary btn-sm mx-auto d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-plus-lg"></i> Add First Experience
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
                Showing {{ $experiences->firstItem() ?? 0 }}–{{ $experiences->lastItem() ?? 0 }} of {{ $experiences->total() }} records
            </span>
            @if($experiences->hasPages())
                <div class="m-0">
                    {{ $experiences->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
