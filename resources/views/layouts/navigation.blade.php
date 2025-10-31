<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\JobServiceProvider::class,
    App\Providers\ReactionServiceProvider::class,
]; ?>

<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="/" class="text-lg font-bold">
                    {{ config('app.name') }}
                </a>

                <!-- Navigation Links -->
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="ml-8">Admin Dashboard</a>
                    @elseif(auth()->user()->role === 'employer')
                        <a href="{{ route('employer.dashboard') }}" class="ml-8">Employer Dashboard</a>
                    @endif
                    <a href="{{ route('forum.threads.index') }}" class="ml-8">Forum</a>
                @endauth
            </div>

            <div class="flex items-center">
                @auth
                    <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="ml-4">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700">Login</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-500 hover:text-gray-700">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>