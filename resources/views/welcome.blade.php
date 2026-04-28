<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BikeMarket - Premium Bike Marketplace</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        .bike-card:hover { transform: translateY(-5px); transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 glass border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">B</div>
                    <span class="text-2xl font-bold tracking-tight text-slate-800">Bike<span class="text-indigo-600">Market</span></span>
                </div>
                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="#" class="text-slate-600 hover:text-indigo-600 transition">Browse</a>
                    <a href="#" class="text-slate-600 hover:text-indigo-600 transition">Popular</a>
                    <a href="#" class="text-slate-600 hover:text-indigo-600 transition">Contact</a>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-600 font-medium hover:text-indigo-600">Dashboard</a>
                        <a href="{{ route('ads.create') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full font-semibold shadow-md hover:bg-indigo-700 transition">Post Ad</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 font-medium hover:text-indigo-600 ml-4">Login</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full font-semibold shadow-md hover:bg-indigo-700 transition">Post Ad</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-slate-900 py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 -left-1/4 w-1/2 h-full bg-indigo-500 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 -right-1/4 w-1/2 h-full bg-purple-500 rounded-full blur-[120px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">Find Your Next <span class="text-indigo-400">Dream Ride</span></h1>
            <p class="text-slate-300 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">The most trusted marketplace for buying and selling premium bikes. Verified listings, professional community, and seamless experience.</p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <div class="relative flex-1 max-w-xl">
                    <input type="text" placeholder="Search for bikes (e.g. Yamaha R1, Honda CBR)..." class="w-full px-6 py-4 rounded-full bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 backdrop-blur-sm">
                </div>
                <button class="bg-indigo-600 text-white px-8 py-4 rounded-full font-bold shadow-xl hover:bg-indigo-700 transition">Search Now</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-slate-800">Available Listings</h2>
                <p class="text-slate-500 mt-2">Discover verified bikes from trusted sellers</p>
            </div>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium hover:bg-slate-50">Filter</button>
                <select class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium hover:bg-slate-50">
                    <option>Latest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>
        </div>

        @if($ads->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($ads as $ad)
                    <div class="bike-card bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 group">
                        <div class="relative h-48 bg-slate-200 overflow-hidden">
                            @if($ad->image)
                                <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 italic">No Image</div>
                            @endif
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-indigo-600 shadow-sm">
                                {{ $ad->condition }}
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-slate-800 group-hover:text-indigo-600 transition line-clamp-1">{{ $ad->title }}</h3>
                            </div>
                            <div class="text-2xl font-bold text-indigo-600 mb-4">${{ number_format($ad->price) }}</div>
                            <div class="flex items-center gap-3 text-slate-500 text-sm mb-4">
                                <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg> {{ $ad->location }}</span>
                                <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> {{ $ad->year }}</span>
                            </div>
                            <a href="{{ route('ads.show', $ad) }}" class="block w-full py-3 bg-slate-50 text-center rounded-xl font-semibold text-slate-700 hover:bg-indigo-600 hover:text-white transition">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-700">No bikes found</h3>
                <p class="text-slate-500 mt-2">Be the first to post an ad on our marketplace!</p>
                <a href="{{ route('ads.create') }}" class="mt-6 inline-block bg-indigo-600 text-white px-6 py-3 rounded-full font-bold shadow-lg hover:bg-indigo-700 transition">Post Your Ad Now</a>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex justify-center items-center gap-2 mb-6">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">B</div>
                <span class="text-xl font-bold tracking-tight text-slate-800">BikeMarket</span>
            </div>
            <p class="text-slate-500 text-sm">&copy; 2026 BikeMarket Marketplace. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
