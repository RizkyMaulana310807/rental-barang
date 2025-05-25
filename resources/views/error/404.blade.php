<x-layout>
    <x-slot:title>Halaman Tidak Ditemukan</x-slot:title>

    <div class="min-h-screen flex items-center justify-center px-4 bg-gray-50">
        <div class="w-full max-w-2xl text-center">

            <!-- Status Badge -->
            <div class="inline-flex items-center bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold mb-6">
                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                HTTP 404 - Not Found
            </div>

            <!-- Illustration -->
            <div class="mb-8">
                <div class="relative h-48 w-48 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="absolute -bottom-2 -right-2 bg-white p-2 rounded-full shadow-md">
                        <span class="text-2xl font-bold text-blue-600">404</span>
                    </div>
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">
                Halaman Tidak Ditemukan
            </h1>

            <!-- Description -->
            <p class="text-gray-600 mb-8 text-lg max-w-lg mx-auto">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin telah dipindahkan, dihapus, atau alamat URL-nya salah.
            </p>

            <!-- Search Box -->
            <div class="mb-8 max-w-md mx-auto">
                <form action="/search" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Cari sesuatu..." 
                        class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Suggested Pages -->
            <div class="mb-8 text-left bg-white p-4 rounded-lg shadow-sm border border-gray-200 max-w-md mx-auto">
                <h3 class="font-semibold text-gray-700 mb-3">Mungkin Anda mencari:</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/" class="text-blue-600 hover:text-blue-800 hover:underline flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="/produk" class="text-blue-600 hover:text-blue-800 hover:underline flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Produk Kami
                        </a>
                    </li>
                    <li>
                        <a href="/kontak" class="text-blue-600 hover:text-blue-800 hover:underline flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Hubungi Kami
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4 mb-8">
                <a href="/" class="px-6 py-3 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-600 transition shadow-md hover:shadow-lg">
                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                </a>
                <button onclick="history.back()" class="px-6 py-3 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition border border-gray-300 shadow-sm hover:shadow">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Sebelumnya
                </button>
            </div>

            <!-- Footer -->
            <div class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Nama Perusahaan. All rights reserved.
            </div>
        </div>
    </div>
</x-layout>