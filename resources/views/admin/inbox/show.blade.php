@extends('admin.layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="container-fluid px-0">
    <!-- Breadcrumbs -->
    <div class="mb-4">
        <a href="{{ route('admin.inbox.index') }}" class="text-primary text-decoration-none small">&larr; Back to Inbox</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Message Details</h1>
        <p class="text-secondary small mb-0">From: {{ $message->name }}</p>
    </div>

    <div class="glass-panel p-4" style="max-width: 800px;">
        <!-- Metadata Header -->
        <div class="d-flex flex-column flex-sm-row justify-content-between border-bottom pb-3 mb-4 gap-3" style="border-color: var(--border-color) !important;">
            <div>
                <span class="text-secondary small d-block mb-1">Sender</span>
                <h4 class="fw-bold text-white mb-0" style="font-size: 1.15rem;">{{ $message->name }}</h4>
                <a href="mailto:{{ $message->email }}" class="text-primary text-decoration-none small"><i class="bi bi-envelope"></i> {{ $message->email }}</a>
            </div>
            
            <div class="text-sm-end">
                <span class="text-secondary small d-block mb-1">Received Date</span>
                <span class="text-white small fw-bold">{{ $message->created_at->format('l, d F Y H:i') }}</span>
                <span class="text-secondary small d-block">IP: {{ $message->ip_address ?: 'Unknown' }}</span>
            </div>
        </div>

        <!-- Subject -->
        <div class="mb-4">
            <span class="text-secondary small d-block mb-1">Subject</span>
            <h5 class="fw-bold text-white" style="font-family: var(--font-heading);">{{ $message->subject ?: '(No Subject)' }}</h5>
        </div>

        <!-- Message Body -->
        <div class="mb-4 p-3 rounded bg-dark border" style="border-color: var(--border-color) !important; min-height: 180px;">
            <span class="text-secondary small d-block mb-2 border-bottom pb-1" style="border-color: var(--border-color) !important; opacity: 0.5;">Message</span>
            <p class="text-white-50 mb-0" style="line-height: 1.8; white-space: pre-wrap; font-size: 0.95rem;">{{ $message->message }}</p>
        </div>

        <!-- Actions Panel -->
        <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 border-top pt-4" style="border-color: var(--border-color) !important;">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ rawurlencode($message->subject) }}" class="btn-admin btn-admin-primary justify-content-center">
                <i class="bi bi-reply-fill"></i> Reply by Email
            </a>
            
            <div class="d-flex gap-2">
                <form action="{{ route('admin.inbox.read', $message->id) }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn-admin btn-admin-secondary justify-content-center">
                        <i class="bi bi-envelope"></i> Mark as {{ $message->is_read ? 'Unread' : 'Read' }}
                    </button>
                </form>
                
                <form action="{{ route('admin.inbox.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry permanently?');" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-admin btn-admin-danger justify-content-center">
                        <i class="bi bi-trash"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
