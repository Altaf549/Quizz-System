<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quiz Management System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .login-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-card-header {
            background: #ff6b6b;
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            color: white;
        }
        .login-card-body {
            padding: 2rem;
        }
        .input-group {
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.5rem;
        }
        .input-group-text {
            background-color: #f8fafc;
            border: none;
            border-right: 1px solid #e2e8f0;
            color: #4a5568;
        }
        .form-control {
            background-color: #f8fafc;
            border: none;
            border-radius: 0;
            box-shadow: none;
            padding: 0.75rem;
            color: #4a5568;
        }
        .form-control:focus {
            border-color: #ff6b6b;
            box-shadow: none;
        }
        .form-check-input {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .form-check-input:checked {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }
        .form-check-label {
            color: #4a5568;
        }
        .text-muted {
            color: #718096;
        }
        .text-white {
            color: #ffffff;
        }
        .alert {
            border-radius: 0.5rem;
            background-color: rgba(255,255,255,0.05);
            border: 1px solid #e2e8f0;
        }
        .alert-danger {
            background-color: rgba(248,113,113,0.1);
            border-color: rgba(248,113,113,0.2);
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }
        .login-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-card-header {
            background: #ff6b6b;
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            color: white;
        }
        .login-card-body {
            padding: 2rem;
        }
        .login-form {
            margin-top: 1rem;
        }
        .input-group {
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.5rem;
        }
        .input-group-text {
            background-color: #f8fafc;
            border: none;
            border-right: 1px solid #e2e8f0;
            color: #4a5568;
        }
        .form-control {
            border: none;
            border-radius: 0;
            box-shadow: none;
            padding: 0.75rem;
        }
        .form-control:focus {
            border-color: #ff6b6b;
            box-shadow: none;
        }
        .btn-primary {
            background: #ff6b6b;
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #ff5252;
            transform: translateY(-1px);
        }
        .form-check-input {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .form-check-input:checked {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }
        .form-check-label {
            color: #4a5568;
        }
        .text-muted {
            color: #cbd5e0;
        }
        .text-white {
            color: #ffffff;
        }
        .alert {
            border-radius: 0.5rem;
            background-color: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .alert-danger {
            background-color: rgba(248,113,113,0.1);
            border-color: rgba(248,113,113,0.2);
        }
    </style>
    
    <!-- Custom styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        #app {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }
        
        .main-content {
            flex: 1;
            width: 100%;
            padding: 2rem;
            padding-left: 0;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .table-responsive {
            margin-bottom: 2rem;
        }
        .login-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-card-header {
            background: #ff6b6b;
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            color: white;
        }
        .login-card-body {
            padding: 2rem;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 600;
            color: #2d3748 !important;
        }
        .nav-link {
            color: #4a5568 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #2d3748 !important;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-radius: 12px;
        }
        .btn-primary {
            background-color: #4299e1;
            border-color: #4299e1;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #3182ce;
            border-color: #3182ce;
        }
        .form-control:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 0.2rem rgba(66, 153, 225, 0.25);
        }
        .invalid-feedback {
            color: #e53e3e;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar-container bg-white shadow-sm" style="width: 250px; min-height: 100vh;">
            <div class="sidebar-header py-3 px-4">
                <h4 class="mb-0">Quiz Management</h4>
            </div>
            <nav class="sidebar-nav">
                @include('layouts.sidebar')
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content flex-grow-1 ms-3" style="min-height: 100vh;">
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</body>
</html>
