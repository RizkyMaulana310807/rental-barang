@props(['id', 'name', 'description', 'stock', 'price' => 0, 'imageUrl' => 'imageUrl'])

<div x-data="{ openDetail: false }"
    class="max-w-sm rounded-lg overflow-hidden shadow-md bg-white hover:shadow-lg transition-shadow duration-300 cursor-pointer"
    @click="openDetail = true">
    <!-- Card Thumbnail -->
    <img class="w-full h-48 object-cover" src="{{ $imageUrl }}" width="200" alt="{{ $name }}">

    <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-800">{{ $name }}</h2>
        <p class="text-gray-600 text-sm truncate">{{ $description }}</p>
        <div class="mt-2 flex justify-between text-sm text-gray-500">
            <span>Stok: {{ $stock }}</span>
            {{-- <span>ID: {{ $id }}</span> --}}
        </div>
    </div>

    <!-- Modal Detail -->
    <div x-show="openDetail" @click.away="openDetail = false" x-transition
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
            <div class="p-6 space-y-6">
                <div class="flex justify-between items-start">
                    <h3 class="text-2xl font-bold text-gray-800">Detail Barang</h3>
                    <button @click="openDetail = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="h-64 overflow-hidden rounded-lg">
                        <img class="w-full h-full object-cover"
                            src="{{ $imageUrl ?? asset('images/default-item.jpg') }}" alt="{{ $name }}">
                    </div>

                    <div class="space-y-4">
                        {{-- <div>
                            <span class="font-semibold text-gray-700">ID Barang:</span>
                            <p class="text-gray-900">{{ $id }}</p>
                        </div> --}}

                        <div>
                            <span class="font-semibold text-gray-700">Nama Barang:</span>
                            <p class="text-gray-900">{{ $name }}</p>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Deskripsi:</span>
                            <p class="text-gray-900">{{ $description }}</p>
                        </div>

                        <div>
                            <span class="font-semibold text-gray-700">Stok Tersedia:</span>
                            <p class="text-gray-900">{{ $stock }} unit</p>
                        </div>

                        {{-- <div>
                            <span class="font-semibold text-gray-700">Harga:</span>
                            <p class="text-blue-600 font-bold">
                                Rp {{ number_format($price, 0, ',', '.') }}
                            </p>
                        </div> --}}
                    </div>
                </div>

                <div>
                    <a href="{{ route('peminjaman.create', ['barang' => $id]) }}"
                        class="w-full block text-center bg-indigo-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition-colors {{ $stock <= 0 ? 'pointer-events-none opacity-50' : '' }}">
                        Pinjam
                    </a>
                </div>

                @if (auth()->check() && trim(auth()->user()->role) == 'admin')
                    <div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
