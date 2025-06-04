<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Exports\KelasExport;
use App\Exports\TransaksiExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ExportController extends Controller
{
    public function ExportUser()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $filename = 'USR_' . Carbon::now()->format('Ymd_His') . '_data_users.xlsx';
            return Excel::download(new UsersExport, $filename);
        } else{
            return redirect()->route('404');
        }
    }

    public function ExportBarang()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $filename = 'BRG_' . Carbon::now()->format('Ymd_His') . '_data_barang.xlsx';
            return Excel::download(new BarangExport, $filename);
        } else{
            return redirect()->route('404');
        }
    }

    public function ExportTransaksi()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $filename = 'TRX_' . Carbon::now()->format('Ymd_His') . '_data_transaksi.xlsx';
            return Excel::download(new TransaksiExport, $filename);
        } else{
            return redirect()->route('404');
        }
    }

    public function ExportKelas()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $filename = 'KLS_' . Carbon::now()->format('Ymd_His') . '_data_kelas.xlsx';
            return Excel::download(new KelasExport, $filename);
        } else{
            return redirect()->route('404');
        }
    }
}
