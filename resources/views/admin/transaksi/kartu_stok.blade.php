@extends('components.layouts.app.sidebar')
@section('title', 'Data Kartu Stok')
@section('header', 'Data Kartu Stok')
@section('header-text', 'Manage your stock')
@section('style')
    <style>
        /* Jika Anda ingin tetap menggunakan warna kustom */
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #f5f5f5;
            --accent-color: #e8f5e9;
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <div class="mb-6">
                <a class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md items-center transition-colors duration-300 font-medium text-base"
                    href="{{ route('dashboard') }}">
                    ← Back
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900">Kartu Stok</h3>
                    <p class="text-sm text-gray-600 mt-1">Monitoring pergerakan stok barang</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    SL. / Nama Barang
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Jenis Transaksi
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Stock Masuk
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Stock Keluar
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Jumlah Stock
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Total Barang
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($groupBarang as $barang)
                                @php
                                    $transaksi = $barang['transaksi'];
                                    $rowspan   = count($transaksi);
                                    $no        = $loop->iteration;
                                @endphp

                                @foreach($transaksi as $i => $trx)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <!-- SL + Nama Barang (hanya di baris pertama) -->
                                        @if($i === 0)
                                            <td rowspan="{{ $rowspan }}" class="px-6 py-4 whitespace-nowrap align-top">
                                                <div class="flex items-start space-x-3">
                                                    <span class="text-sm font-bold text-gray-500 w-8">{{ str_pad($no, 2, '0', STR_PAD_LEFT) }}</span>
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900">
                                                            {{ $barang['NAMA_BARANG'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif

                                        <!-- Jenis Transaksi (badge biru muda persis gambar) -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-300">
                                                {{ $trx['JENIS_TRANSAKSI'] }}
                                            </span>
                                        </td>

                                        <!-- Stock Masuk -->
                                        <td class="px-6 py-4 text-center text-sm text-gray-700">
                                            {{ $trx['STOCK_MASUK'] ?? 0 }}
                                        </td>

                                        <!-- Stock Keluar -->
                                        <td class="px-6 py-4 text-center text-sm text-gray-700">
                                            {{ $trx['STOCK_KELUAR'] ?? 0 }}
                                        </td>

                                        <!-- Jumlah Stock -->
                                        <td class="px-6 py-4 text-center text-sm font-medium text-gray-900">
                                            {{ $trx['JUMLAH_STOCK'] }}
                                        </td>

                                        <!-- Tanggal -->
                                        <td class="px-6 py-4 text-center text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($trx['TANGGAL_DIUPDATE'])->format('d/m/Y') }}
                                        </td>

                                        <!-- Total Barang / Saldo Akhir (rowspan) -->
                                        @if($i === 0)
                                            <td rowspan="{{ $rowspan }}" class="px-6 py-4 text-center align-top">
                                                <div class="text-lg font-bold text-gray-900">
                                                    {{ $barang['SALDO_AKHIR'] }}
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">Total Barang</div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500 text-lg">
                                        Belum ada data kartu stok
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection