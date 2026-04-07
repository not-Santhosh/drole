
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-lg rounded-3xl border border-slate-200 bg-white dark:bg-slate-900 dark:border-slate-800 shadow-xl p-8">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-semibold text-slate-900 dark:text-slate-100">Sign in to your account</h1>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Use your email and password to login securely.</p>
            </div>

            @session('success')

            @endsession

            @session('error')

            @endsession

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <x-forms.label for="email" required>Email</x-forms.label>
                    <x-forms.input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        :required="true"
                        autofocus
                        class="mt-2"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-forms.label for="password" required>Password</x-forms.label>
                    <x-forms.input
                        id="password"
                        name="password"
                        type="password"
                        :required="true"
                        class="mt-2" 
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full">
                    <x-forms.button type="submit">
                        Sign In
                    </x-forms.button>
                </div>
            </form>
            <div class="text-center text-xs mt-3 text-slate-500">Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">Sign up</a></div>
        </div>
    </div>
@endsection