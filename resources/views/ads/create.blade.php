<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Post Your Bike Ad') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-slate-200">
                <div class="p-8">
                    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- General Info -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-bold text-slate-800 border-b border-slate-100 pb-4">General Information</h3>
                            
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Ad Title</label>
                                <input type="text" name="title" required placeholder="e.g. 2023 Yamaha R6 - Mint Condition" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                                <textarea name="description" rows="5" required placeholder="Describe your bike's features, history, and any modifications..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"></textarea>
                                @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Specifications -->
                        <div class="space-y-6 pt-6">
                            <h3 class="text-xl font-bold text-slate-800 border-b border-slate-100 pb-4">Specifications</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Price ($)</label>
                                    <input type="number" name="price" required placeholder="e.g. 8500" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                    @error('price') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Condition</label>
                                    <select name="condition" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Brand</label>
                                    <input type="text" name="brand" placeholder="e.g. Yamaha" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Model</label>
                                    <input type="text" name="model" placeholder="e.g. R6" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Year</label>
                                    <input type="number" name="year" placeholder="e.g. 2023" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Location</label>
                                    <input type="text" name="location" required placeholder="e.g. Los Angeles, CA" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                                </div>
                            </div>
                        </div>

                        <!-- Media -->
                        <div class="space-y-6 pt-6">
                            <h3 class="text-xl font-bold text-slate-800 border-b border-slate-100 pb-4">Photos</h3>
                            
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col items-center justify-center w-full h-64 border-2 border-slate-200 border-dashed rounded-3xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        <p class="mb-2 text-sm text-slate-500 font-bold uppercase tracking-wider">Click to upload photo</p>
                                        <p class="text-xs text-slate-400">PNG, JPG or GIF (MAX. 2MB)</p>
                                    </div>
                                    <input type="file" name="image" class="hidden" />
                                </label>
                            </div>
                            @error('image') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-10 flex gap-4">
                            <button type="submit" class="flex-1 bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl hover:bg-indigo-700 transition transform hover:-translate-y-1">
                                Post Ad for Review
                            </button>
                            <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
