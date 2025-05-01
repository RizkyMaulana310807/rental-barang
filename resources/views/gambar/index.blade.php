<h2>Daftar Gambar</h2>

<p><a href="{{ route('gambar.uploadForm') }}">Upload Gambar Baru</a></p>

@foreach($data as $gambar)
    <div style="margin: 10px 0;">
        <p><strong>{{ $gambar->nama }}</strong></p>
        <img src="{{ asset('storage/' . $gambar->path) }}" width="200">
    </div>
@endforeach
