<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengadaan</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto max-w-2xl px-4 py-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition-colors duration-300 font-medium text-base"
                    href="{{ route('penerimaan') }}">
                    &larr; Back
                </a>
            </div>

            <!-- Form Container -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-2xl font-semibold text-gray-800">Detail Penerimaan</h3>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                            Penerimaan </label>
                        <div class="relative">
                            <span href=""
                                class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                {{ $result_detail->TANGGAL_PENERIMAAN }}
                            </span>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                            Pengadaan </label>
                        <div class="relative">
                            <span href=""
                                class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                {{ $result_detail->TANGGAL_PENGADAAN }}
                            </span>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="user" class="block text-sm font-medium text-gray-700 mb-1">Penanggung Jawab</label>
                        <div class="relative">
                            <span href=""
                                class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                {{ $result_detail->PENANGGUNG_JAWAB }}
                            </span>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="barang" class="block text-sm font-medium text-gray-700 mb-1">Barang
                            Pengadaan</label>
                        @foreach ($list_barang_pengadaan as $barang_pengadaan)
                            <div class="relative sm:col-span-6 flex flex-row justify-between items-center">
                                <span href=""
                                    class="block w-full rounded-md bg-white py-0 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    {{ $barang_pengadaan['NAMA_BARANG'] }}
                                </span>

                                <div class="flex flex-row justify-between items-center">
                                    <span href=""
                                        class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        Rp{{ number_format($barang_pengadaan['HARGA_SATUAN'], 0, ',', '.') }}
                                    </span>
                                    <span>x</span>
                                    <span href=""
                                        class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        {{ $barang_pengadaan['JUMLAH'] }}
                                    </span>
                                    <span>=</span>
                                    <span href=""
                                        class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        Rp{{ number_format($barang_pengadaan['SUBTOTAL_BARANG'], 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="sm:col-span-6">
                            <label for="barang" class="block text-sm font-medium text-gray-700 mb-1">Barang
                                Penerimaan</label>
                            @foreach ($detail as $barang)
                                <div class="relative sm:col-span-6 flex flex-row justify-between items-center">
                                    <span href=""
                                        class="block w-full rounded-md bg-white py-0 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        {{ $barang['NAMA_BARANG'] }}
                                    </span>

                                    <div class="flex flex-row justify-between items-center">
                                        <span href=""
                                            class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            Rp{{ number_format($barang['HARGA_PENERIMAAN'], 0, ',', '.') }}
                                        </span>
                                        <span>x</span>
                                        <span href=""
                                            class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            {{ $barang['JUMLAH'] }}
                                        </span>
                                        <span>=</span>
                                        <span href=""
                                            class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            Rp{{ number_format($barang['SUBTOTAL_BARANG'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                            <hr>

                            <div class="flex flex-row justify-between items-center">
                                <span href=""
                                    class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    Subtotal Barang
                                </span>

                                <div>
                                    <span href=""
                                        class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        Rp{{ number_format($result_detail->SUBTOTAL_PENERIMAAN, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-6 flex flex-row justify-between items-center">
                            <label for="subpengadaan" class="block text-sm font-medium text-gray-700">Subtotal
                                Penerimaan</label>
                            <div class="relative">
                                <span href=""
                                    class="block w-full rounded-md bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    Rp{{ number_format($result_detail->SUBTOTAL_PENERIMAAN, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>