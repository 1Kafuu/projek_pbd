<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vendor</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto max-w-2xl px-4 py-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition-colors duration-300 font-medium text-base"
                    href="{{ route('datavendor') }}">
                    &larr; Back
                </a>
            </div>

            <!-- Form Container -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-2xl font-semibold text-gray-800">Update Vendor</h3>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('update-vendor', ['id' => $data->NO_VENDOR]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="nama_vendor" class="block text-sm font-medium text-gray-700 mb-1">Nama Vendor</label>
                            <div class="relative">
                                <input id="nama_vendor" type="text" name="nama_vendor" placeholder="Masukkan Nama Vendor..." value="{{ $data->NAMA_VENDOR }}"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nama_vendor') border-red-500  @enderror"
                                    required>
                        
                                @error('nama_vendor')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="badan_hukum" class="block text-sm font-medium text-gray-700 mb-1">Status Badan Hukum</label>
                            <div class="relative">
                                <select id="badan_hukum" name="badan_hukum"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('badan_hukum') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Status Badan Hukum...</option>
                                    <option value="Y" {{ $data->BADAN_HUKUM == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="N" {{ $data->BADAN_HUKUM == 'No' ? 'selected' : '' }}>No</option>
                                    
                                </select>
                                @error('badan_hukum')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Vendor</label>
                            <div class="relative">
                                <select id="status" name="status"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('status') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Status Vendor...</option>
                                    <option value="A" {{ $data->STATUS_VENDOR == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="N" {{ $data->STATUS_VENDOR == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Vendor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>