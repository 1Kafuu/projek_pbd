@extends('components.layouts.app.sidebar')
@section('title', 'Data Satuan')
@section('header', 'Data Satuan')
@section('header-text', 'Manage your satuan')
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
                    <div
                        class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-2xl font-semibold text-gray-800">Satuan</h3>
                            <p class="text-sm text-gray-600">Manage satuan</p>
                        </div>
                        <button
                            class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md flex items-center justify-center sm:justify-end transition-colors duration-300 font-medium">
                            + Add Satuan
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                            
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Id Satuan
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Satuan
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($result) && is_array($result))
                                    @foreach($result as $satuan)
                                        @php
                                            $id = $satuan->NO_SATUAN ?? '';
                                            $namasatuan = $satuan->NAMA_SATUAN ?? 'Guest';
                                            $status = $satuan->STATUS_SATUAN ?? '';
                                        @endphp
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ htmlspecialchars($id) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-700">{{ htmlspecialchars($namasatuan) }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="text-sm text-gray-700">{{ htmlspecialchars($status) }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <i
                                                    class="bi bi-three-dots-vertical text-gray-500 hover:text-gray-700 cursor-pointer p-1 rounded hover:bg-gray-100 transition-colors"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No satuan found
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection