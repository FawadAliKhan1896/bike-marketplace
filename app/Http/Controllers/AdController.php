<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ad;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * Display a listing of active ads on the home screen.
     */
    public function index()
    {
        $ads = Ad::where('is_active', 1)->latest()->get();
        return view('website.index', compact('ads'));
    }

    /**
     * Show the form for creating a new ad.
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created ad in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'brand' => 'nullable|string',
            'model' => 'nullable|string',
            'year' => 'nullable|integer',
            'condition' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ads', 'public');
        }

        Auth::user()->ads()->create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'condition' => $request->condition,
            'location' => $request->location,
            'image' => $imagePath,
            'is_active' => 0, // Default pending
        ]);

        return redirect()->route('dashboard')->with('success', 'Ad posted successfully! It will be visible once activated by admin.');
    }

    /**
     * Display the user's dashboard with their ads and stats.
     */
    public function dashboard()
    {
        $ads = Auth::user()->ads()->latest()->get();
        return view('dashboard', compact('ads'));
    }

    /**
     * Display the specified ad and increment views.
     */
    public function show(Ad $ad)
    {
        if ($ad->is_active || (Auth::check() && Auth::id() === $ad->user_id)) {
            $ad->increment('views');
            return view('ads.show', compact('ad'));
        }
        abort(404);
    }
}
