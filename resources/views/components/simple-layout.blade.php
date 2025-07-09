<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GoPub') }}</title>

    <!-- Simple CSS -->
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #3182ce;
            text-decoration: none;
        }
        .navbar-nav {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-item {
            margin-left: 1.5rem;
        }
        .nav-link {
            color: #4a5568;
            text-decoration: none;
        }
        .nav-link:hover {
            color: #2b6cb0;
        }
        .header {
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }
        .header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a202c;
        }
        .card {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }
        .card-body {
            padding: 1.5rem;
        }
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: all 0.15s ease-in-out;
            text-decoration: none;
        }
        .btn-primary {
            color: #fff;
            background-color: #3182ce;
            border: 1px solid #3182ce;
        }
        .btn-primary:hover {
            background-color: #2b6cb0;
            border-color: #2b6cb0;
        }
        .btn-secondary {
            color: #3182ce;
            background-color: #ebf8ff;
            border: 1px solid #ebf8ff;
        }
        .btn-secondary:hover {
            background-color: #bee3f8;
            border-color: #bee3f8;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus {
            border-color: #a4cafe;
            outline: 0;
            box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45);
        }
        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            text-align: left;
        }
        .footer {
            background-color: #fff;
            border-top: 1px solid #e2e8f0;
            padding: 1.5rem 0;
            margin-top: 3rem;
        }
        .footer p {
            margin: 0;
            color: #718096;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">GoPub</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('search') }}" class="nav-link">Search</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('publications.index') }}" class="nav-link">Publications</a>
                    </li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">Users</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; padding: 0;">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    @if (isset($header))
        <header class="header">
            <div class="container">
                <h1>{{ $header }}</h1>
            </div>
        </header>
    @endif

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} GoPub. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>