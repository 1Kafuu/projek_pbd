<?php

namespace App\Http\Controllers\satuan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class satuanController extends Controller
{
    public function getsatuan(Request $request) {
        $filter = $request->query('filter', 'active');

        $whereClause = '';
        if ($filter === 'active') {
            $whereClause = "WHERE STATUS_SATUAN = '1'";
        }

        $result = DB::select("
        SELECT *, CASE 
        WHEN STATUS_SATUAN = '1' THEN 'Active'
        ELSE 'Inactive' END AS STATUS_SATUAN from datasatuan
        $whereClause
        ORDER BY NO_SATUAN
    ");

        return view('admin.master.datasatuan', compact('result', 'filter'));
    }

    public function createsatuan() {
        return view('admin.master.satuan_crud.create');
    }

    public function storeSatuan(Request $request) {

        // dd($request->all());

        $request->validate([
            'satuan' => 'required|string|min:2|max:255',
            'status' => 'required|int',
        ]);

        $check = DB::select("SELECT * FROM datasatuan WHERE LOWER(nama_satuan) = LOWER(?)", [$request->satuan]);

        if (count($check) > 0) {
            return back()->with('error', 'Satuan already exists');
        }

        $result = DB::statement("INSERT INTO datasatuan (nama_satuan, status_satuan) VALUES (?, ?)", [
            $request->satuan,
            $request->status
        ]);

        return redirect()->route('datasatuan')->with('success', 'Satuan added succesfully');
    }

    public function deletesatuan($id) {
        $result = DB::statement("DELETE FROM datasatuan WHERE no_satuan = ?", [$id]);
        return redirect()->route('datasatuan')->with('success', 'Satuan deleted succesfully');
    }

    public function getSatuanbyID($id) {
        $data = DB::select("SELECT *, CASE WHEN STATUS_SATUAN = '1' THEN 'Active' ELSE 'Inactive' END AS STATUS_SATUAN FROM datasatuan WHERE no_satuan = ?", [$id]);
        $data = $data[0];
        return view('admin.master.satuan_crud.update', compact('data'));
    }

    public function updateSatuan(Request $request, $id) {
        // dd($request->all());
        $request->validate([
            'satuan' => 'required|string|min:2|max:255',
            'status' => 'required|integer|in:1,2',
        ]);

        $result = DB::statement("UPDATE datasatuan SET NAMA_SATUAN = ?, STATUS_SATUAN = ? WHERE NO_SATUAN = ?", [
            $request->satuan,
            $request->status,
            $id
        ]);
        
        return redirect()->route('datasatuan')->with('success', 'Satuan updated succesfully');
    }
}
