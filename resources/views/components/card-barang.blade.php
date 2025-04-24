<?php
$available = true;
?>


<div 
    x-data="{ openDetail: false }"
    class="max-w-sm mx-auto bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 cursor-pointer"
    @click="openDetail = true"
>
    <!-- Gambar Stock -->
    <div class="h-48 overflow-hidden">
        <img 
            class="w-full h-full object-cover" 
            src="{{ $imageUrl ?? asset('images/default-stock.jpg') }}" 
            alt="{{ $stockName ?? 'Default stock' }}"
            onerror="this.src='{{ asset('images/default-stock.jpg') }}'"
        >
    </div>
    
    <!-- Konten Card -->
    <div class="p-4">
        <!-- Nama Stock -->
        <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $stockName ?? 'Default stock' }}</h3>
        
        <!-- Deskripsi -->
        <p class="mt-2 text-gray-600 text-sm line-clamp-3">
            {{ $description ?? 'Default deskripsi' }}
        </p>
        
        <!-- Footer Card -->
        <div class="mt-4 flex justify-between items-center">
            <span class="text-indigo-600 font-medium">Stock ID: {{ $stockId ?? '000' }}</span>
            
            <div class="flex space-x-2">
                <!-- Tombol Pinjam -->
                <button 
                    @click.stop="$wire.emit('borrowStock', {{ $stockId ?? '000' }})"
                    class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium hover:bg-green-200 transition-colors"
                >
                    Pinjam
                </button>
                
                <!-- Tombol Detail -->
                <button 
                    @click.stop="openDetail = true"
                    class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-medium hover:bg-indigo-200 transition-colors"
                >
                    Detail
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div 
        x-show="openDetail" 
        @click.away="openDetail = false"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
        style="display: none;"
    >
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-bold text-gray-800">{{ $stockName ?? 'Default stock' }}</h3>
                    <button @click="openDetail = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="h-64 overflow-hidden rounded-lg">
                        <img 
                            class="w-full h-full object-cover" 
                            src="{{ $imageUrl ?? asset('images/default-stock.jpg') }}" 
                            alt="{{ $stockName ?? 'Default stock' }}"
                            onerror="this.src='{{ asset('images/default-stock.jpg') }}'"
                        >
                    </div>
                    
                    <div>
                        <p class="text-gray-700 mb-4">{{ $description ?? 'Default deskripsi' }}</p>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Stock ID:</span>
                                <span>{{ $stockId ?? '000' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Status:</span>
                                <span class="px-2 py-1 text-xs rounded-full {{ $available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $available ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Lokasi:</span>
                                <span>{{ $location ?? 'Gudang Utama' }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex space-x-3">
                            <button 
                                @click.stop="$wire.emit('borrowStock', {{ $stockId ?? '000' }})"
                                class="flex-1 bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition-colors disabled:opacity-50"
                                {{ $available ? '' : 'disabled' }}
                            >
                                Pinjam Sekarang
                            </button>
                            <button 
                                @click.stop="openDetail = false"
                                class="flex-1 bg-gray-200 text-gray-800 py-2 px-4 rounded hover:bg-gray-300 transition-colors"
                            >
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>