<div x-data="{ open: true }" class="flex">
    <!-- Sidebar -->
    <div :class="open ? 'w-64' : 'w-20'" class="bg-white h-screen shadow-md transition-all duration-300 flex flex-col justify-between">

        <!-- Top Section -->
        <div>
            <!-- Toggle Button -->
            <div class="flex items-center justify-between p-4 border-b">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
                                10-4.48 10-10S17.52 2 12 2z" />
                    </svg>
                    <span x-show="open" class="text-lg font-semibold">Flup</span>
                </div>
                <button @click="open = !open">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path x-show="open" d="M15 19l-7-7 7-7" />
                        <path x-show="!open" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-4">
                <div>
                    <p x-show="open" class="text-gray-500 text-xs uppercase mb-2">Marketing</p>
                    <ul class="space-y-2">
                        <li><a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path d="M3 12h18M3 6h18M3 18h18" />
                                </svg>
                                <span x-show="open">Dashboard</span>
                            </a></li>
                        <li><a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path d="M3 3h18v18H3z" />
                                </svg>
                                <span x-show="open">Marketplace</span>
                            </a></li>
                        <!-- Tambahkan menu lainnya di sini -->
                    </ul>
                </div>

                <div>
                    <p x-show="open" class="text-gray-500 text-xs uppercase mb-2">System</p>
                    <ul class="space-y-2">
                        <li><a href="#" class="flex items-center space-x-3 text-gray-700 hover:text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path d="M12 6v6l4 2" />
                                </svg>
                                <span x-show="open">Settings</span>
                            </a></li>
                        <li class="flex items-center justify-between">
                            <div class="flex items-center space-x-3 text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path d="M12 3v18m9-9H3" />
                                </svg>
                                <span x-show="open">Dark mode</span>
                            </div>
                            <label x-show="open" class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only">
                                <div class="w-10 h-4 bg-gray-200 rounded-full shadow-inner"></div>
                                <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
                            </label>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="p-4 border-t">
            <div class="flex items-center space-x-3">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar"
                     class="w-8 h-8 rounded-full">
                <div x-show="open">
                    <p class="text-sm font-semibold">Harper Nelson</p>
                    <p class="text-xs text-gray-500">Admin Manager</p>
                </div>
            </div>
            <div class="mt-2" x-show="open">
                <button class="text-red-500 text-sm hover:underline">Log out</button>
            </div>
        </div>
    </div>

    <!-- Content Area (slot/layout content) -->
    <div class="flex-1">
        {{ $slot }}
    </div>
</div>
