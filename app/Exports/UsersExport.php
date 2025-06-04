<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $users = User::with('kelas')->get();

        return $users->map(function ($user) {
            return [
                'ID'            => $user->id,
                'Name'          => $user->name,
                'Username'      => $user->username,
                'Email'         => $user->email,
                'Class ID'      => $user->class_id,
                'Kelas'         => $user->kelas->nama_kelas ?? '-', // relasi
                'Role'          => $user->role,
                'isGuru'        => $user->isGuru ? 'Ya' : 'Tidak',
                'Password'      => $user->password, // hati-hati, biasanya tidak disarankan
                'Remember Token'=> $user->remember_token,
                'Created At'    => $user->created_at,
                'Updated At'    => $user->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Username',
            'Email',
            'Class ID',
            'Kelas',
            'Role',
            'isGuru',
            'Password',
            'Remember Token',
            'Created At',
            'Updated At',
        ];
    }
}
