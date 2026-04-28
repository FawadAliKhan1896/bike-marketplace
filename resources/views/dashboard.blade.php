<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('My Dashboard') }}
            </h2>
            <a href="{{ route('ads.create') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Post New Ad
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Stats Overview -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-800 mb-6">Performance Overview</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-slate-50 p-4 rounded-2xl">
                                <div class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Ads</div>
                                <div class="text-3xl font-black text-slate-800">{{ $ads->count() }}</div>
                            </div>
                            <div class="bg-indigo-50 p-4 rounded-2xl">
                                <div class="text-indigo-600 text-xs font-bold uppercase tracking-wider mb-1">Total Views</div>
                                <div class="text-3xl font-black text-indigo-700">{{ $ads->sum('views') }}</div>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-2xl">
                                <div class="text-purple-600 text-xs font-bold uppercase tracking-wider mb-1">Active</div>
                                <div class="text-3xl font-black text-purple-700">{{ $ads->where('is_active', 1)->count() }}</div>
                            </div>
                            <div class="bg-amber-50 p-4 rounded-2xl">
                                <div class="text-amber-600 text-xs font-bold uppercase tracking-wider mb-1">Pending</div>
                                <div class="text-3xl font-black text-amber-700">{{ $ads->where('is_active', 0)->count() }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-indigo-600 p-8 rounded-3xl shadow-xl text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold mb-2">Sell Faster!</h3>
                            <p class="text-indigo-100 text-sm mb-6">Upgrade your ads to featured status to get 10x more visibility.</p>
                            <button class="bg-white text-indigo-600 px-6 py-2.5 rounded-xl font-bold hover:bg-indigo-50 transition">Learn More</button>
                        </div>
                        <div class="absolute -right-10 -bottom-10 opacity-20 transform rotate-12">
                            <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Ads Management -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-slate-800">Manage Your Ads</h3>
                        </div>
                        
                        <div class="divide-y divide-slate-100">
                            @forelse($ads as $ad)
                                <div class="p-6 flex flex-col md:flex-row gap-6 hover:bg-slate-50 transition">
                                    <div class="w-full md:w-32 h-24 bg-slate-100 rounded-2xl overflow-hidden flex-shrink-0">
                                        @if($ad->image)
                                            <img src="{{ asset('storage/' . $ad->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-400 italic text-xs">No Image</div>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h4 class="font-bold text-slate-800 text-lg">{{ $ad->title }}</h4>
                                                <p class="text-slate-500 text-sm">${{ number_format($ad->price) }} • {{ $ad->brand }} {{ $ad->model }}</p>
                                            </div>
                                            <div>
                                                @if($ad->is_active)
                                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">Active</span>
                                                @else
                                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Pending Approval</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-6 mt-4">
                                            <div class="flex items-center gap-2 text-slate-600 text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                <span class="font-bold">{{ $ad->views }}</span> views
                                            </div>
                                            <div class="flex items-center gap-2 text-slate-600 text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                                <span class="font-bold">{{ $ad->engagement }}</span> engagement
                                            </div>
                                            <div class="ml-auto flex gap-2">
                                                <a href="{{ route('ads.show', $ad) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </a>
                                                <button class="p-2 text-slate-400 hover:text-rose-600 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-20 text-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <h4 class="text-slate-800 font-bold">No ads posted yet</h4>
                                    <p class="text-slate-500 mt-1">Start selling your bike today!</p>
                                    <a href="{{ route('ads.create') }}" class="mt-6 inline-block bg-indigo-600 text-white px-6 py-2 rounded-xl font-bold">Create Your First Ad</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
