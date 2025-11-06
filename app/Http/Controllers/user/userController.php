<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function getuser()
    {   
        $result = DB::select("SELECT * from datauser ORDER BY NAMA_ROLE ASC");
        return view('admin.master.datauser', compact('result'));
    }

    public function getRole() {
        $roles = DB::select("SELECT * FROM datarole");

        return $roles;
    }

    public function createUser() {
        $roles = $this->getRole();

        return view('admin.master.user_crud.create', compact('roles'));
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

    public function getUserbyID($id) {
        $roles = $this->getRole();
        $data = DB::select("SELECT * FROM datauser WHERE ID_USER = ?", [$id]);
        $data = $data[0];
        
        return view('admin.master.user_crud.update', compact('data', 'roles'));
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
        
        return redirect()->route('datauser')->with('success', 'User updated succesfully');
    }
}
