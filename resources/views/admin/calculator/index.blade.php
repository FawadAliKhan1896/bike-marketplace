@extends('layouts.admin')

@section('title', 'Manage Calculator Rules')

@section('content')
    <div style="margin-bottom: 32px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Price Calculator Rules</h1>
            <p style="color: var(--gray-500); margin-top: 4px;">Configure base prices and annual depreciation rates for the public Price Calculator.</p>
        </div>
        <a href="{{ route('admin.calculator.create') }}" class="admin-btn btn-admin-primary">
            <i class="fas fa-plus"></i> Add Calculator Model
        </a>
    </div>

    <!-- Filters Panel -->
    <div class="admin-panel" style="margin-bottom: 24px;">
        <div class="panel-body" style="padding: 20px 32px;">
            <form method="GET" action="{{ route('admin.calculator.index') }}" style="display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end;">
                
                <div style="flex: 1; min-width: 250px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--gray-500); text-transform: uppercase; margin-bottom: 6px; display: block;">Search Model</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Brand or model name..." class="admin-form-control" style="padding: 10px 14px;">
                </div>

                <div style="display: flex; gap: 12px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Filter</button>
                    <a href="{{ route('admin.calculator.index') }}" class="admin-btn btn-admin-gray">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Models Table -->
    <div class="admin-panel">
        <div class="panel-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Model Name</th>
                            <th>Reference Base Price (New)</th>
                            <th>Annual Depreciation Rate (%)</th>
                            <th>Estimated Value at 3 Years Old (Good Condition)</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($models as $model)
                            <tr>
                                <td style="font-weight: 700; color: var(--gray-900); font-size: 15px;">{{ $model->brand }}</td>
                                <td style="font-weight: 600;">{{ $model->model }}</td>
                                <td style="font-weight: 700; color: var(--primary);">PKR {{ number_format($model->base_price) }}</td>
                                <td>
                                    <div style="font-weight: 600;">{{ $model->depreciation_rate * 100 }}%</div>
                                    <div style="font-size: 11px; color: var(--gray-400);">Compounded annually</div>
                                </td>
                                <td>
                                    <!-- Dynamic Estimate formula: Base * (1-dep)^3 * 0.90 (Good) * 0.95 (10k-15k mileage) -->
                                    @php
                                        $dep = floatval($model->depreciation_rate);
                                        $ageFactor = pow(1 - $dep, 3);
                                        $est = $model->base_price * $ageFactor * 0.90 * 0.95;
                                        $est = max(20000, $est);
                                    @endphp
                                    <span style="font-weight: 600; color: #16a34a;">PKR {{ number_format($est) }}</span>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 8px;">
                                        <!-- Edit button -->
                                        <a href="{{ route('admin.calculator.edit', $model) }}" class="admin-btn btn-admin-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                        <!-- Delete button -->
                                        <form method="POST" action="{{ route('admin.calculator.destroy', $model) }}" onsubmit="return confirm('Are you sure you want to delete this calculator model rule?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn btn-admin-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 48px; color: var(--gray-400);">
                                    <i class="fas fa-calculator" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                                    No custom model price rules configured yet. Click 'Add Calculator Model'.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if($models->hasPages())
                <div style="padding: 24px; border-top: 1px solid var(--gray-100); display: flex; justify-content: center;">
                    {{ $models->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
