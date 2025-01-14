<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-28 fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if (Auth::user()->isAdmin() || Auth::user()->isManager())
                        <x-nav-dropdown-button data-dropdown-toggle="user_dropdownNavbar">
                            {{ __('Users') }}
                        </x-nav-dropdown-button>
                        <!-- Dropdown menu -->
                        <x-nav-dropdown-wrapper id="user_dropdownNavbar">
                            <x-nav-dropdown-item :href="route('admin.drivers.index')" :active="request()->routeIs('admin.drivers.index')">
                                {{ __('Drivers') }}
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('admin.transporters.index')" :active="request()->routeIs('admin.transporters.index')">
                                {{ __('Transporters') }}
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('admin.clients.index')" :active="request()->routeIs('admin.clients.index')">
                                {{ __('Clients') }}
                            </x-nav-dropdown-item>
                        </x-nav-dropdown-wrapper>

                        <x-nav-dropdown-button data-dropdown-toggle="logistics_dropdownNavbar">
                            {{ __('Logistics') }}
                        </x-nav-dropdown-button>
                        <!-- Dropdown menu -->
                        <x-nav-dropdown-wrapper id="logistics_dropdownNavbar">
                            <x-nav-dropdown-item :href="route('admin.vehicles.index')" :active="request()->routeIs('admin.vehicles.index')">
                                {{ __('Vehicles') }}
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('admin.locations.index')" :active="request()->routeIs('admin.locations.index')">
                                {{ __('Locations') }}
                            </x-nav-dropdown-item>
                            <x-nav-dropdown-item :href="route('admin.managers.index')" :active="request()->routeIs('admin.managers.index')">
                                {{ __('Managers') }}
                            </x-nav-dropdown-item>
                        </x-nav-dropdown-wrapper>
                        

                        <x-nav-link :href="route('admin.expenses.index')" :active="request()->routeIs('admin.expenses.index')">
                            {{ __('Expenses') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.imports.index')" :active="request()->routeIs('admin.imports.index')">
                            {{ __('Imports') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.log-sheets.index')" :active="request()->routeIs('admin.log-sheets.index')">
                            {{ __('Log Sheets') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.invoices.index')" :active="request()->routeIs('admin.invoices.index')">
                            {{ __('Invoices') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('user.show', ['user' => Auth::user()->id])">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link class="text-red-600" :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if (Auth::user()->isAdmin() || Auth::user()->isManager())
                    <x-responsive-nav-link :href="route('admin.drivers.index')">
                        {{ __('Drivers') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.vehicles.index')">
                        {{ __('Vehicles') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.transporters.index')">
                        {{ __('Transporters') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.clients.index')">
                        {{ __('Clients') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.expenses.index')">
                        {{ __('Expenses') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.imports.index')">
                        {{ __('Imports') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.log-sheets.index')">
                        {{ __('Log Sheets') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.invoices.index')">
                        {{ __('Invoices') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.locations.index')">
                        {{ __('Locations') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.managers.index')">
                        {{ __('Managers') }}
                    </x-responsive-nav-link>
                @endif
                <x-responsive-nav-link :href="route('user.show', ['user' => Auth::user()->id])">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link class="text-red-600" :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
