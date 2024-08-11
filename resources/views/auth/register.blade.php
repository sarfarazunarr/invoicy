@extends('layouts.app')

@section('title', 'Register Now')

@section('content')
<div class=" flex items-center justify-center p-10 h-screen">
    <div class="bg-gradient-to-bl from-gray-800 to-blue-700 border border-blue-400 p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl text-white font-bold mb-6 text-center">Create an Account</h2>
        <form action="{{ route('register.save') }}" method="POST" class="user">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-white text-sm font-bold mb-2">Name</label>
                <input id="name" type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required autofocus>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-100 text-sm font-bold mb-2">Email Address</label>
                <input id="email" type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-100 text-sm font-bold mb-2">Password</label>
                <input id="password" type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-100 text-sm font-bold mb-2">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex flex-col items-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full mb-4">
                    Register
                </button>
                <a href="{{ route('login') }}" class="font-bold text-sm text-white hover:text-blue-800">
                    Already have an account?
                </a>
            </div>
        </form>
    </div>
</div>
@endsection