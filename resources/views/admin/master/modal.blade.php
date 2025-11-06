@extends('components.layouts.app.sidebar')
@section('title', 'Data User')
@section('header', 'Data User')
@section('header-text', 'Manage your user')
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
                            <h3 class="text-2xl font-semibold text-gray-800">User</h3>
                            <p class="text-sm text-gray-600">Manage user</p>
                        </div>

                        @extends('components.layouts.app.sidebar')
@section('title', 'Data User')
@section('header', 'Data User')
@section('header-text', 'Manage your user')
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
                                <h3 class="text-2xl font-semibold text-gray-800">User</h3>
                                <p class="text-sm text-gray-600">Manage user</p>
                            </div>

                            <div>
                                <flux:modal.trigger name="edit-profile">
                                    <flux:button variant="primary" color="indigo">
                                        + Add User
                                    </flux:button>
                                </flux:modal.trigger>
                            </div>

                            


                            <flux:modal name="edit-profile" class="md:w-96">
                                <div class="space-y-6">
                                    <div>
                                        <flux:heading size="lg">Update profile</flux:heading>
                                        <flux:text class="mt-2">Make changes to your personal details.</flux:text>
                                    </div>

                                    <flux:input label="Name" placeholder="Your name" />

                                    <flux:input label="Date of birth" type="date" />

                                    <div class="flex">
                                        <flux:spacer />

                                        <flux:button type="submit" variant="primary">Save changes</flux:button>
                                    </div>
                                </div>
                            </flux:modal>
                        </div>

                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg shadow-sm">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
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
                        @endif

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Username
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if(isset($result) && is_array($result))
                                        @foreach($result as $user)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="shrink-0 h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center">
                                                            <span class="text-indigo-600 font-semibold">
                                                                {{ htmlspecialchars(substr($user->USERNAME, 0, 1)) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ htmlspecialchars($user->USERNAME) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span
                                                            class="text-sm text-gray-700">{{ htmlspecialchars($user->NAMA_ROLE) }}</span>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                                    <label for="update-modal" 
                                                        class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm transition-colors duration-300">
                                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>                                        
                                                        Edit
                                                    </label>                                        

                                                    <form action="{{ route('delete-user', ['id' => $user->ID_USER]) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm transition-colors duration-300"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <input type="checkbox" id="update-modal" class="peer fixed appearance-none opacity-0" />

                                        <label for="update-modal"
                                            class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-slate-700/30 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:*:translate-y-0 peer-checked:*:scale-100">

                                            <div
                                                class="max-h-[calc(100vh - 5em)] h-fit w-xl overflow-y-auto overscroll-contain rounded-md bg-white p-6 text-black shadow-2xl transition scale-95 translate-y-4 peer-checked:scale-100 peer-checked:translate-y-0 pointer-events-auto">

                                                <div
                                                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                                                    <div class="mb-4 sm:mb-0">
                                                        <h3 class="text-2xl font-semibold text-gray-800">Update User</h3>
                                                    </div>

                                                    <button type="button"
                                                        onclick="document.getElementById('update-modal').checked = false"
                                                        class="text-gray-400 hover:text-gray-600 ml-auto">
                                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <form method="POST" action="{{ route('update-user', ['id' => $user->ID_USER]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                                        <div class="sm:col-span-6">
                                                            <label for="username"
                                                                class="block text-sm font-medium text-gray-700 mb-1 text-left">Username</label>
                                                            <div class="relative">
                                                                <input id="username" type="text" name="username"
                                                                    placeholder="Masukkan Username..." value=""
                                                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-normal text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('username') border-red-500 @enderror"
                                                                    required>

                                                                @error('username')
                                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="sm:col-span-6">
                                                            <label for="role"
                                                                class="block text-sm font-medium text-gray-700 mb-1 text-left">Role</label>
                                                            <div class="relative">
                                                                <select id="role" name="role"
                                                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-normal text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('role') border-red-500 @enderror"
                                                                    required>
                                                                    <option value="">Pilih Role...</option>
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{ $role->ROLE }}">{{ $role->NAMA_ROLE }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('role')
                                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-8 flex justify-end">
                                                        <button type="submit"
                                                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                            id="createuser">
                                                            Update User
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </label>
                                    @else
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                                No users found
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
                        </div>

                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg shadow-sm">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
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
                        @endif

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Username
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if(isset($result) && is_array($result))
                                        @foreach($result as $user)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="shrink-0 h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center">
                                                            <span class="text-indigo-600 font-semibold">
                                                                {{ htmlspecialchars(substr($user->USERNAME, 0, 1)) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ htmlspecialchars($user->USERNAME) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span
                                                            class="text-sm text-gray-700">{{ htmlspecialchars($user->NAMA_ROLE) }}</span>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                                    <label for="update-modal" 
                                                        class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm transition-colors duration-300">
                                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>                                        
                                                        Edit
                                                    </label>                                        

                                                    <form action="{{ route('delete-user', ['id' => $user->ID_USER]) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm transition-colors duration-300"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                                No users found
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