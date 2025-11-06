<?php

namespace App\Http\Controllers\barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class barangController extends Controller
{
    public function getBarang() {
        $result = DB::select("SELECT *, CASE WHEN STATUS_BARANG = '1' THEN 'Active' ELSE 'Inactive' END AS STATUS_BARANG, CASE WHEN JENIS_BARANG = 'B' THEN 'Barang' ELSE 'Jasa' END AS JENIS_BARANG from databarang ORDER BY NO_BARANG");
        return view('admin.master.databarang', compact('result'));
    }

    public function getSatuan() {
        $result = DB::select("SELECT * from datasatuan WHERE STATUS_SATUAN = '1'");
        
        return $result;
    }

    public function createBarang() {
        $satuan = $this->getSatuan();
        return view('admin.master.barang_crud.create', compact('satuan'));
    }

    public function storeBarang(Request $request) {
        $request->validate([
            'nama_barang' => 'required|string|min:2|max:255',
            'jenis_barang' => 'required|string|min:1|max:1',
            'harga' => 'required|integer',
            'status' => 'required|integer|in:1,2',
            'satuan' => 'required|exists:satuan,idsatuan',
        ]);

        $check = DB::select("SELECT * FROM databarang WHERE LOWER(nama_barang) = LOWER(?)", [$request->nama_barang]);

        if (count($check) > 0) {
            return back()->with('error', 'Barang already exists');
        }

        $result = DB::statement("INSERT INTO barang (nama, jenis, harga, `status`, idsatuan) VALUES (?, ?, ?, ?, ?)", [
            $request->nama_barang,
            $request->jenis_barang,
            $request->harga,
            $request->status,
            $request->satuan
        ]);

        return redirect()->route('databarang')->with('success', 'Barang added succesfully');
    }

    public function deleteBarang($id) {
        $result = DB::statement("DELETE FROM barang WHERE idbarang = ?", [$id]);
        return redirect()->route('databarang')->with('success', 'Barang deleted succesfully');
    }

    public function getBarangbyID($id) {
        $satuan = $this->getSatuan();
        $data = DB::select("SELECT * from barang WHERE idbarang = ?", [$id]);
        $data = $data[0];

        return view('admin.master.barang_crud.update', compact('data', 'satuan'));
    }

    public function updateBarang(Request $request, $id){
        $request->validate([
            'nama_barang' => 'required|string|min:2|max:255',
            'jenis_barang' => 'required|string|min:1|max:1',
            'harga' => 'required|integer',
            'status' => 'required|integer|in:1,2',
            'satuan' => 'required|exists:satuan,idsatuan',
        ]);

        $result = DB::statement("UPDATE barang SET nama = ?, jenis = ?, harga = ?, `status` = ?, idsatuan = ? WHERE idbarang = ?", [
            $request->nama_barang,
            $request->jenis_barang,
            $request->harga,
            $request->status,
            $request->satuan,
            $id
        ]);
        
        return redirect()->route('databarang')->with('success', 'Barang updated succesfully');
    }
}
