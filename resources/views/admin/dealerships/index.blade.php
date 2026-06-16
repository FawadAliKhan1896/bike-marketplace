@extends('layouts.admin')

@section('title', 'Manage Dealerships')

@section('content')
    <div style="margin-bottom: 32px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Manage Dealerships</h1>
            <p style="color: var(--gray-500); margin-top: 4px;">Configure and promote motorcycle dealerships listed on your website.</p>
        </div>
        <a href="{{ route('admin.dealerships.create') }}" class="admin-btn btn-admin-primary">
            <i class="fas fa-plus"></i> Add New Dealership
        </a>
    </div>

    <!-- Filters Panel -->
    <div class="admin-panel" style="margin-bottom: 24px;">
        <div class="panel-body" style="padding: 20px 32px;">
            <form method="GET" action="{{ route('admin.dealerships.index') }}" style="display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end;">
                
                <div style="flex: 1; min-width: 250px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--gray-500); text-transform: uppercase; margin-bottom: 6px; display: block;">Search Dealership</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, city, phone..." class="admin-form-control" style="padding: 10px 14px;">
                </div>

                <div style="display: flex; gap: 12px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Filter</button>
                    <a href="{{ route('admin.dealerships.index') }}" class="admin-btn btn-admin-gray">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Dealerships Table -->
    <div class="admin-panel">
        <div class="panel-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Dealership Name</th>
                            <th>Location / City</th>
                            <th>Contact Information</th>
                            <th>Website</th>
                            <th>Featured Status</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dealerships as $dealer)
                            <tr>
                                <td style="width: 80px;">
                                    @if($dealer->logo)
                                        <img src="{{ asset('storage/' . $dealer->logo) }}" style="width: 60px; height: 60px; object-fit: contain; border-radius: var(--radius-sm); border: 1px solid var(--gray-100);" alt="Logo">
                                    @else
                                        <div style="width: 60px; height: 60px; background: var(--gray-100); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-sm); color: var(--gray-400); font-size: 9px; font-weight: 700; text-align: center; line-height: 1.2;">NO LOGO</div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 700; font-size: 15px; color: var(--gray-900);">{{ $dealer->name }}</div>
                                    <div style="font-size: 12px; color: var(--gray-400); max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-top: 2px;">{{ $dealer->description }}</div>
                                </td>
                                <td>
                                    <div style="font-weight: 600;">{{ $dealer->city }}</div>
                                    <div style="font-size: 12px; color: var(--gray-500); margin-top: 2px;">{{ $dealer->address }}</div>
                                </td>
                                <td>
                                    <div style="font-weight: 500;"><i class="fas fa-phone-alt" style="font-size: 11px; color: var(--gray-400);"></i> {{ $dealer->phone }}</div>
                                    <div style="font-size: 12px; color: var(--gray-500); margin-top: 2px;"><i class="far fa-envelope" style="font-size: 11px; color: var(--gray-400);"></i> {{ $dealer->email }}</div>
                                </td>
                                <td>
                                    @if($dealer->website_url)
                                        <a href="{{ $dealer->website_url }}" target="_blank" style="color: var(--primary); font-weight: 600;"><i class="fas fa-external-link-alt"></i> Visit Site</a>
                                    @else
                                        <span style="color: var(--gray-400); font-style: italic;">None</span>
                                    @endif
                                </td>
                                <td>
                                    @if($dealer->is_featured)
                                        <span class="admin-badge badge-featured"><i class="fas fa-star" style="margin-right: 4px;"></i> Featured</span>
                                    @else
                                        <span class="admin-badge" style="background: var(--gray-100); color: var(--gray-500);">Standard</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 8px;">
                                        <!-- Edit button -->
                                        <a href="{{ route('admin.dealerships.edit', $dealer) }}" class="admin-btn btn-admin-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                        <!-- Delete button -->
                                        <form method="POST" action="{{ route('admin.dealerships.destroy', $dealer) }}" onsubmit="return confirm('Are you sure you want to delete this dealership?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-btn btn-admin-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 48px; color: var(--gray-400);">
                                    <i class="fas fa-store-slash" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                                    No dealerships found. Click 'Add New Dealership' to create one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if($dealerships->hasPages())
                <div style="padding: 24px; border-top: 1px solid var(--gray-100); display: flex; justify-content: center;">
                    {{ $dealerships->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
