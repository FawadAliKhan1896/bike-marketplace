<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BikeMarket | Pakistan's Leading Enterprise Bike Marketplace</title>
    <meta name="description" content="Buy and sell certified used bikes, explore new bike prices, and read expert reviews. Pakistan's most trusted automotive marketplace.">
    
    <!-- Enterprise Font Selection: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Iconography -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/styles.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/fav.png')}}" type="image/x-icon">
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
                    <a href="#" class="nav-link">Used Bikes</a>
                    <a href="#" class="nav-link">New Bikes</a>
                    <a href="#" class="nav-link">Certification</a>
                    <a href="#" class="nav-link">Reviews</a>
                    <a href="#" class="nav-link">News</a>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Find the Perfect Bike for You</h1>
            <p>Search over 50,000+ verified listings across Pakistan</p>
            
            <div class="hero-search-card">
                <input type="text" placeholder="e.g. Honda CB 150R in Lahore">
                <button class="btn btn-primary">Search Now</button>
            </div>

            <div style="margin-top: 20px; display: flex; justify-content: center; gap: 12px; font-size: 13px;">
                <span style="opacity: 0.7;">Popular:</span>
                <a href="#" style="text-decoration: underline; opacity: 0.9;">Honda 125</a>
                <a href="#" style="text-decoration: underline; opacity: 0.9;">Suzuki GS 150</a>
                <a href="#" style="text-decoration: underline; opacity: 0.9;">Yamaha YBR</a>
                <a href="#" style="text-decoration: underline; opacity: 0.9;">Electric Bikes</a>
            </div>

            <div style="margin-top: 32px; display: flex; justify-content: center; gap: 24px; font-size: 14px; font-weight: 500;">
                <span><i class="fas fa-check-circle" style="color: #4ade80;"></i> Verified Sellers</span>
                <span><i class="fas fa-check-circle" style="color: #4ade80;"></i> Secure Payments</span>
                <span><i class="fas fa-check-circle" style="color: #4ade80;"></i> 24/7 Support</span>
            </div>
        </div>
    </section>

    <!-- Browse by Category -->
    <section class="categories">
        <div class="container">
            <div class="section-header">
                <div class="section-title">
                    <h2>Browse by Category</h2>
                    <p>Find the type of ride that fits your lifestyle</p>
                </div>
                <a href="#" class="view-all">View All Categories <i class="fas fa-chevron-right"></i></a>
            </div>
            <div class="category-grid">
                <a href="#" class="category-item">
                    <i class="fas fa-motorcycle"></i>
                    <span>Sports Bikes</span>
                </a>
                <a href="#" class="category-item">
                    <i class="fas fa-road"></i>
                    <span>Cruisers</span>
                </a>
                <a href="#" class="category-item">
                    <i class="fas fa-mountain"></i>
                    <span>Dirt Bikes</span>
                </a>
                <a href="#" class="category-item">
                    <i class="fas fa-motorcycle"></i>
                    <span>Scooters</span>
                </a>
                <a href="#" class="category-item">
                    <i class="fas fa-bolt"></i>
                    <span>Electric</span>
                </a>
                <a href="#" class="category-item">
                    <i class="fas fa-gear"></i>
                    <span>Accessories</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Listings -->
    <section class="featured" style="background: #fff;">
        <div class="container">
            <div class="section-header">
                <div class="section-title">
                    <h2>Latest Ads</h2>
                    <p>Discover recently posted bikes from verified sellers</p>
                </div>
                <a href="{{ route('ads') }}" class="view-all">See All Ads <i class="fas fa-chevron-right"></i></a>
            </div>

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
                    <div style="grid-column: span 4; text-align: center; padding: 60px; background: #f8fafc; border-radius: 12px; border: 1px dashed #e2e8f0;">
                        <i class="fas fa-motorcycle" style="font-size: 40px; color: #cbd5e1; margin-bottom: 16px;"></i>
                        <h4 style="color: #64748b;">No active ads found</h4>
                        <p style="color: #94a3b8; font-size: 14px; margin-top: 8px;">Be the first to post an ad!</p>
                        <a href="{{ route('ads.create') }}" class="btn btn-primary" style="margin-top: 20px; display: inline-block;">Post Your Ad Now</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Trust/Stats Section -->
    <section class="trust-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>500k+</h3>
                    <p>Verified Listings</p>
                </div>
                <div class="stat-item">
                    <h3>1M+</h3>
                    <p>Monthly Users</p>
                </div>
                <div class="stat-item">
                    <h3>10k+</h3>
                    <p>Certified Inspections</p>
                </div>
                <div class="stat-item">
                    <h3>50+</h3>
                    <p>Cities Covered</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trending & Popular -->
    <section class="trending">
        <div class="container">
            <div class="section-header">
                <div class="section-title">
                    <h2>Trending This Week</h2>
                    <p>Most searched and viewed bikes in your area</p>
                </div>
                <div class="bike-tabs">
                    <button class="tab-btn active">New Launches</button>
                    <button class="tab-btn">Popular Used</button>
                    <button class="tab-btn">Electric</button>
                </div>
            </div>

            <div class="listing-grid">
                <!-- Trending Card 1 -->
                <div class="listing-card">
                    <div class="listing-image">
                        <img src="https://images.unsplash.com/photo-1609630875171-b1321377ee65?auto=format&fit=crop&q=80&w=600" alt="KTM Duke">
                    </div>
                    <div class="listing-content">
                        <h3 class="listing-title">KTM Duke 390 ABS</h3>
                        <div class="listing-price">PKR 1,850,000</div>
                        <p style="font-size: 14px; color: var(--gray-500); margin-bottom: 12px;">The ultimate street fighter for urban commuters.</p>
                        <a href="#" class="btn btn-outline" style="width: 100%;">View Details</a>
                    </div>
                </div>
                <!-- Add more cards as needed -->
            </div>
        </div>
    </section>

    <!-- Testimonials / Trust -->
    <section class="testimonials" style="background: var(--white);">
        <div class="container">
            <div class="section-title" style="text-align: center; margin-bottom: 60px;">
                <h2>What Our Users Say</h2>
                <p>Join thousands of happy buyers and sellers</p>
            </div>
            <div class="listing-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                <div style="background: var(--gray-50); padding: 32px; border-radius: var(--radius-lg);">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                        <img src="https://i.pravatar.cc/150?u=1" style="width: 50px; height: 50px; border-radius: 50%;" alt="User">
                        <div>
                            <h4 style="font-weight: 700;">Ali Ahmed</h4>
                            <div style="color: #eab308; font-size: 12px;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                    </div>
                    <p style="font-style: italic; color: var(--gray-600);">"I sold my bike within 2 days of posting the ad. The verification process was smooth and trustworthy."</p>
                </div>
                <div style="background: var(--gray-50); padding: 32px; border-radius: var(--radius-lg);">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                        <img src="https://i.pravatar.cc/150?u=2" style="width: 50px; height: 50px; border-radius: 50%;" alt="User">
                        <div>
                            <h4 style="font-weight: 700;">Zainab Khan</h4>
                            <div style="color: #eab308; font-size: 12px;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                    </div>
                    <p style="font-style: italic; color: var(--gray-600);">"Found a great deal on a certified Yamaha. The inspection report provided by BikeMarket was very detailed."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Newsletter CTA -->
    <section class="container" style="padding-bottom: 80px;">
        <div class="newsletter">
            <h2>Join the BikeMarket Community</h2>
            <p>Get exclusive updates on price drops, new arrivals, and market trends.</p>
            <div class="newsletter-form">
                <input type="email" placeholder="your@email.com">
                <button class="btn btn-primary">Subscribe Now</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <img src="{{asset('assets/images/logo.png')}}" style="height: 40px; margin-bottom: 24px;" alt="Logo">
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
                        <li><a href="#">Used Bikes for Sale</a></li>
                        <li><a href="#">New Bike Prices</a></li>
                        <li><a href="#">Bikes by City</a></li>
                        <li><a href="#">Auction Portal</a></li>
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
                        <li><a href="#">Contact Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 BikeMarket (Pvt) Ltd. All rights reserved.</p>
                <div style="display: flex; gap: 24px;">
                    <a href="#">Sitemap</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>