<x-layout>
    <x-slot:title>Server Error</x-slot:title>

    <!-- Tambahkan meta tag untuk HTTP Status Code 500 -->
    <meta http-equiv="status" content="500">

    <div class="min-h-screen flex items-center justify-center px-4 bg-gray-100">
        <div class="w-full max-w-2xl text-center">

            <!-- Status Alert dengan animasi -->
            <div
                class="inline-flex items-center bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold mb-6 animate-pulse">
                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                HTTP 500 - Internal Server Error
            </div>

            <!-- Illustration dengan animasi lebih menarik -->
            <div class="mb-8">
                <div class="relative h-40 w-40 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-full w-full text-red-500 absolute inset-0 animate-bounce" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div class="absolute -inset-4 bg-red-100 rounded-full opacity-0 animate-ping-slow"></div>
                </div>
            </div>

            <!-- Title dengan gradien teks -->
            <h1
                class="text-3xl sm:text-4xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-red-700">
                Terjadi Kesalahan Server
            </h1>

            <!-- Description dengan daftar kemungkinan penyebab -->
            <div class="text-gray-600 mb-8 text-lg max-w-lg mx-auto">
                <p class="mb-4">Maaf, terjadi masalah teknis pada server kami. Tim kami telah diberitahu dan sedang
                    bekerja untuk memperbaikinya.</p>

                <div class="text-left bg-red-50 p-4 rounded-lg border-l-4 border-red-500">
                    <h3 class="font-semibold text-red-700 mb-2">Kemungkinan penyebab:</h3>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        <li>Permintaan yang tidak valid dari server</li>
                        <li>Masalah koneksi database</li>
                        <li>Overload server sementara</li>
                        <li>Proses maintenance yang tidak terduga</li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons dengan animasi hover -->
            <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4 mb-8">
                <a href="/"
                    class="px-6 py-3 bg-red-500 text-white rounded-lg font-medium hover:bg-red-600 transition transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                </a>
                <a href="#" onclick="window.location.reload()"
                    class="px-6 py-3 bg-white text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition transform hover:-translate-y-1 border border-gray-300 shadow-sm hover:shadow">
                    <i class="fas fa-sync-alt mr-2"></i> Muat Ulang Halaman
                </a>
                <a href="mailto:support@example.com?subject=500 Error Report"
                    class="px-6 py-3 bg-gray-800 text-white rounded-lg font-medium hover:bg-gray-900 transition transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                    <i class="fas fa-bug mr-2"></i> Laporkan Masalah
                </a>
            </div>

            <!-- Technical Details dengan lebih banyak informasi -->
            @if (trim(auth()->user()->role) == 'admin')
                <details class="mb-8 text-left bg-gray-50 p-4 rounded-lg cursor-pointer border border-gray-200">
                    <summary class="font-medium text-gray-700 flex items-center justify-between">
                        <span>Detail Teknis (Untuk Developer)</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200 transform group-open:rotate-180"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </summary>
                    <div class="mt-3 text-sm text-gray-600 bg-white p-3 rounded space-y-2">
                        <p><span class="font-semibold">Error:</span> Internal Server Error (500)</p>
                        <p><span class="font-semibold">Waktu:</span> <span id="error-time"></span></p>
                        <p><span class="font-semibold">URL:</span> <span id="error-url"></span></p>
                        <p><span class="font-semibold">Method:</span> <span id="error-method"></span></p>
                        <p><span class="font-semibold">Request ID:</span>
                            {{ request()->header('X-Request-ID') ?? 'N/A' }}</p>
                        <p><span class="font-semibold">IP Address:</span> {{ request()->ip() }}</p>
                    </div>
                </details>
            @endif
            <!-- Status Monitor -->
            <div class="mb-8 p-4 bg-white rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-semibold text-gray-700 mb-3">Status Layanan Kami</h3>
                <div class="flex flex-wrap justify-center gap-4">
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-sm">Website: Operational</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                        <span class="text-sm">API: Disrupted</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                        <span class="text-sm">Database: Degraded</span>
                    </div>
                </div>
            </div>

            <!-- Contact Info dengan lebih banyak opsi -->
            <div
                class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6 text-sm mb-6">
                <a href="mailto:support@example.com"
                    class="flex items-center text-gray-600 hover:text-red-500 transition">
                    <i class="fas fa-envelope mr-2"></i> Email Support
                </a>
                <a href="tel:+628123456789" class="flex items-center text-gray-600 hover:text-red-500 transition">
                    <i class="fas fa-phone-alt mr-2"></i> Telepon Darurat
                </a>
                <a href="#" class="flex items-center text-gray-600 hover:text-red-500 transition">
                    <i class="fas fa-comment-alt mr-2"></i> Live Chat
                </a>
            </div>

            <!-- Social Links dengan tooltip -->
            <div class="flex justify-center space-x-4 mb-4">
                <a href="#"
                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-red-500 hover:text-white transition group relative">
                    <i class="fab fa-facebook-f"></i>
                    <span
                        class="absolute -bottom-8 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">Facebook</span>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-red-500 hover:text-white transition group relative">
                    <i class="fab fa-twitter"></i>
                    <span
                        class="absolute -bottom-8 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">Twitter</span>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-red-500 hover:text-white transition group relative">
                    <i class="fab fa-instagram"></i>
                    <span
                        class="absolute -bottom-8 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">Instagram</span>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 hover:bg-red-500 hover:text-white transition group relative">
                    <i class="fab fa-telegram"></i>
                    <span
                        class="absolute -bottom-8 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">Telegram</span>
                </a>
            </div>

            <!-- Footer dengan link tambahan -->
            <div class="text-gray-500 text-sm space-x-4">
                <span>&copy; {{ date('Y') }} Nama Perusahaan. All rights reserved.</span>
                <a href="#" class="hover:text-red-500">Kebijakan Privasi</a>
                <a href="#" class="hover:text-red-500">Syarat Penggunaan</a>
            </div>
        </div>
    </div>

    <script>
        // Set current time and request details for error
        document.getElementById('error-time').textContent = new Date().toLocaleString();
        document.getElementById('error-url').textContent = window.location.pathname;
        document.getElementById('error-method').textContent = '{{ request()->method() }}';

        // Tambahkan animasi custom
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'ping-slow': 'ping 2s cubic-bezier(0, 0, 0.2, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite'
                    }
                }
            }
        }
    </script>
</x-layout>
