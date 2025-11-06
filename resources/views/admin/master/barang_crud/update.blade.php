<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Barang</title>
    @vite('resources/css/app.css')
</head>

<body>
    {{-- {{ dd($data) }} --}}
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto max-w-2xl px-4 py-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition-colors duration-300 font-medium text-base"
                    href="{{ route('databarang') }}">
                    &larr; Back
                </a>
            </div>

            <!-- Form Container -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-2xl font-semibold text-gray-800">Update Barang</h3>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('update-barang', ['id' => $data->idbarang]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        
                        <div class="sm:col-span-6">
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Barang</label>
                            <div class="relative">
                                <input id="nama_barang" type="text" name="nama_barang" placeholder="Masukkan Nama Barang..." value="{{ $data->nama }}"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nama_barang') border-red-500  @enderror"
                                    required>
                        
                                @error('nama_barang')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="jenis_barang" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                Barang</label>
                            <div class="relative">
                                <select id="jenis_barang" name="jenis_barang"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('jenis_barang') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Jenis Barang...</option>
                                    <option value="B" {{ $data->jenis == 'B' ? 'selected' : '' }}>Barang</option>
                                    <option value="J" {{ $data->jenis == 'J' ? 'selected' : '' }}>Jasa</option>
                                </select>
                                @error('satuan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="sm:col-span-6">
                            <label for="satuan" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                            <div class="relative">
                                <select id="satuan" name="satuan"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('satuan') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Satuan...</option>
                                    @foreach ($satuan as $s)
                                        <option value="{{ $s->NO_SATUAN }}" {{ ($data->idsatuan ?? '') == $s->NO_SATUAN ? 'selected' : '' }}>
                                            {{ $s->NAMA_SATUAN }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('satuan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <div class="relative">
                                <input id="harga" type="number" name="harga" placeholder="Masukkan Harga..." value="{{ $data->harga }}"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('harga') border-red-500  @enderror"
                                    required>
                        
                                @error('harga')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <div class="relative">
                                <select id="status" name="status"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('status') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Status...</option>
                                    <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ $data->status == '2' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('satuan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>