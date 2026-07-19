<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Page Not Found | Ghoza Himma</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif !important;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-color);
            color: var(--text-primary);
        }
    </style>
</head>
<body>

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Large 404 text -->
                <div class="error-code text-primary">404</div>
                
                <!-- Headline -->
                <h1 class="h2 fw-bold mb-3">Oops! Page Not Found</h1>
                
                <!-- Description -->
                <p class="text-secondary-custom mb-5 fs-5">
                    The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                </p>

                <!-- Back to Home trigger -->
                <a href="{{ url('/') }}" class="btn-custom btn-custom-primary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i> Back to Homepage
                </a>
            </div>
        </div>
    </div>

</body>
</html>
