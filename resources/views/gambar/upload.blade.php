<h2>Upload Gambar</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('gambar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nama" placeholder="Nama gambar" required>
    <input type="file" name="gambar" required>
    <button type="submit">Upload</button>
</form>

<p><a href="{{ route('gambar.index') }}">Lihat Daftar Gambar</a></p>
