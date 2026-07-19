@extends('admin.layouts.admin')

@section('title', 'Manage Awards')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Awards & Accolades</h1>
            <p class="text-secondary small mb-0">Manage honors, contest awards, and achievements.</p>
        </div>
        <a href="{{ route('admin.awards.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Add Award
        </a>
    </div>

    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th style="width: 100px;">Thumbnail</th>
                        <th>Award Title</th>
                        <th>Issuer</th>
                        <th>Year</th>
                        <th>Description</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($awards as $award)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $award->order }}</td>
                            <td>
                                @if($award->image_path)
                                    <img src="{{ asset($award->image_path) }}" alt="" style="width: 64px; height: 36px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                                @else
                                    <div class="small text-muted" style="width: 64px; height: 36px; border: 1px dashed var(--border-color); display: flex; align-items: center; justify-content: center; border-radius: 4px;"><i class="bi bi-trophy"></i></div>
                                @endif
                            </td>
                            <td class="fw-bold text-white">{{ $award->title }}</td>
                            <td class="text-primary fw-semibold">{{ $award->issuer }}</td>
                            <td class="text-secondary">{{ $award->year }}</td>
                            <td class="text-muted small">{{ Str::limit($award->description, 100) }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.awards.edit', $award->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                        <i class="bi bi-pencil-square text-primary"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.awards.destroy', $award->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this award?');">
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
                                <i class="bi bi-trophy fs-1 d-block mb-3 opacity-50"></i>
                                No award entries registered.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
