<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getuser() {
        $result = DB::select("SELECT * from datauser");
        return view('admin.datauser', compact('result'));
    }

}
