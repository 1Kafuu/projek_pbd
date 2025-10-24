<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class roleController extends Controller
{
    public function getrole() {
        $result = DB::select("SELECT * from datarole");
        return view('admin.master.datarole', compact('result'));
    }
}
