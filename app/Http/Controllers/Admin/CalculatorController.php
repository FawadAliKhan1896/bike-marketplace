<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalculatorModel;
use App\Models\CalculatorValuation;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index(Request $request)
    {
        $query = CalculatorModel::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
        }

        $models = $query->orderBy('brand')->orderBy('model')->paginate(10)->withQueryString();

        return view('admin.calculator.index', compact('models'));
    }

    public function create()
    {
        return view('admin.calculator.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'depreciation_rate' => 'required|numeric|min:0|max:1',
        ]);

        CalculatorModel::create($request->all());

        return redirect()->route('admin.calculator.index')->with('success', 'Calculator model config added successfully.');
    }

    public function edit(CalculatorModel $calculator)
    {
        return view('admin.calculator.edit', compact('calculator'));
    }

    public function update(Request $request, CalculatorModel $calculator)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'depreciation_rate' => 'required|numeric|min:0|max:1',
        ]);

        $calculator->update($request->all());

        return redirect()->route('admin.calculator.index')->with('success', 'Calculator model config updated successfully.');
    }

    public function destroy(CalculatorModel $calculator)
    {
        $calculator->delete();
        return redirect()->route('admin.calculator.index')->with('success', 'Calculator model config deleted successfully.');
    }

    public function valuations(Request $request)
    {
        $query = CalculatorValuation::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('condition', 'like', "%{$search}%");
        }

        $valuations = $query->latest()->paginate(15)->withQueryString();

        return view('admin.calculator.valuations', compact('valuations'));
    }
}
