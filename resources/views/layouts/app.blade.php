<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StockPro')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6, .brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        body {
            background: linear-gradient(135deg, #f5f1ff 0%, #e8e0ff 100%);
            color: #2d2d3d;
            min-height: 100vh;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #2d1b4e 0%, #1a0f2e 100%);
            min-height: 100vh;
            padding: 20px 0;
            box-shadow: 4px 0 15px rgba(45, 27, 78, 0.3);
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 14px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: 0.3px;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(147, 112, 219, 0.2);
            border-left-color: #9370db;
            padding-left: 24px;
        }
        
        .brand {
            padding: 30px 20px;
            color: white;
            font-size: 28px;
            text-align: center;
            border-bottom: 2px solid rgba(147, 112, 219, 0.3);
            letter-spacing: 1px;
        }
        
        .main-content {
            padding: 40px;
        }
        
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
            margin-bottom: 24px;
            border-top: 4px solid #7c3aed;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(45, 27, 78, 0.12);
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #7c3aed;
            font-family: 'Playfair Display', serif;
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .stat-change {
            font-size: 12px;
            margin-top: 8px;
            color: #10b981;
            font-weight: 600;
        }
        
        .chart-container {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
            margin-bottom: 24px;
        }
        
        .table-container {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
            margin-bottom: 24px;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background: #f9f5ff;
            color: #2d1b4e;
            font-weight: 600;
            border: none;
            border-bottom: 2px solid #e8d5ff;
            padding: 14px;
            font-size: 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .table tbody td {
            padding: 14px;
            border: none;
            border-bottom: 1px solid #f0e9ff;
            vertical-align: middle;
        }
        
        .table tbody tr:hover {
            background-color: #f9f5ff;
        }
        
        .alert-badge {
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .alert-critique {
            background-color: #fde8e8;
            color: #c62828;
        }
        
        .alert-warning {
            background-color: #fff3e0;
            color: #e65100;
        }
        
        .topbar {
            background: white;
            padding: 18px 40px;
            box-shadow: 0 2px 15px rgba(45, 27, 78, 0.08);
            border-bottom: 2px solid #f0e9ff;
        }
        
        .topbar h5 {
            color: #2d1b4e;
            font-size: 24px;
        }
        
        /* Styles pour les boutons */
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            border: none;
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 24px;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
            background: linear-gradient(135deg, #6d28d9 0%, #5b21b6 100%);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 24px;
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 24px;
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }
        
        /* Styles pour les formulaires */
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #f0e9ff;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 0.3rem rgba(124, 58, 237, 0.1);
            background: white;
        }
        
        .form-label {
            color: #2d1b4e;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        
        /* Styles pour les cartes */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(45, 27, 78, 0.12);
        }
        
        .card-header {
            background: linear-gradient(135deg, #f9f5ff 0%, #f0e9ff 100%);
            border: none;
            color: #2d1b4e;
            font-weight: 700;
            border-radius: 16px 16px 0 0;
            padding: 20px;
            letter-spacing: 0.3px;
        }
        
        /* Styles pour les alertes */
        .alert {
            border: none;
            border-radius: 12px;
            border-left: 4px solid;
            padding: 14px 16px;
            font-weight: 500;
        }
        
        .alert-danger {
            background-color: #fde8e8;
            border-left-color: #dc2626;
            color: #991b1b;
        }
        
        .alert-success {
            background-color: #d1fae5;
            border-left-color: #10b981;
            color: #065f46;
        }
        
        .alert-warning {
            background-color: #fef3c7;
            border-left-color: #f59e0b;
            color: #92400e;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="brand">
                    <i class="bi bi-box-seam"></i> StockPro
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                        <i class="bi bi-house-door"></i> Tableau de Bord
                    </a>
                    <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="/products">
                        <i class="bi bi-box"></i> Produits
                    </a>
                    <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="/categories">
                        <i class="bi bi-tags"></i> Catégories
                    </a>
                    <a class="nav-link {{ request()->is('movements*') ? 'active' : '' }}" href="/movements">
                        <i class="bi bi-arrow-left-right"></i> Mouvements
                    </a>
                    <a class="nav-link {{ request()->is('alerts*') ? 'active' : '' }}" href="/alerts">
                        <i class="bi bi-exclamation-triangle"></i> Alertes
                    </a>
                    <hr style="border-color: rgba(255,255,255,0.2); margin: 20px 0;">
                    <a class="nav-link" href="/profile">
                        <i class="bi bi-person"></i> Profil
                    </a>
                    <form method="POST" action="/logout" style="display: inline;">
                        @csrf
                        <button class="nav-link" style="border: none; background: none; width: 100%; text-align: left;">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <div class="topbar d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@yield('header', 'Tableau de Bord')</h5>
                    <div class="d-flex align-items-center gap-3">
                        <span class="text-muted">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}" alt="Avatar" class="rounded-circle" width="40">
                    </div>
                </div>

                <div class="main-content">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @yield('scripts')
</body>
</html>
