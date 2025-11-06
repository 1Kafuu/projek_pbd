<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto max-w-2xl px-4 py-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition-colors duration-300 font-medium text-base"
                    href="{{ route('datauser') }}">
                    &larr; Back
                </a>
            </div>

            <!-- Form Container -->
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-2xl font-semibold text-gray-800">Update User</h3>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('update-user', ['id' => $data->ID_USER]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <!-- Username Field - Full Width -->
                        <div class="sm:col-span-6">
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <div class="relative">
                                <input id="username" type="text" name="username" placeholder="Masukkan Username..."
                                    value="{{ $data->USERNAME }}"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('username') border-red-500  @enderror"
                                    required>

                                @error('username')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Field - Full Width -->
                        <div class="sm:col-span-6">
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <div class="relative">
                                <select id="role" name="role"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('role') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Role...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->ROLE }}" {{ ($data->ID_ROLE ?? '') == $role->ROLE ? 'selected' : '' }}>
                                            {{ $role->NAMA_ROLE }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>