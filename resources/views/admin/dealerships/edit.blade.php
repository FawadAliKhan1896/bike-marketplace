@extends('layouts.admin')

@section('title', 'Edit Dealership')

@section('content')
    <div style="margin-bottom: 32px;">
        <a href="{{ route('admin.dealerships.index') }}" style="color: var(--primary); font-weight: 600; display: inline-flex; align-items: center; gap: 6px; font-size: 14px; margin-bottom: 12px;">
            <i class="fas fa-arrow-left"></i> Back to Dealerships List
        </a>
        <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Edit Dealership Details</h1>
        <p style="color: var(--gray-500); margin-top: 4px;">Update details or settings for partner dealership.</p>
    </div>

    <div class="admin-panel" style="max-width: 800px;">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.dealerships.update', $dealership) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="admin-form-group">
                    <label for="name">Dealership Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $dealership->name) }}" class="admin-form-control" required>
                    @error('name')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="email">Contact Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $dealership->email) }}" class="admin-form-control" required>
                        @error('email')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $dealership->phone) }}" class="admin-form-control" required>
                        @error('phone')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $dealership->city) }}" class="admin-form-control" required>
                        @error('city')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="website_url">Website URL (Optional)</label>
                        <input type="url" id="website_url" name="website_url" value="{{ old('website_url', $dealership->website_url) }}" class="admin-form-control">
                        @error('website_url')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-group">
                    <label for="address">Full Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $dealership->address) }}" class="admin-form-control" required>
                    @error('address')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group" style="display: flex; gap: 24px; align-items: center; flex-wrap: wrap;">
                    @if($dealership->logo)
                        <div style="text-align: center;">
                            <label style="display: block; font-size: 12px; font-weight: 700; color: var(--gray-400); margin-bottom: 6px; text-transform: uppercase;">Current Logo</label>
                            <img src="{{ asset('storage/' . $dealership->logo) }}" style="width: 100px; height: 100px; object-fit: contain; border: 1px solid var(--gray-200); padding: 8px; border-radius: var(--radius-md); background: var(--white);" alt="Logo">
                        </div>
                    @endif
                    <div style="flex: 1; min-width: 200px;">
                        <label for="logo">Replace Logo Image</label>
                        <input type="file" id="logo" name="logo" class="admin-form-control" style="padding: 8px 12px;">
                        <span style="color: var(--gray-400); font-size: 12px; margin-top: 4px; display: block;">Leave blank if you don't want to change the logo. PNG/JPG, Max 2MB.</span>
                        @error('logo')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-group">
                    <label for="description">Short Description / Brand Specialties</label>
                    <textarea id="description" name="description" rows="4" class="admin-form-control">{{ old('description', $dealership->description) }}</textarea>
                    @error('description')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label class="form-checkbox">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $dealership->is_featured) ? 'checked' : '' }}>
                        <span>Promote to Featured Dealership (Highlights at top of listing page)</span>
                    </label>
                    @error('is_featured')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; gap: 16px; margin-top: 32px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Save Changes</button>
                    <a href="{{ route('admin.dealerships.index') }}" class="admin-btn btn-admin-gray">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
