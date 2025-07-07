<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ request()->cookie('theme', 'light') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Patungann - Smart Bill Splitting')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <!-- Additional CSS -->
    @stack('styles')

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <style>
        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Alert Styles */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 16px;
            border: 1px solid transparent;
        }
        
        .alert-success {
            background-color: #f0f9ff;
            border-color: #0ea5e9;
            color: #0c4a6e;
        }
        
        .alert-error {
            background-color: #fef2f2;
            border-color: #ef4444;
            color: #7f1d1d;
        }
        
        .alert-info {
            background-color: #f8fafc;
            border-color: #64748b;
            color: #334155;
        }

        /* Form Error Styles */
        .error-text {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .input-error {
            border-color: #ef4444;
        }

        /* Dark mode button */
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background: hsl(var(--primary));
            color: hsl(var(--primary-foreground));
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body class="bg-background text-foreground">
    <!-- Navigation -->
    @auth
        @include('components.navigation')
    @endauth

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @yield('footer')

    <!-- Theme Toggle Button -->
    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle Dark Mode">
        🌙
    </button>

    <!-- JavaScript -->
    <script>
        // CSRF Token for AJAX
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };

        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.classList.toggle('dark');
            
            // Save to cookie
            document.cookie = `theme=${newTheme}; path=/; max-age=31536000`; // 1 year
            
            // Update button text
            const button = document.querySelector('.theme-toggle');
            button.textContent = newTheme === 'dark' ? '☀️' : '🌙';
        }

        // Initialize theme
        document.addEventListener('DOMContentLoaded', function() {
            const theme = getCookie('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                document.querySelector('.theme-toggle').textContent = '☀️';
            }
        });

        // Get cookie helper
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
        });

        // Loading button helper
        function showLoading(button) {
            const originalText = button.innerHTML;
            button.innerHTML = '<span class="loading"></span> Loading...';
            button.disabled = true;
            
            return function hideLoading() {
                button.innerHTML = originalText;
                button.disabled = false;
            };
        }

        // Form submission with loading
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        showLoading(submitButton);
                    }
                });
            });
        });

        // Fade in animation for content
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate-fade-in-up');
            animatedElements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.animationDelay = `${index * 100}ms`;
                }, 0);
            });
        });
    </script>

    <!-- Additional JavaScript -->
    @stack('scripts')
</body>
</html>