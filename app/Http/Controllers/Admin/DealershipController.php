<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DealershipController extends Controller
{
    public function index(Request $request)
    {
        $query = Dealership::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
        }

        $dealerships = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dealerships.index', compact('dealerships'));
    }

    public function create()
    {
        return view('admin.dealerships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('dealerships', 'public');
        }

        Dealership::create($data);

        return redirect()->route('admin.dealerships.index')->with('success', 'Dealership created successfully.');
    }

    public function edit(Dealership $dealership)
    {
        return view('admin.dealerships.edit', compact('dealership'));
    }

    public function update(Request $request, Dealership $dealership)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($dealership->logo) {
                Storage::disk('public')->delete($dealership->logo);
            }
            $data['logo'] = $request->file('logo')->store('dealerships', 'public');
        }

        $dealership->update($data);

        return redirect()->route('admin.dealerships.index')->with('success', 'Dealership updated successfully.');
    }

    public function destroy(Dealership $dealership)
    {
        if ($dealership->logo) {
            Storage::disk('public')->delete($dealership->logo);
        }
        
        $dealership->delete();

        return redirect()->route('admin.dealerships.index')->with('success', 'Dealership deleted successfully.');
    }
}
