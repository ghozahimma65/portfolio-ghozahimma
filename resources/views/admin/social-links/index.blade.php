@extends('admin.layouts.admin')

@section('title', 'Manage Social Links')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Social Links</h1>
            <p class="text-secondary small mb-0">Manage social and repository links (GitHub, LinkedIn, WhatsApp).</p>
        </div>
        <a href="{{ route('admin.social-links.create') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus-lg"></i> Add Social Link
        </a>
    </div>

    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Order</th>
                        <th>Platform</th>
                        <th>Icon Class</th>
                        <th>Target URL</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($social_links as $link)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $link->order }}</td>
                            <td class="fw-bold text-white">
                                @if($link->icon)
                                    <i class="{{ $link->icon }} text-primary me-2"></i>
                                @endif
                                {{ $link->platform }}
                            </td>
                            <td class="text-secondary"><code>{{ $link->icon ?: 'None' }}</code></td>
                            <td><a href="{{ $link->url }}" target="_blank" class="small text-primary text-decoration-none">{{ $link->url }}</a></td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.social-links.edit', $link->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                        <i class="bi bi-pencil-square text-primary"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.social-links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this social link?');">
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
                            <td colspan="5" class="text-center py-5 text-secondary">
                                <i class="bi bi-link-45deg fs-1 d-block mb-3 opacity-50"></i>
                                No social links registered.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
