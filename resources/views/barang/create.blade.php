<x-layout>
    <x-slot:title>Tambah Barang</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-indigo-800">Tambah Data Barang</h2>
            <a href="/"
                class="text-indigo-600 bg-white w-12 h-12 flex justify-center items-center rounded-lg border-2 border-transparent hover:border-white hover:text-white hover:bg-indigo-500 transition duration-300 group">
                <i class="fas fa-home fa-xl group-hover:fa-beat-fade text-current"></i>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-gray-700 mb-2">Nama Barang</label>
                            <input type="text" name="nama" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition h-32"></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Stok</label>
                            <input type="number" name="stock" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Gambar</label>
                            <div class="flex items-center justify-center w-full">
                                <label
                                    class="flex flex-col w-full border-2 border-dashed border-gray-300 hover:border-indigo-500 hover:bg-indigo-50 rounded-lg cursor-pointer transition"
                                    id="upload-container">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4"
                                        id="upload-content">
                                        <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" id="upload-icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-sm text-gray-500" id="upload-text">Klik untuk upload gambar</p>
                                    </div>
                                    <input type="file" name="gambar" required class="hidden" id="file-input"
                                        onchange="previewImage()">
                                </label>
                            </div>
                            <div id="image-preview" class="hidden mt-4">
                                <img id="preview-image" class="max-h-48 rounded-lg mx-auto">
                                <button type="button" onclick="removeImage()"
                                    class="mt-2 text-sm text-red-600 hover:text-red-800">Ganti gambar</button>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Simpan Barang
                        </button>
                    </form>
                </div>

                <div class="w-full md:w-1/2 bg-indigo-50 rounded-xl p-6 flex flex-col items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-plus fa-4x fa-bounce text-indigo-600 mx-auto"></i>
                        <h3 class="text-lg font-medium text-indigo-800 mt-4">Tambah Barang Baru</h3>
                        <p class="text-gray-600 mt-2">Isi formulir dengan detail barang yang ingin ditambahkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const fileInput = document.getElementById('file-input');
            const file = fileInput.files[0];
            const uploadContent = document.getElementById('upload-content');
            const uploadIcon = document.getElementById('upload-icon');
            const uploadText = document.getElementById('upload-text');
            const previewContainer = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview-image');

            if (file) {
                // Hide upload prompt
                uploadContent.classList.add('hidden');

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);

                // Change upload text to show filename
                uploadText.textContent = file.name;
                uploadIcon.classList.add('text-indigo-600');
                uploadIcon.classList.remove('text-gray-400');
            }
        }

        function removeImage() {
            const fileInput = document.getElementById('file-input');
            const uploadContent = document.getElementById('upload-content');
            const previewContainer = document.getElementById('image-preview');
            const uploadIcon = document.getElementById('upload-icon');
            const uploadText = document.getElementById('upload-text');

            // Reset file input
            fileInput.value = '';

            // Show upload prompt again
            uploadContent.classList.remove('hidden');
            previewContainer.classList.add('hidden');

            // Reset text and icon
            uploadText.textContent = 'Klik untuk upload gambar';
            uploadIcon.classList.remove('text-indigo-600');
            uploadIcon.classList.add('text-gray-400');
        }
    </script>
</x-layout>
