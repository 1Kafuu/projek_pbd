@extends('components.layouts.app.sidebar')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')
@section('header-text', 'Welcome back to your dashboard')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-background via-purple-50/30 to-blue-50/30">
        <main class="container mx-auto px-4 py-8">
            <div class="grid gap-6 md:grid-cols-3">
                @php
                    $stats = [
                        [
                            'title' => 'Total Users',
                            'value' => '1,234',
                            'icon' => 'users',
                            'description' => 'Active users in system',
                            'gradient' => 'from-purple-500 to-purple-600',
                            'shadowColor' => 'shadow-purple-500/20',
                        ],
                        [
                            'title' => 'Total Penjualan',
                            'value' => '5,678',
                            'icon' => 'shopping-cart',
                            'description' => 'Total sales transactions',
                            'gradient' => 'from-blue-500 to-cyan-500',
                            'shadowColor' => 'shadow-blue-500/20',
                        ],
                        [
                            'title' => 'Keuntungan',
                            'value' => 'Rp 45,890,000',
                            'icon' => 'trending-up',
                            'description' => 'Total profit this month',
                            'gradient' => 'from-emerald-500 to-teal-500',
                            'shadowColor' => 'shadow-emerald-500/20',
                        ],
                    ];

                    $menuItems = [
                        [
                            'title' => 'Pengadaan',
                            'description' => 'Kelola pengadaan barang',
                            'icon' => 'package',
                            'color' => 'bg-gradient-to-br from-violet-500 to-purple-600',
                            'iconBg' => 'bg-violet-100',
                            'iconColor' => 'text-violet-600',
                            'link' => 'pengadaan',
                        ],
                        [
                            'title' => 'Penerimaan',
                            'description' => 'Terima barang masuk',
                            'icon' => 'package-check',
                            'color' => 'bg-gradient-to-br from-blue-500 to-cyan-500',
                            'iconBg' => 'bg-blue-100',
                            'iconColor' => 'text-blue-600',
                            'link' => 'penerimaan',
                        ],
                        [
                            'title' => 'Retur',
                            'description' => 'Proses pengembalian barang',
                            'icon' => 'package-x',
                            'color' => 'bg-gradient-to-br from-orange-500 to-red-500',
                            'iconBg' => 'bg-orange-100',
                            'iconColor' => 'text-orange-600',
                            'link' => 'retur',
                        ],
                        [
                            'title' => 'Penjualan',
                            'description' => 'Kelola transaksi penjualan',
                            'icon' => 'dollar-sign',
                            'color' => 'bg-gradient-to-br from-emerald-500 to-teal-500',
                            'iconBg' => 'bg-emerald-100',
                            'iconColor' => 'text-emerald-600',
                            'link' => 'penjualan',
                        ],
                        [
                            'title' => 'Margin Penjualan',
                            'description' => 'Analisa margin keuntungan',
                            'icon' => 'trending-up',
                            'color' => 'bg-gradient-to-br from-pink-500 to-rose-500',
                            'iconBg' => 'bg-pink-100',
                            'iconColor' => 'text-pink-600',
                            'link' => 'margin',
                        ],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div
                        class="bg-white rounded-xl border border-gray-200 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden border-0 {{ $stat['shadowColor'] }} shadow-xl">
                        <div class="h-2 bg-gradient-to-r {{ $stat['gradient'] }}"></div>
                        <div class="p-6">
                            <div class="flex items-center justify-between pb-2">
                                <h3 class="text-sm font-medium text-gray-600">{{ $stat['title'] }}</h3>
                                <div class="pt-1 pb-1 pr-2 pl-2 rounded-lg {{ $stat['gradient'] }} bg-gradient-to-br">
                                    @if($stat['icon'] === 'users')
                                        <i class='bx  bx-user' style='color:#fefefe'></i>
                                    @elseif($stat['icon'] === 'shopping-cart')
                                        <i class='bx  bx-cart' style='color:#fefefe'></i>
                                    @elseif($stat['icon'] === 'trending-up')
                                        <i class='bx  bx-chart-network' style='color:#fefefe'></i>
                                    @endif
                                    </svg>
                                </div>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">{{ $stat['value'] }}</div>
                            <p class="text-xs text-gray-500 mt-2">{{ $stat['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Menu Utama</h2>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($menuItems as $item)
                        <div
                            class="bg-white rounded-xl border border-gray-200 hover:shadow-2xl transition-all duration-300 cursor-pointer hover:-translate-y-2 border-0 overflow-hidden group">
                            <div class="{{ $item['color'] }} p-6 text-white">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="pt-3 pb-3 pr-3 pl-3 rounded-xl {{ $item['iconBg'] }} group-hover:scale-110 transition-transform duration-300">
                                        <svg class="h-7 w-8 {{ $item['iconColor'] }}" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            @if($item['icon'] === 'package')
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m12 3l8 4.5v9L12 21l-8-4.5v-9L12 3m0 9l8-4.5M12 12v9m0-9L4 7.5m12-2.25l-8 4.5" />

                                            @elseif($item['icon'] === 'package-check')
                                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2">
                                                    <path d="m16 16l2 2l4-4" />
                                                    <path
                                                        d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14M16.5 9.4L7.55 4.24" />
                                                    <path d="M3.29 7L12 12l8.71-5M12 22V12" />
                                                </g>

                                            @elseif($item['icon'] === 'package-x')
                                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2">
                                                    <path
                                                        d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14M16.5 9.4L7.55 4.24" />
                                                    <path d="M3.29 7L12 12l8.71-5M12 22V12m5 1l5 5m-5 0l5-5" />
                                                </g>

                                            @elseif($item['icon'] === 'dollar-sign')
                                                <path fill="currentColor"
                                                    d="M15.999 8.5h2c0-2.837-2.755-4.131-5-4.429V2h-2v2.071c-2.245.298-5 1.592-5 4.429c0 2.706 2.666 4.113 5 4.43v4.97c-1.448-.251-3-1.024-3-2.4h-2c0 2.589 2.425 4.119 5 4.436V22h2v-2.07c2.245-.298 5-1.593 5-4.43s-2.755-4.131-5-4.429V6.1c1.33.239 3 .941 3 2.4zm-8 0c0-1.459 1.67-2.161 3-2.4v4.799c-1.371-.253-3-1.002-3-2.399zm8 7c0 1.459-1.67 2.161-3 2.4v-4.8c1.33.239 3 .941 3 2.4z" />
                                            @elseif($item['icon'] === 'trending-up')
                                                <path fill="currentColor"
                                                    d="M3.4 18L2 16.6l7.4-7.45l4 4L18.6 8H16V6h6v6h-2V9.4L13.4 16l-4-4l-6 6Z" />
                                            @endif
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <a href={{ route($item['link']) }}>
                                            <h3 class="text-xl font-bold mb-2">{{ $item['title'] }}</h3>
                                            <p class="text-white/90 text-sm">{{ $item['description'] }}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
@endsection