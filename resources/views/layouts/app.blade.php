<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Viešbutis')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #ec4899;
            --accent: #14b8a6;
            --accent-light: #2dd4bf;
            --neutral-50: #f9fafb;
            --neutral-100: #f3f4f6;
            --neutral-200: #e5e7eb;
            --neutral-300: #d1d5db;
            --neutral-400: #9ca3af;
            --neutral-500: #6b7280;
            --neutral-600: #4b5563;
            --neutral-700: #374151;
            --neutral-800: #1f2937;
            --neutral-900: #111827;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--neutral-50);
            color: var(--neutral-700);
            line-height: 1.6;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, #667eea 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            background-color: rgba(99, 102, 241, 0.95);
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            text-decoration: none;
            color: white;
            transition: transform 0.2s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .navbar-menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            position: relative;
        }

        .navbar-menu a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        .navbar-menu a:hover {
            color: white;
        }

        .navbar-menu a:hover::after {
            width: 100%;
        }

        .navbar-auth {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            margin: 1rem 0;
            border: 1px solid var(--neutral-100);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-header {
            border-bottom: 1px solid var(--neutral-100);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
        }

        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--neutral-900);
        }

        /* Buttons */
        .btn {
            padding: 0.625rem 1.25rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover:not(:disabled) {
            background: var(--primary-dark);
            box-shadow: 0 10px 15px rgba(99, 102, 241, 0.4);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--neutral-200);
            color: var(--neutral-700);
        }

        .btn-secondary:hover:not(:disabled) {
            background: var(--neutral-300);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover:not(:disabled) {
            background: #dc2626;
            box-shadow: 0 10px 15px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }

        .btn-success {
            background: var(--success);
            color: white;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover:not(:disabled) {
            background: #059669;
            box-shadow: 0 10px 15px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .btn-accent {
            background: var(--accent);
            color: white;
            box-shadow: 0 4px 6px rgba(20, 184, 166, 0.3);
        }

        .btn-accent:hover:not(:disabled) {
            background: #0d9488;
            box-shadow: 0 10px 15px rgba(20, 184, 166, 0.4);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover:not(:disabled) {
            background: var(--primary);
            color: white;
        }

        /* Form Elements */
        .form-group {
            margin: 1.5rem 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.625rem;
            font-weight: 600;
            color: var(--neutral-700);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--neutral-200);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            background: white;
            transition: all 0.2s ease;
            color: var(--neutral-700);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: white;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin: 1rem 0;
            border-left: 4px solid;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            border-left-color: var(--success);
        }

        .alert-danger {
            background: #fef2f2;
            color: #7f1d1d;
            border-left-color: var(--danger);
        }

        .alert-warning {
            background: #fffbeb;
            color: #92400e;
            border-left-color: var(--warning);
        }

        .alert-info {
            background: #f0f9ff;
            color: #0c2340;
            border-left-color: var(--primary);
        }

        .alert ul {
            margin: 0.5rem 0 0 1.5rem;
        }

        .alert li {
            margin: 0.25rem 0;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--neutral-100);
        }

        th {
            background: var(--neutral-50);
            font-weight: 700;
            color: var(--neutral-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background: var(--neutral-50);
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin: 1.5rem 0;
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .badge-primary {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        /* Utilities */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mt-1 { margin-top: 0.5rem; }
        .mt-2 { margin-top: 1rem; }
        .mt-3 { margin-top: 1.5rem; }
        .mt-4 { margin-top: 2rem; }

        .mb-1 { margin-bottom: 0.5rem; }
        .mb-2 { margin-bottom: 1rem; }
        .mb-3 { margin-bottom: 1.5rem; }
        .mb-4 { margin-bottom: 2rem; }

        .gap-1 { gap: 0.5rem; }
        .gap-2 { gap: 1rem; }
        .gap-3 { gap: 1.5rem; }

        .flex { display: flex; }
        .flex-between { display: flex; justify-content: space-between; align-items: center; }
        .flex-center { display: flex; justify-content: center; align-items: center; }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-menu {
                gap: 1rem;
                font-size: 0.9rem;
            }

            .container {
                padding: 1rem;
            }

            .card {
                padding: 1rem;
            }

            .grid,
            .grid-2 {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.9rem;
            }

            th,
            td {
                padding: 0.75rem 0.5rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }

        /* Form Elements - Enhanced */
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--neutral-200);
            border-radius: 8px;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            font-size: 0.95rem;
            background: white;
            transition: all 0.2s ease;
            color: var(--neutral-700);
        }

        /* Select Specific Styling */
        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%234b5563' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-color: white;
            padding-right: 2.5rem;
        }

        .form-group select option {
            padding: 0.5rem;
            color: var(--neutral-700);
            background: white;
        }

        /* Checkbox & Radio Styling */
        .form-group input[type="checkbox"],
        .form-group input[type="radio"] {
            width: auto;
            height: 1.25rem;
            width: 1.25rem;
            padding: 0;
            border: 2px solid var(--neutral-300);
            border-radius: 4px;
            cursor: pointer;
            accent-color: var(--primary);
            margin-right: 0.5rem;
            vertical-align: middle;
            transition: all 0.2s ease;
            appearance: auto;
            -webkit-appearance: auto;
        }

        .form-group input[type="radio"] {
            border-radius: 50%;
        }

        .form-group input[type="checkbox"]:checked,
        .form-group input[type="radio"]:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-group input[type="checkbox"]:focus,
        .form-group input[type="radio"]:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-group input[type="checkbox"]:hover,
        .form-group input[type="radio"]:hover {
            border-color: var(--primary);
        }

        /* Checkbox Label Wrapper */
        .checkbox-group,
        .radio-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0.75rem 0;
        }

        .checkbox-group label,
        .radio-group label {
            margin: 0;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
        }

        /* Text Input & Textarea */
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group input[type="time"],
        .form-group textarea {
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background-color: white;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .form-group select {
                appearance: auto;
                -webkit-appearance: auto;
                -moz-appearance: auto;
                background-image: none;
                padding-right: 1rem;
            }

            .form-group input[type="checkbox"],
            .form-group input[type="radio"] {
                width: 1.5rem;
                height: 1.5rem;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="navbar-brand">
            🏨 Viešbutis
        </a>
        <div class="navbar-menu">
            @auth
                <a href="{{ route('dashboard') }}">Informacija</a>
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('rooms.index') }}">Kambariai</a>
                    <a href="{{ route('reservations.index') }}">Rezervacijos</a>
                @elseif(auth()->user()->hasRole('director'))
                    <a href="{{ route('reviews.index') }}">Atsiliepimai</a>
                @else
                    <a href="{{ route('reservations.index') }}">Mano rezervacijos</a>
                    <a href="{{ route('reviews.index') }}">Atsiliepimai</a>
                @endif
            @else
                <a href="{{ route('login') }}">Prisijungti</a>
                <a href="{{ route('register') }}">Registruotis</a>
            @endauth
        </div>
        @auth
            <div class="navbar-auth">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="padding: 0.5rem 1rem; margin: 0;">Atsijungti</button>
                </form>
            </div>
        @endauth
    </div>
</nav>

<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <div>
                <strong>❌ Klaidos:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            <div style="flex: 1;">
                <strong>✓ Sėkmė!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>
