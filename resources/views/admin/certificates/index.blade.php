@extends('admin.layouts.admin')

@section('title', 'Manage Certificates')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Certifications</h1>
            <p class="text-secondary small mb-0">Manage training accomplishments and dynamic PDF links.</p>
        </div>
        <a href="{{ route('admin.certificates.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Add Certificate
        </a>
    </div>

    <!-- Search & Filter panel -->
    <div class="glass-panel p-3 mb-4">
        <form action="{{ route('admin.certificates.index') }}" method="GET" class="row g-2">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control form-control-admin" placeholder="Search by title, issuer, category..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-admin btn-admin-primary w-100 justify-content-center">Apply</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.certificates.index') }}" class="btn-admin btn-admin-secondary w-100 justify-content-center" title="Clear Filters">Clear</a>
            </div>
        </form>
    </div>

    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th style="width: 120px;">Image</th>
                        <th>Name</th>
                        <th>Issuer</th>
                        <th>Issue Date</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certificates as $cert)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $cert->order }}</td>
                            <td>
                                @if($cert->image_path)
                                    <img src="{{ $cert->image_path && str_starts_with($cert->image_path, 'http') ? $cert->image_path : asset($cert->image_path) }}" alt="" style="width: 80px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                                @else
                                    <div class="small text-muted" style="width: 80px; height: 45px; border: 1px dashed var(--border-color); display: flex; align-items: center; justify-content: center; border-radius: 4px;"><i class="bi bi-award"></i></div>
                                @endif
                            </td>
                            <td>
                                <span class="d-block fw-bold text-white">{{ $cert->title }}</span>
                                @if($cert->credential_url)
                                    <a href="{{ $cert->credential_url }}" target="_blank" class="small text-primary text-decoration-none text-truncate d-inline-block" style="max-width: 200px;">Verify Credential &rarr;</a>
                                @endif
                            </td>
                            <td class="text-secondary">{{ $cert->issuer }}</td>
                            <td class="text-secondary">{{ $cert->issue_date }}</td>
                            <td><span class="badge bg-dark text-secondary border" style="font-size: 0.7rem; border-color: var(--border-color) !important;">{{ $cert->category ?: 'General' }}</span></td>
                            <td>
                                @if($cert->featured)
                                    <span class="admin-badge admin-badge-success">🟢 Featured</span>
                                @else
                                    <span class="text-muted small">Standard</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.certificates.edit', $cert->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                        <i class="bi bi-pencil-square text-primary"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this certificate?');">
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
                            <td colspan="8" class="text-center py-5 text-secondary">
                                <i class="bi bi-award fs-1 d-block mb-3 opacity-50"></i>
                                No certificates registered yet.
                                <div class="mt-3">
                                    <a href="{{ route('admin.certificates.create') }}" class="btn-admin btn-admin-primary btn-sm mx-auto d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-plus-lg"></i> Add First Certificate
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
                Showing {{ $certificates->firstItem() ?? 0 }}–{{ $certificates->lastItem() ?? 0 }} of {{ $certificates->total() }} records
            </span>
            @if($certificates->hasPages())
                <div class="m-0">
                    {{ $certificates->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
