@php
    use Illuminate\Support\Carbon;
@endphp


<x-layout>
    <x-slot:title>Tambah Peminjaman Barang</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-indigo-800">Tambah Peminjaman Barang</h2>
            <a href="/Dashboard/transaksi"
                class="text-indigo-600 bg-white w-12 h-12 flex justify-center items-center rounded-lg border-2 border-transparent hover:border-white hover:text-white hover:bg-indigo-500 transition duration-300 group">
                <i class="fas fa-home fa-xl group-hover:fa-beat-fade text-current"></i>
            </a>
        </div>

        {{-- Notifikasi Error Global --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            Terdapat {{ $errors->count() }} kesalahan dalam pengisian form:
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div id="toast"
                class="fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const toast = document.getElementById('toast');
                    if (toast) {
                        toast.style.opacity = '0';
                        setTimeout(() => toast.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-md">
            <form id="peminjamanForm" action="{{ route('peminjaman.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Data Peminjam -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-indigo-700 border-b pb-2">Data Peminjam</h3>

                        <div>
                            <label class="block text-gray-700 mb-2">Peminjam</label>
                            <select name="user_id" id="user_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                required>
                                <option value="">-- Pilih User --</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('user_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} - {{ $item->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Pilih Barang -->
                        <div>
                            <label for="barang_id" class="block text-gray-700 mb-2">Barang yang Dipinjam*</label>
                            <select name="barang_id" id="barang_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}" data-stock="{{ $barang->stock }}"
                                        {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                        {{ $barang->nama }} (Stok: {{ $barang->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <!-- Jadwal Peminjaman -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-indigo-700 border-b pb-2">Jadwal Peminjaman</h3>

                        <div>
                            <label for="tanggal_pinjam" class="block text-gray-700 mb-2">Tanggal Pinjam*</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                                value="{{ old('tanggal_pinjam') }}" required min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <div>
                            <label for="tanggal_kembali" class="block text-gray-700 mb-2">Tanggal Kembali*</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                value="{{ old('tanggal_kembali') }}" required min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="jam_mulai" class="block text-gray-700 mb-2">Jam Mulai*</label>
                                <input type="time" name="jam_mulai" id="jam_mulai"
                                    value="{{ old('jam_mulai', now()->format('H:i')) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg ...">
                            </div>

                            <div>
                                <label for="jam_selesai" class="block text-gray-700 mb-2">Jam Selesai*</label>
                                <input type="time" name="jam_selesai" id="jam_selesai"
                                    value="{{ old('jam_selesai', now()->addHours(2)->format('H:i')) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg ...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 font-medium">
                        Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            // Fungsi bantu untuk padding angka (contoh: 09, 05)
            const pad = (n) => n.toString().padStart(2, '0');

            const now = new Date();
            const today = `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())}`;
            const jamMulai = `${pad(now.getHours())}:${pad(now.getMinutes())}`;
            const jamSelesai = `${pad((now.getHours() + 2) % 24)}:${pad(now.getMinutes())}`;

            // Set tanggal dan waktu default
            const tanggalPinjam = document.getElementById('tanggal_pinjam');
            const tanggalKembali = document.getElementById('tanggal_kembali');
            const jamMulaiInput = document.getElementById('jam_mulai');
            const jamSelesaiInput = document.getElementById('jam_selesai');

            if (tanggalPinjam && !tanggalPinjam.value) tanggalPinjam.value = today;
            if (tanggalKembali && !tanggalKembali.value) tanggalKembali.value = today;
            if (jamMulaiInput && !jamMulaiInput.value) jamMulaiInput.value = jamMulai;
            if (jamSelesaiInput && !jamSelesaiInput.value) jamSelesaiInput.value = jamSelesai;

            // Set batas minimum tanggal kembali sesuai tanggal pinjam
            tanggalKembali.min = tanggalPinjam.value;
        });

        // Validasi tanggal kembali tidak boleh sebelum tanggal pinjam
        document.getElementById('tanggal_pinjam').addEventListener('change', function() {
            const tanggalKembali = document.getElementById('tanggal_kembali');
            tanggalKembali.min = this.value;

            if (tanggalKembali.value && tanggalKembali.value < this.value) {
                tanggalKembali.value = this.value;
            }
        });

        // Validasi jam selesai tidak boleh sebelum jam mulai
        document.getElementById('jam_mulai').addEventListener('change', function() {
            const jamSelesai = document.getElementById('jam_selesai');

            if (jamSelesai.value && jamSelesai.value < this.value) {
                jamSelesai.value = this.value;
            }
        });

        // Cek stok barang sebelum submit
        document.getElementById('peminjamanForm').addEventListener('submit', function(e) {
            const barangSelect = document.getElementById('barang_id');
            const selectedOption = barangSelect.options[barangSelect.selectedIndex];
            const stok = parseInt(selectedOption.getAttribute('data-stock'));

            if (stok <= 0) {
                e.preventDefault();
                alert('Maaf, stok barang ini sudah habis. Silahkan pilih barang lain.');
            }
        });
    </script>
</x-layout>
