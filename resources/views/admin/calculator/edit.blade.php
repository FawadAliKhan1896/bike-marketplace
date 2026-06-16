@extends('layouts.admin')

@section('title', 'Edit Calculator Model')

@section('content')
    <div style="margin-bottom: 32px;">
        <a href="{{ route('admin.calculator.index') }}" style="color: var(--primary); font-weight: 600; display: inline-flex; align-items: center; gap: 6px; font-size: 14px; margin-bottom: 12px;">
            <i class="fas fa-arrow-left"></i> Back to Rules List
        </a>
        <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Edit Pricing Model</h1>
        <p style="color: var(--gray-500); margin-top: 4px;">Update base price and depreciation parameters for pricing calculations.</p>
    </div>

    <div class="admin-panel" style="max-width: 600px;">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.calculator.update', $calculator) }}">
                @csrf
                @method('PUT')

                <div class="admin-form-group">
                    <label for="brand">Brand Name</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand', $calculator->brand) }}" class="admin-form-control" required>
                    @error('brand')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="model">Model Name</label>
                    <input type="text" id="model" name="model" value="{{ old('model', $calculator->model) }}" class="admin-form-control" required>
                    @error('model')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="base_price">Reference Base Price (New, PKR)</label>
                    <input type="number" step="any" id="base_price" name="base_price" value="{{ old('base_price', $calculator->base_price) }}" class="admin-form-control" required>
                    @error('base_price')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="depreciation_rate">Annual Depreciation Rate (e.g. 0.10 for 10%)</label>
                    <input type="number" step="0.01" min="0" max="1" id="depreciation_rate" name="depreciation_rate" value="{{ old('depreciation_rate', $calculator->depreciation_rate) }}" class="admin-form-control" required>
                    @error('depreciation_rate')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; gap: 16px; margin-top: 32px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Save Changes</button>
                    <a href="{{ route('admin.calculator.index') }}" class="admin-btn btn-admin-gray">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
