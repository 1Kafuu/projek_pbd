<?php

namespace App\Http\Controllers\penerimaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class penerimaanController extends Controller
{
    public function getPenerimaan() {
        $result = DB::select("SELECT * FROM datapenerimaan");
        return view('admin.transaksi.penerimaan', compact('result'));
    }
}
