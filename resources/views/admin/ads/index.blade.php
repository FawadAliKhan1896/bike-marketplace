@extends('layouts.admin')

@section('title', 'Manage Ads')

@section('content')
    <div style="margin-bottom: 32px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Manage Bike Ads</h1>
            <p style="color: var(--gray-500); margin-top: 4px;">Approve, update, or remove bike advertisements across the website.</p>
        </div>
    </div>

    <!-- Filters Panel -->
    <div class="admin-panel" style="margin-bottom: 24px;">
        <div class="panel-body" style="padding: 20px 32px;">
            <form method="GET" action="{{ route('admin.ads.index') }}" style="display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end;">
                
                <div style="flex: 1; min-width: 200px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--gray-500); text-transform: uppercase; margin-bottom: 6px; display: block;">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Title, brand, model..." class="admin-form-control" style="padding: 10px 14px;">
                </div>

                <div style="width: 180px; min-width: 150px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--gray-500); text-transform: uppercase; margin-bottom: 6px; display: block;">Status</label>
                    <select name="status" class="admin-form-control" style="padding: 10px 14px;">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active Only</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending Approval</option>
                    </select>
                </div>

                <div style="display: flex; gap: 12px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Filter</button>
                    <a href="{{ route('admin.ads.index') }}" class="admin-btn btn-admin-gray">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Ads Table -->
    <div class="admin-panel">
        <div class="panel-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Listing Details</th>
                            <th>Seller</th>
                            <th>Specifications</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ads as $ad)
                            <tr>
                                <td style="width: 80px;">
                                    @if($ad->image)
                                        <img src="{{ asset('storage/' . $ad->image) }}" style="width: 60px; height: 45px; object-fit: cover; border-radius: var(--radius-sm);" alt="Bike">
                                    @else
                                        <div style="width: 60px; height: 45px; background: var(--gray-100); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-sm); color: var(--gray-400); font-size: 9px; font-weight: 700;">NO IMG</div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 700; font-size: 15px; color: var(--gray-900);">{{ $ad->title }}</div>
                                    <div style="font-size: 12px; color: var(--gray-400); margin-top: 2px;"><i class="fas fa-map-marker-alt"></i> {{ $ad->location }}</div>
                                </td>
                                <td>
                                    <div style="font-weight: 600;">{{ $ad->user->name }}</div>
                                    <div style="font-size: 12px; color: var(--gray-500);">{{ $ad->user->email }}</div>
                                </td>
                                <td>
                                    <div style="font-weight: 600; font-size: 13px;">{{ $ad->brand }} {{ $ad->model }}</div>
                                    <div style="font-size: 12px; color: var(--gray-500); margin-top: 2px;">Year: {{ $ad->year }} | {{ $ad->condition }}</div>
                                </td>
                                <td style="font-weight: 700; color: var(--primary); font-size: 15px;">PKR {{ number_format($ad->price) }}</td>
                                <td>
                                    @if($ad->is_active)
                                        <span class="admin-badge badge-active">Active</span>
                                    @else
                                        <span class="admin-badge badge-pending">Pending</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 8px;">
                                        <!-- Approval/Toggle Status Button -->
                                        <form method="POST" action="{{ route('admin.ads.toggle-status', $ad) }}" style="margin: 0;">
                                            @csrf
                                            @if($ad->is_active)
                                                <button type="submit" class="admin-btn btn-admin-gray btn-sm" title="Reject/Set Pending">Deactivate</button>
                                            @else
                                                <button type="submit" class="admin-btn btn-admin-success btn-sm" title="Approve/Set Active">Approve</button>
                                            @endif
                                        </form>

                                        <!-- Edit button -->
                                        <a href="{{ route('admin.ads.edit', $ad) }}" class="admin-btn btn-admin-primary btn-sm"><i class="fas fa-edit"></i></a>

                                        <!-- Delete button -->
                                        <form method="POST" action="{{ route('admin.ads.destroy', $ad) }}" onsubmit="return confirm('Are you sure you want to delete this ad?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn btn-admin-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 48px; color: var(--gray-400);">
                                    <i class="fas fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                                    No listings found matching your search.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if($ads->hasPages())
                <div style="padding: 24px; border-top: 1px solid var(--gray-100); display: flex; justify-content: center;">
                    {{ $ads->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
