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
    </script>


</x-layout>
