<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function getuser()
    {
        $result = DB::select("SELECT * from datauser");
        return view('admin.master.datauser', compact('result'));
    }

    public function createUser()
    {
        return view ('admin.master.user-crud.create');
    }
}
