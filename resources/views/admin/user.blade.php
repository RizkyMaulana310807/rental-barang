<x-layout>
    <x-slot:title>User</x-slot:title>
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
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                        Password</th>
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
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->class }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->role }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->isGuru }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->password }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b">{{ $item->created_at }}</td>
                            <td class="px-6 py-4 whitespaqce-nowrap border-b">{{ $item->updated_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b bg-white sticky right-0 z-10">
                                <div class="flex space-y-2 gap-4">
                                    <a href="{{ route('user.edit', ['id' => $item->id]) }}"
                                        class="bg-white hover:bg-blue-500 text-blue-500 hover:text-white border-2 border-blue-500 font-bold py-2 px-4 rounded hover:rounded-md flex items-center transition-all duration-200 ease-in-out">
                                        <i class="fas fa-pen-to-square mr-2"></i> Edit
                                    </a>
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-white text-white hover:text-red-500 hover:border-red-500 border-2 border-transparent font-bold py-2 px-4 rounded flex items-center transition-all duration-200 ease-in-out">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
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

</x-layout>
