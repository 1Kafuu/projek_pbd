<?php

namespace App\Http\Controllers\margin_penjualan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class marginPenjualanController extends Controller
{
    public function getMargin(Request $request) {
        $filter = $request->query('filter', 'active'); // default: aktif saja

        $whereClause = '';
        if ($filter === 'active') {
            $whereClause = "WHERE STATUS_MARGIN = '1'";
        }

        $result = DB::select("
        SELECT *, CASE 
            WHEN STATUS_MARGIN = 1 THEN  'Active'
            ELSE  'Inactive'
        END AS STATUS_MARGIN FROM datamargin
        $whereClause
        ORDER BY NO_MARGIN
    ");

        return view('admin.transaksi.margin_penjualan', compact('result', 'filter'));
    }

    public function getUser() {
        $result = DB::select("SELECT * FROM datauser");
        return $result;
    }

    public function createMargin() {
        $penanggungjawab = $this->getUser();
        return view('admin.transaksi.margin_crud.create', compact('penanggungjawab'));
    }

    public function setnonactive($id)
    {
        $result = DB::statement("UPDATE margin_penjualan SET status = 0 WHERE idmargin_penjualan != ?", [$id]);
        return $result;
        
    }

    public function storeMargin(Request $request) {
        $username = Auth::user()->username;

        $penanggungjawab = DB::select("SELECT iduser FROM user WHERE username = ?", [$username]);
        $penanggungjawab = $penanggungjawab[0]->iduser;
        
        $request->validate([
            'persen' => 'required|decimal:0,2',
            'status' => 'required|integer',
        ]);

        $check = DB::select("SELECT * FROM margin_penjualan WHERE persen = ?", [$request->persen]);

        if (count($check) > 0) {
            return back()->with('error', 'Margin already exists');
        }

        $result = DB::statement("INSERT INTO margin_penjualan (persen, iduser, `status`) VALUES (?, ?, ?)", [
            $request->persen,
            $penanggungjawab,
            $request->status
        ]);

        $idmargin = DB::select("SELECT idmargin_penjualan FROM margin_penjualan ORDER BY idmargin_penjualan DESC LIMIT 1");

        if ($request->status == 1) {
            $this->setnonactive($idmargin[0]->idmargin_penjualan);
        }

        return redirect()->route('margin')->with('success', 'Margin added succesfully');
    }

    public function getMarginbyID($id) {
        $result = DB::select("SELECT * FROM margin_penjualan WHERE idmargin_penjualan = ?", [$id]);
        $result = $result[0];
        return view('admin.transaksi.margin_crud.update', compact('result'));
    }

    public function updateMargin(Request $request, $id) {
        $request->validate([
            'persen' => 'required|decimal:0,2',
            'status' => 'required|integer',
        ]);

        $result = DB::statement("UPDATE margin_penjualan SET persen = ?, `status` = ? WHERE idmargin_penjualan = ?", [
            $request->persen,
            $request->status,
            $id
        ]);

        if ($request->status == 1) {
            $this->setnonactive($id);
        }
        
        return redirect()->route('margin')->with('success', 'Margin updated succesfully');
    }

    public function deleteMargin($id) {
        $result = DB::statement("DELETE FROM margin_penjualan WHERE idmargin_penjualan = ?", [$id]);
        return redirect()->route('margin')->with('success', 'Margin deleted succesfully');
    }

}
