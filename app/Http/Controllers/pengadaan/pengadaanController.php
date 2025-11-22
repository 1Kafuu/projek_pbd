<?php

namespace App\Http\Controllers\pengadaan;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class pengadaanController extends Controller
{
    public function getPengadaan(Request $request)
    {
        $filter = $request->query('filter', 'proses'); // default: proses

        $whereClause = '';
        if ($filter === 'proses') {
            $whereClause = "WHERE STATUS_PENGADAAN = 'P' OR STATUS_PENGADAAN = 'S'";
        } elseif ($filter === 'batal') {
            $whereClause = "WHERE STATUS_PENGADAAN = 'B'";
        }

        $result = DB::select("SELECT *, 
        CASE 
            WHEN STATUS_PENGADAAN = 'P' THEN 'Process'
            WHEN STATUS_PENGADAAN = 'S' THEN 'Sebagian' 
            WHEN STATUS_PENGADAAN = 'C' THEN 'Selesai'
            WHEN STATUS_PENGADAAN = 'B' THEN 'Batal'
            ELSE 'Unknown'
        END AS STATUS_PENGADAAN 
    FROM datapengadaan
    $whereClause");

        return view('admin.transaksi.pengadaan', compact('result', 'filter'));
    }

    public function getPengadaanFull($id)
    {
        $result = DB::select("SELECT *, CASE WHEN STATUS_PENGADAAN = 'P' THEN 'Pending' ELSE 'Complete' END AS STATUS_PENGADAAN FROM datapengadaan_full WHERE NO_PENGADAAN = ?", [$id]);
        return view('admin.transaksi.pengadaan_crud.detail', compact('result'));
    }

    public function getVendor()
    {
        $result = DB::select("SELECT * FROM datavendor WHERE STATUS_VENDOR = 'A'");
        return $result;
    }

    public function getBarang($idvendor)
    {
        $barangs = DB::select("SELECT * FROM databarang WHERE NO_VENDOR = ?", [$idvendor]);
        return response()->json($barangs);
    }

    public function getPengadaanbyID($id)
    {
        $data = DB::select("SELECT *, CASE WHEN STATUS_PENGADAAN = 'P' THEN 'Pending' ELSE 'Complete' END AS STATUS_PENGADAAN FROM datapengadaan_full WHERE NO_PENGADAAN = ?", [$id]);

        return $data;
    }

    public function detailPengadaan($id)
    {
        $result = $this->getPengadaanbyID($id);
        if ($result !== []) {
            $result_detail = $result[0];
            $detail = [];

            foreach ($result as $barang) {
                $detail[] = [
                    'NAMA_BARANG' => $barang->NAMA_BARANG,
                    'HARGA_SATUAN' => $barang->HARGA_SATUAN,
                    'JUMLAH' => $barang->JUMLAH_BARANG,
                    'SUBTOTAL_BARANG' => $barang->SUBTOTAL_BARANG
                ];
            }

            return view('admin.transaksi.pengadaan_crud.detail', compact('detail', 'result_detail'));
        }

        return redirect()->route('pengadaan')->with('error', 'Detail pengadaan tidak ditemukan');
    }

    public function createPengadaan()
    {
        $vendors = $this->getVendor();

        return view('admin.transaksi.pengadaan_crud.create', compact('vendors'));
    }

    public function storePengadaan(Request $request)
    {
        $request->validate([
            'vendor' => 'required',
            'barang' => 'required|array',
            'barang.*' => 'required',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $username = Auth::user()->username;

            $penanggungjawab = DB::select("SELECT iduser FROM user WHERE username = ?", [$username]);

            if (empty($penanggungjawab)) {
                throw new Exception('User tidak ditemukan');
            }

            $penanggungjawab = $penanggungjawab[0]->iduser;

            // Insert data pengadaan
            $create = DB::statement("INSERT INTO pengadaan (timestamp, vendor_idvendor, user_iduser) VALUES (NOW(), ?, ?)", [
                $request->vendor,
                $penanggungjawab
            ]);

            if (!$create) {
                throw new Exception('Gagal membuat pengadaan');
            }

            // Insert detail barang
            $n = count($request->barang);

            for ($i = 0; $i < $n; $i++) {
                $insert = DB::statement("CALL buatPengadaan(?, ?)", [
                    $request->barang[$i],
                    $request->jumlah[$i]
                ]);

                if (!$insert) {
                    throw new Exception('Gagal menambahkan barang ke pengadaan');
                }
            }

            DB::commit();
            return redirect()->route('pengadaan')->with('success', 'Pengadaan berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('pengadaan')->with('error', 'Gagal menambahkan pengadaan: ' . $e->getMessage());
        }
    }

    public function cancelPengadaan($id)
    {
        $result = DB::statement("UPDATE pengadaan SET `status` = 'B' WHERE idpengadaan = ?", [$id]);
        return redirect()->route('pengadaan')->with('success', 'Pengadaan berhasil dibatalkan');
    }
}
