@extends('layouts.admin')

@section('title', 'Edit Ad')

@section('content')
    <div style="margin-bottom: 32px;">
        <a href="{{ route('admin.ads.index') }}" style="color: var(--primary); font-weight: 600; display: inline-flex; align-items: center; gap: 6px; font-size: 14px; margin-bottom: 12px;">
            <i class="fas fa-arrow-left"></i> Back to Ads List
        </a>
        <h1 style="font-size: 28px; font-weight: 800; color: var(--gray-900);">Edit Ad Details</h1>
        <p style="color: var(--gray-500); margin-top: 4px;">Update details for the bike listing post.</p>
    </div>

    <div class="admin-panel" style="max-width: 800px;">
        <div class="panel-body">
            <form method="POST" action="{{ route('admin.ads.update', $ad) }}">
                @csrf
                @method('PUT')

                <div class="admin-form-group">
                    <label for="title">Listing Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $ad->title) }}" class="admin-form-control" required>
                    @error('title')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="brand">Brand</label>
                        <input type="text" id="brand" name="brand" value="{{ old('brand', $ad->brand) }}" class="admin-form-control">
                        @error('brand')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="model">Model</label>
                        <input type="text" id="model" name="model" value="{{ old('model', $ad->model) }}" class="admin-form-control">
                        @error('model')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="year">Year</label>
                        <input type="number" id="year" name="year" value="{{ old('year', $ad->year) }}" class="admin-form-control">
                        @error('year')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="condition">Condition</label>
                        <select id="condition" name="condition" class="admin-form-control" required>
                            <option value="Used" {{ old('condition', $ad->condition) === 'Used' ? 'selected' : '' }}>Used</option>
                            <option value="New" {{ old('condition', $ad->condition) === 'New' ? 'selected' : '' }}>New</option>
                        </select>
                        @error('condition')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label for="price">Price (PKR)</label>
                        <input type="number" step="any" id="price" name="price" value="{{ old('price', $ad->price) }}" class="admin-form-control" required>
                        @error('price')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $ad->location) }}" class="admin-form-control" required>
                        @error('location')
                            <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5" class="admin-form-control" required>{{ old('description', $ad->description) }}</textarea>
                    @error('description')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label for="is_active">Status</label>
                    <select id="is_active" name="is_active" class="admin-form-control" required>
                        <option value="1" {{ old('is_active', $ad->is_active) ? 'selected' : '' }}>Active (Visible on public pages)</option>
                        <option value="0" {{ !old('is_active', $ad->is_active) ? 'selected' : '' }}>Pending/Inactive</option>
                    </select>
                    @error('is_active')
                        <span style="color: var(--accent); font-size: 12px; font-weight: 500; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; gap: 16px; margin-top: 32px;">
                    <button type="submit" class="admin-btn btn-admin-primary">Save Changes</button>
                    <a href="{{ route('admin.ads.index') }}" class="admin-btn btn-admin-gray">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
