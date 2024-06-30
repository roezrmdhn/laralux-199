@extends('layouts.customer')
@section('content')
    <x-auth-card>
        <x-slot name="logo">
        </x-slot>
        <h2 class="text-2xl uppercase font-medium mb-1">Login</h2>
        <div class="contain">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="space-y-2">
                    <div>
                        <x-label class="text-gray-600 mb-2 block" for="email" :value="__('Email')" />
                        <x-input id="email"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="Email" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            type="password" placeholder="Password" name="password" required
                            autocomplete="current-password" />
                    </div>
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                        <x-button class="ml-3">
                            {{ __('Log in') }}
                        </x-button>
                    </div>

                </div>
            </form>
        </div>
    </x-auth-card>
@endsection
