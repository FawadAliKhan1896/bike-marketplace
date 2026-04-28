<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ad->title }} | BikeMarket</title>
    
    <!-- Enterprise Font Selection: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Iconography -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/styles.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/fav.png')}}" type="image/x-icon">

    <style>
        .ad-detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
            margin-top: 40px;
        }
        .ad-gallery {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--gray-200);
        }
        .ad-main-image {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
        }
        .ad-info-card {
            background: var(--white);
            padding: 32px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            margin-top: 24px;
        }
        .ad-sidebar-card {
            background: var(--white);
            padding: 24px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            position: sticky;
            top: 104px;
        }
        .price-tag {
            font-size: 32px;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 8px;
        }
        .spec-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-100);
        }
        .spec-label {
            color: var(--gray-500);
            font-size: 14px;
        }
        .spec-value {
            font-weight: 700;
            color: var(--gray-800);
        }
        @media (max-width: 992px) {
            .ad-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Main Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="/">
                        <img src="{{asset('assets/images/logo.png')}}" alt="BikeMarket Enterprise Logo">
                    </a>
                </div>
                
                <nav class="nav">
                    <a href="/" class="nav-link">Home</a>
                    <a href="#" class="nav-link">Used Bikes</a>
                    <a href="#" class="nav-link">New Bikes</a>
                </nav>

                <div class="header-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline" style="padding: 8px 16px;">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 8px 16px;">Sign In</a>
                    @endauth
                    <a href="{{ route('ads.create') }}" class="btn btn-accent">Post an Ad</a>
                </div>
            </div>
        </div>
    </header>

    <main class="container" style="padding-bottom: 80px;">
        <div class="ad-detail-grid">
            
            <!-- Left Side: Gallery & Description -->
            <div>
                <div class="ad-gallery">
                    @if($ad->image)
                        <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}" class="ad-main-image">
                    @else
                        <div style="aspect-ratio: 16/9; display: flex; align-items: center; justify-content: center; background: #f8fafc; color: #cbd5e1; font-style: italic;">
                            <i class="fas fa-image" style="font-size: 64px;"></i>
                        </div>
                    @endif
                </div>

                <div class="ad-info-card">
                    <h1 style="font-size: 28px; font-weight: 800; margin-bottom: 16px;">{{ $ad->title }}</h1>
                    <div style="display: flex; gap: 16px; color: var(--gray-500); font-size: 14px; margin-bottom: 32px;">
                        <span><i class="fas fa-map-marker-alt"></i> {{ $ad->location }}</span>
                        <span><i class="far fa-calendar"></i> Posted {{ $ad->created_at->diffForHumans() }}</span>
                        <span><i class="far fa-eye"></i> {{ $ad->views }} Views</span>
                    </div>

                    <h3 style="margin-bottom: 16px; border-bottom: 2px solid var(--primary); display: inline-block; padding-bottom: 4px;">Bike Overview</h3>
                    <div class="listing-specs" style="border: none; padding: 0; margin-bottom: 32px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                        <div style="background: var(--gray-50); padding: 16px; border-radius: var(--radius-md);">
                            <div style="font-size: 12px; text-transform: uppercase; opacity: 0.6;">Year</div>
                            <div style="font-weight: 700; font-size: 18px;">{{ $ad->year }}</div>
                        </div>
                        <div style="background: var(--gray-50); padding: 16px; border-radius: var(--radius-md);">
                            <div style="font-size: 12px; text-transform: uppercase; opacity: 0.6;">Brand</div>
                            <div style="font-weight: 700; font-size: 18px;">{{ $ad->brand }}</div>
                        </div>
                        <div style="background: var(--gray-50); padding: 16px; border-radius: var(--radius-md);">
                            <div style="font-size: 12px; text-transform: uppercase; opacity: 0.6;">Condition</div>
                            <div style="font-weight: 700; font-size: 18px;">{{ $ad->condition }}</div>
                        </div>
                    </div>

                    <h3 style="margin-bottom: 16px;">Description</h3>
                    <div style="line-height: 1.8; color: var(--gray-700); white-space: pre-wrap;">{{ $ad->description }}</div>
                </div>
            </div>

            <!-- Right Side: Pricing & Seller -->
            <div class="sidebar">
                <div class="ad-sidebar-card">
                    <div class="price-tag">PKR {{ number_format($ad->price) }}</div>
                    <p style="color: var(--gray-500); font-size: 14px; margin-bottom: 24px;">Inclusive of all taxes</p>
                    
                    <button class="btn btn-primary" style="width: 100%; padding: 16px; margin-bottom: 12px; font-size: 16px;">
                        <i class="fas fa-phone-alt" style="margin-right: 8px;"></i> Show Phone Number
                    </button>
                    <button class="btn btn-outline" style="width: 100%; padding: 16px; font-size: 16px;">
                        <i class="fas fa-comment-dots" style="margin-right: 8px;"></i> Send Message
                    </button>
                </div>

                <div class="ad-sidebar-card" style="margin-top: 24px;">
                    <h4 style="margin-bottom: 16px;">Seller Information</h4>
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                        <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800;">
                            {{ substr($ad->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div style="font-weight: 700;">{{ $ad->user->name }}</div>
                            <div style="font-size: 12px; color: var(--gray-500);">Member since {{ $ad->user->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                    <div style="background: var(--gray-50); padding: 12px; border-radius: var(--radius-sm); font-size: 13px; text-align: center; color: var(--gray-600);">
                        <i class="fas fa-shield-alt" style="color: var(--primary);"></i> Verified Seller
                    </div>
                </div>

                <div style="margin-top: 24px; text-align: center;">
                    <a href="#" style="color: var(--accent); font-size: 13px; font-weight: 700;"><i class="fas fa-flag"></i> Report this Ad</a>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2024 BikeMarket (Pvt) Ltd. All rights reserved.</p>
                <div style="display: flex; gap: 24px;">
                    <a href="/">Home</a>
                    <a href="#">Privacy</a>
                    <a href="#">Terms</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
