<x-layout>
    <x-slot:title>Edit Peminjaman Barang</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-indigo-800">Edit Peminjaman Barang</h2>
            <a href="/Dashboard/transaksi"
                class="text-indigo-600 bg-white w-12 h-12 flex justify-center items-center rounded-lg border-2 border-transparent hover:border-white hover:text-white hover:bg-indigo-500 transition duration-300 group">
                <i class="fas fa-home fa-xl group-hover:fa-beat-fade text-current"></i>
            </a>
        </div>

        {{-- Error & Success Notification --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                <h3 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan dalam pengisian
                    form:</h3>
                <ul class="list-disc pl-5 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div id="toast"
                class="fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => document.getElementById('toast')?.remove(), 3000);
            </script>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-md">
            <form id="peminjamanForm" action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Data Peminjam -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-indigo-700 border-b pb-2">Data Peminjam</h3>

                        <div>
                            <label class="block text-gray-700 mb-2">Peminjam</label>
                            <select name="user_id" required
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('id_user', $peminjaman->id_user) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} - {{ $item->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Barang yang Dipinjam*</label>
                            <select name="barang_id" required
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}"
                                        {{ old('id_barang', $peminjaman->id_barang) == $barang->id ? 'selected' : '' }}>
                                        {{ $barang->nama }} (Stok: {{ $barang->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Jadwal -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-indigo-700 border-b pb-2">Jadwal Peminjaman</h3>

                        <div>
                            <label class="block text-gray-700 mb-2">Tanggal Pinjam*</label>
                            <input type="date" name="tanggal_pinjam"
                                value="{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}" required
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Tanggal Kembali*</label>
                            <input type="date" name="tanggal_kembali"
                                value="{{ $peminjaman->tanggal_kembali->format('Y-m-d') }}" required
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 mb-2">Jam Mulai*</label>
                                <input type="time" name="jam_mulai" value="{{ $peminjaman->jam_mulai }}" required
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Jam Selesai*</label>
                                <input type="time" name="jam_selesai" value="{{ $peminjaman->jam_selesai }}"
                                    required
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
