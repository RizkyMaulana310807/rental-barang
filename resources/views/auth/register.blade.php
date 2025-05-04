<x-layout>
    <x-slot:title>Register</x-slot:title>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
        <div class="bg-white w-full max-w-5xl rounded-xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-5">
            <!-- Left Side (30%) -->
            <div class="hidden md:flex md:col-span-2 items-center justify-center bg-cover bg-center p-10"
                style="background-image: url('https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=600&q=80');">
                <div class="text-white">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Nucleus.svg/1200px-Nucleus.svg.png"
                        alt="Logo" class="w-12 mb-6">
                    <p class="text-xl font-semibold mb-3">"Simply all the tools that my team and I need."</p>
                    <p class="text-sm">Karen Yue<br><span class="text-xs">Director of Digital Marketing Technology</span>
                    </p>
                </div>
            </div>

            <!-- Right Side (70%) -->
            <div class="p-8 md:p-10 md:col-span-3 bg-white">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Create your account</h2>
                <p class="text-gray-600 mb-6 text-sm">Buat akun Anda untuk meminjam dan mengelola data dengan mudah.</p>

                <form action="#" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" placeholder="Nama lengkap"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Username</label>
                            <input type="text" placeholder="Username (Optional)"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Kelas <span
                                    class="text-red-500">*</span></label>
                            <select
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="" disabled selected>Pilih Kelas</option>
                                <option value="X RPL 1">X RPL 1</option>
                                <option value="X RPL 2">X RPL 2</option>
                                <option value="XI RPL 1">XI RPL 1</option>
                                <option value="XI RPL 2">XI RPL 2</option>
                                <option value="XII RPL 1">XII RPL 1</option>
                                <option value="XII RPL 2">XII RPL 2</option>
                                <!-- Tambahkan opsi kelas lainnya sesuai kebutuhan -->
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" placeholder="you@example.com"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" placeholder="Password" id="password"
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
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 text-sm">
                        <input type="checkbox" class="form-checkbox text-purple-600 rounded">
                        <span>Saya setuju dengan <a href="#" class="text-purple-600 hover:underline">syarat &
                                ketentuan</a></span>
                    </div>

                    <button type="submit"
                        class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">Buat
                        Akun</button>
                </form>

                <p class="text-sm text-center mt-6 text-gray-600">Sudah punya akun? <a href="#"
                        class="text-purple-600 hover:underline">Login</a></p>
            </div>
        </div>
    </div>
</x-layout>


<script>
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
