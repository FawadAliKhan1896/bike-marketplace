@extends('layouts.admin')

@section('title', 'Add Dealership')

@section('content')
    <div style="margin-bottom: 32px;">
        <a href="{{ route('admin.dealerships.index') }}" style="color: var(--primary); font-weight: 600; display: inline-flex; align-items: center; gap: 6px; font-size: 14px; margin-bottom: 12px;">
            <i class="fas fa-arrow-left"></i> Back to Dealerships List
        </a>
        <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Add New Dealership</h1>
        <p style="color: var(--gray-500); margin-top: 4px;">Register a new partner dealership to show in directory listing.</p>
    </div>

    <div class="admin-panel" style="max-width: 800px;">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.dealerships.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="admin-form-group">
                    <label for="name">Dealership Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="admin-form-control" placeholder="e.g. Honda Point Lahore" required>
                    @error('name')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="email">Contact Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="admin-form-control" placeholder="e.g. contact@dealership.com" required>
                        @error('email')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="admin-form-control" placeholder="e.g. 042-35800000" required>
                        @error('phone')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" class="admin-form-control" placeholder="e.g. Lahore" required>
                        @error('city')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="website_url">Website URL (Optional)</label>
                        <input type="url" id="website_url" name="website_url" value="{{ old('website_url') }}" class="admin-form-control" placeholder="e.g. https://www.dealership.com">
                        @error('website_url')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-group">
                    <label for="address">Full Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" class="admin-form-control" placeholder="e.g. 14-A, Maulana Shaukat Ali Road, Johar Town" required>
                    @error('address')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="logo">Dealership Logo Image</label>
                    <input type="file" id="logo" name="logo" class="admin-form-control" style="padding: 8px 12px;">
                    <span style="color: var(--gray-400); font-size: 12px; margin-top: 4px; display: block;">Upload a PNG or JPG logo. Max size: 2MB.</span>
                    @error('logo')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="description">Short Description / Brand Specialties</label>
                    <textarea id="description" name="description" rows="4" class="admin-form-control" placeholder="Describe the dealership, e.g. Authorized 3S Dealer for Honda bikes, offering spare parts and engine tuneup.">{{ old('description') }}</textarea>
                    @error('description')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label class="form-checkbox">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <span>Promote to Featured Dealership (Highlights at top of listing page)</span>
                    </label>
                    @error('is_featured')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; gap: 16px; margin-top: 32px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Create Dealership</button>
                    <a href="{{ route('admin.dealerships.index') }}" class="admin-btn btn-admin-gray">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
