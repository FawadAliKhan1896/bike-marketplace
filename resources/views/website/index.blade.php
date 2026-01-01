<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BikeWale - New Bikes, Used Bikes, Bike Price, Reviews & News</title>
    <link rel="stylesheet" href="{{asset('assets/styles.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/fav.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <style>
        /* HERO BASE */
.hero {
    position: relative;
    min-height: 90vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    color: #fff;
}

/* Grain overlay (luxury feel) */
.hero-overlay {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.05'/%3E%3C/svg%3E");
    pointer-events: none;
}

/* CONTAINER */
.hero-container {
    position: relative;
    max-width: 1300px;
    margin: auto;
    padding: 0 40px;
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 40px;
    z-index: 2;
}

/* GLASS CARD */
.hero-card {
    backdrop-filter: blur(16px);
    background: linear-gradient(
        145deg,
        rgba(255,255,255,.12),
        rgba(255,255,255,.04)
    );
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 24px;
    padding: 48px;
    box-shadow: 0 40px 120px rgba(0,0,0,.6);
    animation: fadeUp 1s ease forwards;
}

/* BADGE */
.promo-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 12px;
    letter-spacing: .08em;
    text-transform: uppercase;
    background: rgba(255,255,255,.15);
    margin-bottom: 20px;
}

.promo-badge.alt {
    background: rgba(255, 200, 0, .15);
}

/* HEADINGS */
.hero h1 {
    font-size: clamp(36px, 4vw, 56px);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 24px;
}

