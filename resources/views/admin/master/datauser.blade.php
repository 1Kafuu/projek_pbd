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
                            <a class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md flex items-center justify-center sm:justify-end transition-colors duration-300 font-medium"
                                href="{{ route('create-user') }}">
                                + Add User
                            </a>
                        </div>

                        <div class="mb-6">
                            <div class="bg-gray-100 border border-gray-300 rounded-md flex items-center px-3 py-2">
                                <i class="bi bi-search text-gray-500 mr-2"></i>
                                <input type="text" placeholder="Search..."
                                    class="w-full bg-transparent border-0 focus:ring-0 text-gray-700">
                            </div>
                        </div>

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
                                            @php
                                                $username = $user->USERNAME ?? '';
                                                $role = $user->NAMA_ROLE ?? 'Guest';
                                                $initial = substr($username, 0, 1);
                                            @endphp
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="flex-shrink-0 h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center">
                                                            <span
                                                                class="text-indigo-600 font-semibold">
                                                                {{ htmlspecialchars($initial) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ htmlspecialchars($username) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span class="text-sm text-gray-700">{{ htmlspecialchars($role) }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <i
                                                        class="bi bi-three-dots-vertical text-gray-500 hover:text-gray-700 cursor-pointer p-1 rounded hover:bg-gray-100 transition-colors"></i>
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