<?php

namespace App\Http\Controllers\retur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class returController extends Controller
{
    public function getRetur()
    {
        $result = DB::select("SELECT * FROM dataretur");
        return view('admin.transaksi.retur', compact('result'));
    }
}
