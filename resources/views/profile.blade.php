<x-layout>
    <x-slot:title>Profil Pengguna</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header Profil -->
            <div class="bg-blue-600 py-4 px-6">
                <h1 class="text-2xl font-bold text-white">Profil Pengguna</h1>
            </div>

            <!-- Konten Profil -->
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Foto Profil -->
                    <div class="w-full md:w-1/3 flex justify-center">
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Detail Profil -->
                    <div class="w-full md:w-2/3 space-y-4">
                        <div>
                            <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-600">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Pengguna' }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-medium text-gray-700">Username</h3>
                                <p>{{ auth()->user()->username }}</p>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-700">Email</h3>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-700">Status</h3>
                                <p>{{ auth()->user()->isGuru ? 'Guru' : 'Siswa' }}</p>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-700">Bergabung Pada</h3>
                                <p>{{ auth()->user()->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                {{-- <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Edit Profil
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                        Kembali
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</x-layout>
