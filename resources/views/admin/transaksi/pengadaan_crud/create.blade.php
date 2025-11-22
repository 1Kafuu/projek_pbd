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
    <div class="container mx-auto max-w-4xl px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('pengadaan') }}" 
               class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-md font-medium">
                ← Back
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Create Pengadaan</h3>

            <!-- Alert Error -->
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-sm text-red-800">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div x-data="pengadaanCreate()">
                @csrf

                <!-- Pilih Vendor -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Vendor</label>
                    <select x-model="selectedVendor" 
                            @change="loadBarang()"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        <option value="">Pilih Vendor...</option>
                        @foreach($vendors as $v)
                            <option value="{{ $v->NO_VENDOR }}">{{ $v->NAMA_VENDOR }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Loading indicator -->
                <div x-show="loading" class="text-center py-4">
                    <span class="text-gray-500">Memuat barang...</span>
                </div>

                <!-- Form Barang (hanya muncul jika ada barang) -->
                <template x-if="barangs.length > 0 && selectedVendor">
                    <form :action="`{{ route('store-pengadaan') }}`" method="POST" @submit.prevent="submitForm($event.target)">
                        @csrf
                        <input type="hidden" name="vendor" :value="selectedVendor">

                        <div class="space-y-6">
                            <template x-for="(item, index) in items" :key="index">
                                <div class="flex gap-4 items-end p-4 bg-gray-50 rounded-lg border">
                                    <!-- Barang -->
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Barang</label>
                                        <select :name="'barang[' + index + ']'" 
                                                x-model="item.barang_id"
                                                @change="updateHarga(index)"
                                                class="w-full rounded-md border border-gray-300 px-3 py-2"
                                                required>
                                            <option value="">Pilih Barang...</option>
                                            <template x-for="barang in barangs" :key="barang.NO_BARANG">
                                                <option :value="barang.NO_BARANG" 
                                                        :data-harga="barang.HARGA_BARANG">
                                                    <span x-text="barang.NAMA_BARANG"></span> 
                                                    (Rp <span x-text="formatRupiah(barang.HARGA_BARANG)"></span>)
                                                </option>
                                            </template>
                                        </select>
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="w-32">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                        <input type="number" :name="'jumlah[' + index + ']'" 
                                               x-model.number="item.jumlah" 
                                               @input="calculateSubtotal(index)" 
                                               min="1" 
                                               class="w-full rounded-md border border-gray-300 px-3 py-2"
                                               required>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="w-48 text-right">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Subtotal</label>
                                        <div class="font-semibold text-indigo-600">
                                            Rp <span x-text="formatRupiah(item.subtotal)"></span>
                                        </div>
                                    </div>

                                    <!-- Hapus -->
                                    <div>
                                        <button type="button" @click="removeItem(index)" 
                                                x-show="items.length > 1"
                                                class="text-red-600 hover:text-red-800">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <div class="flex justify-between items-center">
                                <button type="button" @click="addItem()" 
                                        class="text-indigo-600 hover:text-indigo-800 font-medium">
                                    + Tambah Barang
                                </button>

                                <div class="text-right">
                                    <p class="text-lg font-semibold">Total Pengadaan:</p>
                                    <p class="text-2xl font-bold text-indigo-600">
                                        Rp <span x-text="formatRupiah(total)"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="flex justify-end mt-8">
                                <button type="submit" 
                                        class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md">
                                    Create Pengadaan
                                </button>
                            </div>
                        </div>
                    </form>
                </template>

                <!-- Jika vendor sudah dipilih tapi tidak ada barang -->
                <div x-show="selectedVendor && barangs.length === 0 && !loading" class="text-center py-8 text-gray-500">
                    Vendor ini belum memiliki barang.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function pengadaanCreate() {
    return {
        selectedVendor: '',
        barangs: [],
        loading: false,
        items: [{
            barang_id: '',
            harga: '',
            jumlah: '',
            subtotal: 0
        }],
        total: 0,

        async loadBarang() {
            if (!this.selectedVendor) {
                this.barangs = [];
                return;
            }

            this.loading = true;
            try {
                const response = await fetch(`/barang-pengadaan/${this.selectedVendor}`);
                this.barangs = await response.json();
                this.resetItems();
            } catch (err) {
                alert('Gagal memuat data barang');
            } finally {
                this.loading = false;
            }
        },

        addItem() {
            this.items.push({
                barang_id: '',
                harga: '',
                jumlah: '',
                subtotal: ''
            });
        },

        removeItem(index) {
            this.items.splice(index, 1);
            this.updateTotal();
        },

        updateHarga(index) {
            const select = event.target;
            const option = select.selectedOptions[0];
            const harga = option ? parseFloat(option.dataset.harga) || 0 : 0;
            this.items[index].harga = harga;
            this.items[index].barang_id = select.value;
            this.calculateSubtotal(index);
        },

        calculateSubtotal(index) {
            const item = this.items[index];
            item.subtotal = item.harga * (item.jumlah || 0);
            this.updateTotal();
        },

        updateTotal() {
            this.total = this.items.reduce((sum, item) => sum + item.subtotal, 0);
        },

        resetItems() {
            this.items = [{ barang_id: '', harga: 0, jumlah: 1, subtotal: 0 }];
            this.total = 0;
        },

        submitForm(form) {
            const hasEmpty = this.items.some(item => !item.barang_id || item.jumlah < 1);
            if (hasEmpty) {
                alert('Mohon lengkapi semua barang dan jumlah!');
                return;
            }
            form.submit();
        },

        formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka || 0);
        }
    }
}
</script>
</body>
</html>