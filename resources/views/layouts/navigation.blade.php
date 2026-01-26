<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT: Logo + Desktop links --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                @php
                    $isPraktijkmanagement = auth()->check() &&
                        strtolower(trim((string) auth()->user()->rolename)) === 'praktijkmanagement';
                    $isAdmin = auth()->check() && strtolower(trim((string) auth()->user()->rolename)) === 'admin';
                @endphp

                {{-- DESKTOP NAV (md and up) --}}
                <div class="hidden space-x-8 md:-my-px md:ms-10 md:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.index')">
                        Afspraken
                    </x-nav-link>

                    @if(auth()->check() && strtolower(auth()->user()->rolename) === 'patient')
                        <x-nav-link :href="route('invoices.index')" :active="request()->routeIs('invoices.index')">
                            Facturen
                        </x-nav-link>
                    @endif

                    @if($isAdmin)
                        <x-nav-link :href="route('appointments.manage')" :active="request()->routeIs('appointments.manage')">
                            Management
                        </x-nav-link>
                    @endif

                    @if(auth()->check() && in_array(auth()->user()->rolename, ['Tandarts', 'Mondhygienis']))
                        <x-nav-link :href="route('appointments.my')" :active="request()->routeIs('appointments.my')">
                            Mijn afspraken
                        </x-nav-link>
                    @endif

                    @if($isPraktijkmanagement)
                        <x-nav-link :href="route('employees.index')" :active="request()->routeIs('employees.index')">
                            {{ __('Medewerkers') }}
                        </x-nav-link>

                        <x-nav-link :href="route('employees.availability.create')" :active="request()->routeIs('employees.availability.create')">
                            {{ __('Mijn Beschikbaarheid') }}
                        </x-nav-link>

                        <x-nav-link :href="route('omzet.index')" :active="request()->routeIs('omzet.index')">
                            Omzet bekijken
                        </x-nav-link>

                        <x-nav-link :href="route('invoices.manage')" :active="request()->routeIs('invoices.manage')">
                            Facturen beheren
                        </x-nav-link>

                        <x-nav-link :href="route('dashboard.verkomende-behandelingen')" :active="request()->routeIs('dashboard.verkomende-behandelingen')">
                            Verkomende Behandelingen
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- RIGHT: Desktop user dropdown --}}
            <div class="hidden md:flex md:items-center md:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
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

            {{-- MOBILE: Hamburger --}}
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }"
                              class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }"
                              class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-100">
        <div class="px-4 py-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.index')">
                Afspraken
            </x-responsive-nav-link>

            @if(auth()->check() && strtolower(auth()->user()->rolename) === 'patient')
                <x-responsive-nav-link :href="route('invoices.index')" :active="request()->routeIs('invoices.index')">
                    Facturen
                </x-responsive-nav-link>
            @endif

            @if($isAdmin)
                <x-responsive-nav-link :href="route('appointments.manage')" :active="request()->routeIs('appointments.manage')">
                    Management
                </x-responsive-nav-link>
            @endif

            @if(auth()->check() && in_array(auth()->user()->rolename, ['Tandarts', 'Mondhygienis']))
                <x-responsive-nav-link :href="route('appointments.my')" :active="request()->routeIs('appointments.my')">
                    Mijn afspraken
                </x-responsive-nav-link>
            @endif

            @if($isPraktijkmanagement)
                <x-responsive-nav-link :href="route('employees.index')" :active="request()->routeIs('employees.index')">
                    Medewerkers
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('employees.availability.create')" :active="request()->routeIs('employees.availability.create')">
                    Mijn Beschikbaarheid
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('omzet.index')" :active="request()->routeIs('omzet.index')">
                    Omzet bekijken
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('invoices.manage')" :active="request()->routeIs('invoices.manage')">
                    Facturen beheren
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('dashboard.verkomende-behandelingen')" :active="request()->routeIs('dashboard.verkomende-behandelingen')">
                    Verkomende Behandelingen
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="border-t border-gray-200 px-4 py-4">
            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
