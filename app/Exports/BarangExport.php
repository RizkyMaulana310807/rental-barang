<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class BarangExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Barang::all()->map(function ($barang) {
            return [
                'ID'          => $barang->id,
                'Nama'        => $barang->nama,
                'Deskripsi'   => $barang->deskripsi,
                'Stock'       => $barang->stock,
                'Gambar Path' => $barang->img_path,
                'Dibuat Pada' => Carbon::parse($barang->created_at)->format('d-m-Y H:i'),
                'Diupdate Pada' => Carbon::parse($barang->updated_at)->format('d-m-Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Deskripsi',
            'Stock',
            'Gambar Path',
            'Dibuat Pada',
            'Diupdate Pada'
        ];
    }
}
