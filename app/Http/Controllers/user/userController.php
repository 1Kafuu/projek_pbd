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

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:2|max:255',
            'password' => 'required|string|min:8|max:255'    
        ]);

        $result = DB::statement("CALL createuser(?, ?, 5)", [
            $request->username,
            bcrypt($request->password)  // Jika password perlu di-hash
        ]);
        
        return back()->with('success', 'User added succesfully');
    }
}
