<x-layout>
    <x-slot:title>Edit Pengguna</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-indigo-800">Edit Pengguna</h2>
            <a href="/Dashboard/user"
                class="text-indigo-600 bg-white w-12 h-12 flex justify-center items-center rounded-lg border-2 border-transparent hover:border-white hover:text-white hover:bg-indigo-500 transition duration-300 group">
                <i class="fas fa-home fa-xl group-hover:fa-beat-fade text-current"></i>
            </a>
        </div>

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
        @elseif ($errors->has('error'))
            <div id="toast"
                class="fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
                {{ $errors->first() }}
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

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-1/2 space-y-6">
                    <form id="userEditForm" action="{{ route('user.update', ['id' => $user->id]) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-gray-700 mb-2">Nama</label>
                            <input type="text" id="name" name="name" required
                                value="{{ $user->name ?? 'User Mungkin Tidak Di Temukan' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                        </div>
                        <div>
                            <label for="username" class="block text-gray-700 mb-2">Username</label>
                            <input type="text" id="username" name="username" required
                                value="{{ $user->username ?? 'User Mungkin Tidak Di Temukan' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                value="{{ $user->email ?? 'User Mungkin Tidak Di Temukan' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                        </div>

                        <div>
                            <label for="class" class="block text-gray-700 mb-2">Kelas</label>
                            <select name="class_id"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="none" disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $user->class_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kelas }}
                                    </option>
                                @endforeach
                                <!-- Tambahkan opsi kelas lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div>
                            <label for="role" class="block text-gray-700 mb-2">Role</label>
                            <select id="role" name="role" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <option value="user" {{ isset($user) && $user->role == 'user' ? 'selected' : '' }}>
                                    User</option>
                                <option value="admin" {{ isset($user) && $user->role == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                            </select>
                        </div>

                        <div>
                            <label for="isGuru" class="block text-gray-700 mb-2">Apakah Guru?</label>
                            <select id="isGuru" name="isGuru" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <option value="0" {{ isset($user) && $user->isGuru == 0 ? 'selected' : '' }}>
                                    Bukan Guru</option>
                                <option value="1" {{ isset($user) && $user->isGuru == 1 ? 'selected' : '' }}>Guru
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="password" class="block text-gray-700 mb-2">Password</label>
                            <input type="password" id="password" name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
                        </div>

                        <button type="button" onclick="showEditModal()"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                            Edit Pengguna
                        </button>
                    </form>
                </div>





                <div class="w-full md:w-1/2 bg-indigo-50 rounded-xl p-6 flex flex-col items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-user-plus fa-4x fa-bounce text-indigo-600 mx-auto"></i>
                        <h3 class="text-lg font-medium text-indigo-800 mt-4">Edit Pengguna</h3>
                        <p class="text-gray-600 mt-2">Isi formulir dengan detail pengguna yang ingin diedit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-center">
            <h2 class="text-xl font-semibold mb-4">Konfirmasi edit</h2>
            <p class="mb-6">Apakah Anda yakin ingin Mengedit User <span id="modalUserName"
                    class="font-bold text-blue-600"></span>?</p>
            <div class="flex justify-center gap-4">
                <button onclick="submitEditForm()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Ya, Edit
                </button>
                <button onclick="closeEditModal()"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Batal
                </button>
            </div>
        </div>
    </div>


    <script>
        function showEditModal() {
            const modal = document.getElementById('confirmModal');
            const nameSpan = document.getElementById('modalUserName');
            const name = document.getElementById('name').value;
            nameSpan.textContent = name;
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function submitEditForm() {
            document.getElementById('userEditForm').submit();
        }
    </script>
</x-layout>
