<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certified Dealerships | BikeMarket</title>
    <meta name="description" content="Explore authorized and certified partner bike dealerships across Pakistan. Find verified dealers in Lahore, Karachi, Islamabad and more.">
    
    <!-- Enterprise Font Selection: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Iconography -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon">

    <style>
        .page-header-hero {
            background: linear-gradient(rgba(11, 26, 48, 0.9), rgba(11, 26, 48, 0.9)), url('https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&q=80&w=1200') center/cover;
            padding: 60px 0;
            color: var(--white);
            text-align: center;
            border-bottom: 4px solid var(--accent);
        }

        .page-header-hero h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }

        .page-header-hero p {
            font-size: 16px;
            opacity: 0.8;
        }

        .search-dealers-bar {
            background: var(--white);
            padding: 16px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            max-width: 900px;
            margin: -35px auto 40px;
            border: 1px solid var(--gray-200);
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-dealers-bar input {
            flex: 1;
            min-width: 250px;
            border: 1px solid var(--gray-200);
            padding: 12px 16px;
            font-size: 14px;
            outline: none;
            border-radius: var(--radius-sm);
            color: var(--gray-800);
        }

        .search-dealers-bar select {
            width: 200px;
            min-width: 150px;
            border: 1px solid var(--gray-200);
            padding: 12px 16px;
            font-size: 14px;
            outline: none;
            border-radius: var(--radius-sm);
            color: var(--gray-800);
            cursor: pointer;
        }

        .featured-dealers-container {
            margin-bottom: 60px;
        }

        .featured-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .featured-header h3 {
            font-size: 22px;
            font-weight: 800;
            color: var(--gray-900);
        }

        .featured-badge {
            background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);
            color: var(--white);
            font-size: 11px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: var(--radius-full);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.2);
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
        }

        .featured-card {
            background: var(--white);
            border: 2px solid #fbbf24;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: 0 10px 30px rgba(251, 191, 36, 0.08);
            position: relative;
            transition: all var(--transition-base);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .featured-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(251, 191, 36, 0.15);
        }

        .dealer-card-top {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .dealer-logo-wrapper {
            width: 80px;
            height: 80px;
            border-radius: var(--radius-md);
            border: 1px solid var(--gray-200);
            padding: 6px;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dealer-logo-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .dealer-info h4 {
            font-size: 18px;
            font-weight: 800;
            color: var(--gray-900);
        }

        .dealer-city {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 2px;
        }

        .dealer-desc {
            font-size: 13px;
            color: var(--gray-600);
            line-height: 1.6;
            flex: 1;
        }

        .dealer-contacts {
            font-size: 13px;
            border-top: 1px solid var(--gray-100);
            padding-top: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .dealer-contacts span {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-700);
        }

        .dealer-contacts i {
            color: var(--primary);
            width: 16px;
        }

        .standard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .standard-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            transition: all var(--transition-base);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .standard-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
            box-shadow: var(--shadow-lg);
        }
    </style>
</head>
<body>

    <!-- Top Utility Bar -->
    <div class="top-bar">
        <div class="container top-bar-content">
            <div class="top-bar-left">
                <span><i class="fas fa-phone-alt"></i> Helpline: <strong>0312-3456789</strong></span>
                <span class="divider">|</span>
                <span><i class="fas fa-shield-alt"></i> 100% Certified Partner</span>
            </div>
            <div class="top-bar-right">
                <a href="#" class="top-link"><i class="fas fa-balance-scale"></i> Compare Bikes</a>
                <a href="#" class="top-link"><i class="fas fa-edit"></i> Write a Review</a>
                <a href="#" class="top-link"><i class="fas fa-mobile-alt"></i> Download App</a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="header" id="mainHeader">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="BikeMarket Logo">
                    </a>
                </div>
                
                <nav class="nav">
                    <div class="nav-item">
                        <a href="/" class="nav-link">Home</a>
                    </div>
                    <div class="nav-item has-dropdown">
                        <a href="#" class="nav-link">Used Bikes <i class="fas fa-chevron-down nav-arrow"></i></a>
                        <div class="dropdown-menu">
                            <div class="dropdown-grid">
                                <div class="dropdown-column">
                                    <h4>Find Used Bikes</h4>
                                    <a href="{{ route('ads') }}"><i class="fas fa-search"></i> Search Used Bikes</a>
                                    <a href="{{ route('dealerships') }}"><i class="fas fa-tags"></i> Dealership Listings</a>
                                    <a href="{{ route('calculator') }}"><i class="fas fa-calculator"></i> Price Calculator</a>
                                </div>
                                <div class="dropdown-column">
                                    <h4>Popular Brands</h4>
                                    <a href="{{ route('ads', ['brand' => 'Honda']) }}">Honda</a>
                                    <a href="{{ route('ads', ['brand' => 'Suzuki']) }}">Suzuki</a>
                                    <a href="{{ route('ads', ['brand' => 'Yamaha']) }}">Yamaha</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('dealerships') }}" class="nav-link active">Dealerships</a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('calculator') }}" class="nav-link">Price Calculator</a>
                    </div>
                </nav>

                <div class="header-actions">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-premium"><i class="fas fa-user-shield"></i> Admin Panel</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-premium"><i class="fas fa-user-circle"></i> Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-premium"><i class="fas fa-sign-in-alt"></i> Sign In</a>
                    @endauth
                    <a href="{{ route('ads.create') }}" class="btn btn-accent-premium">
                        <span>Post an Ad</span>
                        <i class="fas fa-plus-circle"></i>
                    </a>
                    
                    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle Menu">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            <div class="drawer-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="BikeMarket Logo">
            </div>
            <button class="drawer-close" id="drawerClose" aria-label="Close Menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="drawer-body">
            <nav class="drawer-nav">
                <a href="/" class="drawer-link"><i class="fas fa-home"></i> Home</a>
                <a href="{{ route('ads') }}" class="drawer-link"><i class="fas fa-search"></i> Search Used Bikes</a>
                <a href="{{ route('dealerships') }}" class="drawer-link active"><i class="fas fa-tags"></i> Dealership Listings</a>
                <a href="{{ route('calculator') }}" class="drawer-link"><i class="fas fa-calculator"></i> Price Calculator</a>
            </nav>
        </div>
        <div class="drawer-footer">
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-premium" style="width: 100%; justify-content: center; margin-bottom: 12px;"><i class="fas fa-user-shield"></i> Admin Panel</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-premium" style="width: 100%; justify-content: center; margin-bottom: 12px;"><i class="fas fa-user-circle"></i> Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-premium" style="width: 100%; justify-content: center; margin-bottom: 12px;"><i class="fas fa-sign-in-alt"></i> Sign In</a>
            @endauth
            <a href="{{ route('ads.create') }}" class="btn btn-accent-premium" style="width: 100%; justify-content: center;">
                <span>Post an Ad</span>
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="page-header-hero">
        <div class="container">
            <h1>Certified Bike Dealerships</h1>
            <p>Locate the most trusted authorized 3S showrooms and partner dealers in your town</p>
        </div>
    </section>

    <!-- Search/Filters Bar -->
    <div class="container">
        <form method="GET" action="{{ route('dealerships') }}" id="dealerFilterForm" class="search-dealers-bar">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by showroom name or brands sold...">
            
            <select name="city" onchange="document.getElementById('dealerFilterForm').submit();">
                <option value="">All Cities</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}" {{ request('city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="btn btn-primary" style="padding: 0 32px;">Search Showrooms</button>
        </form>

        <!-- Featured Dealerships Section -->
        @if($dealerships->where('is_featured', true)->count() > 0 && !request()->filled('page'))
            <div class="featured-dealers-container">
                <div class="featured-header">
                    <h3>Featured Partners</h3>
                    <span class="featured-badge">Verified Showroom</span>
                </div>

                <div class="featured-grid">
                    @foreach($dealerships->where('is_featured', true) as $dealer)
                        <div class="featured-card">
                            <div class="dealer-card-top">
                                <div class="dealer-logo-wrapper">
                                    @if($dealer->logo)
                                        <img src="{{ asset('storage/' . $dealer->logo) }}" alt="{{ $dealer->name }}">
                                    @else
                                        <i class="fas fa-store" style="font-size: 28px; color: var(--gray-300);"></i>
                                    @endif
                                </div>
                                <div class="dealer-info">
                                    <h4>{{ $dealer->name }}</h4>
                                    <div class="dealer-city">{{ $dealer->city }}</div>
                                </div>
                            </div>
                            
                            <p class="dealer-desc">{{ $dealer->description }}</p>
                            
                            <div class="dealer-contacts">
                                <span><i class="fas fa-phone-alt"></i> {{ $dealer->phone }}</span>
                                <span><i class="far fa-envelope"></i> {{ $dealer->email }}</span>
                                <span><i class="fas fa-map-marker-alt"></i> {{ $dealer->address }}</span>
                            </div>

                            @if($dealer->website_url)
                                <a href="{{ $dealer->website_url }}" target="_blank" class="btn btn-outline" style="width: 100%; justify-content: center; font-size: 13px; font-weight: 700; border-width: 1.5px;">Visit Showroom Website</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Standard Dealerships Section -->
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 22px; font-weight: 800; color: var(--gray-900); margin-bottom: 20px;">All Showroom Partners</h3>
            
            <div class="standard-grid">
                @forelse($dealerships->where('is_featured', false) as $dealer)
                    <div class="standard-card">
                        <div class="dealer-card-top">
                            <div class="dealer-logo-wrapper">
                                @if($dealer->logo)
                                    <img src="{{ asset('storage/' . $dealer->logo) }}" alt="{{ $dealer->name }}">
                                @else
                                    <i class="fas fa-store" style="font-size: 28px; color: var(--gray-300);"></i>
                                @endif
                            </div>
                            <div class="dealer-info">
                                <h4>{{ $dealer->name }}</h4>
                                <div class="dealer-city">{{ $dealer->city }}</div>
                            </div>
                        </div>

                        <p class="dealer-desc">{{ $dealer->description }}</p>
                        
                        <div class="dealer-contacts">
                            <span><i class="fas fa-phone-alt"></i> {{ $dealer->phone }}</span>
                            <span><i class="far fa-envelope"></i> {{ $dealer->email }}</span>
                            <span><i class="fas fa-map-marker-alt"></i> {{ $dealer->address }}</span>
                        </div>

                        @if($dealer->website_url)
                            <a href="{{ $dealer->website_url }}" target="_blank" class="btn btn-outline" style="width: 100%; justify-content: center; font-size: 13px; font-weight: 700; border-width: 1px;">Showroom Website</a>
                        @endif
                    </div>
                @empty
                    @if($dealerships->where('is_featured', true)->count() == 0)
                        <div style="grid-column: span 3; text-align: center; padding: 60px; background: var(--white); border-radius: var(--radius-lg); border: 1px dashed var(--gray-200);">
                            <i class="fas fa-store-slash" style="font-size: 48px; color: var(--gray-300); margin-bottom: 20px;"></i>
                            <h4 style="font-weight: 700; color: var(--gray-800);">No Showrooms Found</h4>
                            <p style="color: var(--gray-500); font-size: 14px; margin-top: 8px;">No dealerships matched your city or name filter query.</p>
                            <a href="{{ route('dealerships') }}" class="btn btn-primary" style="margin-top: 20px;">Reset Showroom Search</a>
                        </div>
                    @endif
                @endforelse
            </div>

            <!-- Pagination Links -->
            @if($dealerships->hasPages())
                <div style="display: flex; justify-content: center; margin-bottom: 80px;">
                    {{ $dealerships->links() }}
                </div>
            @endif
        </div>

    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <img src="{{ asset('assets/images/logo.png') }}" style="height: 40px; margin-bottom: 24px;" alt="Logo">
                    <p style="color: var(--gray-500); font-size: 14px; line-height: 1.8;">
                        BikeMarket is the ultimate destination for bike enthusiasts in Pakistan. We provide a platform that ensures safety, transparency, and value for every transaction.
                    </p>
                </div>
                <div class="footer-col">
                    <h4>Marketplace</h4>
                    <ul>
                        <li><a href="{{ route('ads') }}">Used Bikes for Sale</a></li>
                        <li><a href="{{ route('dealerships') }}">Dealership Listings</a></li>
                        <li><a href="{{ route('calculator') }}">Price Calculator</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Expert Reviews</a></li>
                        <li><a href="#">Bike Comparison</a></li>
                        <li><a href="#">News & Updates</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 BikeMarket (Pvt) Ltd. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Header Scroll & Drawer Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const header = document.getElementById('mainHeader');
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const mobileDrawerOverlay = document.getElementById('mobileDrawerOverlay');
            const drawerClose = document.getElementById('drawerClose');

            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            });

            mobileMenuToggle.addEventListener('click', () => {
                mobileDrawer.classList.add('active');
                mobileDrawerOverlay.classList.add('active');
            });

            const closeDrawer = () => {
                mobileDrawer.classList.remove('active');
                mobileDrawerOverlay.classList.remove('active');
            };

            drawerClose.addEventListener('click', closeDrawer);
            mobileDrawerOverlay.addEventListener('click', closeDrawer);
        });
    </script>
</body>
</html>
