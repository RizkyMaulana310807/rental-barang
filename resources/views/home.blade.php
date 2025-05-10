<x-layout>
    <x-slot:title>Home</x-slot:title>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- @dd(count($stocks)) --}}
        @if (count($stocks) > 0)
            @foreach ($stocks as $stock)
                <x-card-barang :id="$stock->id" :name="$stock->nama" :description="$stock->deskripsi" :stock="$stock->stock"
                    :imageUrl="asset('storage/' . $stock->img_path)" />
            @endforeach
        @else
            <p class="text-sm text-gray-700">Tidak ada item yang tersedia</p>
        @endif
    </div>
</x-layout>
