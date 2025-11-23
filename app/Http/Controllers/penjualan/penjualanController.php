<?php

namespace App\Http\Controllers\penjualan;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class penjualanController extends Controller
{
    public function getPenjualan()
    {
        $result = DB::select("SELECT * FROM datapenjualan ORDER BY NO_PENJUALAN DESC");
        return view('admin.transaksi.penjualan', compact('result'));
    }

    public function getBarang()
    {
        $data = DB::select("
            SELECT DISTINCT d.* 
            FROM databarang d
            INNER JOIN datakartustok k ON d.NO_BARANG = k.NO_BARANG
            WHERE d.STATUS_BARANG = '1'
            AND k.NO_KARTU_STOK = (
                SELECT MAX(NO_KARTU_STOK) 
                FROM datakartustok k2 
                WHERE k2.NO_BARANG = d.NO_BARANG
            )
            AND k.SALDO_AKHIR > 0
        ");
        return $data;
    }

    public function createPenjualan()
    {
        $barang = $this->getBarang();
        return view('admin.transaksi.penjualan_crud.create', compact('barang'));
    }

    public function storePenjualan(Request $request)
    {
        $request->validate([
            'barang' => 'required|array',
            'barang.*' => 'required',
            'harga_satuan' => 'required|array',
            'harga_satuan.*' => 'required',
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

            $margin = DB::select("SELECT * FROM margin_penjualan WHERE `status` = 1");

            // Insert data penjualan
            $create = DB::statement("INSERT INTO penjualan (created_at, iduser, idmargin_penjualan) VALUES (NOW(), ?, ?)", [
                $penanggungjawab,
                $margin[0]->idmargin_penjualan
            ]);

            if (!$create) {
                throw new Exception('Penjualan gagal dibuat');
            }

            $n = count($request->barang);
            for ($i = 0; $i < $n; $i++) {
                $insert = DB::statement("CALL buatPenjualan(?, ?, ?)", [
                    $request->barang[$i],
                    $request->jumlah[$i],
                    $request->harga_satuan[$i]
                ]);

                if (!$insert) {
                    throw new Exception('Penerimaan gagal dibuat');
                }
            }

            DB::commit();
            return redirect()->route('penjualan')->with('success', 'Penerimaan berhasil dibuat');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('penjualan')->with('error', $e->getMessage());
        }
    }

    public function getPenjualanbyID($id)
    {
        $data = DB::select("SELECT * FROM datapenjualan_full WHERE NO_PENJUALAN = ?", [$id]);

        return $data;
    }

    public function detailPenjualan($id)
    {
        $result = $this->getPenjualanbyId($id);

        if ($result !== []) {
            $result_detail = $result[0];
            $detail = [];

            foreach ($result as $barang) {
                $detail[] = [
                    'NAMA_BARANG' => $barang->NAMA_BARANG,
                    'HARGA_JUAL' => $barang->HARGA_JUAL,
                    'JUMLAH' => $barang->JUMLAH_JUAL,
                    'SUBTOTAL_JUAL' => $barang->SUBTOTAL_JUAL
                ];
            }

            return view('admin.transaksi.penjualan_crud.detail', compact('detail', 'result_detail'));
        }

        return redirect()->route('penjualan')->with('error', 'Detail penjualan tidak ditemukan');
    }
}
