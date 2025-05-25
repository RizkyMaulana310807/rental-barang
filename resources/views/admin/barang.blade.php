<x-layout>
    <x-slot:title>Barang</x-slot:title>
    <x-breadcrumb />
    <x-header>
        <x-slot:header>
            Barang
        </x-slot:header>
        <x-slot:link>
            /barang/create
        </x-slot:link>
    </x-header>

    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        No</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        ID</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Nama</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Deskripsi</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Stok</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Gambar</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if (count($barang) > 0)
                    @foreach ($barang as $index => $item)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->deskripsi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">
                                <img class="w-8 h-8 rounded" src="{{ asset('storage/' . $item->img_path) }}"
                                    alt="{{ $item->img_path }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">
                                <div class="flex space-y-2 gap-4">
                                    <a href="{{ route('barang.edit', ['id' => $item->id]) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 border-2 border-blue-500 text-blue-500 bg-white hover:bg-blue-500 hover:text-white font-bold rounded transition-all duration-200">
                                        <i class="fas fa-pen-to-square mr-2"></i> Edit
                                    </a>
                                    <button type="button"
                                        onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                        class="inline-flex items-center justify-center px-4 py-2 border-2 border-red-500 text-white bg-red-500 hover:bg-white hover:text-red-500 font-bold rounded transition-all duration-200">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 border-b">
                            Tidak ada item di sini. <a href="/barang/create"
                                class="text-blue-600 hover:underline">Tambahkan satu</a>.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- Modal Global Delete --}}
        <div id="globalDeleteModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-center">
                <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
                <p class="mb-6">Apakah Anda yakin ingin menghapus barang <span id="modalBarangName"
                        class="font-bold text-red-600"></span>?</p>
                <div class="flex justify-center gap-4">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Ya, Hapus
                        </button>
                    </form>
                    <button onclick="closeDeleteModal()"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Batal
                    </button>
                </div>
            </div>
        </div>
        <script>
            function showDeleteModal(id, name) {
                const modal = document.getElementById('globalDeleteModal');
                const nameSpan = document.getElementById('modalBarangName');
                const deleteForm = document.getElementById('deleteForm');

                // Tampilkan nama barang
                nameSpan.textContent = name;

                // Set action ke form
                deleteForm.action = `/barang/${id}`;

                // Tampilkan modal
                modal.classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('globalDeleteModal').classList.add('hidden');
            }
        </script>

    </div>
</x-layout>
