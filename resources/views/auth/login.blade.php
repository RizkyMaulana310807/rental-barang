<x-layout>
    <x-slot:title>Login</x-slot:title>
    @if (session('error'))
        <div id="toast"
            class="fixed mt-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
               bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-lg 
               text-center z-50 w-[90%] max-w-md transition-opacity duration-500">
            <div class="flex items-center justify-center gap-2">
                <i class="fa-solid fa-square-xmark fa-bounce text-xl"></i>
                <span class="font-medium">{{ session('error') }}</span>
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
    @elseif(session('succes'))
        <div id="toast"
            class="fixed mt-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
           bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg 
           text-center z-50 w-[90%] max-w-md transition-opacity duration-500">
            <div class="flex items-center justify-center gap-2">
                <i class="fa-solid fa-square-check fa-bounce text-xl"></i>
                <span class="font-medium">{{ session('succes') }}</span>
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
                    <p class="text-xl font-semibold mb-3">"Simply all the tools that my team and I need."</p>
                    <p class="text-sm">Karen Yue<br><span class="text-xs">Director of Digital Marketing
                            Technology</span>
                    </p>
                </div>
            </div>

            <!-- Right Side (70%) -->
            <div class="p-8 md:p-10 md:col-span-3 bg-white">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Login</h2>
                <p class="text-gray-600 mb-6 text-sm">Login dengan akun Anda untuk meminjam barang dengan mudah.</p>

                <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" placeholder="you@example.com"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none"
                            required />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none pr-10"
                                required />

                            <button type="button" onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1 text-gray-500 hover:text-gray-700">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 text-sm">
                        <input type="checkbox" class="form-checkbox text-purple-600 rounded" name="remember"
                            id="remember">
                        <label class="text-gray-700" for="remember">Ingat saya</label>
                    </div>


                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">Login</button>
                </form>


                <p class="text-sm text-center mt-6 text-gray-600">Belum punya akun? <a href="/register"
                        class="text-purple-600 hover:underline">Daftar</a></p>
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
