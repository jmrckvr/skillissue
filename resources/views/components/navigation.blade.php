<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                                Dashboard
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'employer')
                            <x-nav-link :href="route('employer.dashboard')" :active="request()->routeIs('employer.*')">
                                Dashboard
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')">
                                Find Jobs
                            </x-nav-link>
                        @endif
                        
                        <x-nav-link :href="route('forum.threads.index')" :active="request()->routeIs('forum.*')">
                            Community
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
                <x-notification-bell />
                <x-dropdown>
                    <x-slot name="trigger">
                        {{ Auth::user()->name }}
                    </x-slot>

                    <x-dropdown-link :href="route('profile.edit')">
                        Profile
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-dropdown-link>
                    </form>
                </x-dropdown>
            @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Log in</a>
                    <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
