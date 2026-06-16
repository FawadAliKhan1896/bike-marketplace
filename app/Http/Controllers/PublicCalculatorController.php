<?php

namespace App\Http\Controllers;

use App\Models\CalculatorModel;
use App\Models\CalculatorValuation;
use Illuminate\Http\Request;

class PublicCalculatorController extends Controller
{
    public function index()
    {
        // Get all unique brands and their models to populate interactive dropdowns
        $models = CalculatorModel::orderBy('brand')->orderBy('model')->get();
        
        // Group by brand for easy JS access
        $groupedModels = $models->groupBy('brand');

        return view('website.calculator', compact('groupedModels'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1980|max:2026',
            'condition' => 'required|string|in:Excellent,Good,Fair,Poor',
            'mileage' => 'required|integer|min:0',
        ]);

        $brand = $request->brand;
        $modelName = $request->model;
        $year = intval($request->year);
        $condition = $request->condition;
        $mileage = intval($request->mileage);

        // Find configured pricing rules
        $calculatorModel = CalculatorModel::where('brand', $brand)
            ->where('model', $modelName)
            ->first();

        if ($calculatorModel) {
            $basePrice = floatval($calculatorModel->base_price);
            $depreciationRate = floatval($calculatorModel->depreciation_rate);
        } else {
            // Dynamic Fallback base prices if model not in admin settings
            $cleanBrand = strtolower($brand);
            if (str_contains($cleanBrand, 'honda')) {
                $basePrice = 180000;
            } elseif (str_contains($cleanBrand, 'yamaha')) {
                $basePrice = 320000;
            } elseif (str_contains($cleanBrand, 'suzuki')) {
                $basePrice = 280000;
            } else {
                $basePrice = 150000; // default standard bike
            }
            $depreciationRate = 0.10; // 10% default depreciation
        }

        // Calculate Age Depreciation (compounded annually)
        $currentYear = 2026;
        $age = max(0, $currentYear - $year);
        $ageFactor = pow(1 - $depreciationRate, $age);
        
        // Cap depreciation at 75% max (25% residual value)
        $ageFactor = max(0.25, $ageFactor);

        // Calculate Condition Factor
        $conditionFactor = match ($condition) {
            'Excellent' => 1.0,
            'Good' => 0.90,
            'Fair' => 0.75,
            'Poor' => 0.55,
            default => 0.80,
        };

        // Calculate Mileage Factor
        if ($mileage < 5000) {
            $mileageFactor = 1.0;
        } elseif ($mileage < 15000) {
            $mileageFactor = 0.95;
        } elseif ($mileage < 30000) {
            $mileageFactor = 0.88;
        } elseif ($mileage < 50000) {
            $mileageFactor = 0.78;
        } else {
            $mileageFactor = 0.65;
        }

        // Final Valuation
        $estimatedPrice = $basePrice * $ageFactor * $conditionFactor * $mileageFactor;
        
        // Floor price limit (no bike should evaluate below scrap value)
        $estimatedPrice = max(20000, $estimatedPrice);

        // Save valuation query to database
        CalculatorValuation::create([
            'brand' => $brand,
            'model' => $modelName,
            'year' => $year,
            'condition' => $condition,
            'mileage' => $mileage,
            'estimated_price' => $estimatedPrice,
        ]);

        return response()->json([
            'success' => true,
            'brand' => $brand,
            'model' => $modelName,
            'year' => $year,
            'condition' => $condition,
            'mileage' => number_format($mileage) . ' km',
            'base_price' => number_format($basePrice),
            'estimated_price' => number_format($estimatedPrice),
            'estimated_price_raw' => $estimatedPrice,
            'age' => $age,
            'depreciation_info' => ($depreciationRate * 100) . '% annual rate',
        ]);
    }
}
