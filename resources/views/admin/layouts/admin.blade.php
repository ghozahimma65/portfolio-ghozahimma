<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Portfolio CMS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <style>
        .hover-quick-action:hover {
            transform: translateY(-3px);
            background-color: rgba(255, 255, 255, 0.05) !important;
            border-color: var(--accent) !important;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- 1. Sidebar Navigation -->
    <aside id="sidebar" class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">GHOZA.CMS</a>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Overview
                </a>
            </li>
            <li class="sidebar-section-title text-uppercase small text-muted px-3 mt-3 mb-1" style="font-size: 0.65rem; font-weight: 800; letter-spacing: 0.05em;">Content Modules</li>
            <li>
                <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-folder-fill"></i> Projects
                </a>
            </li>
            <li>
                <a href="{{ route('admin.experiences.index') }}" class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase-fill"></i> Experiences
                </a>
            </li>
            <li>
                <a href="{{ route('admin.certificates.index') }}" class="sidebar-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
                    <i class="bi bi-award-fill"></i> Certifications
                </a>
            </li>
            <li>
                <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                    <i class="bi bi-cpu-fill"></i> Skills
                </a>
            </li>
            <li>
                <a href="{{ route('admin.education.index') }}" class="sidebar-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard-fill"></i> Education
                </a>
            </li>
            <li>
                <a href="{{ route('admin.organizations.index') }}" class="sidebar-link {{ request()->routeIs('admin.organizations.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Organizations
                </a>
            </li>
            <li>
                <a href="{{ route('admin.awards.index') }}" class="sidebar-link {{ request()->routeIs('admin.awards.*') ? 'active' : '' }}">
                    <i class="bi bi-trophy-fill"></i> Awards
                </a>
            </li>
            <li>
                <a href="{{ route('admin.social-links.index') }}" class="sidebar-link {{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}">
                    <i class="bi bi-link-45deg"></i> Social Links
                </a>
            </li>

            <li class="sidebar-section-title text-uppercase small text-muted px-3 mt-3 mb-1" style="font-size: 0.65rem; font-weight: 800; letter-spacing: 0.05em;">Blog & Files</li>
            <li>
                <a href="{{ route('admin.blog-posts.index') }}" class="sidebar-link {{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-richtext"></i> Blog Posts
                </a>
            </li>
            <li>
                <a href="{{ route('admin.media.index') }}" class="sidebar-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Media Library
                </a>
            </li>

            <li class="sidebar-section-title text-uppercase small text-muted px-3 mt-3 mb-1" style="font-size: 0.65rem; font-weight: 800; letter-spacing: 0.05em;">System</li>
            <li>
                <a href="{{ route('admin.inbox.index') }}" class="sidebar-link {{ request()->routeIs('admin.inbox.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope-fill"></i> Contact Inbox
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear-fill"></i> Settings & About
                </a>
            </li>
        </ul>
        
        <!-- User log info / Logout -->
        <div class="mt-auto pt-3 border-top" style="border-color: var(--border-color) !important;">
            <div class="d-flex align-items-center mb-3">
                <div class="flex-grow-1 min-w-0">
                    <span class="d-block text-truncate fw-bold" style="font-size: 0.85rem;">{{ Auth::user()->name }}</span>
                    <span class="d-block text-truncate text-secondary small" style="font-size: 0.75rem;">Administrator</span>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-admin btn-admin-danger w-100 justify-content-center text-center">
                    <i class="bi bi-box-arrow-left"></i> Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- 2. Main Page Layout Grid -->
    <div class="admin-layout-wrapper">
        <!-- Top Navbar -->
        <header class="admin-navbar">
            <button id="sidebar-toggle" class="navbar-toggler-admin" aria-label="Toggle sidebar menu">
                <i class="bi bi-list"></i>
            </button>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('portfolio.index') }}" target="_blank" class="btn-admin btn-admin-secondary btn-sm">
                    <i class="bi bi-globe"></i> View Website
                </a>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="admin-content-area">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap Bundle with Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Sidebar Toggle Script & UX Enhancements -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Sidebar Toggle Logic
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebar-toggle');
            if (toggle && sidebar) {
                toggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    sidebar.classList.toggle('show');
                });
                
                document.addEventListener('click', (e) => {
                    if (sidebar.classList.contains('show') && !sidebar.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                });
            }

            // 2. SweetAlert2 Toast configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: '#1f2937',
                color: '#f3f4f6',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // Expose globally
            window.Toast = Toast;

            // 3. Flash Messages Toast triggers
            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: {!! json_encode(session('success')) !!}
                });
            @endif

            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: {!! json_encode(session('error')) !!}
                });
            @endif

            @if(session('warning'))
                Toast.fire({
                    icon: 'warning',
                    title: {!! json_encode(session('warning')) !!}
                });
            @endif

            @if(session('info'))
                Toast.fire({
                    icon: 'info',
                    title: {!! json_encode(session('info')) !!}
                });
            @endif

            // Helper to disable submit buttons and show loading state
            const disableFormButtons = (form) => {
                const buttons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
                buttons.forEach(button => {
                    button.disabled = true;
                    button.setAttribute('data-original-html', button.innerHTML);
                    button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
                });
            };

            // 4. SweetAlert2 confirmation before deleting records
            const deleteForms = document.querySelectorAll('form');
            deleteForms.forEach(form => {
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput && methodInput.value === 'DELETE') {
                    let confirmMsg = 'Are you sure you want to delete this record?';
                    if (form.hasAttribute('onsubmit')) {
                        const onsubmitValue = form.getAttribute('onsubmit');
                        const match = onsubmitValue.match(/confirm\(['"](.+)['"]\)/);
                        if (match && match[1]) {
                            confirmMsg = match[1];
                        }
                        form.removeAttribute('onsubmit');
                    }

                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Confirm Action',
                            text: confirmMsg,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel',
                            background: '#1f2937',
                            color: '#f3f4f6'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                disableFormButtons(form);
                                form.submit();
                            }
                        });
                    });
                }
            });

            // 5. Disable submit buttons while forms are submitting
            document.addEventListener('submit', (e) => {
                const form = e.target;
                const methodInput = form.querySelector('input[name="_method"]');
                // Skip if it is a DELETE form (already handled by Swal logic above)
                if (methodInput && methodInput.value === 'DELETE') {
                    return;
                }
                disableFormButtons(form);
            });

            // 6. Live image preview for image uploads
            document.addEventListener('change', (e) => {
                const input = e.target;
                if (input.type === 'file' && input.files && input.files[0]) {
                    const file = input.files[0];
                    if (!file.type.startsWith('image/')) {
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const container = input.closest('.form-group-custom') || input.closest('.mb-3') || input.parentElement;
                        if (!container) return;

                        let img = container.querySelector('img.preview-img-target');
                        if (!img) {
                            img = container.querySelector('img');
                        }

                        if (img) {
                            img.src = event.target.result;
                            img.classList.add('preview-img-target');
                        } else {
                            img = document.createElement('img');
                            img.src = event.target.result;
                            img.className = 'img-thumbnail mt-2 preview-img-target d-block';
                            img.style.maxHeight = '120px';
                            img.style.objectFit = 'contain';
                            img.style.border = '1px solid var(--border-color)';
                            img.style.borderRadius = '4px';
                            img.style.padding = '4px';
                            img.style.background = 'rgba(0,0,0,0.2)';
                            input.parentNode.insertBefore(img, input.nextSibling);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });

            // 7. Smart Auto Slug Generator
            const titleInput = document.querySelector('input[name="title"], input[id="title"]');
            const slugInput = document.querySelector('input[name="slug"], input[id="slug"]');
            if (titleInput && slugInput) {
                let isSlugEdited = slugInput.value.trim() !== '';

                slugInput.addEventListener('input', () => {
                    isSlugEdited = true;
                });

                titleInput.addEventListener('input', () => {
                    if (!isSlugEdited) {
                        slugInput.value = titleInput.value
                            .toLowerCase()
                            .replace(/[^a-z0-9\s-]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-')
                            .trim();
                    }
                });
            }

            // 8. Helpful Tooltips Mappings & Initialization
            const tooltipData = {
                'slug': 'URL-friendly identifier. Only lowercase letters, numbers, and hyphens.',
                'seo_title': 'Page title shown in search engine results and browser tabs.',
                'seo_description': 'Page summary for search results (recommended under 160 characters).',
                'featured': 'Check to highlight this item prominently on your homepage.',
                'published': 'Published items are publicly visible; drafts are private to admin.',
                'status': 'Draft is private to admin; Published is visible to public.'
            };

            document.querySelectorAll('label, .form-check-label').forEach(label => {
                const forAttr = label.getAttribute('for');
                const labelText = label.innerText.toLowerCase().trim().replace(/[^a-z_]/g, '');
                const identifier = forAttr || labelText;

                const matchedKey = Object.keys(tooltipData).find(key => identifier.includes(key));
                if (matchedKey) {
                    label.style.cursor = 'help';
                    label.setAttribute('data-bs-toggle', 'tooltip');
                    label.setAttribute('data-bs-placement', 'top');
                    label.setAttribute('title', tooltipData[matchedKey]);
                }
            });

            // Initialize Bootstrap Tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        });
    </script>
    @yield('scripts')
</body>
</html>
