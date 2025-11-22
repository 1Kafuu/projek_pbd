<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vendorController extends Controller
{
    public function getVendor(Request $request) {
        $filter = $request->query('filter', 'active');

        $whereClause = '';
        if ($filter === 'active') {
            $whereClause = "WHERE STATUS_VENDOR = 'A'";
        }

        $result = DB::select("
        SELECT *, CASE WHEN STATUS_VENDOR = 'A' THEN 'Active' ELSE 'Inactive' END AS STATUS_VENDOR, CASE WHEN BADAN_HUKUM = 'Y' THEN 'Yes' ELSE 'No' END AS BADAN_HUKUM from datavendor
        $whereClause
        ORDER BY NO_VENDOR
    ");
        return view('admin.master.datavendor', compact('result', 'filter'));
    }

    public function createVendor() {
        return view('admin.master.vendor_crud.create');
    }

    public function storeVendor(Request $request) {

        $request->validate([
            'nama_vendor' => 'required|string|min:2|max:255',
            'badan_hukum' => 'required|string|min:1|max:1',
            'status' => 'required|string|min:1|max:1',
        ]);
        
        $check = DB::select("SELECT * FROM datavendor WHERE LOWER(nama_vendor) = LOWER(?)", [$request->nama_vendor]);

        if (count($check) > 0) {
            return back()->with('error', 'Vendor already exists');
        }

        $result = DB::statement("INSERT INTO datavendor (nama_vendor, badan_hukum, status_vendor) VALUES (?, ?, ?)", [
            $request->nama_vendor,
            $request->badan_hukum,
            $request->status
        ]);

        return redirect()->route('datavendor')->with('success', 'Vendor added succesfully');
    }

    public function deleteVendor($id) {
        DB::statement("DELETE FROM datavendor WHERE NO_VENDOR = ?", [$id]);
        return back()->with('success', 'Vendor deleted successfully');
    }

    public function getVendorbyID($id) {
        $data = DB::select("SELECT *, CASE WHEN STATUS_VENDOR = 'A' THEN 'Active' ELSE 'Inactive' END AS STATUS_VENDOR, CASE WHEN BADAN_HUKUM = 'Y' THEN 'Yes' ELSE 'No' END AS BADAN_HUKUM FROM datavendor WHERE NO_VENDOR = ?", [$id]);
        $data = $data[0];
        
        return view('admin.master.vendor_crud.update', compact('data'));  
    }

    public function updateVendor(Request $request, $id) {
        // dd($request->all());
        $request->validate([
            'nama_vendor' => 'required|string|min:2|max:255',
            'badan_hukum' => 'required|string|min:1|max:1',
            'status' => 'required|string|min:1|max:1',
        ]);

        $result = DB::statement("UPDATE datavendor SET NAMA_VENDOR = ?, BADAN_HUKUM = ?, STATUS_VENDOR = ? WHERE NO_VENDOR = ?", [
            $request->nama_vendor,
            $request->badan_hukum,
            $request->status,
            $id
        ]);
        
        return redirect()->route('datavendor')->with('success', 'Vendor updated succesfully');
    }
}
