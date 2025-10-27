<?php

namespace App\Http\Controllers\margin_penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class marginPenjualanController extends Controller
{
    public function getMargin() {
        $result = DB::select("SELECT * FROM datamargin");
        return view('admin.transaksi.margin_penjualan', compact('result'));
    }
}
