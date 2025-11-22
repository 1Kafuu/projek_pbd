<?php

namespace App\Http\Controllers\penerimaan;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class penerimaanController extends Controller
{
    public function getPenerimaan() {
        $result = DB::select("SELECT *, CASE 
            WHEN STATUS = 'P' THEN 'Process'
            WHEN STATUS = 'S' THEN 'Sebagian' 
            WHEN STATUS = 'C' THEN 'Selesai'
            WHEN STATUS = 'B' THEN 'Batal'
            ELSE 'Unknown'
        END AS STATUS
        FROM datapenerimaan");

        $pengadaan = $this->getPengadaan();

        return view('admin.transaksi.penerimaan', compact('result', 'pengadaan'));
    }

    public function getPengadaan() {
        $result = DB::select("SELECT *, 
        CASE 
            WHEN STATUS_PENGADAAN = 'P' THEN 'Process'
            WHEN STATUS_PENGADAAN = 'S' THEN 'Sebagian' 
            WHEN STATUS_PENGADAAN = 'C' THEN 'Selesai'
            WHEN STATUS_PENGADAAN = 'B' THEN 'Batal'
            ELSE 'Unknown'
        END AS STATUS_PENGADAAN 
        FROM datapengadaan
        WHERE STATUS_PENGADAAN IN('P', 'S')");

        return $result;
    }

    public function createPenerimaan($id) {
        $pengadaan = DB::select("SELECT NO_BARANG, NAMA_BARANG, JUMLAH_BARANG FROM datapengadaan_full WHERE NO_PENGADAAN = ?", [$id]);
        return view('admin.transaksi.penerimaan_crud.create', compact('pengadaan', 'id'));
    }

    public function storePenerimaan($id, Request $request) {
        $request->validate([
            'barang' => 'required|array',
            'barang.*' => 'required',
            'harga_satuan_terima' => 'required|array',
            'harga_satuan_terima.*' => 'required',
            'jumlah_terima' => 'required|array',
            'jumlah_terima.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $username = Auth::user()->username;

            $penanggungjawab = DB::select("SELECT iduser FROM user WHERE username = ?", [$username]);

            if (empty($penanggungjawab)) {
                throw new Exception('User tidak ditemukan');
            }

            $penanggungjawab = $penanggungjawab[0]->iduser;

            // Insert data penerimaan
            $create = DB::statement("INSERT INTO penerimaan (created_at, idpengadaan, iduser) VALUES (NOW(), ?, ?)", [
                $id,
                $penanggungjawab
            ]);

            if (!$create) {
                throw new Exception('Penerimaan gagal dibuat');
            }

            $n = count($request->barang);
            for ($i = 0; $i < $n; $i++) {
                $insert = DB::statement("CALL buatPenerimaan(?, ?, ?)", [
                    $request->barang[$i],
                    $request->jumlah_terima[$i],
                    $request->harga_satuan_terima[$i]
                ]);

                if (!$insert) {
                    throw new Exception('Penerimaan gagal dibuat');
                }
            }

            DB::commit();
            return redirect()->route('penerimaan')->with('success', 'Penerimaan berhasil dibuat');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('penerimaan')->with('error', $e->getMessage());
        }
    }
}
