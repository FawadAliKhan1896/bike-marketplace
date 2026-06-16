<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Dealership;
use App\Models\CalculatorModel;
use App\Models\CalculatorValuation;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_ads' => Ad::count(),
            'active_ads' => Ad::where('is_active', 1)->count(),
            'pending_ads' => Ad::where('is_active', 0)->count(),
            
            'total_dealerships' => Dealership::count(),
            'featured_dealerships' => Dealership::where('is_featured', 1)->count(),
            
            'calculator_models' => CalculatorModel::count(),
            'total_valuations' => CalculatorValuation::count(),
        ];

        $recentAds = Ad::with('user')->latest()->limit(5)->get();
        $recentValuations = CalculatorValuation::latest()->limit(5)->get();
        $recentDealerships = Dealership::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentAds', 'recentValuations', 'recentDealerships'));
    }
}
