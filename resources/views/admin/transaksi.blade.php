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
        <x-slot:download>
            /export-transaksi
        </x-slot:download>

        <x-slot:link>
            /peminjaman/create
        </x-slot:link>
    </x-header>

    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search Input -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari data..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Filter Dropdown -->
            <div class="md:w-48">
                <select id="filterSelect"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Data</option>
                    <!-- Options akan ditambahkan via JavaScript berdasarkan halaman -->
                </select>
            </div>

            <!-- Sort Dropdown -->
            {{-- <div class="md:w-48">
                <select id="sortSelect"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Urutkan Berdasarkan</option>
                    <!-- Options akan ditambahkan via JavaScript berdasarkan halaman -->
                </select>
            </div> --}}

            <!-- Clear Button -->
            {{-- <button id="clearFilters"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-times mr-2"></i>Reset
            </button> --}}
        </div>

        <!-- Results Counter -->
        <div class="mt-3 text-sm text-gray-600">
            Menampilkan <span id="resultCount">0</span> dari <span id="totalCount">0</span> data
        </div>
    </div>


    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">No</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">User</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase border-b">Barang</th>
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
                            <td class="px-6 py-4 border-b">{{ $item->user->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->barang->nama }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->tanggal_pinjam }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->tanggal_kembali }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->jam_mulai }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->jam_selesai }}</td>
                            <td class="px-6 py-4 border-b">{{ $item->jam_dikembalikan ?? '-' }}</td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->status == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 border-b sticky right-0 bg-white z-10">
                                <div class="flex gap-2">
                                    <a href="{{ route('peminjaman.edit', ['id' => $item->id]) }}"
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
    <div id="globalDeleteModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
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

        class RealTimeTableSearch {
            constructor(config) {
                this.tableSelector = config.tableSelector || 'table tbody';
                this.searchInputId = config.searchInputId || 'searchInput';
                this.filterSelectId = config.filterSelectId || 'filterSelect';
                this.sortSelectId = config.sortSelectId || 'sortSelect';
                this.clearButtonId = config.clearButtonId || 'clearFilters';
                this.resultCountId = config.resultCountId || 'resultCount';
                this.totalCountId = config.totalCountId || 'totalCount';

                this.pageType = config.pageType; // 'transaksi', 'user', 'barang', 'kelas'
                this.searchableColumns = config.searchableColumns || [];
                this.filterOptions = config.filterOptions || [];
                this.sortOptions = config.sortOptions || [];

                this.allRows = [];
                this.filteredRows = [];

                this.init();
            }

            init() {
                this.cacheTableRows();
                this.setupFilterOptions();
                this.setupSortOptions();
                this.bindEvents();
                this.updateResultCount();
            }

            cacheTableRows() {
                const tbody = document.querySelector(this.tableSelector);
                if (!tbody) return;

                this.allRows = Array.from(tbody.querySelectorAll('tr')).filter(row => {
                    // Filter out empty state rows
                    return !row.querySelector('td[colspan]');
                });

                this.filteredRows = [...this.allRows];

                // Add data attributes for easier filtering
                this.allRows.forEach((row, index) => {
                    row.setAttribute('data-original-index', index);
                    this.addRowDataAttributes(row);
                });
            }
            dateToTimestamp(dateString) {
                if (!dateString || dateString === '-') return 0;

                // Asumsikan format tanggal adalah YYYY-MM-DD atau DD/MM/YYYY
                let date;

                if (dateString.includes('/')) {
                    // Format DD/MM/YYYY
                    const parts = dateString.split('/');
                    if (parts.length === 3) {
                        date = new Date(parts[2], parts[1] - 1, parts[0]);
                    }
                } else if (dateString.includes('-')) {
                    // Format YYYY-MM-DD
                    date = new Date(dateString);
                } else {
                    date = new Date(dateString);
                }

                return date.getTime() || 0;
            }


            addRowDataAttributes(row) {
                const cells = row.querySelectorAll('td');

                switch (this.pageType) {
                    case 'transaksi':
                        if (cells.length >= 9) {
                            row.setAttribute('data-user', cells[1].textContent.trim().toLowerCase());
                            row.setAttribute('data-barang', cells[2].textContent.trim().toLowerCase());
                            row.setAttribute('data-status', cells[8].textContent.trim().toLowerCase());

                            // Perbaikan: simpan tanggal dalam format yang bisa di-sort
                            const tanggalPinjam = cells[3].textContent.trim();
                            const tanggalKembali = cells[4].textContent.trim();

                            row.setAttribute('data-tanggal-pinjam', tanggalPinjam);
                            row.setAttribute('data-tanggal-kembali', tanggalKembali);

                            // Konversi ke timestamp untuk sorting yang lebih akurat
                            row.setAttribute('data-tanggal-pinjam-timestamp', this.dateToTimestamp(tanggalPinjam));
                            row.setAttribute('data-tanggal-kembali-timestamp', this.dateToTimestamp(tanggalKembali));
                        }
                        break;

                    case 'user':
                        if (cells.length >= 10) {
                            row.setAttribute('data-name', cells[2].textContent.trim().toLowerCase());
                            row.setAttribute('data-username', cells[3].textContent.trim().toLowerCase());
                            row.setAttribute('data-email', cells[4].textContent.trim().toLowerCase());
                            row.setAttribute('data-kelas', cells[5].textContent.trim().toLowerCase());
                            row.setAttribute('data-role', cells[6].textContent.trim().toLowerCase());
                            row.setAttribute('data-isguru', cells[7].textContent.trim().toLowerCase());
                            row.setAttribute('data-created-at', cells[8].textContent.trim());
                            row.setAttribute('data-updated-at', cells[9].textContent.trim());
                        }
                        break;

                    case 'barang':
                        if (cells.length >= 6) {
                            row.setAttribute('data-name', cells[2].textContent.trim().toLowerCase());
                            row.setAttribute('data-deskripsi', cells[3].textContent.trim().toLowerCase());
                            row.setAttribute('data-stock', parseInt(cells[4].textContent.trim()) || 0);
                        }
                        break;

                    case 'kelas':
                        if (cells.length >= 5) {
                            row.setAttribute('data-name', cells[2].textContent.trim().toLowerCase());
                            row.setAttribute('data-created-at', cells[3].textContent.trim());
                            row.setAttribute('data-updated-at', cells[4].textContent.trim());
                        }
                        break;
                }
            }

            setupFilterOptions() {
                const filterSelect = document.getElementById(this.filterSelectId);
                if (!filterSelect) return;

                // Clear existing options except the first one
                while (filterSelect.children.length > 1) {
                    filterSelect.removeChild(filterSelect.lastChild);
                }

                this.filterOptions.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.textContent = option.label;
                    filterSelect.appendChild(optionElement);
                });
            }

            setupSortOptions() {
                const sortSelect = document.getElementById(this.sortSelectId);
                if (!sortSelect) return;

                // Clear existing options except the first one
                while (sortSelect.children.length > 1) {
                    sortSelect.removeChild(sortSelect.lastChild);
                }

                this.sortOptions.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.textContent = option.label;
                    sortSelect.appendChild(optionElement);
                });
            }

            bindEvents() {
                // Search input
                const searchInput = document.getElementById(this.searchInputId);
                if (searchInput) {
                    searchInput.addEventListener('input', this.debounce(() => {
                        this.performSearch();
                    }, 300));
                }

                // Filter select
                const filterSelect = document.getElementById(this.filterSelectId);
                if (filterSelect) {
                    filterSelect.addEventListener('change', () => {
                        this.performSearch();
                    });
                }

                // Sort select
                const sortSelect = document.getElementById(this.sortSelectId);
                if (sortSelect) {
                    sortSelect.addEventListener('change', () => {
                        this.performSort();
                    });
                }

                // Clear button
                const clearButton = document.getElementById(this.clearButtonId);
                if (clearButton) {
                    clearButton.addEventListener('click', () => {
                        this.clearAllFilters();
                    });
                }
            }

            performSearch() {
                const searchTerm = document.getElementById(this.searchInputId).value.toLowerCase();
                const filterValue = document.getElementById(this.filterSelectId).value;

                this.filteredRows = this.allRows.filter(row => {
                    // Search filter
                    const matchesSearch = this.rowMatchesSearch(row, searchTerm);

                    // Category filter
                    const matchesFilter = this.rowMatchesFilter(row, filterValue);

                    return matchesSearch && matchesFilter;
                });

                this.displayRows();
                this.updateResultCount();
            }

            rowMatchesSearch(row, searchTerm) {
                if (!searchTerm) return true;

                return this.searchableColumns.some(column => {
                    const cellValue = row.getAttribute(`data-${column}`) || '';
                    return cellValue.includes(searchTerm);
                });
            }

            rowMatchesFilter(row, filterValue) {
                if (!filterValue) return true;

                const [filterType, filterVal] = filterValue.split(':');
                const rowValue = row.getAttribute(`data-${filterType}`) || '';

                return rowValue === filterVal;
            }

            performSort() {
                const sortValue = document.getElementById(this.sortSelectId).value;
                if (!sortValue) {
                    // Jika tidak ada sort yang dipilih, tampilkan dalam urutan original
                    this.filteredRows.sort((a, b) => {
                        const aIndex = parseInt(a.getAttribute('data-original-index'));
                        const bIndex = parseInt(b.getAttribute('data-original-index'));
                        return aIndex - bIndex;
                    });
                    this.displayRows();
                    return;
                }

                const [sortField, sortOrder] = sortValue.split(':');

                this.filteredRows.sort((a, b) => {
                    let aVal, bVal;

                    // Handle different data types dengan lebih spesifik
                    if (sortField.includes('tanggal')) {
                        // Gunakan timestamp untuk sorting tanggal
                        aVal = parseInt(a.getAttribute(`data-${sortField}-timestamp`)) || 0;
                        bVal = parseInt(b.getAttribute(`data-${sortField}-timestamp`)) || 0;
                    } else if (sortField === 'stock') {
                        aVal = parseInt(a.getAttribute(`data-${sortField}`)) || 0;
                        bVal = parseInt(b.getAttribute(`data-${sortField}`)) || 0;
                    } else {
                        // Untuk string, ambil nilai dan lowercase
                        aVal = (a.getAttribute(`data-${sortField}`) || '').toLowerCase();
                        bVal = (b.getAttribute(`data-${sortField}`) || '').toLowerCase();

                        // Handle empty values
                        if (aVal === '' || aVal === '-') aVal = 'zzz'; // Push empty to end
                        if (bVal === '' || bVal === '-') bVal = 'zzz';
                    }

                    let comparison = 0;

                    if (typeof aVal === 'number' && typeof bVal === 'number') {
                        comparison = aVal - bVal;
                    } else {
                        if (aVal > bVal) comparison = 1;
                        else if (aVal < bVal) comparison = -1;
                        else comparison = 0;
                    }

                    return sortOrder === 'desc' ? -comparison : comparison;
                });

                this.displayRows();
            }

            displayRows() {
                const tbody = document.querySelector(this.tableSelector);
                if (!tbody) return;

                // Hide all rows first
                this.allRows.forEach(row => {
                    row.style.display = 'none';
                });

                // Show filtered rows
                this.filteredRows.forEach((row, index) => {
                    row.style.display = '';
                    // Update row styling for alternating colors
                    if (index % 2 === 0) {
                        row.className = row.className.replace('bg-gray-50', 'bg-white');
                        if (!row.className.includes('bg-white')) {
                            row.className += ' bg-white';
                        }
                    } else {
                        row.className = row.className.replace('bg-white', 'bg-gray-50');
                        if (!row.className.includes('bg-gray-50')) {
                            row.className += ' bg-gray-50';
                        }
                    }
                });

                // Show/hide empty state
                this.toggleEmptyState();
            }

            toggleEmptyState() {
                const tbody = document.querySelector(this.tableSelector);
                if (!tbody) return;

                let emptyRow = tbody.querySelector('tr td[colspan]')?.parentElement;

                if (this.filteredRows.length === 0) {
                    if (!emptyRow) {
                        emptyRow = document.createElement('tr');
                        const colspan = this.allRows[0]?.querySelectorAll('td').length || 10;
                        emptyRow.innerHTML = `
                    <td colspan="${colspan}" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 border-b">
                        Tidak ada data yang sesuai dengan pencarian.
                    </td>
                `;
                        tbody.appendChild(emptyRow);
                    }
                    emptyRow.style.display = '';
                } else if (emptyRow) {
                    emptyRow.style.display = 'none';
                }
            }

            updateResultCount() {
                const resultCountEl = document.getElementById(this.resultCountId);
                const totalCountEl = document.getElementById(this.totalCountId);

                if (resultCountEl) resultCountEl.textContent = this.filteredRows.length;
                if (totalCountEl) totalCountEl.textContent = this.allRows.length;
            }

            clearAllFilters() {
                document.getElementById(this.searchInputId).value = '';
                document.getElementById(this.filterSelectId).selectedIndex = 0;
                document.getElementById(this.sortSelectId).selectedIndex = 0;

                this.filteredRows = [...this.allRows];
                this.displayRows();
                this.updateResultCount();
            }

            debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
        }

        function initTransaksiSearch() {
            new RealTimeTableSearch({
                pageType: 'transaksi',
                searchableColumns: ['user', 'barang', 'status'],
                filterOptions: [{
                        value: 'status:dikembalikan',
                        label: 'Status: Dikembalikan'
                    },
                    {
                        value: 'status:dipinjam',
                        label: 'Status: Dipinjam'
                    },
                    {
                        value: 'status:terlambat',
                        label: 'Status: Terlambat'
                    }
                ],
                sortOptions: [{
                        value: 'tanggal-pinjam:desc',
                        label: 'Tanggal Pinjam (Terbaru)'
                    },
                    {
                        value: 'tanggal-pinjam:asc',
                        label: 'Tanggal Pinjam (Terlama)'
                    },
                    {
                        value: 'tanggal-kembali:desc',
                        label: 'Tanggal Kembali (Terbaru)'
                    },
                    {
                        value: 'tanggal-kembali:asc',
                        label: 'Tanggal Kembali (Terlama)'
                    },
                    {
                        value: 'user:asc',
                        label: 'User (A-Z)'
                    },
                    {
                        value: 'user:desc',
                        label: 'User (Z-A)'
                    },
                    {
                        value: 'barang:asc',
                        label: 'Barang (A-Z)'
                    },
                    {
                        value: 'barang:desc',
                        label: 'Barang (Z-A)'
                    },
                    {
                        value: 'status:asc',
                        label: 'Status (A-Z)'
                    },
                    {
                        value: 'status:desc',
                        label: 'Status (Z-A)'
                    }
                ]
            });
        }

        initTransaksiSearch();
    </script>
</x-layout>
