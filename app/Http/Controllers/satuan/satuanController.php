<?php

namespace App\Http\Controllers\satuan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class satuanController extends Controller
{
    public function getsatuan() {
        $result = DB::select("SELECT * from datasatuan");
        return view('admin.datasatuan', compact('result'));
    }
}
