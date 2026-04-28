<x-guest-layout>
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 24px; font-weight: 800; color: var(--gray-900); text-align: center;">Join BikeMarket</h2>
        <p style="color: var(--gray-500); text-align: center; font-size: 14px;">Start selling and buying bikes today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; font-size: 14px; font-weight: 700; color: var(--gray-700); margin-bottom: 8px;">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                style="width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid var(--gray-300); font-size: 15px; outline: none; transition: var(--transition-base);">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; font-size: 14px; font-weight: 700; color: var(--gray-700); margin-bottom: 8px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                style="width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid var(--gray-300); font-size: 15px; outline: none; transition: var(--transition-base);">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; font-size: 14px; font-weight: 700; color: var(--gray-700); margin-bottom: 8px;">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                style="width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid var(--gray-300); font-size: 15px; outline: none; transition: var(--transition-base);">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom: 24px;">
            <label for="password_confirmation" style="display: block; font-size: 14px; font-weight: 700; color: var(--gray-700); margin-bottom: 8px;">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                style="width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid var(--gray-300); font-size: 15px; outline: none; transition: var(--transition-base);">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-size: 16px; margin-bottom: 20px;">
            Register Account
        </button>

        <div style="text-align: center; font-size: 14px; color: var(--gray-600);">
            Already have an account? 
            <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700;">Sign In</a>
        </div>
    </form>
</x-guest-layout>
