<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vendorController extends Controller
{
    public function getVendor() {
        $result = DB::select("SELECT * from datavendor");
        return view('admin.master.datavendor', compact('result'));
    }
}
