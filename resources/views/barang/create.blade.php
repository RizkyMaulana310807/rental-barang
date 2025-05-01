<h2>Tambah Data Barang</h2>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nama Barang:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" required></textarea><br><br>

    <label>Stok:</label><br>
    <input type="number" name="stock" required><br><br>

    <label>Gambar:</label><br>
    <input type="file" name="gambar" required><br><br>

    <button type="submit">Simpan</button>
</form>


<a href="/">Home
</a>
