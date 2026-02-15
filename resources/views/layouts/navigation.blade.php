<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @php
                        $branding = \App\Models\BrandingSetting::query()->first();
                        $v = $branding?->cache_bust_token;
                    @endphp
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        @if($branding?->logo_path)
                            <img src="{{ asset('storage/'.$branding->logo_path).($v ? '?v='.$v : '') }}"
                                 alt="Logo"
                                 style="{{ $branding?->logo_width ? 'width:'.$branding->logo_width.'px;' : '' }}{{ $branding?->logo_height ? 'height:'.$branding->logo_height.'px;' : '' }}"
                                 class="object-contain"/>
                        @else
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                            <span class="font-bold text-lg text-blue-600">Pena Langit</span>
                        @endif
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.branding.show')" :active="request()->routeIs('admin.branding.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Branding') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.hero.show')" :active="request()->routeIs('admin.hero.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Hero Section') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.profile.show')" :active="request()->routeIs('admin.profile.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Profil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.articles.index')" :active="request()->routeIs('admin.articles.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Ruang Tulisan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.galleries.index')" :active="request()->routeIs('admin.galleries.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Galeri') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.careers.index')" :active="request()->routeIs('admin.careers.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Karir') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.faqs.index')" :active="request()->routeIs('admin.faqs.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('FAQ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.footer.index')" :active="request()->routeIs('admin.footer.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Footer') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Layanan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')" class="text-gray-900 hover:text-blue-600 hover:border-blue-600 focus:text-blue-600 focus:border-blue-600">
                        {{ __('Toko Buku') }}
                    </x-nav-link>
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ __('Kontak') }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.contact.settings.show')">
                                    {{ __('Pengaturan') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.contact.messages.index')">
                                    {{ __('Pesan Masuk') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
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

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.branding.show')" :active="request()->routeIs('admin.branding.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Branding') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.hero.show')" :active="request()->routeIs('admin.hero.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Hero Section') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.profile.show')" :active="request()->routeIs('admin.profile.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Profil') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.articles.index')" :active="request()->routeIs('admin.articles.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Ruang Tulisan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.galleries.index')" :active="request()->routeIs('admin.galleries.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Galeri') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.careers.index')" :active="request()->routeIs('admin.careers.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Karir') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.faqs.index')" :active="request()->routeIs('admin.faqs.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('FAQ') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.footer.index')" :active="request()->routeIs('admin.footer.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Footer') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Layanan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Toko Buku') }}
                </x-responsive-nav-link>
                <div class="border-t border-gray-200 my-2"></div>
                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Kontak
                </div>
                <x-responsive-nav-link :href="route('admin.contact.settings.show')" :active="request()->routeIs('admin.contact.settings.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Pengaturan Kontak') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.contact.messages.index')" :active="request()->routeIs('admin.contact.messages.*')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50 hover:border-blue-600">
                    {{ __('Pesan Masuk') }}
                </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" class="text-gray-600 hover:text-blue-600 hover:bg-blue-50"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
