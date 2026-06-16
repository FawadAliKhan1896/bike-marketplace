<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | BikeMarket</title>
    
    <!-- Enterprise Font Selection: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Iconography -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Core Brand CSS -->
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">

    <!-- Admin Specific Custom CSS -->
    <style>
        :root {
            --sidebar-width: 260px;
            --admin-dark: #0b1a30;
            --admin-dark-hover: #1e2e4a;
            --admin-bg: #f3f4f6;
            --admin-card-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        body.admin-body {
            background-color: var(--admin-bg);
            color: var(--gray-800);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            font-family: var(--font-sans);
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--admin-dark);
            color: var(--white);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1050;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            padding: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-brand h3 {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0.05em;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand h3 span {
            color: var(--accent);
        }

        .sidebar-close {
            display: none;
            background: transparent;
            border: none;
            color: var(--white);
            font-size: 20px;
            cursor: pointer;
        }

        .sidebar-menu {
            flex: 1;
            padding: 24px 16px;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            overflow-y: auto;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            font-weight: 600;
            border-radius: var(--radius-md);
            transition: all var(--transition-base);
        }

        .sidebar-menu li a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sidebar-menu li a:hover {
            color: var(--white);
            background: var(--admin-dark-hover);
            transform: translateX(4px);
        }

        .sidebar-menu li a.active {
            color: var(--white);
            background: var(--primary);
            box-shadow: 0 4px 12px rgba(0, 66, 154, 0.3);
        }

        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Main Content Wrapper */
        .admin-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Top Bar Styling */
        .admin-header {
            background: var(--white);
            height: 70px;
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-toggle {
            background: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: var(--gray-700);
            display: none;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
        }

        .admin-user i {
            font-size: 18px;
            color: var(--primary);
        }

        .admin-content {
            padding: 32px;
            flex: 1;
        }

        /* Alert/Status messages */
        .admin-alert {
            padding: 16px 20px;
            border-radius: var(--radius-md);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
            border-left: 4px solid transparent;
        }

        .admin-alert-success {
            background: #f0fdf4;
            color: #166534;
            border-left-color: #22c55e;
        }

        /* Responsive Admin Cards */
        .admin-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .admin-stat-card {
            background: var(--white);
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--admin-card-shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid var(--gray-100);
            transition: transform var(--transition-base), box-shadow var(--transition-base);
        }

        .admin-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .stat-card-left h4 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-400);
            margin-bottom: 8px;
        }

        .stat-card-left .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--gray-900);
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .icon-blue {
            background: rgba(0, 66, 154, 0.1);
            color: var(--primary);
        }

        .icon-red {
            background: rgba(232, 28, 36, 0.1);
            color: var(--accent);
        }

        .icon-green {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .icon-yellow {
            background: rgba(234, 179, 8, 0.1);
            color: #eab308;
        }

        /* Admin Panels / Content Blocks */
        .admin-panel {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--admin-card-shadow);
            border: 1px solid var(--gray-100);
            margin-bottom: 32px;
            overflow: hidden;
        }

        .panel-header {
            padding: 24px 32px;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .panel-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--gray-900);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-body {
            padding: 32px;
        }

        /* Mobile Friendly Tables */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        .admin-table th {
            background: var(--gray-50);
            padding: 16px 24px;
            font-weight: 700;
            color: var(--gray-500);
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--gray-200);
        }

        .admin-table td {
            padding: 18px 24px;
            border-bottom: 1px solid var(--gray-100);
            color: var(--gray-700);
        }

        .admin-table tr:hover td {
            background: var(--gray-50);
        }

        /* Badges */
        .admin-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 700;
            border-radius: var(--radius-full);
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .badge-active {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-featured {
            background: #dbeafe;
            color: #1d4ed8;
        }

        /* Forms Styling */
        .admin-form-group {
            margin-bottom: 24px;
        }

        .admin-form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .admin-form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 14px;
            color: var(--gray-800);
            transition: all var(--transition-fast);
            background: var(--white);
            font-family: inherit;
        }

        .admin-form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 66, 154, 0.15);
        }

        .admin-form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            color: var(--gray-700);
        }

        .form-checkbox input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }

        /* Action Buttons */
        .admin-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            font-size: 13px;
            font-weight: 700;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all var(--transition-base);
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .btn-admin-primary {
            background: var(--primary);
            color: var(--white);
        }
        .btn-admin-primary:hover {
            background: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(0, 66, 154, 0.2);
        }

        .btn-admin-success {
            background: #22c55e;
            color: var(--white);
        }
        .btn-admin-success:hover {
            background: #16a34a;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.2);
        }

        .btn-admin-danger {
            background: var(--accent);
            color: var(--white);
        }
        .btn-admin-danger:hover {
            background: var(--accent-dark);
            box-shadow: 0 4px 12px rgba(232, 28, 36, 0.2);
        }

        .btn-admin-gray {
            background: var(--gray-200);
            color: var(--gray-700);
        }
        .btn-admin-gray:hover {
            background: var(--gray-300);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 11px;
            border-radius: var(--radius-sm);
        }

        /* Overlay */
        .admin-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .admin-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive Breakpoints */
        @media (max-width: 991px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.active {
                transform: translateX(0);
            }

            .sidebar-close {
                display: block;
            }

            .admin-main {
                margin-left: 0;
            }

            .header-toggle {
                display: block;
            }

            .admin-header {
                padding: 0 20px;
            }

            .admin-content {
                padding: 20px;
            }
        }
    </style>
    @yield('styles')
</head>
<body class="admin-body">

    <!-- Sidebar Overlay for Mobile -->
    <div class="admin-overlay" id="adminOverlay"></div>

    <!-- Admin Left Navigation Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <h3>BikeMarket <span>Admin</span></h3>
            <button class="sidebar-close" id="sidebarCloseBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.ads.index') }}" class="{{ request()->routeIs('admin.ads.*') ? 'active' : '' }}">
                    <i class="fas fa-motorcycle"></i> Manage Ads
                </a>
            </li>
            <li>
                <a href="{{ route('admin.dealerships.index') }}" class="{{ request()->routeIs('admin.dealerships.*') ? 'active' : '' }}">
                    <i class="fas fa-store"></i> Dealerships
                </a>
            </li>
            <li>
                <a href="{{ route('admin.calculator.index') }}" class="{{ request()->routeIs('admin.calculator.index') || request()->routeIs('admin.calculator.create') || request()->routeIs('admin.calculator.edit') ? 'active' : '' }}">
                    <i class="fas fa-calculator"></i> Price Calculator
                </a>
            </li>
            <li>
                <a href="{{ route('admin.calculator.valuations') }}" class="{{ request()->routeIs('admin.calculator.valuations') ? 'active' : '' }}">
                    <i class="fas fa-history"></i> Valuation Inquiries
                </a>
            </li>
            <li style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 16px;">
                <a href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Public Website
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="admin-btn btn-admin-danger" style="width: 100%; justify-content: center;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main">
        <header class="admin-header">
            <button class="header-toggle" id="sidebarToggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="admin-user">
                <span>Welcome, <strong>{{ Auth::user()->name }}</strong></span>
                <i class="fas fa-user-circle"></i>
            </div>
        </header>

        <section class="admin-content">
            <!-- Success/Error alert notifications -->
            @if(session('success'))
                <div class="admin-alert admin-alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </section>
    </main>

    <!-- Admin Panel Mobile Interactivity Controller -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const closeBtn = document.getElementById('sidebarCloseBtn');
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('adminOverlay');

            const toggleSidebar = () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            };

            if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
            if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>
    @yield('scripts')
</body>
</html>
