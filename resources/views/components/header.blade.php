<div class="bg-white w-full flex py-3 px-6 rounded-sm">
    <div class="w-1/2 flex text-center items-center">
        <ol>
            <li class="text-gray-700">{{ $header }}</li>
        </ol>
    </div>
    <div class="w-1/2 flex justify-end gap-6">
        <a href="{{ $download }}"
            class="bg-green-500 py-2 px-3 rounded-sm text-white font-bold border-2 border-transparent hover:bg-white hover:text-green-500 hover:border-green-500 transition-all duration-200 ease-in-out">Download data
            {{ $header }} <i class="fas fa-download fa-beat"></i></a>
            <a href="{{ $link }}"
            class="bg-blue-500 py-2 px-3 rounded-sm text-white font-bold border-2 border-transparent hover:bg-white hover:text-blue-500 hover:border-blue-500 transition-all duration-200 ease-in-out">Tambah
            {{ $header }} <i class="fas fa-plus fa-beat"></i></a>

    </div>
</div>


