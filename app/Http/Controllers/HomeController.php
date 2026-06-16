<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Reused in AdController, but let's keep index fallback clean
        $ads = Ad::where('is_active', 1)->latest()->take(6)->get();
        return view('website.index', compact('ads'));
    }

    public function ads(Request $request)
    {
        $query = Ad::where('is_active', 1);

        // Text Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Brand Filter
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Condition Filter
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Location Filter
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        // Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', floatval($request->min_price));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', floatval($request->max_price));
        }

        // Year Filter
        if ($request->filled('min_year')) {
            $query->where('year', '>=', intval($request->min_year));
        }
        if ($request->filled('max_year')) {
            $query->where('year', '<=', intval($request->max_year));
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'year_desc' => $query->orderBy('year', 'desc'),
            default => $query->latest(),
        };

        $ads = $query->paginate(12)->withQueryString();

        // Get unique options to populate filter dropdowns
        $brands = Ad::where('is_active', 1)->select('brand')->distinct()->pluck('brand');
        $locations = Ad::where('is_active', 1)->select('location')->distinct()->pluck('location');

        return view('website.ads', compact('ads', 'brands', 'locations'));
    }
}
