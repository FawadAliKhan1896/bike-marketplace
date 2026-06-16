<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdminAdController extends Controller
{
    public function index(Request $request)
    {
        $query = Ad::with('user');

        if ($request->filled('status')) {
            $status = $request->status === 'active' ? 1 : 0;
            $query->where('is_active', $status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        $ads = $query->latest()->paginate(10)->withQueryString();

        return view('admin.ads.index', compact('ads'));
    }

    public function toggleStatus(Ad $ad)
    {
        $ad->is_active = !$ad->is_active;
        $ad->save();

        $statusMessage = $ad->is_active ? 'Ad has been approved and is now active.' : 'Ad status has been set to pending.';
        return back()->with('success', $statusMessage);
    }

    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(Request $request, Ad $ad)
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
            'is_active' => 'required|boolean',
        ]);

        $ad->update($request->all());

        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully.');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return back()->with('success', 'Ad deleted successfully.');
    }
}
