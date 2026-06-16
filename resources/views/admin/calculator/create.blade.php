@extends('layouts.admin')

@section('title', 'Add Calculator Model')

@section('content')
    <div style="margin-bottom: 32px;">
        <a href="{{ route('admin.calculator.index') }}" style="color: var(--primary); font-weight: 600; display: inline-flex; align-items: center; gap: 6px; font-size: 14px; margin-bottom: 12px;">
            <i class="fas fa-arrow-left"></i> Back to Rules List
        </a>
        <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Add Pricing Model</h1>
        <p style="color: var(--gray-500); margin-top: 4px;">Set a new brand and model base price for estimation calculations.</p>
    </div>

    <div class="admin-panel" style="max-width: 600px;">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.calculator.store') }}">
                @csrf

                <div class="admin-form-group">
                    <label for="brand">Brand Name</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand') }}" class="admin-form-control" placeholder="e.g. Honda" required>
                    @error('brand')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="model">Model Name</label>
                    <input type="text" id="model" name="model" value="{{ old('model') }}" class="admin-form-control" placeholder="e.g. CG 125" required>
                    @error('model')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="base_price">Reference Base Price (New, PKR)</label>
                    <input type="number" step="any" id="base_price" name="base_price" value="{{ old('base_price') }}" class="admin-form-control" placeholder="e.g. 235000" required>
                    <span style="color: var(--gray-400); font-size: 12px; margin-top: 4px; display: block;">This is the cost of the model when brand new.</span>
                    @error('base_price')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="depreciation_rate">Annual Depreciation Rate (e.g. 0.10 for 10%)</label>
                    <input type="number" step="0.01" min="0" max="1" id="depreciation_rate" name="depreciation_rate" value="{{ old('depreciation_rate', 0.10) }}" class="admin-form-control" required>
                    <span style="color: var(--gray-400); font-size: 12px; margin-top: 4px; display: block;">The percentage value drops each year (e.g., 0.08 = 8%, 0.12 = 12%).</span>
                    @error('depreciation_rate')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; gap: 16px; margin-top: 32px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Add Pricing Model</button>
                    <a href="{{ route('admin.calculator.index') }}" class="admin-btn btn-admin-gray">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
