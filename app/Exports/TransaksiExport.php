<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class TransaksiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $transaksis = Peminjaman::with(['user', 'barang'])->get();

        return $transaksis->map(function ($trx) {
            return [
                'ID'                => $trx->id,
                'Nama User'         => $trx->user->name ?? '-',      // relasi ke user
                'Nama Barang'       => $trx->barang->nama_barang ?? '-', // relasi ke barang
                'Tanggal Pinjam'    => Carbon::parse($trx->tanggal_pinjam)->format('d-m-Y'),
                'Tanggal Kembali'   => Carbon::parse($trx->tanggal_kembali)->format('d-m-Y'),
                'Jam Mulai'         => $trx->jam_mulai,
                'Jam Selesai'       => $trx->jam_selesai,
                'Jam Dikembalikan'  => $trx->jam_dikembalikan ?? '-',
                'Status'            => ucfirst($trx->status),
                'Created At'        => Carbon::parse($trx->created_at)->format('d-m-Y H:i'),
                'Updated At'        => Carbon::parse($trx->updated_at)->format('d-m-Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama User',
            'Nama Barang',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Jam Mulai',
            'Jam Selesai',
            'Jam Dikembalikan',
            'Status',
            'Created At',
            'Updated At'
        ];
    }
}
