@extends('admin.layouts.admin')

@section('title', 'Inbox Messages')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Contact Inbox</h1>
            <p class="text-secondary small mb-0">Read and manage inquiries submitted from your public portfolio contact form.</p>
        </div>
        <a href="{{ route('admin.inbox.export') }}" class="btn-admin btn-admin-primary">
            <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
        </a>
    </div>

    <!-- Table panel -->
    <div class="glass-panel">
        <div class="table-responsive">
            <table class="table admin-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th style="width: 100px;">Status</th>
                        <th>Sender Name</th>
                        <th>Sender Email</th>
                        <th>Subject</th>
                        <th>Received Date</th>
                        <th style="width: 180px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr style="{{ !$msg->is_read ? 'font-weight: 700;' : '' }}">
                            <td>
                                @if($msg->is_read)
                                    <span class="admin-badge bg-transparent border text-secondary" style="border-color: var(--border-color) !important; font-size: 0.65rem;">Read</span>
                                @else
                                    <span class="admin-badge admin-badge-success" style="font-size: 0.65rem;">Unread</span>
                                @endif
                            </td>
                            <td class="text-white">{{ $msg->name }}</td>
                            <td class="text-secondary small">
                                <a href="mailto:{{ $msg->email }}" class="text-secondary text-decoration-none"><i class="bi bi-envelope"></i> {{ $msg->email }}</a>
                            </td>
                            <td>
                                <span class="d-block text-white text-truncate" style="max-width: 250px;">{{ $msg->subject ?: '(No Subject)' }}</span>
                            </td>
                            <td class="text-secondary small">{{ $msg->created_at->format('M d, Y H:i') }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.inbox.show', $msg->id) }}" class="btn-admin btn-admin-secondary btn-sm px-2">
                                        <i class="bi bi-eye text-primary"></i> View
                                    </a>
                                    <form action="{{ route('admin.inbox.read', $msg->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn-admin btn-admin-secondary btn-sm px-2" title="{{ $msg->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                            @if($msg->is_read)
                                                <i class="bi bi-envelope-open text-muted"></i>
                                            @else
                                                <i class="bi bi-envelope-fill text-success"></i>
                                            @endif
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.inbox.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-admin btn-admin-secondary btn-sm px-2 text-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary">
                                <i class="bi bi-envelope-open fs-1 d-block mb-3 opacity-50"></i>
                                Inbox is empty. No messages received.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="p-3 border-top" style="border-color: var(--border-color) !important;">
                {{ $messages->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
