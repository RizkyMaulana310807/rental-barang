<x-layout>
    <x-slot:title>testing</x-slot:title>
    <a href="/barang/create">Tambah barang
    </a>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($stocks as $stock)
            <x-card-barang :id="$stock->id" :name="$stock->nama" :description="$stock->deskripsi" :stock="$stock->stock" :imageUrl="asset('storage/' . $stock->img_path)" />
        @endforeach
    </div>
</x-layout>
