<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Access Verification - Ghoza Himma</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            background-color: var(--bg-dark);
        }
        .login-glow {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, rgba(59, 130, 246, 0) 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
            pointer-events: none;
        }
        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 2.5rem;
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-glow"></div>
        
        <div class="glass-panel login-card">
            <!-- Brand -->
            <div class="text-center mb-4">
                <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.5rem; letter-spacing: -0.03em;">CMS CONTROL CENTER</h1>
                <p class="text-secondary small">Authenticating session. Please insert credentials.</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 small mb-4 py-2" style="background-color: rgba(239, 68, 68, 0.1); color: var(--status-danger);">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary small fw-bold">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control form-control-admin w-100" placeholder="admin@admin.com" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="form-label text-secondary small fw-bold">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-admin w-100" placeholder="••••••••" required autocomplete="current-password">
                </div>

                <!-- Remember Me -->
                <div class="mb-4 d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input bg-transparent border-secondary" type="checkbox" name="remember" id="remember" style="cursor: pointer;">
                        <label class="form-check-label text-secondary small" for="remember" style="cursor: pointer; user-select: none;">
                            Remember session
                        </label>
                    </div>
                </div>

                <!-- Action Button -->
                <button type="submit" class="btn-admin btn-admin-primary w-100 justify-content-center" style="padding: 0.75rem;">
                    Sign In <i class="bi bi-box-arrow-in-right"></i>
                </button>
            </form>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', () => {
                    const button = form.querySelector('button[type="submit"]');
                    if (button) {
                        button.disabled = true;
                        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Authenticating...';
                    }
                });
            }
        });
    </script>
</body>
</html>
