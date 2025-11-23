<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Penjualan</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto max-w-6xl px-4 py-8">
            <div class="mb-6">
                <a class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition-colors duration-300 font-medium text-base"
                    href="{{ route('penjualan') }}">
                    Back
                </a>
            </div>

            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-2xl font-semibold text-gray-800">Create Penjualan</h3>
                    </div>
                </div>

                @if (session('error'))
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
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg shadow-sm">
                        <ul class="list-disc list-inside text-sm text-red-800">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('store-penjualan') }}" method="POST" x-data="formPenjualan()">
                    @csrf
                    <!-- Daftar Barang -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Daftar Barang</label>
                        <div class="space-y-4">
                            <template x-for="(item, index) in items" :key="index">
                                <div
                                    class="grid grid-cols-12 gap-4 p-5 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">

                                    <!-- BARANG – kolom paling lebar (5/12) -->
                                    <div class="col-span-5">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Barang</label>
                                        <select :name="'barang[' + index + ']'" x-model="item.barang_id"
                                            @change="updateHargaDanStok(index); removeSelectedFromOthers(index)"
                                            class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 px-4 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                            required>
                                            <option value="">Pilih Barang...</option>
                                            @foreach($barang as $b)
                                                <option value="{{ $b->NO_BARANG }}"
                                                    :data-harga="{{ $b->HARGA_BARANG ?? 0 }}"
                                                    x-show="!isBarangSelected('{{ $b->NO_BARANG }}', index)">
                                                    {{ $b->NAMA_BARANG }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- HARGA – 2/12 -->
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                        <input type="number" :name="'harga_satuan[' + index + ']'"
                                            x-model.number="item.harga" @input="hitungSubtotal(index)" min="0"
                                            class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 px-4 text-right")"
                                            required readonly>
                                    </div>

                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                        <div class="relative">
                                            <input type="number" :name="'jumlah[' + index + ']'"
                                                x-model.number="item.jumlah" @input="hitungSubtotal(index)" min="1"
                                                class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 px-4 pr-10 text-center"
                                                required>
                                        </div>
                                    </div>

                                    <!-- SUBTOTAL – 2/12 -->
                                    <div class="col-span-2 flex items-end justify-end">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Subtotal</label>
                                            <div class="font-bold text-lg text-indigo-600">
                                                Rp <span x-text="formatRupiah(item.subtotal)"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- HAPUS – 1/12 -->
                                    <div class="col-span-1 flex items-end justify-center">
                                        <button type="button" @click="removeItem(index)"
                                            class="text-red-600 hover:text-red-900 font-medium text-sm"
                                            x-show="items.length > 1">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <!-- Tombol Tambah Barang -->
                            <div>
                                <button type="button" @click="tambahBaris()"
                                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    + Tambah Barang
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Total Keseluruhan -->
                    <div class="mt-8 border-t pt-4">
                        <div class="flex justify-end">
                            <div class="text-right">
                                <p class="text-lg font-semibold text-gray-700">Total Penjualan:</p>
                                <p class="text-2xl font-bold text-indigo-600">
                                    Rp <span x-text="formatRupiah(total)"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create Penjualan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function formPenjualan() {
            return {
                items: [{ barang_id: '', harga: 0, jumlah: 1, subtotal: 0 }],

                get total() {
                    return this.items.reduce((acc, item) => acc + (item.subtotal || 0), 0);
                },

                updateHargaDanStok(index) {
                    const select = event.target;
                    const option = select.options[select.selectedIndex];
                    const harga = option.dataset.harga || 0;

                    this.items[index].harga = parseInt(harga);
                    this.items[index].jumlah = 1;
                    this.hitungSubtotal(index);
                },

                isBarangSelected(barangId, currentIndex) {
                    return this.items.some((item, i) => {
                        return i !== currentIndex && item.barang_id == barangId;
                    });
                },

                removeSelectedFromOthers(currentIndex) {
                    this.$nextTick(() => this.items = [...this.items]);
                },

                hitungSubtotal(index) {
                    const item = this.items[index];
                    item.subtotal = item.harga * item.jumlah;
                },

                formatRupiah(angka) {
                    return new Intl.NumberFormat('id-ID').format(angka || 0);
                },

                removeItem(index) {
                    this.items.splice(index, 1);
                },

                tambahBaris() {
                    this.items.push({ barang_id: '', harga: 0, jumlah: 1, stok: 0, subtotal: 0 });
                }
            }
        }
    </script>
</body>

</html>