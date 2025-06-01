<x-layout>
    <x-slot:title>Riwayat Transaksi</x-slot:title>

    @if (session('success') || session('error'))
        <div id="toast"
            class="fixed top-4 right-4 z-50 px-4 py-3 rounded shadow-lg transition-opacity duration-500 
            {{ session('success') ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}">
            {{ session('success') ?? session('error') }}
        </div>

        <script>
            // Hilangkan toast setelah 3 detik
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500); // fade out
                }
            }, 3000);
        </script>
    @endif


    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-indigo-800">Riwayat Transaksi Saya</h2>
            <a href="/"
                class="text-indigo-600 bg-white w-12 h-12 flex justify-center items-center rounded-lg border-2 border-transparent hover:border-white hover:text-white hover:bg-indigo-500 transition duration-300 group">
                <i class="fas fa-home fa-xl group-hover:fa-beat-fade text-current"></i>
            </a>
        </div>

        <!-- Filter Status -->
        <div class="mb-6 flex flex-wrap gap-2">
            <button onclick="filterTransactions('all')" id="filter-all"
                class="px-4 py-2 rounded-full bg-indigo-600 text-white transition-all duration-300">
                Semua
            </button>
            <button onclick="filterTransactions('dipinjam')" id="filter-dipinjam"
                class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all duration-300">
                Dipinjam
            </button>
            <button onclick="filterTransactions('dikembalikan')" id="filter-dikembalikan"
                class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all duration-300">
                Selesai
            </button>
            <button onclick="filterTransactions('terlambat')" id="filter-terlambat"
                class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all duration-300">
                Terlambat
            </button>
        </div>

        <!-- Card Transaksi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($transactions as $transaction)
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 
                    @if ($transaction->status == 'dipinjam') border-yellow-500
                    @elseif($transaction->status == 'dikembalikan') border-green-500
                    @elseif($transaction->status == 'terlambat') border-red-500
                    @else border-gray-500 @endif">

                    <!-- Gambar Barang -->
                    <div class="h-64 overflow-hidden rounded-t-lg">
                        <img class="w-full h-full object-cover"
                            src="{{ $transaction->barang?->img_path ? asset('storage/' . $transaction->barang->img_path) : asset('images/default-item.jpg') }}"
                            alt="{{ $transaction->barang->nama ?? 'Barang' }}">
                    </div>

                    <!-- Info Barang -->
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $transaction->barang->nama ?? 'Barang tidak ditemukan' }}
                            </h3>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if ($transaction->status == 'dipinjam') bg-yellow-100 text-yellow-800
                                @elseif($transaction->status == 'dikembalikan') bg-green-100 text-green-800
                                @elseif($transaction->status == 'terlambat') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-500 mt-1">
                            Tanggal Pinjam: {{ \Carbon\Carbon::parse($transaction->tanggal_pinjam)->format('d M Y') }}
                            {{ $transaction->jam_mulai }}
                        </p>
                        {{-- @if ($transaction->status == 'dipinjam') --}}
                        <p class="text-sm text-gray-500">
                            Batas Kembali:
                            {{ \Carbon\Carbon::parse($transaction->tanggal_kembali)->format('d M Y') }}
                            {{ $transaction->jam_selesai }}
                        </p>
                        {{-- @endif --}}
                    </div>

                    <!-- Tombol -->
                    <div class="p-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                        @if ($transaction->status != 'dikembalikan')
                        <button onclick="showReturnModal('{{ $transaction->id }}')"
                            class="text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-1 rounded text-sm">
                            Kembalikan
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Modal untuk transaksi ini -->
                <div id="returnModal-{{ $transaction->id }}"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-4">Konfirmasi Pengembalian</h2>
                        <form action="{{ route('peminjaman.return', $transaction->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <p class="text-gray-700 mb-2">Konfirmasi pengembalian barang:</p>
                                <p class="text-gray-700">Deadline: {{ $transaction->tanggal_kembali }}
                                    {{ $transaction->jam_selesai }}</p>
                                <p class="text-gray-700">Waktu saat ini: {{ now()->format('d M Y H:i') }}</p>
                            </div>
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeReturnModal('{{ $transaction->id }}')"
                                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                    Konfirmasi Pengembalian
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-inbox fa-3x"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700">Tidak ada transaksi</h3>
                    <p class="text-gray-500 mt-1">Anda belum memiliki riwayat transaksi</p>
                    {{-- <a href="{{ route('items.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Pinjam Barang Sekarang
                    </a> --}}
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Sukses Pengembalian -->
    @if (session('success'))
        <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-center">
                <h2 class="text-xl font-semibold mb-4 text-green-600">Barang Berhasil Dikembalikan</h2>
                <p class="text-gray-700 mb-6">{{ session('success') }}</p>
                <button onclick="closeSuccessModal()"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Tutup
                </button>
            </div>
        </div>
    @endif

    <script>
        function showReturnModal(transactionId) {
            const modal = document.getElementById(`returnModal-${transactionId}`);
            modal.classList.remove('hidden');
        }

        function closeReturnModal(transactionId) {
            const modal = document.getElementById(`returnModal-${transactionId}`);
            modal.classList.add('hidden');
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
            location.reload();
        }

        // Auto close success modal after 3 seconds
        @if (session('success'))
            setTimeout(() => {
                closeSuccessModal();
            }, 3000);
        @endif
    </script>
</x-layout>
