@extends('layouts.admin')

@section('title', 'Valuation Inquiries')

@section('content')
    <div style="margin-bottom: 32px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Customer Valuation Logs</h1>
        <p style="color: var(--gray-500); margin-top: 4px;">Monitor recent price estimations requested by customers visiting the website.</p>
    </div>

    <!-- Filters Panel -->
    <div class="admin-panel" style="margin-bottom: 24px;">
        <div class="panel-body" style="padding: 20px 32px;">
            <form method="GET" action="{{ route('admin.calculator.valuations') }}" style="display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end;">
                
                <div style="flex: 1; min-width: 250px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--gray-500); text-transform: uppercase; margin-bottom: 6px; display: block;">Search Valuation Logs</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Brand, model, or condition..." class="admin-form-control" style="padding: 10px 14px;">
                </div>

                <div style="display: flex; gap: 12px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Filter</button>
                    <a href="{{ route('admin.calculator.valuations') }}" class="admin-btn btn-admin-gray">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Valuations Table -->
    <div class="admin-panel">
        <div class="panel-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Brand / Model</th>
                            <th>Year</th>
                            <th>Condition</th>
                            <th>Mileage</th>
                            <th>Valuation Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($valuations as $valuation)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $valuation->created_at->format('M d, Y') }}</div>
                                    <div style="font-size: 11px; color: var(--gray-400);">{{ $valuation->created_at->format('h:i A') }}</div>
                                </td>
                                <td style="font-weight: 700; color: var(--gray-900); font-size: 15px;">
                                    {{ $valuation->brand }} {{ $valuation->model }}
                                </td>
                                <td style="font-weight: 600;">{{ $valuation->year }}</td>
                                <td>
                                    <span class="admin-badge" style="background: var(--gray-100); color: var(--gray-700);">
                                        {{ $valuation->condition }}
                                    </span>
                                </td>
                                <td>{{ number_format($valuation->mileage) }} km</td>
                                <td style="font-weight: 800; color: #16a34a; font-size: 15px;">
                                    PKR {{ number_format($valuation->estimated_price) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 48px; color: var(--gray-400);">
                                    <i class="fas fa-history" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                                    No customer valuation checks logged yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if($valuations->hasPages())
                <div style="padding: 24px; border-top: 1px solid var(--gray-100); display: flex; justify-content: center;">
                    {{ $valuations->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
