@extends('admin.layouts.admin')

@section('title', 'Media Library')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Media Library</h1>
            <p class="text-secondary small mb-0">Upload, replace, and copy asset path URLs for biography photos or project previews.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left: Upload Box -->
        <div class="col-lg-4">
            <div class="glass-panel p-4 mb-4">
                <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;"><i class="bi bi-cloud-upload text-primary"></i> Upload Asset</h3>
                
                <form action="{{ route('admin.media.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label text-secondary small fw-bold">Select File</label>
                        <input type="file" id="file" name="file" class="form-control form-control-admin w-100" accept="image/*,application/pdf,application/zip" required>
                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Allowed formats: JPG, PNG, WEBP, PDF, ZIP (Max 5MB)</small>
                    </div>
                    
                    <button type="submit" class="btn-admin btn-admin-primary w-100 justify-content-center">
                        Upload Asset
                    </button>
                </form>
            </div>

            <!-- Copy notification toast element -->
            <div class="glass-panel p-3 text-center" style="border-style: dashed;">
                <span class="text-secondary small"><i class="bi bi-info-circle text-primary"></i> Click <b>Copy URL</b> on any card to use the asset path inside project forms or setting inputs.</span>
            </div>
        </div>

        <!-- Right: Explorer Grid -->
        <div class="col-lg-8">
            <!-- Search header -->
            <div class="glass-panel p-3 mb-4">
                <form action="{{ route('admin.media.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-admin flex-grow-1" placeholder="Search files by name..." value="{{ request('search') }}">
                    <button type="submit" class="btn-admin btn-admin-primary">Search</button>
                    @if(request('search'))
                        <a href="{{ route('admin.media.index') }}" class="btn-admin btn-admin-secondary">Clear</a>
                    @endif
                </form>
            </div>

            <!-- Media files grid -->
            <div class="row g-3">
                @forelse($mediaFiles as $media)
                    @php
                        $isImage = str_contains($media->file_type, 'image');
                        $fileSizeKb = round($media->file_size / 1024, 1);
                    @endphp
                    <div class="col-6 col-sm-4 col-md-3">
                        <div class="glass-panel p-2 h-100 d-flex flex-column justify-content-between position-relative" style="overflow: hidden;">
                            <!-- Thumbnail area -->
                            <div class="d-flex align-items-center justify-content-center bg-dark" style="aspect-ratio: 4/3; border-radius: 6px; overflow: hidden; border: 1px solid rgba(255,255,255,0.03);">
                                @if($isImage)
                                    <img src="{{ $media->filepath && str_starts_with($media->filepath, 'http') ? $media->filepath : asset($media->filepath) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                @elseif(str_contains($media->file_type, 'pdf'))
                                    <i class="bi bi-file-pdf text-danger fs-1"></i>
                                @elseif(str_contains($media->file_type, 'zip'))
                                    <i class="bi bi-file-zip text-warning fs-1"></i>
                                @else
                                    <i class="bi bi-file-earmark-text text-secondary fs-1"></i>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="mt-2 flex-grow-1">
                                <span class="d-block text-white text-truncate fw-bold small" style="font-size: 0.8rem;" title="{{ $media->filename }}">{{ $media->filename }}</span>
                                <span class="text-secondary d-block" style="font-size: 0.65rem;">{{ $fileSizeKb }} KB • {{ $media->created_at->format('M d') }}</span>
                            </div>

                            <!-- Actions footer panel -->
                            <div class="d-flex gap-1 mt-2">
                                <button type="button" class="btn-admin btn-admin-secondary btn-sm flex-grow-1 copy-path-btn" data-url="{{ $media->filepath && str_starts_with($media->filepath, 'http') ? $media->filepath : asset($media->filepath) }}" style="font-size: 0.7rem; padding: 4px 8px;">
                                    <i class="bi bi-link-45deg"></i> Copy URL
                                </button>
                                <form action="{{ route('admin.media.destroy', $media->id) }}" method="POST" onsubmit="return confirm('Delete this media asset permanently?');" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-admin btn-admin-secondary btn-sm px-2 text-danger" style="padding: 4px 8px;" title="Delete file">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-secondary">
                        <i class="bi bi-images fs-1 d-block mb-3 opacity-50"></i>
                        No assets uploaded yet.
                    </div>
                @endforelse
            </div>

            <!-- Pagination links -->
            @if($mediaFiles->hasPages())
                <div class="glass-panel p-3 mt-4">
                    {{ $mediaFiles->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Copy to clipboard logic
        document.querySelectorAll('.copy-path-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const url = btn.getAttribute('data-url');
                
                // Use relative path from root to keep DB values clean, or full URL
                // Let's copy relative path (starting with storage/ or assets/) to make database inserts highly portable!
                const parsedUrl = new URL(url);
                const relativePath = parsedUrl.pathname.replace(/^\//, ''); // removes leading slash
                
                navigator.clipboard.writeText('/' + relativePath).then(() => {
                    const originalText = btn.innerHTML;
                    btn.innerHTML = `<i class="bi bi-check-lg text-success"></i> Copied!`;
                    btn.classList.add('border-success');
                    
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.classList.remove('border-success');
                    }, 2000);
                }).catch(err => {
                    console.error('Failed to copy: ', err);
                });
            });
        });
    });
</script>
@endsection
