<nav x-data="{ open: false }" style="background-color: #551919; height: 60px;">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto" style="width: 80%;">
        <div class="flex items-center justify-between" style="height: 60px;">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center items-center">
                    <a href="{{ route('welcome') }}">
                        <x-application-mark />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                    @if (auth() -> user() -> admin)
                    <x-nav-link href="{{ route('admin-dashboard') }}" :active="request()->routeIs('admin-dashboard')">
                        <i class="fa-solid fa-house" style="margin-right: 5px;"></i>{{ __('Panel de control') }}
                    </x-nav-link>
                    @elseif (auth() -> user() -> company)
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <i class="fa-solid fa-house" style="margin-right: 5px;"></i>{{ __('Panel de usuario') }}
                    </x-nav-link>
                    @elseif (auth() -> user() -> worker)
                    <x-nav-link href="{{ route('worker-dashboard') }}" :active="request()->routeIs('worker-dashboard')">
                        <i class="fa-solid fa-house" style="margin-right: 5px;"></i>{{ __('Panel de control') }}
                    </x-nav-link>
                    @endif
                    @endauth

                    <x-nav-link href="{{ route('articles') }}" :active="request()->routeIs('articles')">
                        {{ __('Artículos') }}
                    </x-nav-link>

                    @if (!Auth::check() || (Auth::check() && Auth::user()->company))
                    <x-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.*')">
                        {{ __('Cesta') }}
                        @if (Auth::user()?->company?->cart?->articles?->count() != 0)
                        <span style="
                            background-color:#d9d6d6;
                            color: #531919;
                            border-radius: 50%;
                            padding: 2px 6px;
                            font-size: 0.75rem;
                            font-weight: bold;
                            margin-left: 5px;
                            width: auto;
                        ">
                            {{ Auth::user()?->company?->cart?->articles?->count() ?? 0 }}
                        </span>
                        @endif
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- Settings Dropdown -->
                @auth
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}

                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @else
                @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                    @else
                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 text-[#d6d9d9] border border-transparent hover:border-[#d6d9d9] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 border-[#d6d9d9] hover:border-[#d6d9d9] border text-[#d6d9d9] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
                @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white fixed z-50 w-screen">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            @if (auth() -> user() -> admin)
            <x-responsive-nav-link href="{{ route('admin-dashboard') }}" :active="request()->routeIs('admin-dashboard')">
                <i class="fa-solid fa-house" style="margin-right: 5px;"></i>{{ __('Panel de control') }}
            </x-responsive-nav-link>
            @elseif (auth() -> user() -> company)
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                <i class="fa-solid fa-house" style="margin-right: 5px;"></i>{{ __('Panel de usuario') }}
            </x-responsive-nav-link>
            @elseif (auth() -> user() -> worker)
            <x-responsive-nav-link href="{{ route('worker-dashboard') }}" :active="request()->routeIs('worker-dashboard')">
                <i class="fa-solid fa-house" style="margin-right: 5px;"></i>{{ __('Panel de control') }}
            </x-responsive-nav-link>
            @endif
            @else
            @if (Route::has('login'))
                <x-responsive-nav-link href="{{ route('login') }}">
                    {{ __('Log in') }}
                </x-responsive-nav-link>

                @if (Route::has('register'))
                    <x-responsive-nav-link href="{{ route('register') }}">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            @endif
            @endauth

            <x-responsive-nav-link href="{{ route('articles') }}" :active="request()->routeIs('articles')">
                {{ __('Artículos') }}
            </x-responsive-nav-link>

            @if (!Auth::check() || (Auth::check() && Auth::user()->company))
            <x-responsive-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.*')">
                {{ __('Cesta') }}
                @if (Auth::user()?->company?->cart?->articles?->count() != 0)
                <span style="
                    background-color: #531919;
                    color:#d9d6d6;
                    border-radius: 50%;
                    padding: 2px 6px;
                    font-size: 0.75rem;
                    font-weight: bold;
                    margin-left: 5px;
                    width: auto;
                ">
                    {{ Auth::user()?->company?->cart?->articles?->count() ?? 0 }}
                </span>
                @endif
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 me-3">
                    <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                        @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-responsive-nav-link>
                @endcan

                <!-- Team Switcher -->
                @if (Auth::user()->allTeams()->count() > 1)
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-switchable-team :team="$team" component="responsive-nav-link" />
                @endforeach
                @endif
                @endif
            </div>
        </div>
        @endauth
    </div>
</nav>