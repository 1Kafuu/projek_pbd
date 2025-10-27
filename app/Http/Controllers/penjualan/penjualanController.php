<?php

namespace App\Http\Controllers\penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class penjualanController extends Controller
{
    public function getPenjualan() {
        $result = DB::select("SELECT * FROM datapenjualan");
        return view('admin.transaksi.penjualan', compact('result'));
    }
}
