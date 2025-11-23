<?php

namespace App\Http\Controllers\kartu_stok;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class kartuStokController extends Controller
{
    public function getStok()
    {
        // Ambil semua data
        $raw = DB::select("
        SELECT 
            NO_BARANG,
            NAMA_BARANG,
            CASE 
                WHEN JENIS_TRANSAKSI = 'A' THEN 'PENERIMAAN' 
                ELSE 'PENJUALAN' 
            END AS JENIS_TRANSAKSI,
            STOCK_MASUK,
            STOCK_KELUAR,
            JUMLAH_STOCK,
            TANGGAL_DIUPDATE,
            SALDO_AKHIR
        FROM datakartustok 
        ORDER BY NAMA_BARANG, TANGGAL_DIUPDATE ASC
    ");

        $groupBarang = [];

        foreach ($raw as $row) {
            $nama = $row->NAMA_BARANG;

            // Jika barang belum ada, buat entry baru
            if (!isset($groupBarang[$nama])) {
                $groupBarang[$nama] = [
                    'NO_BARANG'      => $row->NO_BARANG,
                    'NAMA_BARANG'    => $row->NAMA_BARANG,
                    'SALDO_AKHIR'    => $row->SALDO_AKHIR,        // akan di-update terus
                    'JUMLAH_STOCK'   => $row->JUMLAH_STOCK,       // update terus
                    'TANGGAL_TERAKHIR' => $row->TANGGAL_DIUPDATE, // update terus
                    'transaksi'      => []                        // nama lebih jelas
                ];
            }

            // Selalu tambahkan transaksi (detail)
            $groupBarang[$nama]['transaksi'][] = [
                'JENIS_TRANSAKSI' => $row->JENIS_TRANSAKSI,
                'STOCK_MASUK'     => $row->STOCK_MASUK ?? 0,
                'STOCK_KELUAR'    => $row->STOCK_KELUAR ?? 0,
                'JUMLAH_STOCK'    => $row->JUMLAH_STOCK,
                'TANGGAL_DIUPDATE' => $row->TANGGAL_DIUPDATE,
            ];

            // Update data summary (selalu ambil yang terbaru karena diurutkan ASC)
            $groupBarang[$nama]['SALDO_AKHIR'] = $row->SALDO_AKHIR;
            $groupBarang[$nama]['JUMLAH_STOCK'] = $row->JUMLAH_STOCK;
            $groupBarang[$nama]['TANGGAL_TERAKHIR'] = $row->TANGGAL_DIUPDATE;
        }

        // Ubah jadi array biasa (bukan associative) supaya @foreach lebih enak
        $groupBarang = array_values($groupBarang);

        return view('admin.transaksi.kartu_stok', compact('groupBarang'));
    }
}
