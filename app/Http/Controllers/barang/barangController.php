<?php

namespace App\Http\Controllers\barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class barangController extends Controller
{
    public function getBarang() {
        $result = DB::select("SELECT * from databarang");
        return view('admin.databarang', compact('result'));
    }
}