.hero h1 span {
    background: linear-gradient(90deg, #fff, #d1d1d1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* PRICE */
.price {
    font-size: 40px;
    font-weight: 700;
}

.price.small {
    font-size: 32px;
}

.price-note {
    font-size: 14px;
    opacity: .75;
    margin-bottom: 24px;
}

/* CTA */
.cta-group {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

button {
    border: none;
    cursor: pointer;
    font-weight: 600;
    border-radius: 999px;
    padding: 14px 26px;
    transition: all .3s ease;
}

/* BUTTONS */
.btn-primary {
    background: #fff;
    color: #000;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(255,255,255,.25);
}

.btn-outline {
    background: transparent;
    border: 1px solid rgba(255,255,255,.4);
    color: #fff;
}

.btn-outline:hover {
    background: rgba(255,255,255,.15);
}

.btn-secondary {
    background: linear-gradient(135deg, #ffb703, #ff8c00);
    color: #000;
}

.btn-secondary:hover {
    transform: translateY(-2px);
}

/* BIKE IMAGE */
.hero-bike {
    position: absolute;
    right: -80px;
    bottom: -40px;
    max-width: 55%;
    z-index: 1;
    animation: float 6s ease-in-out infinite;
}

.hero-bike img {
    width: 100%;
    filter: drop-shadow(0 40px 80px rgba(0,0,0,.7));
}

/* ANIMATIONS */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-16px); }
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .hero-container {
        grid-template-columns: 1fr;
    }

    .hero-bike {
        position: relative;
        max-width: 100%;
        right: 0;
        bottom: 0;
        margin-top: 40px;
    }
}

    </style>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="{{asset('assets/images/logo.png')}}" alt="BikeWale">
                </div>
                
                <nav class="nav">
                    <a href="#" class="nav-link">NEW BIKES</a>
                    <a href="#" class="nav-link">USED BIKES</a>
                    <a href="#" class="nav-link">NEWS</a>
                    <a href="#" class="nav-link">REVIEWS</a>
                    <a href="#" class="nav-link">VIDEOS</a>
                    <a href="#" class="nav-link">MORE</a>
                </nav>

                <div class="header-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search bikes, brands...">
                    </div>
                    <div class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>karachi</span>
                    </div>
                    <button class="login-btn">Login</button>
                </div>
            </div>
        </div>
    </header>

   <!-- Hero Section -->
    <section class="hero"
        style="background:
            linear-gradient(120deg, rgba(0,0,0,.85), rgba(0,0,0,.55), rgba(0,0,0,.85)),
            url('{{ asset('assets/images/hero.jpg') }}') center/cover no-repeat;">

        <!-- subtle overlay noise -->
        <span class="hero-overlay"></span>

        <div class="hero-container">

            <!-- LEFT CONTENT -->
            <div class="hero-card hero-left">
                <span class="promo-badge">Beginner Friendly Trail Bike</span>

                <h1>
                    Find a Bike That <br>
                    <span>Fits Your Style</span>
                </h1>

                <div class="price">
                    ₹1,99,900 <small>*</small>
                </div>
                <p class="price-note">Ex-showroom price</p>

                <div class="cta-group">
                    <button class="btn-primary">View Offers</button>
                    <button class="btn-outline">Explore Models</button>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="hero-card hero-right">
                <span class="promo-badge alt">Get Out & Play</span>

                <div class="price small">
                    ₹1,25,000 <small>*</small>
                </div>
                <p class="price-note">Starting from</p>

                <button class="btn-secondary">Browse More</button>
            </div>

        </div>

        <!-- BIKE IMAGE -->
        <div class="hero-bike">
            <img src="/placeholder.svg?height=450&width=900" alt="Bike Showcase">
        </div>
    </section>


    <!-- Find Right Bike -->
    <section class="find-bike">
        <div class="container">
            <h2>FIND THE RIGHT BIKE</h2>
            <p>Get Comprehensive Information on Bikes</p>
            <div class="bike-finder">
                <select class="finder-select">
                    <option>Select Brand</option>
                    <option>Royal Enfield</option>
                    <option>Honda</option>
                    <option>TVS</option>
                    <option>Bajaj</option>
                </select>
                <select class="finder-select">
                    <option>Select Model</option>
                    <option>Classic 350</option>
                    <option>Hunter 350</option>
                    <option>Meteor 350</option>
                </select>
                <select class="finder-select">
                    <option>Select Version</option>
                    <option>Standard</option>
                    <option>Deluxe</option>
                    <option>Premium</option>
                </select>
                <button class="search-btn">Search</button>
            </div>
        </div>
    </section>

    <!-- Featured Bikes -->
    <section class="featured-bikes">
        <div class="container">
            <h2>Featured Bikes</h2>
            <div class="bike-tabs">
                <button class="tab-btn active" data-tab="upcoming">UPCOMING</button>
                <button class="tab-btn" data-tab="popular">POPULAR</button>
                <button class="tab-btn" data-tab="electric">ELECTRIC</button>
                <button class="tab-btn" data-tab="latest">LATEST</button>
            </div>
            
            <div class="bikes-grid">
                <div class="bike-card">
                    <img src="/placeholder.svg?height=200&width=300" alt="Continental GT 650">
                    <h3>Royal Enfield Continental GT 650</h3>
                    <div class="price">₹3,19,015</div>
                    <div class="location">Avg. Ex-Showroom price</div>
                    <button class="view-offers">View Offers</button>
                    <div class="rating">
                        <span class="stars">★★★★☆</span>
                        <span>Check on road price</span>
                    </div>
                </div>

                <div class="bike-card">
                    <img src="/placeholder.svg?height=200&width=300" alt="Hunter 350">
                    <h3>Royal Enfield Hunter 350</h3>
                    <div class="price">₹1,68,000</div>
                    <div class="location">Avg. Ex-Showroom price</div>
                    <button class="view-offers">View Offers</button>
                    <div class="rating">
                        <span class="stars">★★★★☆</span>
                        <span>Check on road price</span>
                    </div>
                </div>

                <div class="bike-card">
                    <img src="/placeholder.svg?height=200&width=300" alt="Classic 350">
                    <h3>Royal Enfield Classic 350</h3>
                    <div class="price">₹1,97,843</div>
                    <div class="location">Avg. Ex-Showroom price</div>
                    <button class="view-offers">View Offers</button>
                    <div class="rating">
                        <span class="stars">★★★★☆</span>
                        <span>Check on road price</span>
                    </div>
                </div>
            </div>
            
            <div class="view-all">
                <a href="#">All Trending Bikes ></a>
            </div>
        </div>
    </section>

    <!-- Popular Offers -->
    <section class="popular-offers">
        <div class="container">
            <h2>Get Offers on Popular Bikes</h2>
            <div class="offers-grid">
                <div class="offer-card">
                    <img src="/placeholder.svg?height=150&width=250" alt="TVS Raider 125">
                    <h3>TVS Raider 125</h3>
                    <div class="price">₹98,389</div>
                    <div class="location">Gurgaon</div>
                    <button class="get-offer">Get Best Offer</button>
                </div>

                <div class="offer-card">
                    <img src="/placeholder.svg?height=150&width=250" alt="Hero Xpulse">
                    <h3>Hero Xpulse</h3>
                    <div class="price">₹1,54,648</div>
                    <div class="location">Gurgaon</div>
                    <button class="get-offer">Get Best Offer</button>
                </div>

                <div class="offer-card">
                    <img src="/placeholder.svg?height=150&width=250" alt="TVS Jupiter">
                    <h3>TVS Jupiter</h3>
                    <div class="price">₹83,325</div>
                    <div class="location">Gurgaon</div>
                    <button class="get-offer">Get Best Offer</button>
                </div>

                <div class="offer-card">
                    <img src="/placeholder.svg?height=150&width=250" alt="TVS Ntorq 125">
                    <h3>TVS Ntorq 125</h3>
                    <div class="price">₹94,685</div>
                    <div class="location">Gurgaon</div>
                    <button class="get-offer">Get Best Offer</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Browse by Brands -->
    <section class="brands">
        <div class="container">
            <h2>Browse Bikes By</h2>
            <div class="brand-tabs">
                <button class="brand-tab active">BRANDS</button>
                <button class="brand-tab">BUDGET</button>
                <button class="brand-tab">DISPLACEMENT</button>
                <button class="brand-tab">BODY TYPE</button>
            </div>
            
            <div class="brands-grid">
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="Royal Enfield">
                    <span>Royal Enfield</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="Honda">
                    <span>Honda</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="TVS">
                    <span>TVS</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="Suzuki">
                    <span>Suzuki</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="Hero">
                    <span>Hero</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="Yamaha">
                    <span>Yamaha</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="KTM">
                    <span>KTM</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="Triumph">
                    <span>Triumph</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="Bajaj">
                    <span>Bajaj</span>
                </div>
                <div class="brand-card">
                    <img src="/placeholder.svg?height=60&width=100" alt="Husqvarna">
                    <span>Husqvarna</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Price Calculator -->
    <section class="price-calculator">
        <div class="container">
            <div class="calculator-content">
                <div class="calculator-left">
                    <h2>Check On-Road Price</h2>
                    <form class="price-form">
                        <select class="form-input">
                            <option>Select Brand</option>
                            <option>Royal Enfield</option>
                            <option>Honda</option>
                            <option>TVS</option>
                        </select>
                        <select class="form-input">
                            <option>Select Model</option>
                            <option>Classic 350</option>
                            <option>Hunter 350</option>
                        </select>
                        <select class="form-input">
                            <option>Select City</option>
                            <option>Karachi</option>
                            <option>Lahore</option>
                            <option>Mumbai</option>
                        </select>
                        <button type="submit" class="calculate-btn">Check On-Road Price</button>
                    </form>
                </div>
                <div class="calculator-right">
                    <img src="/placeholder.svg?height=300&width=400" alt="Couple on bike">
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Bikes -->
    <section class="trending-bikes">
        <div class="container">
            <h2>Trending Bikes of August 2025</h2>
            <div class="trending-tabs">
                <button class="trending-tab active">SCOOTERS</button>
                <button class="trending-tab">MOTORCYCLES</button>
                <button class="trending-tab">SPORTS</button>
                <button class="trending-tab">CRUISERS</button>
            </div>
            
            <div class="trending-grid">
                <div class="trending-card">
                    <img src="/placeholder.svg?height=180&width=280" alt="TVS Jupiter">
                    <h3>TVS Jupiter</h3>
                    <div class="price">₹83,325</div>
                    <div class="location">Gurgaon</div>
                    <button class="check-price">Check on road price</button>
                </div>

                <div class="trending-card">
                    <img src="/placeholder.svg?height=180&width=280" alt="Suzuki Access 125">
                    <h3>Suzuki Access 125</h3>
                    <div class="price">₹86,799</div>
                    <div class="location">Gurgaon</div>
                    <button class="check-price">Check on road price</button>
                </div>

                <div class="trending-card">
                    <img src="/placeholder.svg?height=180&width=280" alt="TVS Ntorq 125">
                    <h3>TVS Ntorq 125</h3>
                    <div class="price">₹94,685</div>
                    <div class="location">Gurgaon</div>
                    <button class="check-price">Check on road price</button>
                </div>
            </div>
            
            <div class="view-all">
                <a href="#">All Scooters ></a>
            </div>
        </div>
    </section>

    <!-- Compare Bikes -->
    <section class="compare-bikes">
        <div class="container">
            <h2>Compare Bikes</h2>
            <div class="compare-grid">
                <div class="compare-item">
                    <div class="compare-images">
                        <img src="/placeholder.svg?height=100&width=150" alt="Classic 350">
                        <span class="vs">VS</span>
                        <img src="/placeholder.svg?height=100&width=150" alt="CB350RS">
                    </div>
                    <div class="compare-details">
                        <h4>Classic 350 vs CB350RS</h4>
                        <div class="compare-prices">₹1,97,843 vs ₹2,07,500</div>
                    </div>
                </div>

                <div class="compare-item">
                    <div class="compare-images">
                        <img src="/placeholder.svg?height=100&width=150" alt="Hunter 350">
                        <span class="vs">VS</span>
                        <img src="/placeholder.svg?height=100&width=150" alt="CB350RS">
                    </div>
                    <div class="compare-details">
                        <h4>Hunter 350 vs CB350RS</h4>
                        <div class="compare-prices">₹1,68,000 vs ₹2,07,500</div>
                    </div>
                </div>

                <div class="compare-item">
                    <div class="compare-images">
                        <img src="/placeholder.svg?height=100&width=150" alt="Pulsar NS200">
                        <span class="vs">VS</span>
                        <img src="/placeholder.svg?height=100&width=150" alt="Apache RTR 200">
                    </div>
                    <div class="compare-details">
                        <h4>Pulsar NS200 vs Apache RTR 200</h4>
                        <div class="compare-prices">₹1,52,000 vs ₹1,45,000</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- User Reviews -->
    <section class="user-reviews">
        <div class="container">
            <h2>User Reviews</h2>
            <div class="reviews-grid">
                <div class="review-card">
                    <div class="review-header">
                        <img src="/placeholder.svg?height=50&width=50" alt="User">
                        <div class="review-info">
                            <h4>Arjun</h4>
                            <div class="rating">★★★★★</div>
                        </div>
                    </div>
                    <p>"The website has honest bike reviews. I have been using this website for 2+ years and found it very helpful."</p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <img src="/placeholder.svg?height=50&width=50" alt="User">
                        <div class="review-info">
                            <h4>Priya</h4>
                            <div class="rating">★★★★★</div>
                        </div>
                    </div>
                    <p>"I have purchased my bike through this website and the bike is very good looking and comfortable."</p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <img src="/placeholder.svg?height=50&width=50" alt="User">
                        <div class="review-info">
                            <h4>Rohit</h4>
                            <div class="rating">★★★★★</div>
                        </div>
                    </div>
                    <p>"It is very simple bike that helps in a great way to responsible and great speed."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Updates -->
    <section class="latest-updates">
        <div class="container">
            <h2>Latest Updates</h2>
            <div class="update-tabs">
                <button class="update-tab active">NEWS</button>
                <button class="update-tab">EXPERT REVIEWS</button>
                <button class="update-tab">VIDEOS</button>
            </div>
            
            <div class="updates-grid">
                <div class="update-card">
                    <img src="/placeholder.svg?height=200&width=300" alt="News">
                    <div class="update-content">
                        <h3>After Introducing Battery as a Service, Bajaj Chetak to Offer Fixed Battery Option</h3>
                        <p>Bajaj Finserv has announced that it will offer fixed battery option for the Chetak electric scooter...</p>
                        <div class="update-meta">
                            <span>Auto News</span>
                            <span>2 hours ago</span>
                        </div>
                    </div>
                </div>

                <div class="update-card">
                    <img src="/placeholder.svg?height=200&width=300" alt="News">
                    <div class="update-content">
                        <h3>2024 KTM 690 SMC R Breaks Cover! India Launch Expected</h3>
                        <p>KTM has unveiled the 2024 690 SMC R supermoto at the EICMA 2023 motorcycle show...</p>
                        <div class="update-meta">
                            <span>Auto News</span>
                            <span>4 hours ago</span>
                        </div>
                    </div>
                </div>

                <div class="update-card">
                    <img src="/placeholder.svg?height=200&width=300" alt="News">
                    <div class="update-content">
                        <h3>Royal Enfield Announces Himalayan Spiti Off-Road Experience in Ladakh</h3>
                        <p>Royal Enfield has announced an off-road riding experience with the Himalayan...</p>
                        <div class="update-meta">
                            <span>Auto News</span>
                            <span>6 hours ago</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="view-all">
                <a href="#">All News ></a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>BikeWale</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Connect</h4>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">YouTube</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Others</h4>
                    <ul>
                        <li><a href="#">Advertise</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 BikeWale. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>