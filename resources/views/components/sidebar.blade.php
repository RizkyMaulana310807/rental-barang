<div x-data="{ open: true }" class="flex">
    <!-- Sidebar -->
    <div :class="open ? 'w-64' : 'w-20'"
        class="bg-white h-screen shadow-md transition-all duration-300 flex flex-col justify-between">

        <!-- Top Section -->
        <div>
            <!-- Toggle Button -->
            <div class="flex items-center justify-between p-4 border-b">
                <div class="flex items-center space-x-2">
                    <img class="h-8 w-auto" src="{{ asset('images/logosmkrembg.png') }}" alt="Logo">
                    <span x-show="open" class="text-lg font-semibold text-gray-700">Dashboard</span>
                </div>
                <button @click="open = !open">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-4">
                <div>
                    <p x-show="open" class="text-gray-500 text-xs uppercase mb-2">Management <i
                            class="fas fa-tools"></i></p>
                    <ul class="space-y-2">
                        <li><a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-green-600">
                                <i class="fas fa-boxes" title="Barang"></i>
                                <span x-show="open">Barang</span>
                            </a></li>
                        <li><a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-green-600">
                                <i class="fas fa-users" title="User"></i>
                                <span x-show="open">User</span>
                            </a></li>
                        <li><a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-green-600">
                                <i class="fa fa-file-alt" title="Transaksi"></i>
                                <span x-show="open">Transaksi</span>
                            </a></li>
                    </ul>
                </div>

                <div>
                    <p x-show="open" class="text-gray-500 text-xs uppercase mb-2">System <i
                            class="fas fa-gear fa-spin"></i></p>
                    <ul class="space-y-2">
                        <li><a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-green-600">
                                <i class="fas fa-gear" title="Settings"></i>
                                <span x-show="open">Settings</span>
                            </a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="p-4 border-t">
            <div class="flex items-center space-x-3">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-8 h-8 rounded-full">
                <div x-show="open">
                    <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500"> <i class="fas fa-clipboard-user"></i> {{ auth()->user()->role }}
                    </p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-100">
                    <i class="fas fa-door-open"></i> Logout
                </button>
            </form>

        </div>
    </div>

    <!-- Content Area (slot/layout content) -->
    <div class="flex-1">
        {{ $slot }}
    </div>
</div>
