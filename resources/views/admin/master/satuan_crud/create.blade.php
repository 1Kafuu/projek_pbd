<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Satuan</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto max-w-2xl px-4 py-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition-colors duration-300 font-medium text-base"
                    href="{{ route('datasatuan') }}">
                    &larr; Back
                </a>
            </div>

            <!-- Form Container -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-2xl font-semibold text-gray-800">Create Satuan</h3>
                    </div>
                </div>

                @if(session('error'))
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

                <!-- Form -->
                <form action="{{ route('store-satuan') }}" method="POST">
                    @csrf
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <!-- Vendor Field - Full Width -->
                        <div class="sm:col-span-6">
                            <label for="satuan" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                            <div class="relative">
                                <input id="satuan" type="text" name="satuan" placeholder="Masukkan Satuan..."
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('satuan') border-red-500  @enderror"
                                    required>

                                @error('satuan')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Satuan</label>
                            <div class="relative">
                                <select id="status" name="status"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('status') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Status Vendor...</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
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
                            Create Satuan
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</body>

</html>