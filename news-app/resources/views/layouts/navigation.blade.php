<style>
    .nav-link {
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .nav-link:hover {
        background-color: #f8f8f8;
    }
</style>
<nav x-data="{ open: false }" class="bg-white shadow-md border-b border-gray-200">

    <!-- Main Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/news.png') }}" alt="Logo" class="h-12 w-auto" />
                </a>
                <div class="ml-4 text-2xl font-serif font-bold text-gray-800">
                    NewsLetter
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex space-x-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="text-lg font-serif text-gray-700 hover:text-red-600">
                    {{ __('Home') }}
                </x-nav-link>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex items-center space-x-4">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-red-600 transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="w-4 h-4 ml-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="p-2 text-gray-400 hover:text-red-600 focus:outline-none transition">
                    <svg class="w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-gray-100 shadow-inner">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('World') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Sports') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Lifestyle') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
