<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;

class PeminjamanController extends Controller
{

    public function index()
    {
        $barangs = Barang::all();
        $user = User::all();
        return view('transaksi.create', compact('barangs', 'user'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'barang_id' => 'required|exists:barang,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after_or_equal:jam_mulai',
        ]);

        // Cek stok barang
        $barang = Barang::findOrFail($request->barang_id);
        if ($barang->stock <= 0) {
            return back()->withErrors(['barang_id' => 'Stok barang tidak mencukupi.'])->withInput();
        }

        $id_user = $request->filled('user_id') ? $request->user_id : Auth::id();

        Peminjaman::create([
            'id_user' => $id_user,
            'id_barang' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'dipinjam', // Atau sesuai logikamu
        ]);

        // Kurangi stok barang
        $barang->decrement('stock');

        return redirect()->route(
            Auth::user()->role === 'admin' ? 'dipinjam' : 'home'
        )->with('success', 'Peminjaman berhasil diajukan!');
    }

    public function create(Barang $barang)
    {
        return view('formTransaksi', ['barang' => $barang]);
    }


    public function destroy($id)
    {

        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $transaksi = Peminjaman::findOrFail($id);
            $transaksi->delete();

            return redirect()->route('transaksi')->with('success', 'Barang dan gambar berhasil dihapus.');
        } else {
            return view('home');
        }
    }


    // PeminjamanController.php

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->tanggal_pinjam = Carbon::parse($peminjaman->tanggal_pinjam);
        $peminjaman->tanggal_kembali = Carbon::parse($peminjaman->tanggal_kembali);
        $peminjaman->jam_mulai = Carbon::parse($peminjaman->jam_mulai)->format('H:i');
        $peminjaman->jam_selesai = Carbon::parse($peminjaman->jam_selesai)->format('H:i');

        $barangs = Barang::all();
        $users = User::all(); // Jika perlu memilih user

        return view('transaksi.edit', compact('peminjaman', 'barangs', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after_or_equal:jam_mulai',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'id_user' => $request->user_id ?? Auth::id(),
            'id_barang' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route(Auth::user()->role === 'admin' ? 'transaksi' : 'home')
            ->with('success', 'Peminjaman berhasil diperbarui!');
    }

    public function kembalikan(Request $request, $id)
    {
        try {
            // Ambil data transaksi berdasarkan ID
            $transaction = Peminjaman::findOrFail($id);

            // Validasi data deadline
            if (empty($transaction->tanggal_kembali) || empty($transaction->jam_selesai)) {
                return redirect()->back()->with('error', 'Data deadline tidak tersedia atau tidak lengkap.');
            }

            // Gunakan waktu saat ini untuk pengembalian
            $waktu_kembali = now();
            $deadline = Carbon::parse($transaction->tanggal_kembali . ' ' . $transaction->jam_selesai);

            // Bandingkan waktu kembali vs deadline
            $status = $waktu_kembali->greaterThan($deadline) ? 'terlambat' : 'dikembalikan';

            // Update data transaksi
            $transaction->update([
                'jam_dikembalikan' => $waktu_kembali->format('H:i:s'),
                'status' => $status,
                'updated_at' => $waktu_kembali
            ]);

            return redirect()->back()->with('success', 'Barang berhasil dikembalikan pada ' . $waktu_kembali->format('H:i'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
