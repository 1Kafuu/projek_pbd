<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function getuser()
    {   $roles = DB::select("SELECT * FROM datarole");
        $result = DB::select("SELECT * from datauser ORDER BY NAMA_ROLE ASC");
        return view('admin.master.datauser', compact('result', 'roles'));
    }


    public function storeUser(Request $request)
    {
        // dd($request->all());
        
        $request->validate([
            'username' => 'required|string|min:2|max:255',
            'password' => 'required|string|min:8|max:255',
            'role' => 'required|exists:role,idrole',    
        ]);

        $result = DB::statement("INSERT INTO user (username, password, idrole) VALUES (?, ?, ?)", [
            $request->username,
            bcrypt($request->password),
            $request->role
        ]);
        
        return back()->with('success', 'User added succesfully');
    }

    public function deleteUser($id)
    {
        DB::statement("DELETE FROM user WHERE iduser = ?", [$id]);
        return back()->with('success', 'User deleted successfully');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|min:2|max:255',
            'role' => 'required|exists:role,idrole',    
        ]);

        $result = DB::statement("UPDATE user SET username = ?, idrole = ? WHERE iduser = ?", [
            $request->username,
            $request->role,
            $id
        ]);
        
        return back()->with('success', 'User updated succesfully');
    }
}
