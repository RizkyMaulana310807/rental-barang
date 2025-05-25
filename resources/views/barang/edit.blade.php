<x-layout>
    <x-slot:title>Edit Barang</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-indigo-800">Edit Data Barang</h2>
            <a href="/Dashboard/barang"
                class="text-indigo-600 bg-white w-12 h-12 flex justify-center items-center rounded-lg border-2 border-transparent hover:border-white hover:text-white hover:bg-indigo-500 transition duration-300 group">
                <i class="fas fa-home fa-xl group-hover:fa-beat-fade text-current"></i>
            </a>
        </div>

        {{-- Notifikasi --}}
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
                }, 3000);
            </script>
        @elseif ($errors->any())
            <div id="toast"
                class="fixed top-4 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg transition-opacity duration-500">
                Tidak ada data yang di ubah
            </div>
            <script>
                setTimeout(() => {
                    const toast = document.getElementById('toast');
                    if (toast) {
                        toast.style.opacity = '0';
                        setTimeout(() => toast.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-1/2 space-y-6">
                    <form id="barangEditForm" action="{{ route('barang.update', $barang->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-gray-700 mb-2">Nama Barang</label>
                            <input type="text" name="nama" value="{{ old('nama', $barang->nama) }}" required
                                class="w-full px-4 py-2 border @error('nama') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            @error('nama')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" required
                                class="w-full px-4 py-2 border @error('deskripsi') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition h-32">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Stok</label>
                            <input type="number" name="stock" value="{{ old('stock', $barang->stock) }}" required
                                class="w-full px-4 py-2 border @error('stock') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            @error('stock')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Gambar</label>
                            
                            {{-- Tampilkan gambar yang sudah ada --}}
                            @if($barang->img_path)
                            <div id="current-image" class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                <div class="flex items-center gap-4">
                                    <img class="w-24 h-24 object-cover rounded-lg border" 
                                         src="{{ asset('storage/' . $barang->img_path) }}" 
                                         alt="{{ $barang->nama }}">
                                    <button type="button" onclick="showUploadArea()" 
                                            class="text-sm text-indigo-600 hover:text-indigo-800 underline">
                                        Ganti gambar
                                    </button>
                                </div>
                            </div>
                            @endif

                            {{-- Area upload gambar --}}
                            <div class="flex items-center justify-center w-full" 
                                 id="upload-area" 
                                 @if($barang->img_path) style="display: none;" @endif>
                                <label for="file-input"
                                    class="flex flex-col w-full border-2 border-dashed @error('gambar') border-red-500 @else border-gray-300 @enderror hover:border-indigo-500 hover:bg-indigo-50 rounded-lg cursor-pointer transition"
                                    id="upload-container">
                                    <!-- Konten upload default -->
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4"
                                        id="upload-content">
                                        <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" id="upload-icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-sm text-gray-500" id="upload-text">Klik untuk upload gambar baru</p>
                                        <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG</p>
                                    </div>

                                    <!-- Preview gambar baru (awalnya hidden) -->
                                    <div id="image-preview"
                                        class="hidden w-full flex flex-col items-center justify-center p-4">
                                        <img id="preview-image" class="w-48 h-48 object-cover rounded border" src=""
                                            alt="Preview Gambar">
                                        <div class="mt-3 flex gap-2">
                                            <button type="button" onclick="removeNewImage()"
                                                class="text-sm text-red-600 hover:text-red-800 px-3 py-1 border border-red-300 rounded hover:bg-red-50">
                                                Hapus
                                            </button>
                                            <button type="button" onclick="changeImage()"
                                                class="text-sm text-indigo-600 hover:text-indigo-800 px-3 py-1 border border-indigo-300 rounded hover:bg-indigo-50">
                                                Ganti
                                            </button>
                                        </div>
                                    </div>

                                    <input type="file" name="gambar" class="hidden" id="file-input"
                                        onchange="previewImage()" accept=".jpg,.jpeg,.png" />
                                </label>
                            </div>
                            
                            @if($barang->img_path)
                            <div class="mt-2">
                                <button type="button" onclick="cancelImageChange()" id="cancel-change-btn" 
                                        class="text-sm text-gray-600 hover:text-gray-800 underline" 
                                        style="display: none;">
                                    Batalkan perubahan gambar
                                </button>
                            </div>
                            @endif
                            
                            @error('gambar')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="button" onclick="showConfirmModal()"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                <div class="w-full md:w-1/2 bg-indigo-50 rounded-xl p-6 flex flex-col items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-edit fa-4x fa-bounce text-indigo-600 mx-auto"></i>
                        <h3 class="text-lg font-medium text-indigo-800 mt-4">Edit Barang</h3>
                        <p class="text-gray-600 mt-2">Ubah detail barang sesuai kebutuhan dan simpan perubahan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi --}}
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md text-center">
            <h2 class="text-xl font-semibold mb-4">Konfirmasi Simpan Perubahan</h2>
            <p class="mb-6">Apakah Anda yakin ingin menyimpan perubahan barang <span id="modalBarangName"
                    class="font-bold text-blue-600"></span>?</p>
            <div class="flex justify-center gap-4">
                <button onclick="submitForm()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Ya, Simpan
                </button>
                <button onclick="closeConfirmModal()"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan area upload
        function showUploadArea() {
            document.getElementById('current-image').style.display = 'none';
            document.getElementById('upload-area').style.display = 'block';
            document.getElementById('cancel-change-btn').style.display = 'inline';
            
            // Reset file input dan preview
            resetImageUpload();
        }

        // Fungsi untuk membatalkan perubahan gambar dan kembali ke gambar asli
        function cancelImageChange() {
            document.getElementById('current-image').style.display = 'block';
            document.getElementById('upload-area').style.display = 'none';
            document.getElementById('cancel-change-btn').style.display = 'none';
            
            // Reset file input dan preview
            resetImageUpload();
        }

        // Fungsi untuk reset upload area
        function resetImageUpload() {
            const fileInput = document.getElementById('file-input');
            const uploadContent = document.getElementById('upload-content');
            const previewContainer = document.getElementById('image-preview');
            
            fileInput.value = '';
            previewContainer.classList.add('hidden');
            uploadContent.classList.remove('hidden');
        }

        // Fungsi untuk preview gambar baru
        function previewImage() {
            const fileInput = document.getElementById('file-input');
            const file = fileInput.files[0];
            const uploadContent = document.getElementById('upload-content');
            const previewContainer = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview-image');

            if (file) {
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.');
                    fileInput.value = '';
                    return;
                }

                // Cek ukuran file (maksimal 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    fileInput.value = '';
                    return;
                }

                // Sembunyikan konten upload
                uploadContent.classList.add('hidden');

                // Tampilkan preview
                previewContainer.classList.remove('hidden');

                // Update preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        // Fungsi untuk menghapus gambar baru dan kembali ke upload
        function removeNewImage() {
            resetImageUpload();
        }

        // Fungsi untuk mengganti gambar (trigger file input lagi)
        function changeImage() {
            document.getElementById('file-input').click();
        }

        // Fungsi untuk menampilkan modal konfirmasi
        function showConfirmModal() {
            const modal = document.getElementById('confirmModal');
            const nameSpan = document.getElementById('modalBarangName');
            const name = document.querySelector('input[name="nama"]').value;
            nameSpan.textContent = name;
            modal.classList.remove('hidden');
        }

        // Fungsi untuk menutup modal konfirmasi
        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        // Fungsi untuk submit form
        function submitForm() {
            document.getElementById('barangEditForm').submit();
        }

        // Event listener untuk menutup modal saat klik di luar modal
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeConfirmModal();
            }
        });

        // Drag and drop functionality
        const uploadArea = document.getElementById('upload-container');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            uploadArea.classList.add('border-indigo-500', 'bg-indigo-50');
        }

        function unhighlight(e) {
            uploadArea.classList.remove('border-indigo-500', 'bg-indigo-50');
        }

        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                document.getElementById('file-input').files = files;
                previewImage();
            }
        }
    </script>
</x-layout>