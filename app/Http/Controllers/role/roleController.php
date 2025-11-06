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

    public function createRole() {
        return view('admin.master.role_crud.create');
    }

    public function storeRole(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'nama_role' => 'required|string|min:2|max:255',
        ]);

        $check = DB::select("SELECT * FROM datarole WHERE LOWER(nama_role) = LOWER(?)", [$request->nama_role]);

        if (count($check) > 0) {
            return back()->with('error', 'Role already exists');
        }

        $result = DB::statement("INSERT INTO datarole (nama_role) VALUES (?)", [
            $request->nama_role,
        ]);

        return redirect()->route('datarole')->with('success', 'Role added succesfully');
    }

    public function deleteRole($id)
    {
        DB::statement("DELETE FROM datarole WHERE ROLE = ?", [$id]);
        return back()->with('success', 'User deleted successfully');
    }

    public function getRolebyID($id) {
        $data = DB::select("SELECT * FROM datarole WHERE ROLE = ?", [$id]);
        $data = $data[0];
        
        return view('admin.master.role_crud.update', compact('data'));  
    }
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required|string|min:2|max:255',
        ]);

        $result = DB::statement("UPDATE datarole SET NAMA_ROLE = ? WHERE ROLE = ?", [
            $request->nama_role,
            $id
        ]);
        
        return redirect()->route('datarole')->with('success', 'Role updated succesfully');
    }
}
