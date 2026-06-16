<?php

namespace App\Http\Controllers;

use App\Models\Dealership;
use Illuminate\Http\Request;

class PublicDealershipController extends Controller
{
    public function index(Request $request)
    {
        $query = Dealership::query();

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // City Filter
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Sorting: Featured first, then latest
        $dealerships = $query->orderByDesc('is_featured')
                             ->latest()
                             ->paginate(12)
                             ->withQueryString();

        // Get unique cities for filter dropdown
        $cities = Dealership::select('city')->distinct()->pluck('city');

        return view('website.dealerships', compact('dealerships', 'cities'));
    }
}
