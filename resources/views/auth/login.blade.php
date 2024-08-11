@extends('layouts.app')

@section('title', 'Login Now')

@section('content')
<div class=" flex items-center justify-center h-[90vh]">
    <div class="bg-gradient-to-bl from-gray-800 to-blue-700 border border-blue-400 p-8 rounded-lg shadow-md w-96">        <h2 class="text-2xl font-semibold mb-6 text-center text-white">Login</h2>
        @if ($errors->any())
            <div class="bg-red-100 border text-xs border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login.action') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-white text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 @error('email') border-red-500 @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-white text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 @error('password') border-red-500 @enderror" required autocomplete="current-password">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <input type="checkbox" id="remember" name="remember" class="mr-2" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="text-sm text-gray-300">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-300 hover:underline">Forgot password?</a>
                @endif
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                Login
            </button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-200">
            Don't have an account? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Sign up</a>
        </p>
    </div>
</div>
@endsection