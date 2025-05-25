<x-layout>
    <x-slot:title>Server Unavailable</x-slot:title>

    <div class="min-h-screen flex items-center justify-center px-4 bg-gray-100">
        <div class="w-full max-w-2xl text-center">

            <!-- Status Alert -->
            <div class="inline-flex items-center bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold mb-6">
                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                HTTP 503 - Service Unavailable
            </div>

            <!-- Illustration -->
            <div class="mb-8 animate-bounce-slow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-40 mx-auto text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                </svg>
            </div>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Sedang Dalam Pemeliharaan</h1>

            <!-- Description -->
            <p class="text-gray-600 mb-8 text-lg">
                Kami sedang melakukan peningkatan sistem untuk pengalaman yang lebih baik. Mohon maaf atas ketidaknyamanan ini.
            </p>

            <!-- Countdown -->
            <div class="bg-blue-50 rounded-lg p-4 mb-8 inline-block">
                <h3 class="text-sm font-semibold text-blue-600 mb-2">PERKIRAAN WAKTU SELESAI</h3>
                <div class="flex justify-center space-x-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-800">02</div>
                        <div class="text-xs text-gray-500">JAM</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-800">45</div>
                        <div class="text-xs text-gray-500">MENIT</div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6 text-sm mb-6">
                <a href="mailto:support@example.com" class="flex items-center text-gray-600 hover:text-indigo-500 transition">
                    <i class="fas fa-envelope mr-2"></i> support@example.com
                </a>
                <a href="tel:+628123456789" class="flex items-center text-gray-600 hover:text-indigo-500 transition">
                    <i class="fas fa-phone-alt mr-2"></i> +62 812 3456 789
                </a>
            </div>

            <!-- Social Links -->
            <div class="flex justify-center space-x-4 mb-4">
                <a href="#" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-indigo-500 hover:text-white transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-indigo-500 hover:text-white transition">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-indigo-500 hover:text-white transition">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>

            <!-- Footer -->
            <div class="text-gray-500 text-sm">
                &copy; 2025 Nama Perusahaan. All rights reserved.
            </div>
        </div>
    </div>
</x-layout>
