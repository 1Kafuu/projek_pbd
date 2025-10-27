<?php

namespace App\Http\Controllers\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pengadaanController extends Controller
{
    public function getPengadaan() {
        $result = DB::select("SELECT * FROM datapengadaan");
        return view('admin.transaksi.pengadaan', compact('result'));
    }
}
