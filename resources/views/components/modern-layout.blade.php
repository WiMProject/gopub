<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GoPub') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Modern CSS -->
    <style>
        /* Compact Pagination Layout */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            margin-top: 16px;
        }
        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .pagination-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            color: #6b7280;
            text-decoration: none;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
            height: 28px;
            transition: all 0.15s ease;
            background: white;
        }
        .pagination-btn:hover:not(.disabled) {
            background-color: #f8fafc;
            border-color: #3b82f6;
            color: #3b82f6;
        }
        .pagination-btn.disabled {
            color: #d1d5db;
            cursor: not-allowed;
            opacity: 0.5;
        }
        .pagination-info {
            font-size: 13px;
            color: #6b7280;
            font-weight: 500;
        }
        .pagination-current {
            color: #3b82f6;
            font-weight: 600;
        }
        /* Arrow icons */
        .pagination-btn svg {
            width: 12px;
            height: 12px;
        }
        /* Hide default Laravel pagination */
        .pagination {
            display: none;
        }
        
        /* Auto-suggest styling */
        .search-suggestions {
            position: absolute;
            width: 100%;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-top: 2px;
            display: none;
            min-height: auto;
        }
        
        .suggestion-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .suggestion-item:last-child {
            border-bottom: none;
        }
        
        .suggestion-item:hover {
            background-color: #f8fafc;
            transform: translateX(2px);
        }
        
        .suggestion-title {
            font-weight: 500;
            color: #1f2937;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .suggestion-subtitle {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 2px;
        }
        
        .suggestion-highlight {
            color: #3b82f6;
            font-weight: 600;
            background-color: rgba(59, 130, 246, 0.1);
            padding: 1px 2px;
            border-radius: 2px;
        }
        
        /* Custom scrollbar for suggestions */
        .search-suggestions::-webkit-scrollbar {
            width: 6px;
        }
        
        .search-suggestions::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        
        .search-suggestions::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .search-suggestions::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #64748b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #06b6d4;
            --light: #f3f4f6;
            --dark: #1f2937;
            --white: #ffffff;
            --body-bg: #f9fafb;
            --body-color: #1f2937;
            --border-color: #e5e7eb;
            --card-bg: #ffffff;
            --header-height: 64px;
            --sidebar-width: 250px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            line-height: 1.5;
            color: var(--body-color);
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }
        
        a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s;
        }
        
        a:hover {
            color: var(--primary-dark);
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        /* Header & Navigation */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 20px rgba(0,0,0,0.08);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 0.5rem;
        }
        
        .nav {
            display: flex;
            align-items: center;
        }
        
        .nav-list {
            display: flex;
            list-style: none;
        }
        
        .nav-item {
            margin-left: 1.5rem;
            position: relative;
        }
        
        .nav-link {
            color: var(--secondary);
            font-weight: 500;
            padding: 0.5rem 0;
            transition: color 0.2s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary);
        }
        
        .nav-link i {
            margin-right: 0.25rem;
        }
        
        .dropdown {
            position: relative;
        }
        
        .dropdown-toggle {
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        
        .dropdown-toggle::after {
            content: '';
            display: inline-block;
            margin-left: 0.5rem;
            vertical-align: middle;
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
            display: none;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            background-color: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            clear: both;
            font-weight: 400;
            color: var(--body-color);
            text-align: inherit;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
            text-decoration: none;
        }
        
        .dropdown-item:hover {
            color: var(--primary);
            background-color: var(--light);
        }
        
        .dropdown-divider {
            height: 0;
            margin: 0.5rem 0;
            overflow: hidden;
            border-top: 1px solid var(--border-color);
        }
        
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--secondary);
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        /* Main Content */
        .main {
            padding-top: calc(var(--header-height) + 2rem);
            padding-bottom: 2rem;
            min-height: calc(100vh - var(--header-height));
        }
        
        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: var(--secondary);
            font-size: 1rem;
        }
        
        /* Cards */
        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .card-header {
            padding: 1.25rem 1.5rem;
            background-color: var(--white);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-footer {
            padding: 1rem 1.5rem;
            background-color: var(--white);
            border-top: 1px solid var(--border-color);
        }
        
        /* Buttons */
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            line-height: 1.5;
            border-radius: 8px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }
        
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1.125rem;
            border-radius: 0.5rem;
        }
        
        .btn-primary {
            color: var(--white);
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: var(--white);
        }
        
        .btn-secondary {
            color: var(--white);
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
        
        .btn-secondary:hover {
            background-color: #475569;
            border-color: #475569;
            color: var(--white);
        }
        
        .btn-success {
            color: var(--white);
            background-color: var(--success);
            border-color: var(--success);
        }
        
        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
            color: var(--white);
        }
        
        .btn-danger {
            color: var(--white);
            background-color: var(--danger);
            border-color: var(--danger);
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
            border-color: #dc2626;
            color: var(--white);
        }
        
        .btn-outline-primary {
            color: var(--primary);
            background-color: transparent;
            border-color: var(--primary);
        }
        
        .btn-outline-primary:hover {
            color: var(--white);
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        /* Forms */
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-control {
            display: block;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 0.95rem;
            line-height: 1.5;
            color: var(--dark);
            background-color: var(--white);
            background-clip: padding-box;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-control:focus {
            border-color: #93c5fd;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }
        
        .form-text {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: var(--secondary);
        }
        
        .form-check {
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5rem;
            margin-bottom: 0.125rem;
        }
        
        .form-check-input {
            float: left;
            margin-left: -1.5rem;
            width: 1rem;
            height: 1rem;
            margin-top: 0.25rem;
            vertical-align: top;
            background-color: var(--white);
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            border: 1px solid var(--border-color);
            appearance: none;
        }
        
        .form-check-input[type="checkbox"] {
            border-radius: 0.25rem;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-check-label {
            margin-bottom: 0;
            color: var(--dark);
        }
        
        /* Alerts */
        .alert {
            position: relative;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.375rem;
        }
        
        .alert-success {
            color: #0f766e;
            background-color: #d1fae5;
            border-color: #a7f3d0;
        }
        
        .alert-danger {
            color: #b91c1c;
            background-color: #fee2e2;
            border-color: #fecaca;
        }
        
        .alert-info {
            color: #0369a1;
            background-color: #e0f2fe;
            border-color: #bae6fd;
        }
        
        .alert-warning {
            color: #92400e;
            background-color: #fef3c7;
            border-color: #fde68a;
        }
        
        /* Tables */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--dark);
            vertical-align: top;
            border-color: var(--border-color);
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }
        
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            background-color: var(--light);
        }
        
        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1;
            color: var(--white);
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        
        .badge-primary {
            background-color: var(--primary);
        }
        
        .badge-secondary {
            background-color: var(--secondary);
        }
        
        .badge-success {
            background-color: var(--success);
        }
        
        .badge-danger {
            background-color: var(--danger);
        }
        
        .badge-warning {
            background-color: var(--warning);
            color: var(--dark);
        }
        
        .badge-info {
            background-color: var(--info);
        }
        
        /* Utilities */
        .d-flex {
            display: flex !important;
        }
        
        .flex-column {
            flex-direction: column !important;
        }
        
        .justify-content-between {
            justify-content: space-between !important;
        }
        
        .align-items-center {
            align-items: center !important;
        }
        
        .text-center {
            text-align: center !important;
        }
        
        .text-right {
            text-align: right !important;
        }
        
        .text-primary {
            color: var(--primary) !important;
        }
        
        .text-secondary {
            color: var(--secondary) !important;
        }
        
        .text-success {
            color: var(--success) !important;
        }
        
        .text-danger {
            color: var(--danger) !important;
        }
        
        .text-warning {
            color: var(--warning) !important;
        }
        
        .text-info {
            color: var(--info) !important;
        }
        
        .bg-primary {
            background-color: var(--primary) !important;
        }
        
        .bg-light {
            background-color: var(--light) !important;
        }
        
        .mb-0 {
            margin-bottom: 0 !important;
        }
        
        .mb-1 {
            margin-bottom: 0.25rem !important;
        }
        
        .mb-2 {
            margin-bottom: 0.5rem !important;
        }
        
        .mb-3 {
            margin-bottom: 1rem !important;
        }
        
        .mb-4 {
            margin-bottom: 1.5rem !important;
        }
        
        .mb-5 {
            margin-bottom: 3rem !important;
        }
        
        .mt-0 {
            margin-top: 0 !important;
        }
        
        .mt-1 {
            margin-top: 0.25rem !important;
        }
        
        .mt-2 {
            margin-top: 0.5rem !important;
        }
        
        .mt-3 {
            margin-top: 1rem !important;
        }
        
        .mt-4 {
            margin-top: 1.5rem !important;
        }
        
        .mt-5 {
            margin-top: 3rem !important;
        }
        
        .ml-1 {
            margin-left: 0.25rem !important;
        }
        
        .ml-2 {
            margin-left: 0.5rem !important;
        }
        
        .ml-3 {
            margin-left: 1rem !important;
        }
        
        .mr-1 {
            margin-right: 0.25rem !important;
        }
        
        .mr-2 {
            margin-right: 0.5rem !important;
        }
        
        .mr-3 {
            margin-right: 1rem !important;
        }
        
        .p-0 {
            padding: 0 !important;
        }
        
        .p-1 {
            padding: 0.25rem !important;
        }
        
        .p-2 {
            padding: 0.5rem !important;
        }
        
        .p-3 {
            padding: 1rem !important;
        }
        
        .p-4 {
            padding: 1.5rem !important;
        }
        
        .p-5 {
            padding: 3rem !important;
        }
        
        .rounded {
            border-radius: 0.375rem !important;
        }
        
        .rounded-circle {
            border-radius: 50% !important;
        }
        
        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        }
        
        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
        }
        
        .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }
        
        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        }
        
        /* Grid System */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.75rem;
            margin-left: -0.75rem;
        }
        
        .col {
            flex: 1 0 0%;
            padding-right: 0.75rem;
            padding-left: 0.75rem;
        }
        
        .col-auto {
            flex: 0 0 auto;
            width: auto;
            padding-right: 0.75rem;
            padding-left: 0.75rem;
        }
        
        .col-1 { flex: 0 0 auto; width: 8.33333333%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-2 { flex: 0 0 auto; width: 16.66666667%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-3 { flex: 0 0 auto; width: 25%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-4 { flex: 0 0 auto; width: 33.33333333%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-5 { flex: 0 0 auto; width: 41.66666667%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-6 { flex: 0 0 auto; width: 50%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-7 { flex: 0 0 auto; width: 58.33333333%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-8 { flex: 0 0 auto; width: 66.66666667%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-9 { flex: 0 0 auto; width: 75%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-10 { flex: 0 0 auto; width: 83.33333333%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-11 { flex: 0 0 auto; width: 91.66666667%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .col-12 { flex: 0 0 auto; width: 100%; padding-right: 0.75rem; padding-left: 0.75rem; }
        
        /* Footer */
        .footer {
            background-color: var(--white);
            border-top: 1px solid var(--border-color);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-text {
            color: var(--secondary);
            font-size: 0.875rem;
        }
        
        .footer-links {
            display: flex;
            list-style: none;
        }
        
        .footer-link {
            margin-left: 1.5rem;
            color: var(--secondary);
            font-size: 0.875rem;
        }
        
        .footer-link:hover {
            color: var(--primary);
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .container {
                max-width: 960px;
            }
        }
        
        @media (max-width: 767.98px) {
            .container {
                max-width: 720px;
            }
            
            .mobile-toggle {
                display: block;
            }
            
            .nav-list {
                display: none;
                position: absolute;
                top: var(--header-height);
                left: 0;
                right: 0;
                background-color: var(--white);
                border-top: 1px solid var(--border-color);
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                flex-direction: column;
                padding: 1rem 0;
            }
            
            .nav-list.show {
                display: flex;
            }
            
            .nav-item {
                margin: 0;
                width: 100%;
            }
            
            .nav-link {
                padding: 0.75rem 1.5rem;
                display: block;
            }
            
            .dropdown-menu {
                position: static;
                box-shadow: none;
                border: none;
                padding-left: 2rem;
            }
            
            .dropdown-item {
                padding: 0.5rem 1rem;
            }
        }
        
        @media (max-width: 575.98px) {
            .container {
                max-width: 100%;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .card-header .btn {
                margin-top: 1rem;
                width: 100%;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-links {
                margin-top: 1rem;
                justify-content: center;
            }
            
            .footer-link {
                margin: 0 0.75rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container header-container">
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-book-open"></i> GoPub
            </a>
            
            <button class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <nav class="nav">
                <ul class="nav-list" id="navList">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('search') }}" class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}">
                            <i class="fas fa-search"></i> Search
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('publications.index') }}" class="nav-link {{ request()->routeIs('publications.*') ? 'active' : '' }}">
                                <i class="fas fa-file-alt"></i> Publications
                            </a>
                        </li>
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                    <i class="fas fa-users"></i> Users
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="userDropdown">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" id="userDropdownMenu">
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            @if (isset($header))
                <div class="page-header">
                    <h1 class="page-title">{{ $header }}</h1>
                    @if (isset($subheader))
                        <p class="page-subtitle">{{ $subheader }}</p>
                    @endif
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i> {{ session('info') }}
                </div>
            @endif

            {{ $slot }}
        </div>
    </main>

    <footer class="footer">
        <div class="container footer-content">
            <p class="footer-text">&copy; {{ date('Y') }} GoPub. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="{{ route('about') }}" class="footer-link">About</a></li>
                <li><a href="{{ route('privacy') }}" class="footer-link">Privacy</a></li>
                <li><a href="{{ route('terms') }}" class="footer-link">Terms</a></li>
                <li><a href="{{ route('contact') }}" class="footer-link">Contact</a></li>
            </ul>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileToggle = document.getElementById('mobileToggle');
            const navList = document.getElementById('navList');
            
            if (mobileToggle && navList) {
                mobileToggle.addEventListener('click', function() {
                    navList.classList.toggle('show');
                });
            }
            
            // User dropdown toggle
            const userDropdown = document.getElementById('userDropdown');
            const userDropdownMenu = document.getElementById('userDropdownMenu');
            
            if (userDropdown && userDropdownMenu) {
                userDropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    userDropdownMenu.classList.toggle('show');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userDropdown.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                        userDropdownMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>