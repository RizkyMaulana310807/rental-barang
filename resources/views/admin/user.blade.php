<x-layout>
    <x-slot:title>User</x-slot:title>

    @if (session('success'))
        <div id="toast"
            class="fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
            {{ session('success') }}
        </div>

        <script>
            // Hilangkan toast setelah 2 detik
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500); // Hapus dari DOM setelah transisi
                }
            }, 2000);
        </script>
    @elseif (session('error'))
        <div id="toast"
            class="fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
            {{ session('error') }}
        </div>

        <script>
            // Hilangkan toast setelah 2 detik
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500); // Hapus dari DOM setelah transisi
                }
            }, 2000);
        </script>
    @endif


    <x-breadcrumb />
    <x-header>
        <x-slot:header>
            User
        </x-slot:header>
        <x-slot:link>
            /user/create
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
            </div>

            <!-- Clear Button -->
            <button id="clearFilters"
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
                        Username</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Email</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Kelas</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Role</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        isGuru</th>
                    {{-- <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Password</th> --}}
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Create_at</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Update_at</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b sticky right-0 z-10 bg-gray-50">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if (count($user) > 0)
                    @foreach ($user as $index => $item)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">
                                @if ($item->kelas)
                                    {{ $item->kelas->nama_kelas }}
                                @else
                                    <span class="text-gray-400">Null</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->isGuru }}</td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->password }}</td> --}}
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->created_at }}</td>
                            <td class="px-6 py-4 whitespaqce-nowrap border-b">{{ $item->updated_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b bg-white sticky right-0 z-10">
                                <div class="flex space-y-2 gap-4">
                                    <a href="{{ route('user.edit', ['id' => $item->id]) }}"
                                        class="bg-white hover:bg-blue-500 text-blue-500 hover:text-white border-2 border-blue-500 font-bold py-2 px-4 rounded hover:rounded-md flex items-center transition-all duration-200 ease-in-out">
                                        <i class="fas fa-pen-to-square mr-2"></i> Edit
                                    </a>
                                    {{-- <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                        @csrf
                                        @method('DELETE') --}}
                                    <button type="submit"
                                        onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ $item->email }}')"
                                        class="bg-red-500 hover:bg-white text-white hover:text-red-500 hover:border-red-500 border-2 border-transparent font-bold py-2 px-4 rounded flex items-center transition-all duration-200 ease-in-out">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                    {{-- </form> --}}
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
    </div>


    <div id="globalDeleteModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-center">
            <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
            <p class="mb-6">Apakah Anda yakin ingin menghapus User <span id="modalUserName"
                    class="font-bold text-red-600"></span> dengan email <span id="modalEmail"
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
        function showDeleteModal(id, name, email) {
            const modal = document.getElementById('globalDeleteModal');
            const nameSpan = document.getElementById('modalUserName');
            const emailSpan = document.getElementById('modalEmail');
            const deleteForm = document.getElementById('deleteForm');

            // Set nama kelas ke dalam modal
            nameSpan.textContent = name;
            emailSpan.textContent = email;

            // Set form action
            deleteForm.action = `/user/${id}`;

            // Tampilkan modal
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('globalDeleteModal').classList.add('hidden');
        }

        // Perbaikan untuk Real-Time Search pada halaman User

        class RealTimeTableSearch {
            constructor(config) {
                this.tableSelector = config.tableSelector || 'table tbody';
                this.searchInputId = config.searchInputId || 'searchInput';
                this.filterSelectId = config.filterSelectId || 'filterSelect';
                this.sortSelectId = config.sortSelectId || 'sortSelect';
                this.clearButtonId = config.clearButtonId || 'clearFilters';
                this.resultCountId = config.resultCountId || 'resultCount';
                this.totalCountId = config.totalCountId || 'totalCount';

                this.pageType = config.pageType;
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
                if (!tbody) {
                    console.error('Table tbody not found');
                    return;
                }

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

                console.log(`Cached ${this.allRows.length} rows for search`);
            }

            addRowDataAttributes(row) {
                const cells = row.querySelectorAll('td');

                if (this.pageType === 'user') {
                    if (cells.length >= 10) {
                        // Mapping berdasarkan struktur tabel user Anda
                        row.setAttribute('data-name', cells[2].textContent.trim().toLowerCase());
                        row.setAttribute('data-username', cells[3].textContent.trim().toLowerCase());
                        row.setAttribute('data-email', cells[4].textContent.trim().toLowerCase());
                        row.setAttribute('data-kelas', cells[5].textContent.trim().toLowerCase());
                        row.setAttribute('data-role', cells[6].textContent.trim().toLowerCase());
                        row.setAttribute('data-isguru', cells[7].textContent.trim().toLowerCase());
                        row.setAttribute('data-created-at', cells[8].textContent.trim());
                        row.setAttribute('data-updated-at', cells[9].textContent.trim());
                    }
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
                if (!sortValue) return;

                const [sortField, sortOrder] = sortValue.split(':');

                this.filteredRows.sort((a, b) => {
                    let aVal = a.getAttribute(`data-${sortField}`) || '';
                    let bVal = b.getAttribute(`data-${sortField}`) || '';

                    // Handle different data types
                    if (sortField.includes('created-at') || sortField.includes('updated-at')) {
                        aVal = new Date(aVal).getTime() || 0;
                        bVal = new Date(bVal).getTime() || 0;
                    } else {
                        aVal = aVal.toLowerCase();
                        bVal = bVal.toLowerCase();
                    }

                    if (sortOrder === 'desc') {
                        return bVal > aVal ? 1 : bVal < aVal ? -1 : 0;
                    } else {
                        return aVal > bVal ? 1 : aVal < bVal ? -1 : 0;
                    }
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
                    row.className = row.className.replace(/bg-(white|gray-50)/g, '');
                    if (index % 2 === 0) {
                        row.className += ' bg-white';
                    } else {
                        row.className += ' bg-gray-50';
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
                        const colspan = this.allRows[0]?.querySelectorAll('td').length || 11;
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

        // Fungsi untuk inisialisasi pencarian User
        function initUserSearch() {
            // Tunggu sampai DOM selesai dimuat
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    createUserSearch();
                });
            } else {
                createUserSearch();
            }
        }

        function createUserSearch() {
            const userSearch = new RealTimeTableSearch({
                tableSelector: 'table tbody',
                searchInputId: 'searchInput',
                filterSelectId: 'filterSelect',
                sortSelectId: 'sortSelect',
                clearButtonId: 'clearFilters',
                resultCountId: 'resultCount',
                totalCountId: 'totalCount',
                pageType: 'user',
                searchableColumns: ['name', 'username', 'email', 'kelas', 'role'],
                filterOptions: [{
                        value: 'role:admin',
                        label: 'Admin'
                    },
                    {
                        value: 'role:user',
                        label: 'User'
                    },
                    {
                        value: 'isguru:1',
                        label: 'Guru'
                    },
                    {
                        value: 'isguru:0',
                        label: 'Siswa'
                    }
                ],
                sortOptions: [{
                        value: 'name:asc',
                        label: 'Nama (A-Z)'
                    },
                    {
                        value: 'name:desc',
                        label: 'Nama (Z-A)'
                    },
                    {
                        value: 'email:asc',
                        label: 'Email (A-Z)'
                    },
                    {
                        value: 'email:desc',
                        label: 'Email (Z-A)'
                    },
                    {
                        value: 'created-at:desc',
                        label: 'Terbaru'
                    },
                    {
                        value: 'created-at:asc',
                        label: 'Terlama'
                    }
                ]
            });

            console.log('User search initialized successfully');
        }

        // Panggil fungsi inisialisasi
        initUserSearch();
    </script>


</x-layout>
