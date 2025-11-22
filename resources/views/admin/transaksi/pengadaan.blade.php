@extends('components.layouts.app.sidebar')

@section('title', 'Data Pengadaan')
@section('header', 'Data Pengadaan')
@section('header-text', 'Manage your pengadaan')
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
                <a class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md items-center sm:justify-end transition-colors duration-300 font-medium text-base"
                    href="{{ route('dashboard') }}">
                    Back
                </a>
            </div>
            <div class="max-w mx-auto">
                <!-- Team Settings -->
                <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-2xl font-semibold text-gray-800">Pengadaan</h3>
                            <p class="text-sm text-gray-600">Manage Pengadaan</p>
                        </div>

                        <div class = "flex flex-col">    
                             <a href="{{ route('create-pengadaan') }}"
                                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md flex items-center justify-center sm:justify-end transition-colors duration-300 font-medium mb-4 w-fit ml-auto">
                                    + Add Pengadaan
                             </a>

                            <div class="flex justify-end gap-2 mb-4">
                                <a href="{{ route('pengadaan', ['filter' => 'proses']) }}"
                                    class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors duration-200
                                        {{ $filter === 'proses' ? 'bg-green-600 text-white' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                    Proses
                                </a>

                                <a href="{{ route('pengadaan', ['filter' => 'batal']) }}"
                                    class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors duration-200
                                        {{ $filter === 'batal' ? 'bg-red-600 text-white' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                    Batal
                                </a>

                                <a href="{{ route('pengadaan', ['filter' => 'semua']) }}"
                                    class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors duration-200
                                        {{ $filter === 'semua' ? 'bg-gray-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                    Semua
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg shadow-sm">
                                <div class="flex items-start">
                                    <div class="shrink-0">
                                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">
                                            {{ session('success') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                    @elseif (session('error'))
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg shadow-sm">
                                <div class="flex items-start">
                                    <div class="shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-red-800">
                                            {{ session('error') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        TANGGAL_PENGADAAN
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        PENANGGUNG_JAWAB
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        VENDOR
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        PPN
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        TOTAL_AKHIR
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        STATUS
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ACTION
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (isset($result) && is_array($result))
                                    @foreach ($result as $pengadaan)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-700">{{ htmlspecialchars($pengadaan->TANGGAL_PENGADAAN) }}</span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-700">{{ htmlspecialchars($pengadaan->PENANGGUNG_JAWAB) }}</span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-700">{{ htmlspecialchars($pengadaan->VENDOR) }}</span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-700">{{ htmlspecialchars($pengadaan->PPN) }}</span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-700">
                                                        Rp{{ number_format($pengadaan->TOTAL_AKHIR, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <?php
                                                        $status = trim(strtolower(htmlspecialchars($pengadaan->STATUS_PENGADAAN)));
                                                        $bgColor = $status === 'process' ? 'bg-blue-100 text-blue-800' :
                                                            ($status === 'sebagian' ? 'bg-orange-100 text-orange-800' :
                                                            ($status === 'selesai' ? 'bg-green-100 text-green-800' :
                                                            ($status === 'batal' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')));

                                                        $borderColor = $status === 'process' ? 'border-blue-400' :
                                                            ($status === 'sebagian' ? 'border-orange-400' :
                                                            ($status === 'selesai' ? 'border-green-400' :
                                                            ($status === 'batal' ? 'border-red-400' : 'border-gray-400')));
                                                        ?>
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $bgColor }} {{ $borderColor }}">
                                                            {{ htmlspecialchars($pengadaan->STATUS_PENGADAAN) }}
                                                        </span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                                <a href="{{ route('detail-pengadaan', ['id' => $pengadaan->NO_PENGADAAN]) }}"
                                                    class="inline-flex items-center px-3 py-1 bg-emerald-500 hover:bg-emerald-600 text-white rounded-md text-sm transition-colors duration-200">
                                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Detail
                                                </a>

                                                <a href="{{ route('cancel-pengadaan', ['id' => $pengadaan->NO_PENGADAAN]) }}"
                                                class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm transition-colors duration-300" onclick ="return confirm('Apakah kamu yakin ingin membatalkan pengadaan?')">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12">
                                                    </path>
                                                </svg>
                                                Cancel
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

