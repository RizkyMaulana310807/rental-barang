<x-layout>
    <x-slot:title>Transaksi</x-slot:title>

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
            }, 2000);
        </script>
    @elseif (session('error'))
        <div id="toast"
            class="fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
            {{ session('error') }}
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 2000);
        </script>
    @endif

    <x-breadcrumb />
    <x-header>
        <x-slot:header>
            Transaksi
        </x-slot:header>
        <x-slot:link>
            /pinjam
        </x-slot:link>
    </x-header>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">No</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">ID User</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">ID Barang</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">Tgl Pinjam</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">Tgl Kembali</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">Jam Mulai</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">Jam Selesai</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">Jam Dikembalikan</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">Status</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if (count($transaksis) > 0)
                    @foreach ($transaksis as $index => $item)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 border-b">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->id_user }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->id_barang }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->tanggal_pinjam }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->tanggal_kembali }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->jam_mulai }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->jam_selesai }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->jam_dikembalikan ?? '-' }}</td>
                            <td class="px-6 py-4 border-b">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 border-b sticky right-0 bg-white z-10">
                                <div class="flex gap-2">
                                    <a href="{{ route('peminjaman.edit', $item->id) }}"
                                        class="px-3 py-1 border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white rounded transition-all">Edit</a>
                                    <button onclick="showDeleteModal({{ $item->id }})"
                                        class="px-3 py-1 bg-red-500 text-white hover:bg-white hover:text-red-500 border border-red-500 rounded transition-all">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="text-center text-gray-500 py-4">Tidak ada data transaksi.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div id="globalDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md text-center">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
            <p class="mb-6">Apakah Anda yakin ingin menghapus transaksi ini?</p>
            <div class="flex justify-center gap-4">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Ya, Hapus
                    </button>
                </form>
                <button onclick="closeDeleteModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(id) {
            const modal = document.getElementById('globalDeleteModal');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/pinjam/${id}`;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('globalDeleteModal').classList.add('hidden');
        }
    </script>
</x-layout>
