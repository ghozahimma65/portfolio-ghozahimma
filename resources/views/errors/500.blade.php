<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 - Server Error | Ghoza Himma</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Sora:wght@600;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-color);
            color: var(--text-primary);
        }
        .error-code {
            font-family: 'Sora', sans-serif;
            font-size: 6rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.05em;
        }
    </style>
</head>
<body>

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="fade-up">
                <div class="error-code text-gradient-accent mb-3">500</div>
                <h1 class="h2 fw-bold mb-3">Something Went Wrong</h1>
                <p class="text-secondary mb-4 fs-6" style="line-height: 1.8;">
                    An unexpected internal server error occurred while processing your request. Please try refreshing the page or return to the homepage.
                </p>

                <a href="{{ url('/') }}" class="btn-custom btn-custom-accent">
                    <i class="bi bi-arrow-left me-2"></i> Back to Homepage
                </a>
            </div>
        </div>
    </div>

</body>
</html>
