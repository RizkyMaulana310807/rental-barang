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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Deskripsi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Stok</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Gambar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Aksi</th>
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
                                <img class="w-8 h-8 rounded" src="{{ asset('storage/' . $item->img_path) }}" alt="{{ $item->img_path }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">
                                <div class="flex space-y-2 gap-4">
                                    <button class="bg-white hover:bg-blue-500 text-blue-500 hover:text-white border-2 border-blue-500 font-bold py-2 px-4 rounded hover:rounded-md flex items-center transition-all duration-200 ease-in-out">
                                        <i class="fas fa-pen-to-square mr-2"></i> Edit
                                    </button>
                                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-white text-white hover:text-red-500 hover:border-red-500 border-2 border-transparent font-bold py-2 px-4 rounded flex items-center transition-all duration-200 ease-in-out">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 border-b">
                            Tidak ada item di sini. <a href="/barang/create" class="text-blue-600 hover:underline">Tambahkan satu</a>.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</x-layout>
