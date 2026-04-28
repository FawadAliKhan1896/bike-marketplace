<x-guest-layout>
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 24px; font-weight: 800; color: var(--gray-900); text-align: center;">Welcome Back</h2>
        <p style="color: var(--gray-500); text-align: center; font-size: 14px;">Sign in to manage your bike ads</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div style="margin-bottom: 20px;">
            <label for="email" style="display: block; font-size: 14px; font-weight: 700; color: var(--gray-700); margin-bottom: 8px;">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                style="width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid var(--gray-300); font-size: 15px; outline: none; transition: var(--transition-base);">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; font-size: 14px; font-weight: 700; color: var(--gray-700); margin-bottom: 8px;">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                style="width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid var(--gray-300); font-size: 15px; outline: none; transition: var(--transition-base);">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <label for="remember_me" style="display: flex; align-items: center; cursor: pointer;">
                <input id="remember_me" type="checkbox" name="remember" style="width: 16px; height: 16px; border-radius: 4px; border: 1px solid var(--gray-300); color: var(--primary);">
                <span style="margin-left: 8px; font-size: 14px; color: var(--gray-600);">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size: 14px; color: var(--primary); font-weight: 600;">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-size: 16px; margin-bottom: 20px;">
            Log In
        </button>

        <div style="text-align: center; font-size: 14px; color: var(--gray-600);">
            Don't have an account? 
            <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 700;">Create Account</a>
        </div>
    </form>
</x-guest-layout>
