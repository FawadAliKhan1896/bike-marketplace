<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Used Bikes | BikeMarket</title>
    <meta name="description" content="Search verified used bikes for sale in Pakistan. Apply filters on price, brand, model year, and location.">
    
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
        .search-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 32px;
            margin-top: 40px;
            margin-bottom: 80px;
        }

        .filter-sidebar {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            padding: 24px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .filter-section {
            border-bottom: 1px solid var(--gray-150);
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .filter-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .filter-section h4 {
            font-size: 14px;
            font-weight: 700;
            color: var(--gray-800);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
        }

        .filter-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            font-size: 13px;
            color: var(--gray-700);
            outline: none;
            background: var(--white);
        }

        .filter-input:focus {
            border-color: var(--primary);
        }

        .filter-row {
            display: flex;
            gap: 8px;
        }

        .filter-row input {
            width: 50%;
        }

        .search-header-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            padding: 16px 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .search-title h2 {
            font-size: 20px;
            font-weight: 800;
            color: var(--gray-900);
        }

        .search-title p {
            font-size: 13px;
            color: var(--gray-500);
            margin-top: 2px;
        }

        .sort-select {
            padding: 8px 12px;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            font-size: 13px;
            color: var(--gray-700);
            outline: none;
            background: var(--white);
            cursor: pointer;
        }

        /* Pagination overrides for search page */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 48px;
        }

        @media (max-width: 991px) {
            .search-container {
                grid-template-columns: 1fr;
            }
            .filter-sidebar {
                position: relative;
                top: 0;
            }
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
                        <a href="#" class="nav-link active">Used Bikes <i class="fas fa-chevron-down nav-arrow"></i></a>
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
                        <a href="{{ route('dealerships') }}" class="nav-link">Dealerships</a>
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
                    
                    <!-- Mobile Hamburger Menu Button -->
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
                <a href="{{ route('ads') }}" class="drawer-link active"><i class="fas fa-search"></i> Search Used Bikes</a>
                <a href="{{ route('dealerships') }}" class="drawer-link"><i class="fas fa-tags"></i> Dealership Listings</a>
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

    <!-- Search Section -->
    <div class="container">
        
        <div class="search-container">
            
            <!-- Filters Sidebar -->
            <aside class="filter-sidebar">
                <form method="GET" action="{{ route('ads') }}" id="filterForm">
                    
                    <!-- Text Search -->
                    <div class="filter-section">
                        <h4>Search keyword</h4>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Title, model, brand..." class="filter-input">
                    </div>

                    <!-- Brand Filter -->
                    <div class="filter-section">
                        <h4>Brand</h4>
                        <select name="brand" class="filter-input" onchange="document.getElementById('filterForm').submit();">
                            <option value="">All Brands</option>
                            @foreach($brands as $brand)
                                @if($brand)
                                    <option value="{{ $brand }}" {{ request('brand') === $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Condition Filter -->
                    <div class="filter-section">
                        <h4>Condition</h4>
                        <select name="condition" class="filter-input" onchange="document.getElementById('filterForm').submit();">
                            <option value="">All Conditions</option>
                            <option value="New" {{ request('condition') === 'New' ? 'selected' : '' }}>New</option>
                            <option value="Used" {{ request('condition') === 'Used' ? 'selected' : '' }}>Used</option>
                        </select>
                    </div>

                    <!-- Price Filter -->
                    <div class="filter-section">
                        <h4>Price Range (PKR)</h4>
                        <div class="filter-row">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="filter-input">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="filter-input">
                        </div>
                    </div>

                    <!-- Year Range Filter -->
                    <div class="filter-section">
                        <h4>Model Year</h4>
                        <div class="filter-row">
                            <input type="number" name="min_year" value="{{ request('min_year') }}" placeholder="Min" class="filter-input">
                            <input type="number" name="max_year" value="{{ request('max_year') }}" placeholder="Max" class="filter-input">
                        </div>
                    </div>

                    <!-- City / Location Filter -->
                    <div class="filter-section">
                        <h4>Location</h4>
                        <select name="location" class="filter-input" onchange="document.getElementById('filterForm').submit();">
                            <option value="">All Locations</option>
                            @foreach($locations as $loc)
                                @if($loc)
                                    <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 16px;">
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; font-weight: 700; font-size: 13px;">Apply Filters</button>
                        <a href="{{ route('ads') }}" class="btn btn-outline" style="width: 100%; justify-content: center; font-weight: 700; font-size: 13px; border-width: 1px;">Reset Filters</a>
                    </div>

                </form>
            </aside>

            <!-- Results Column -->
            <main>
                <!-- Search Result Header Panel -->
                <div class="search-header-panel">
                    <div class="search-title">
                        <h2>Used Bikes For Sale</h2>
                        <p>Found <strong>{{ $ads->total() }}</strong> matching listings across Pakistan</p>
                    </div>
                    
                    <div>
                        <!-- Sort Selector -->
                        <form method="GET" action="{{ route('ads') }}" id="sortForm" style="display: flex; align-items: center; gap: 8px;">
                            <!-- Forward active filters hidden inputs to maintain them -->
                            @foreach(request()->except(['sort', 'page']) as $k => $v)
                                @if(is_array($v))
                                    @foreach($v as $arrVal)
                                        <input type="hidden" name="{{ $k }}[]" value="{{ $arrVal }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                @endif
                            @endforeach

                            <span style="font-size: 12px; font-weight: 700; color: var(--gray-500); text-transform: uppercase;">Sort By:</span>
                            <select name="sort" class="sort-select" onchange="document.getElementById('sortForm').submit();">
                                <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest Ads</option>
                                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="year_desc" {{ request('sort') === 'year_desc' ? 'selected' : '' }}>Year: Newer First</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Listings Grid -->
                <div class="listing-grid">
                    @forelse($ads as $ad)
                        <div class="listing-card" onclick="window.location='{{ route('ads.show', $ad) }}'" style="cursor: pointer;">
                            <div class="listing-image">
                                @if($ad->image)
                                    <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}">
                                @else
                                    <div style="height: 100%; display: flex; align-items: center; justify-content: center; background: #f8fafc; color: #cbd5e1; font-style: italic; font-size: 12px;">No Image</div>
                                @endif
                                <span class="listing-badge">{{ $ad->condition }}</span>
                            </div>
                            <div class="listing-content">
                                <h3 class="listing-title">{{ $ad->title }}</h3>
                                <div class="listing-price">PKR {{ number_format($ad->price) }}</div>
                                <div class="listing-specs">
                                    <span><i class="far fa-calendar"></i> {{ $ad->year }}</span>
                                    <span>|</span>
                                    <span><i class="fas fa-motorcycle"></i> {{ $ad->brand }}</span>
                                    <span>|</span>
                                    <span><i class="fas fa-gas-pump"></i> Petrol</span>
                                </div>
                                <div class="listing-footer">
                                    <div class="listing-location">
                                        <i class="fas fa-map-marker-alt"></i> {{ $ad->location }}
                                    </div>
                                    <div class="listing-rating">
                                        <i class="fas fa-star"></i> {{ number_format(4.5 + ($ad->id % 5) * 0.1, 1) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: span 3; text-align: center; padding: 80px 40px; background: var(--white); border-radius: var(--radius-lg); border: 1px dashed var(--gray-200);">
                            <i class="fas fa-motorcycle" style="font-size: 48px; color: var(--gray-300); margin-bottom: 20px;"></i>
                            <h3 style="font-size: 18px; font-weight: 700; color: var(--gray-800);">No Matches Found</h3>
                            <p style="color: var(--gray-500); font-size: 14px; margin-top: 8px; max-width: 400px; margin-left: auto; margin-right: auto;">We couldn't find any listings matching your search filters. Try widening your criteria or searching for something else.</p>
                            <a href="{{ route('ads') }}" class="btn btn-primary" style="margin-top: 24px;">Reset All Filters</a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Container -->
                @if($ads->hasPages())
                    <div class="pagination-container">
                        {{ $ads->links() }}
                    </div>
                @endif
            </main>

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
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
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
                        <li><a href="#">Safety Tips</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 BikeMarket (Pvt) Ltd. All rights reserved.</p>
                <div style="display: flex; gap: 24px;">
                    <a href="#">Sitemap</a>
                    <a href="#">Cookies</a>
                </div>
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

            // Scroll Event for sticky header styling
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            });

            // Open Mobile Drawer
            mobileMenuToggle.addEventListener('click', () => {
                mobileDrawer.classList.add('active');
                mobileDrawerOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            // Close Mobile Drawer
            const closeDrawer = () => {
                mobileDrawer.classList.remove('active');
                mobileDrawerOverlay.classList.remove('active');
                document.body.style.overflow = '';
            };

            drawerClose.addEventListener('click', closeDrawer);
            mobileDrawerOverlay.addEventListener('click', closeDrawer);
        });
    </script>
</body>
</html>