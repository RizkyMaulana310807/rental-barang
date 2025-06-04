<?php
namespace App\Exports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KelasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Kelas::select('id', 'nama_kelas', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Kelas',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }
}
