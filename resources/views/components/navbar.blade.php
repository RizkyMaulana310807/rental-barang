<div class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/">
                    <img class="h-8 w-auto" src="{{ asset('images/logosmkrembg.png') }}" alt="Logo">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center relative">
                @if (Auth::check())
                    <div class="relative">
                        <button onclick="toggleDropdown()" id="userButton"
                            class="underline underline-offset-2 hover:underline-offset-4 hover:cursor-pointer transition-all duration-200 ease-in-out">
                            {{ Auth::user()->name }}
                        </button>

                        <!-- Dropdown -->
                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20">

                            <a class="text-sm block w-full px-4 py-2 text-blue-700 hover:bg-blue-100"
                                href="/Profile">Profile</a>

                            @if (trim(auth()->user()->role) == 'admin')
                                @if (Route::is('dashboard'))
                                    <a href="/"
                                        class="block w-full px-4 py-2 text-sm text-blue-700 hover:text-blue-900 hover:bg-blue-50">
                                        Home
                                    </a>
                                @else
                                    <a href="/Dashboard"
                                        class="block w-full px-4 py-2 text-sm text-blue-700 hover:text-blue-900 hover:bg-blue-50">
                                        Dashboard Admin
                                    </a>
                                @endif
                            @endif

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/register"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Login
                    </a>
                @endif
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger icon -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::check())
                <a href="/Profile"
                    class="block w-full px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                    Profile
                </a>
                @if (trim(auth()->user()->role) == 'admin')
                    @if (Route::is('dashboard'))
                        <a href="/"
                            class="block w-full px-3 py-2 text-base font-medium text-blue-700 hover:text-blue-900 hover:bg-blue-50">
                            Home
                        </a>
                    @else
                        <a href="/Dashboard"
                            class="block w-full px-3 py-2 text-base font-medium text-blue-700 hover:text-blue-900 hover:bg-blue-50">
                            Dashboard Admin
                        </a>
                    @endif
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-3 py-2 text-base font-medium text-red-700 hover:bg-red-100">
                        Logout
                    </button>
                </form>
            @else
                <a href="/register"
                    class="block w-full px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                    Login
                </a>
            @endif
        </div>
    </div>
</div>
