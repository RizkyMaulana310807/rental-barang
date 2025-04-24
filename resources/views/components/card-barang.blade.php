<div class="max-w-sm mx-auto bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <!-- Gambar Stock -->
    <div class="h-48 overflow-hidden">
        <img 
            class="w-full h-full object-cover" 
            src="{{ $imageUrl ?? asset('images/default-stock.jpg') }}" 
            alt="{{ $stockName ?? "Default stock" }}"
            onerror="this.src='{{ asset('images/default-stock.jpg') }}'"
        >
    </div>
    
    <!-- Konten Card -->
    <div class="p-4">
        <!-- Nama Stock -->
        <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $stockName ?? "Default stock" }}</h3>
        
        <!-- Deskripsi -->
        <p class="mt-2 text-gray-600 text-sm line-clamp-3">
            {{ $description ?? "Default deskripsi" }}
        </p>
        
        <!-- Footer Card (opsional) -->
        <div class="mt-4 flex justify-between items-center">
            <span class="text-indigo-600 font-medium">Stock ID: {{ $stockId ?? "Default stock" }}</span>
            <button class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-medium hover:bg-indigo-200 transition-colors">
                Details
            </button>
        </div>
    </div>
</div>