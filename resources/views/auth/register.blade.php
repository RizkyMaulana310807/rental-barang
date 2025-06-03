<x-layout>
    <x-slot:title>Register</x-slot:title>

    @if ($errors->any())
        <div id="toast"
            class="fixed mt-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
       bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-lg 
       text-center z-50 w-[90%] max-w-md transition-opacity duration-500">
            <div class="flex items-center justify-center gap-2">
                <i class="fa-solid fa-square-xmark fa-bounce text-xl"></i>
                <span class="font-medium">
                    {{ $errors->first() }}
                </span>
            </div>
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


    <div class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
        <div class="bg-white w-full max-w-5xl rounded-xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-5">
            <!-- Left Side (30%) -->
            <div class="hidden md:flex md:col-span-2 items-center justify-center bg-cover bg-center p-10"
                style="background-image: url('images/Hotel Saudade.jpeg');">
                <div class="text-white">
                    <img src="images/logosmkrembg.png" alt="Logo" class="w-12 mb-6">
                    <p class="text-xl font-semibold mb-3">"Barang elektronik yang anda butuhkanz"</p>
                    <p class="text-sm">Karen Yue<br><span class="text-xs">CodeX Technology</span>
                    </p>
                </div>
            </div>

            <!-- Right Side (70%) -->
            <div class="p-8 md:p-10 md:col-span-3 bg-white">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Create your account</h2>
                <p class="text-gray-600 mb-6 text-sm">Buat akun Anda untuk meminjam dan mengelola data dengan mudah.</p>

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" placeholder="Nama lengkap"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Username</label>
                            <input type="text" name="username" placeholder="Username (Optional)"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Kelas <span
                                    class="text-red-500">*</span></label>
                            <select name="kelas"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="none" disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                                <!-- Tambahkan opsi kelas lainnya sesuai kebutuhan -->
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="you@example.com"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password" placeholder="Password" id="password"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none pr-10" />
                            <button type="button" onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1 text-gray-500 hover:text-gray-700 border border-gray-500 p-4 rounded-r-lg bg-gray-100">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Konfirmasi Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" placeholder="Ulangi password" id="confirmPassword"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none pr-10" />
                            <button type="button" onclick="togglePassword('confirmPassword')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1 text-gray-500 hover:text-gray-700 border border-gray-500 p-4 rounded-r-lg bg-gray-100">
                                <i class="far fa-eye"></i>
                            </button>
                            <p id="confirmMessage" class="text-sm mt-1 text-red-500 hidden">Password tidak cocok.</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 text-sm">
                        <input id="sdk" name="sdk" type="checkbox"
                            class="form-checkbox text-purple-600 rounded">
                        <label class="text-gray-700" for="sdk">Saya setuju dengan <a href="#"
                                class="text-purple-600 hover:underline">syarat &
                                ketentuan</a></label>
                    </div>

                    <button type="submit"
                        class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-white hover:border-purple-700 hover:text-purple-700 border-2 border-transparent font-bold transition-all duration-200 ease-in-out">Buat
                        Akun</button>
                </form>

                <p class="text-sm text-center mt-6 text-gray-600">Sudah punya akun? <a href="/login"
                        class="text-purple-600 hover:underline">Login</a></p>
            </div>
        </div>
    </div>
</x-layout>


<script>
    const confirmPassword = document.getElementById('confirmPassword');
    const confirmMessage = document.getElementById('confirmMessage');

    confirmPassword.addEventListener('input', () => {
        const password = document.getElementById('password').value;
        const confirm = confirmPassword.value;

        if (confirm !== password) {
            confirmPassword.classList.add('ring', 'ring-red-500');
            confirmMessage.classList.remove('hidden');
            confirmMessage.textContent = 'Password tidak cocok.';
        } else {
            confirmPassword.classList.remove('ring', 'ring-red-500');
            confirmMessage.classList.add('hidden');
            confirmMessage.textContent = '';
        }
    });

    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');

        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
