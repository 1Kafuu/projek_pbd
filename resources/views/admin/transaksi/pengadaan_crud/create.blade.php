<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pengadaan</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto max-w-2xl px-4 py-8">
            <div class="mb-6">
                <a class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md transition-colors duration-300 font-medium text-base"
                    href="{{ route('pengadaan') }}">
                    Back
                </a>
            </div>

            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-6">
                <div
                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-2xl font-semibold text-gray-800">Create Pengadaan</h3>
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

                <form action="{{ route('store-pengadaan') }}" method="POST" x-data="pengadaanForm()">
                    @csrf

                    <!-- Vendor -->
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="vendor" class="block text-sm font-medium text-gray-700 mb-1">Vendor</label>
                            <div class="relative">
                                <select id="vendor" name="vendor"
                                    class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('vendor') border-red-500 @enderror"
                                    required>
                                    <option value="">Pilih Vendor...</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->NO_VENDOR }}">{{ $vendor->NAMA_VENDOR }}</option>
                                    @endforeach
                                </select>
                                @error('vendor')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Barang -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Daftar Barang</label>
                        <div class="space-y-4">
                            <template x-for="(item, index) in items" :key="index">
                                <div class="flex gap-3 items-start p-4 bg-gray-50 rounded-lg border">
                                    <!-- Barang -->
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Barang</label>
                                        <select :name="'barang[' + index + ']'" x-model="item.barang_id"
                                            @change="updateHarga(index)"
                                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            required>
                                            <option value="">Pilih Barang...</option>
                                            @foreach($barangs as $barang)
                                                <option value="{{ $barang->NO_BARANG }}"
                                                    :data-harga="{{ $barang->HARGA_BARANG }}">
                                                    {{ $barang->NAMA_BARANG }} (Rp
                                                    {{ number_format($barang->HARGA_BARANG) }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <p x-show="item.errors.barang" class="mt-1 text-sm text-red-600"
                                            x-text="item.errors.barang"></p>
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="w-32">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                        <input type="number" :name="'jumlah[' + index + ']'"
                                            x-model.number="item.jumlah" @input="updateJumlah(index)" min="1"
                                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            required>
                                        <p x-show="item.errors.jumlah" class="mt-1 text-sm text-red-600"
                                            x-text="item.errors.jumlah"></p>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="w-40 text-right">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Subtotal</label>
                                        <div class="font-semibold text-indigo-600">
                                            Rp <span x-text="formatRupiah(item.subtotal)"></span>
                                        </div>
                                    </div>

                                    <!-- Hapus -->
                                    <div class="mt-6">
                                        <button type="button" @click="removeItem(index)"
                                            class="text-red-600 hover:text-red-800 text-sm font-medium"
                                            x-show="items.length > 1">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <!-- Tombol Tambah Barang -->
                            <div>
                                <button type="button" @click="addItem()"
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
                                <p class="text-lg font-semibold text-gray-700">Total Pengadaan:</p>
                                <p class="text-2xl font-bold text-indigo-600">
                                    Rp <span x-text="formatRupiah(total)"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit" @click.prevent="submitForm($el.closest('form'))"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md shadow-sm transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create Pengadaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function pengadaanForm() {
            return {
                items: [{
                    barang_id: '',
                    harga: 0,
                    jumlah: 1,
                    subtotal: 0,
                    errors: { barang: '', jumlah: '' }
                }],
                total: 0,

                addItem() {
                    this.items.push({
                        barang_id: '',
                        harga: 0,
                        jumlah: 1,
                        subtotal: 0,
                        errors: { barang: '', jumlah: '' }
                    });
                },

                removeItem(index) {
                    this.items.splice(index, 1);
                    this.updateTotal();
                },

                // Dipanggil saat pilih barang
                updateHarga(index) {
                    const select = event.target;
                    const harga = select.selectedOptions[0]?.dataset.harga || 0;
                    const item = this.items[index];
                    item.harga = parseFloat(harga);
                    item.barang_id = select.value;
                    this.calculateSubtotal(index);
                    this.validateItem(index);
                },

                // Dipanggil saat ubah jumlah
                updateJumlah(index) {
                    const item = this.items[index];
                    item.jumlah = parseInt(event.target.value) || 0;
                    this.calculateSubtotal(index);
                    this.validateItem(index);
                },

                // Hitung subtotal berdasarkan harga & jumlah
                calculateSubtotal(index) {
                    const item = this.items[index];
                    item.subtotal = item.harga * item.jumlah;
                    this.updateTotal();
                },

                updateTotal() {
                    this.total = this.items.reduce((sum, item) => sum + item.subtotal, 0);
                },

                validateItem(index) {
                    const item = this.items[index];
                    item.errors.barang = item.barang_id ? '' : 'Pilih barang terlebih dahulu.';
                    item.errors.jumlah = (item.jumlah >= 1) ? '' : 'Jumlah minimal 1.';
                },

                validateAll() {
                    let valid = true;
                    this.items.forEach((item, index) => {
                        this.validateItem(index);
                        if (item.errors.barang || item.errors.jumlah || !item.barang_id || item.jumlah < 1) {
                            valid = false;
                        }
                    });
                    return valid;
                },

                submitForm(form) {
                    if (this.validateAll()) {
                        form.submit();
                    } else {
                        alert('Mohon lengkapi semua data barang dan jumlah.');
                    }
                },

                formatRupiah(angka) {
                    return new Intl.NumberFormat('id-ID').format(angka || 0);
                }
            }
        }
    </script>
</body>

</html>