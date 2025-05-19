<x-layout>
    <x-slot:title>Tambah Kelas</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-indigo-800">Tambah Data Kelas</h2>
            <a href="/Dashboard/user"
                class="text-indigo-600 bg-white w-12 h-12 flex justify-center items-center rounded-lg border-2 border-transparent hover:border-white hover:text-white hover:bg-indigo-500 transition duration-300 group">
                <i class="fas fa-home fa-xl group-hover:fa-beat-fade text-current"></i>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('kelas.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-gray-700 mb-2">Nama</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />

                        </div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Tambah Kelas
                        </button>
                    </form>
                </div>

                <div class="w-full md:w-1/2 bg-indigo-50 rounded-xl p-6 flex flex-col items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-users fa-4x fa-bounce text-indigo-600 mx-auto"></i>
                        <h3 class="text-lg font-medium text-indigo-800 mt-4">Tambah Kelas Baru</h3>
                        <p class="text-gray-600 mt-2">Isi formulir dengan detail Kelas yang ingin ditambahkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
