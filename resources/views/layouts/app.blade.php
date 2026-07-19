<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', $globalSettings['seo_meta_title'])</title>
    <meta name="description" content="@yield('meta_description', $globalSettings['seo_meta_description'])">
    <meta name="keywords" content="{{ $globalSettings['seo_keywords'] }}">
    <meta name="author" content="Ghoza Himma Al Farizqi">
    <meta name="robots" content="{{ $globalSettings['seo_robots'] }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $globalSettings['seo_meta_title'])">
    <meta property="og:description" content="@yield('meta_description', $globalSettings['seo_meta_description'])">
    <meta property="og:image" content="{{ $globalSettings['seo_og_image'] && str_starts_with($globalSettings['seo_og_image'], 'http') ? $globalSettings['seo_og_image'] : asset($globalSettings['seo_og_image']) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="{{ $globalSettings['seo_twitter_card'] }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', $globalSettings['seo_meta_title'])">
    <meta property="twitter:description" content="@yield('meta_description', $globalSettings['seo_meta_description'])">
    <meta property="twitter:image" content="{{ $globalSettings['seo_og_image'] && str_starts_with($globalSettings['seo_og_image'], 'http') ? $globalSettings['seo_og_image'] : asset($globalSettings['seo_og_image']) }}">

    <!-- JSON-LD Person Schema for Search Engines -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Person",
        "name": "Ghoza Himma Al Farizqi",
        "jobTitle": "{{ $globalSettings['about_headline'] }}",
        "description": "{{ $globalSettings['seo_meta_description'] }}",
        "url": "{{ url('/') }}",
        "sameAs": [
            "{{ $globalSettings['contact_github'] }}",
            "{{ $globalSettings['contact_linkedin'] }}"
        ]
    }
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts: Sora & Manrope -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Sora:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- AOS (Animate on Scroll) CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Inline Head Script to prevent theme flicker on page load (Dark mode default) -->
    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>
</head>
<body>

    <!-- 1. Page Loading Spinner -->
    <div id="page-loader" class="loader-wrapper">
        <div class="spinner-custom"></div>
    </div>

    <!-- 2. Sticky Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" aria-label="Primary Navigation">
        <div class="container">
            <a class="navbar-brand" href="#home" aria-label="Ghoza Himma Portfolio Home">GHOZA.</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation menu" style="color: var(--text-primary);">
                <i class="bi bi-list fs-2" aria-hidden="true"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#experience">Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#skills">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#certificates">Certificates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <!-- Theme Toggle Button -->
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <button id="theme-toggle" class="theme-toggle-btn" aria-label="Toggle dark/light theme" title="Toggle theme">
                            <i class="bi bi-sun-fill" aria-hidden="true"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 3. Main Content Container -->
    <main>
        @yield('content')
    </main>

    <!-- 4. Back To Top Trigger Button -->
    <button id="back-to-top" class="back-to-top-btn" aria-label="Back to Top">
        <i class="bi bi-arrow-up fs-5"></i>
    </button>

    <!-- 5. Toast Container for AJAX alert notifications -->
    <div id="toast-container" class="toast-container-custom"></div>

    <!-- Bootstrap Bundle with Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsnCYO7ZGy5DGGLw5Sh8gZ3gO15PEXk5nRIVSXHz59gRISTQN3/35E6Lhm6%20F" crossorigin="anonymous"></script>

    <!-- AOS (Animate on Scroll) JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Init AOS with premium custom speeds
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
                easing: 'ease-out-cubic'
            });
        });
    </script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
