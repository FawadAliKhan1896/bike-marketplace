<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Valuation Price Calculator | BikeMarket</title>
    <meta name="description" content="Calculate the estimated market value of your used bike in Pakistan. Input brand, model year, condition, and mileage for instant results.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        .calculator-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-top: 40px;
            margin-bottom: 80px;
            align-items: start;
        }

        .calc-form-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            padding: 36px;
            box-shadow: var(--shadow-lg);
        }

        .calc-form-card h2 {
            font-size: 24px;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 8px;
        }

        .calc-form-card p {
            font-size: 14px;
            color: var(--gray-500);
            margin-bottom: 28px;
        }

        .calc-result-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            padding: 36px;
            box-shadow: var(--shadow-lg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 480px;
            transition: all var(--transition-base);
            position: relative;
            overflow: hidden;
        }

        .calc-result-card.success-state {
            border-color: #22c55e;
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.05);
        }

        .calc-result-card.success-state::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #22c55e, #4ade80);
        }

        .result-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            color: var(--gray-400);
        }

        .result-placeholder i {
            font-size: 64px;
            color: var(--primary-light);
            margin-bottom: 8px;
            animation: float 3s ease-in-out infinite;
        }

        .result-active-view {
            width: 100%;
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.4s ease-out;
        }

        .result-active-view.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .valuation-number {
            font-size: 40px;
            font-weight: 800;
            color: #16a34a;
            margin-top: 12px;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        .breakdown-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-100);
            font-size: 14px;
        }

        .breakdown-row:last-child {
            border-bottom: none;
        }

        .breakdown-label {
            color: var(--gray-500);
            font-weight: 500;
        }

        .breakdown-value {
            color: var(--gray-800);
            font-weight: 700;
        }

        /* Form styling extensions */
        .calculator-form-group {
            margin-bottom: 20px;
        }

        .calculator-form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--gray-700);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .calculator-form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 14px;
            color: var(--gray-800);
            outline: none;
            background: var(--white);
            transition: border-color var(--transition-fast);
            font-family: inherit;
        }

        .calculator-form-control:focus {
            border-color: var(--primary);
        }

        /* Loader */
        .calc-spinner {
            display: none;
            border: 4px solid var(--gray-100);
            border-top: 4px solid var(--primary);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @media (max-width: 991px) {
            .calculator-layout {
                grid-template-columns: 1fr;
                gap: 32px;
            }
            .calc-result-card {
                min-height: auto;
                padding: 32px 24px;
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
                        <a href="{{ route('dealerships') }}" class="nav-link">Dealerships</a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('calculator') }}" class="nav-link active">Price Calculator</a>
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
                <a href="{{ route('dealerships') }}" class="drawer-link"><i class="fas fa-tags"></i> Dealership Listings</a>
                <a href="{{ route('calculator') }}" class="drawer-link active"><i class="fas fa-calculator"></i> Price Calculator</a>
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

    <!-- Main Content Container -->
    <div class="container">
        
        <div class="calculator-layout">
            
            <!-- Valuation Input Form -->
            <div class="calc-form-card">
                <h2>Used Bike Valuation</h2>
                <p>Calculate your motorcycle's market value based on live dealer pricing rules.</p>
                
                <form id="calculatorForm">
                    <!-- Brand Select -->
                    <div class="calculator-form-group">
                        <label for="brandSelect">Brand</label>
                        <select id="brandSelect" name="brand" class="calculator-form-control" required>
                            <option value="">Select Brand</option>
                            @foreach($groupedModels as $brand => $items)
                                <option value="{{ $brand }}">{{ $brand }}</option>
                            @endforeach
                            <option value="other_custom">--- Other / Write Custom Brand ---</option>
                        </select>
                    </div>

                    <!-- Custom Brand Input (Initially Hidden) -->
                    <div class="calculator-form-group" id="customBrandGroup" style="display: none;">
                        <label for="customBrandInput">Write Brand Name</label>
                        <input type="text" id="customBrandInput" placeholder="e.g. Yamaha" class="calculator-form-control">
                    </div>

                    <!-- Model Select -->
                    <div class="calculator-form-group" id="modelSelectGroup">
                        <label for="modelSelect">Model</label>
                        <select id="modelSelect" name="model" class="calculator-form-control" required>
                            <option value="">Choose brand first</option>
                        </select>
                    </div>

                    <!-- Custom Model Input (Initially Hidden) -->
                    <div class="calculator-form-group" id="customModelGroup" style="display: none;">
                        <label for="customModelInput">Write Model Name</label>
                        <input type="text" id="customModelInput" placeholder="e.g. YBR 125G" class="calculator-form-control">
                    </div>

                    <!-- Year Select -->
                    <div class="calculator-form-group">
                        <label for="yearSelect">Model Year</label>
                        <select id="yearSelect" name="year" class="calculator-form-control" required>
                            <option value="">Select Year</option>
                            @for($y = 2026; $y >= 1995; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Condition Select -->
                    <div class="calculator-form-group">
                        <label for="conditionSelect">Condition</label>
                        <select id="conditionSelect" name="condition" class="calculator-form-control" required>
                            <option value="">Select Condition</option>
                            <option value="Excellent">Excellent (Showroom condition, minimal wear)</option>
                            <option value="Good" selected>Good (Minor scratches, runs perfectly)</option>
                            <option value="Fair">Fair (Noticeable rust/dents, engine needs tuning)</option>
                            <option value="Poor">Poor (Accident damage or engine repair needed)</option>
                        </select>
                    </div>

                    <!-- Mileage Input -->
                    <div class="calculator-form-group">
                        <label for="mileageInput">Mileage (Kilometers driven)</label>
                        <input type="number" id="mileageInput" name="mileage" value="12000" min="0" placeholder="e.g. 15000" class="calculator-form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; font-size: 15px; font-weight: 700; padding: 14px;">Estimate Valuation Price</button>
                </form>
            </div>

            <!-- Valuation Result Display Card -->
            <div class="calc-result-card" id="resultCard">
                
                <!-- Spinner Loader -->
                <div class="calc-spinner" id="calcSpinner"></div>

                <!-- Placeholder View -->
                <div class="result-placeholder" id="resultPlaceholder">
                    <i class="fas fa-calculator"></i>
                    <h3 style="font-size: 18px; font-weight: 800; color: var(--gray-800);">Valuation Results</h3>
                    <p style="color: var(--gray-500); font-size: 13px; max-width: 300px;">Complete the form on the left and click 'Estimate' to calculate the market valuation of your motorcycle.</p>
                </div>

                <!-- Active Valuation Result View -->
                <div class="result-active-view" id="resultActiveView">
                    <i class="fas fa-check-circle" style="color: #22c55e; font-size: 44px; margin-bottom: 16px;"></i>
                    <h3 style="font-size: 16px; font-weight: 700; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Estimated Fair Value</h3>
                    
                    <div class="valuation-number" id="valPrice">PKR 0</div>

                    <div style="background: var(--gray-50); border-radius: var(--radius-md); padding: 8px 16px; margin-bottom: 28px;">
                        <div class="breakdown-row">
                            <span class="breakdown-label">Bike Details</span>
                            <span class="breakdown-value" id="valBikeLabel">Honda CG 125</span>
                        </div>
                        <div class="breakdown-row">
                            <span class="breakdown-label">Model Year</span>
                            <span class="breakdown-value" id="valYear">2022</span>
                        </div>
                        <div class="breakdown-row">
                            <span class="breakdown-label">Condition Level</span>
                            <span class="breakdown-value" id="valCondition">Good</span>
                        </div>
                        <div class="breakdown-row">
                            <span class="breakdown-label">Odometer (Mileage)</span>
                            <span class="breakdown-value" id="valMileage">12,000 km</span>
                        </div>
                        <div class="breakdown-row">
                            <span class="breakdown-label">Base Price (New)</span>
                            <span class="breakdown-value" id="valBasePrice">PKR 235,000</span>
                        </div>
                    </div>

                    <!-- Shortcut post ad pre-filled button -->
                    <a href="#" id="postAdRedirectBtn" class="btn btn-accent-premium" style="width: 100%; justify-content: center; padding: 14px;">
                        <span>Sell This Bike on BikeMarket</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-bottom" style="border: none; padding-top: 0; text-align: center;">
                <p>&copy; 2026 BikeMarket (Pvt) Ltd. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Interactive script controller -->
    <script>
        // Store grouped models database
        const brandModels = @json($groupedModels);

        document.addEventListener('DOMContentLoaded', () => {
            const brandSelect = document.getElementById('brandSelect');
            const modelSelect = document.getElementById('modelSelect');
            const customBrandGroup = document.getElementById('customBrandGroup');
            const customModelGroup = document.getElementById('customModelGroup');
            const modelSelectGroup = document.getElementById('modelSelectGroup');
            
            const customBrandInput = document.getElementById('customBrandInput');
            const customModelInput = document.getElementById('customModelInput');

            // Handle Brand Select Dropdown toggle changes
            brandSelect.addEventListener('change', () => {
                const brand = brandSelect.value;
                
                if (brand === 'other_custom') {
                    // Show custom fields
                    customBrandGroup.style.display = 'block';
                    customModelGroup.style.display = 'block';
                    modelSelectGroup.style.display = 'none';
                    
                    customBrandInput.required = true;
                    customModelInput.required = true;
                    modelSelect.required = false;
                } else {
                    // Hide custom fields
                    customBrandGroup.style.display = 'none';
                    customModelGroup.style.display = 'none';
                    modelSelectGroup.style.display = 'block';
                    
                    customBrandInput.required = false;
                    customModelInput.required = false;
                    modelSelect.required = true;

                    // Clear options and populate
                    modelSelect.innerHTML = '<option value="">Select Model</option>';
                    if (brand && brandModels[brand]) {
                        brandModels[brand].forEach(item => {
                            const opt = document.createElement('option');
                            opt.value = item.model;
                            opt.textContent = item.model;
                            modelSelect.appendChild(opt);
                        });
                    }
                }
            });

            // Handle Form Submissions via AJAX
            const calcForm = document.getElementById('calculatorForm');
            const resultCard = document.getElementById('resultCard');
            const spinner = document.getElementById('calcSpinner');
            const placeholder = document.getElementById('resultPlaceholder');
            const activeView = document.getElementById('resultActiveView');

            calcForm.addEventListener('submit', (e) => {
                e.preventDefault();

                // Show spinner loaders
                placeholder.style.display = 'none';
                activeView.style.display = 'none';
                activeView.classList.remove('show');
                spinner.style.display = 'block';
                resultCard.classList.remove('success-state');

                // Get form inputs
                let brand = brandSelect.value;
                let model = modelSelect.value;
                if (brand === 'other_custom') {
                    brand = customBrandInput.value;
                    model = customModelInput.value;
                }

                const formData = {
                    brand: brand,
                    model: model,
                    year: document.getElementById('yearSelect').value,
                    condition: document.getElementById('conditionSelect').value,
                    mileage: document.getElementById('mileageInput').value,
                };

                // AJAX post request
                fetch("{{ route('calculator.calculate') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(res => res.json())
                .then(data => {
                    spinner.style.display = 'none';

                    if (data.success) {
                        // Populate results values
                        document.getElementById('valPrice').textContent = 'PKR ' + data.estimated_price;
                        document.getElementById('valBikeLabel').textContent = data.brand + ' ' + data.model;
                        document.getElementById('valYear').textContent = data.year;
                        document.getElementById('valCondition').textContent = data.condition;
                        document.getElementById('valMileage').textContent = data.mileage;
                        document.getElementById('valBasePrice').textContent = 'PKR ' + data.base_price;

                        // Setup dynamic Post Ad redirect link with query params
                        const redirectUrl = "{{ route('ads.create') }}?" + 
                            "title=" + encodeURIComponent("Used " + data.brand + " " + data.model + " " + data.year + " for sale") +
                            "&brand=" + encodeURIComponent(data.brand) +
                            "&model=" + encodeURIComponent(data.model) +
                            "&year=" + encodeURIComponent(data.year) +
                            "&condition=" + encodeURIComponent(data.condition === 'Excellent' || data.condition === 'Good' ? 'Used' : 'Used') +
                            "&price=" + encodeURIComponent(data.estimated_price_raw);
                        
                        document.getElementById('postAdRedirectBtn').href = redirectUrl;

                        // Toggle success view transitions
                        activeView.style.display = 'block';
                        setTimeout(() => {
                            activeView.classList.add('show');
                        }, 50);

                        resultCard.classList.add('success-state');
                    } else {
                        // Reset
                        placeholder.style.display = 'flex';
                        alert('Something went wrong. Please check your form details.');
                    }
                })
                .catch(err => {
                    spinner.style.display = 'none';
                    placeholder.style.display = 'flex';
                    alert('Error executing calculator request.');
                });
            });

            // Sticky Header scroll script copy
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
