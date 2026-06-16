@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div style="margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Marketplace Statistics</h1>
        <p style="color: var(--gray-500); margin-top: 4px;">Monitor user activity, listings status, and pricing rules.</p>
    </div>

    <!-- Stats Card Grid -->
    <div class="admin-card-grid">
        <!-- Active Ads -->
        <div class="admin-stat-card">
            <div class="stat-card-left">
                <h4>Active Ads</h4>
                <div class="stat-value">{{ $stats['active_ads'] }}</div>
            </div>
            <div class="stat-card-icon icon-green">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <!-- Pending Ads -->
        <div class="admin-stat-card">
            <div class="stat-card-left">
                <h4>Pending Approval</h4>
                <div class="stat-value">{{ $stats['pending_ads'] }}</div>
            </div>
            <div class="stat-card-icon icon-yellow">
                <i class="fas fa-clock"></i>
            </div>
        </div>

        <!-- Dealerships -->
        <div class="admin-stat-card">
            <div class="stat-card-left">
                <h4>Dealerships</h4>
                <div class="stat-value">{{ $stats['total_dealerships'] }}</div>
            </div>
            <div class="stat-card-icon icon-blue">
                <i class="fas fa-store"></i>
            </div>
        </div>

        <!-- Valuations Ran -->
        <div class="admin-stat-card">
            <div class="stat-card-left">
                <h4>Valuations Ran</h4>
                <div class="stat-value">{{ $stats['total_valuations'] }}</div>
            </div>
            <div class="stat-card-icon icon-red">
                <i class="fas fa-calculator"></i>
            </div>
        </div>
    </div>

    <!-- Recent Activity Lists -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 32px;">
        
        <!-- Recent Ads -->
        <div class="admin-panel" style="margin-bottom: 0;">
            <div class="panel-header">
                <h3><i class="fas fa-motorcycle" style="color: var(--primary);"></i> Recent Bike Ads</h3>
                <a href="{{ route('admin.ads.index') }}" class="admin-btn btn-admin-gray btn-sm">Manage All</a>
            </div>
            <div class="panel-body" style="padding: 0;">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Bike</th>
                                <th>Seller</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAds as $ad)
                                <tr>
                                    <td>
                                        <div style="font-weight: 700;">{{ $ad->title }}</div>
                                        <div style="font-size: 11px; color: var(--gray-400);">{{ $ad->brand }} {{ $ad->model }} ({{ $ad->year }})</div>
                                    </td>
                                    <td>{{ $ad->user->name }}</td>
                                    <td style="font-weight: 600;">PKR {{ number_format($ad->price) }}</td>
                                    <td>
                                        @if($ad->is_active)
                                            <span class="admin-badge badge-active">Active</span>
                                        @else
                                            <span class="admin-badge badge-pending">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 32px; color: var(--gray-400);">
                                        No recent ads found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Valuations -->
        <div class="admin-panel" style="margin-bottom: 0;">
            <div class="panel-header">
                <h3><i class="fas fa-calculator" style="color: var(--accent);"></i> Recent Valuations</h3>
                <a href="{{ route('admin.calculator.valuations') }}" class="admin-btn btn-admin-gray btn-sm">View History</a>
            </div>
            <div class="panel-body" style="padding: 0;">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Bike Requested</th>
                                <th>Condition</th>
                                <th>Mileage</th>
                                <th>Valuation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentValuations as $val)
                                <tr>
                                    <td>
                                        <div style="font-weight: 700;">{{ $val->brand }} {{ $val->model }}</div>
                                        <div style="font-size: 11px; color: var(--gray-400);">Year: {{ $val->year }}</div>
                                    </td>
                                    <td>
                                        <span class="admin-badge" style="background: var(--gray-100); color: var(--gray-700);">
                                            {{ $val->condition }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($val->mileage) }} km</td>
                                    <td style="font-weight: 700; color: #16a34a;">PKR {{ number_format($val->estimated_price) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 32px; color: var(--gray-400);">
                                        No valuations run yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
