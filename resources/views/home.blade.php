<x-layout>
    <x-slot:title>Home</x-slot:title>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="relative">
            <input 
                type="text" 
                id="searchInput" 
                placeholder="Cari barang berdasarkan nama atau deskripsi..." 
                class="w-full px-4 py-3 pl-10 pr-4 border border-gray-300 bg-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200"
            >
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
        
        <!-- Search Stats -->
        <div class="mt-2 text-sm text-gray-600">
            <span id="searchStats">Menampilkan {{ count($stocks) }} dari {{ count($stocks) }} item</span>
        </div>
    </div>

    <!-- Items Grid -->
    <div id="itemsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if (count($stocks) > 0)
            @foreach ($stocks as $stock)
                <div class="stock-item" 
                     data-name="{{ strtolower($stock->nama) }}" 
                     data-description="{{ strtolower($stock->deskripsi) }}"
                     data-stock="{{ $stock->stock }}">
                    <x-card-barang 
                        :id="$stock->id" 
                        :name="$stock->nama" 
                        :description="$stock->deskripsi" 
                        :stock="$stock->stock"
                        :imageUrl="asset('storage/' . $stock->img_path)" 
                    />
                </div>
            @endforeach
        @else
            <div id="noItemsMessage" class="col-span-full text-center py-8">
                <p class="text-sm text-gray-700">Tidak ada item yang tersedia</p>
            </div>
        @endif
    </div>

    <!-- No Results Message -->
    <div id="noResultsMessage" class="hidden col-span-full text-center py-8">
        <div class="text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.467-.881-6.084-2.334.653-.546 1.637-.82 2.763-.82h6.642c1.126 0 2.11.274 2.763.82z"></path>
            </svg>
            <p class="text-lg font-medium">Tidak ada hasil ditemukan</p>
            <p class="text-sm mt-1">Coba ubah kata kunci pencarian Anda</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const itemsGrid = document.getElementById('itemsGrid');
            const stockItems = document.querySelectorAll('.stock-item');
            const searchStats = document.getElementById('searchStats');
            const noResultsMessage = document.getElementById('noResultsMessage');
            const noItemsMessage = document.getElementById('noItemsMessage');
            
            const totalItems = stockItems.length;
            let searchTimeout;

            // Function to perform search
            function performSearch(query) {
                const searchTerm = query.toLowerCase().trim();
                let visibleCount = 0;
                
                // Show/hide items based on search
                stockItems.forEach(item => {
                    const name = item.getAttribute('data-name');
                    const description = item.getAttribute('data-description');
                    
                    const matchesSearch = name.includes(searchTerm) || 
                                        description.includes(searchTerm);
                    
                    if (matchesSearch) {
                        item.style.display = 'block';
                        item.style.opacity = '0';
                        // Fade in animation
                        setTimeout(() => {
                            item.style.transition = 'opacity 0.3s ease-in-out';
                            item.style.opacity = '1';
                        }, 50);
                        visibleCount++;
                    } else {
                        item.style.transition = 'opacity 0.2s ease-in-out';
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 200);
                    }
                });
                
                // Update search stats
                if (searchTerm === '') {
                    searchStats.textContent = `Menampilkan ${totalItems} dari ${totalItems} item`;
                } else {
                    searchStats.textContent = `Menampilkan ${visibleCount} dari ${totalItems} item untuk "${query}"`;
                }
                
                // Show/hide no results message
                if (visibleCount === 0 && searchTerm !== '') {
                    noResultsMessage.classList.remove('hidden');
                    noResultsMessage.classList.add('col-span-full');
                } else {
                    noResultsMessage.classList.add('hidden');
                    noResultsMessage.classList.remove('col-span-full');
                }
                
                // Handle no items message
                if (totalItems === 0) {
                    noItemsMessage.style.display = 'block';
                } else {
                    noItemsMessage.style.display = 'none';
                }
            }

            // Real-time search with debouncing
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value;
                
                // Clear previous timeout
                clearTimeout(searchTimeout);
                
                // Add loading state
                searchInput.style.borderColor = '#93c5fd';
                
                // Debounce search to avoid too many operations
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                    searchInput.style.borderColor = '#d1d5db';
                }, 300);
            });

            // Instant search for better UX (no debouncing for very fast typing)
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Escape') {
                    searchInput.value = '';
                    performSearch('');
                    searchInput.blur();
                }
            });

            // Focus search input with Ctrl+K or Cmd+K
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    searchInput.focus();
                }
            });

            // Initialize search stats
            if (totalItems > 0) {
                searchStats.textContent = `Menampilkan ${totalItems} dari ${totalItems} item`;
            }
        });
    </script>

    <style>
        .stock-item {
            transition: all 0.3s ease-in-out;
        }
        
        .stock-item:hover {
            transform: translateY(-2px);
        }
        
        #searchInput:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-layout>