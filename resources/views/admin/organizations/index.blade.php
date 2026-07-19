@extends('admin.layouts.admin')

@section('title', 'Manage Organizations')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Organizations</h1>
            <p class="text-secondary small mb-0">Manage student organizations, voluntary logs, and roles.</p>
        </div>
        <a href="{{ route('admin.organizations.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Add Organization
        </a>
    </div>

    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th>Organization</th>
                        <th>Position</th>
                        <th>Timeline</th>
                        <th>Description</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organizations as $org)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $org->order }}</td>
                            <td class="fw-bold text-white">{{ $org->organization }}</td>
                            <td class="text-primary fw-semibold">{{ $org->position }}</td>
                            <td class="text-secondary">{{ $org->start_date }} — {{ $org->end_date }}</td>
                            <td class="text-muted small">{{ Str::limit($org->description, 100) }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.organizations.edit', $org->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                        <i class="bi bi-pencil-square text-primary"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.organizations.destroy', $org->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this organization record?');">
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
                                <i class="bi bi-people fs-1 d-block mb-3 opacity-50"></i>
                                No organization records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
