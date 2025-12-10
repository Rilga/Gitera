<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <!-- Tombol Kembali (Atas) -->
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>

        <!-- 2. FORM CARD SECTION -->
        <div class="bg-white rounded-2xl shadow-sm p-6 sm:p-8">
            
            <!-- Card Header -->
            <div class="flex items-start gap-4 mb-8 border-b border-gray-100 pb-6">
                <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Data Diri Pemohon</h1>
                    <p class="text-sm text-gray-500 mt-1">Pastikan data yang Anda isi sudah benar sesuai dengan dokumen resmi.</p>
                </div>
            </div>

            <form action="{{ route('layanan.store', $slug) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" required 
                           class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3" 
                           value="{{ old('nama') }}" placeholder="Budi Hartono">
                    <div class="mt-2 flex items-center gap-1 text-xs text-gray-500">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Nama harus sesuai dengan yang tertera di KTP
                    </div>
                </div>

                <!-- NIK -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">
                        NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="nik" required 
                           class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3" 
                           value="{{ old('nik') }}" placeholder="3374012304890123">
                    <div class="mt-2 flex items-center gap-1 text-xs text-gray-500">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        NIK terdiri dari 16 digit angka
                    </div>
                </div>

                <!-- Grid TTL & JK -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">
                            Tempat/Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="ttl" required 
                               class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3" 
                               value="{{ old('ttl') }}" placeholder="GARUT, 25-04-2002">
                        <div class="mt-2 text-xs text-gray-500">Format: KOTA, DD-MM-YYYY</div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_kelamin" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3">
                            <option value="LAKI-LAKI" {{ old('jenis_kelamin') == 'LAKI-LAKI' ? 'selected' : '' }}>LAKI-LAKI</option>
                            <option value="PEREMPUAN" {{ old('jenis_kelamin') == 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN</option>
                        </select>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alamat" rows="3" required 
                              class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3"
                              placeholder="Jl. Nama Jalan No. XX, RT/RW, Kelurahan, Kecamatan">{{ old('alamat') }}</textarea>
                </div>

                <!-- Bagian Data Lainnya -->
                <div class="mt-8 mb-4">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Data Pendukung & Keperluan
                    </h3>
                    <div class="w-full h-px bg-gray-200 mb-6"></div>
                </div>

                <!-- Grid Pekerjaan - Status - Agama - Kewarganegaraan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Pekerjaan</label>
                        <input type="text" name="pekerjaan" required 
                               class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3" 
                               value="{{ old('pekerjaan') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Status Perkawinan</label>
                        <select name="status" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3">
                            <option value="BELUM KAWIN">BELUM KAWIN</option>
                            <option value="KAWIN">KAWIN</option>
                            <option value="CERAI HIDUP">CERAI HIDUP</option>
                            <option value="CERAI MATI">CERAI MATI</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Agama</label>
                        <select name="agama" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3">
                            <option value="ISLAM">ISLAM</option>
                            <option value="KRISTEN">KRISTEN</option>
                            <option value="KATOLIK">KATOLIK</option>
                            <option value="HINDU">HINDU</option>
                            <option value="BUDDHA">BUDDHA</option>
                            <option value="KONGHUCU">KONGHUCU</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" required 
                               class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3" 
                               value="INDONESIA">
                    </div>
                </div>

                <!-- Keperluan -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-900 mb-2">Keperluan</label>
                    <textarea name="keperluan" rows="3" required 
                              class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-3"
                              placeholder="Contoh: PEMBUATAN SKCK">{{ old('keperluan', 'PEMBUATAN SKCK') }}</textarea>
                </div>

                <!-- Lampiran -->
                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-900 mb-2">
                        Upload Berkas Pendukung (KTP/KK)
                    </label>

                    <!-- Preview daftar file -->
                    <div id="file-preview" class="mb-3 space-y-1"></div>

                    <div class="flex items-center justify-center w-full">
                        <label for="file-input"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">

                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                                </p>
                                <p class="text-xs text-gray-500">PDF, JPG, PNG (MAX. 2MB)</p>
                            </div>

                            <!-- multiple -->
                            <input id="file-input" type="file" name="files[]" multiple class="hidden">
                        </label>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between items-center mt-8">
                    <a href="javascript:history.back()" class="text-gray-600 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-6 py-3 inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>

                    <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-8 py-3 inline-flex items-center shadow-lg shadow-green-200">
                        Kirim Pengajuan
                        <svg class="w-3.5 h-3.5 ms-2" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                </div>

            </form>
        </div>
    </div>

        <!-- MODAL SUCCESS POPUP -->
    <!-- Logika: Muncul jika ada session('success') dari controller ATAU parameter ?success=1 di URL (untuk testing) -->
    @if(session('success') || request('success'))
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full mx-4 relative shadow-2xl transform scale-100 transition-transform duration-300">
            
            <!-- Tombol Close (X) -->
            <button onclick="document.getElementById('successModal').remove()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
    
            <!-- Icon Sukses Besar -->
            <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-6 shadow-inner animate-bounce-short">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
    
            <!-- Judul & Deskripsi Utama -->
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-3">Pengajuan Berhasil!</h2>
            <p class="text-center text-gray-600 mb-6 leading-relaxed">
                Warga harap menunggu proses pengajuan yang akan berlangsung selama <span class="font-semibold text-gray-800">1-3 hari kerja</span>.
            </p>
    
            <!-- Box Hijau: Info Status -->
            <div class="bg-green-50 border border-green-100 rounded-2xl p-4 mb-4 flex items-start gap-3">
                <div class="text-green-600 mt-0.5 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-sm mb-1">Informasi Status</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Jika pengajuan sudah disetujui, status pada halaman riwayat pengajuan akan berubah menjadi <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Approved</span>.
                    </p>
                </div>
            </div>
            
            <!-- Box Kuning: Info Tambahan (Sesuaikan Saja) -->
            <div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-4 mb-8 flex items-start gap-3">
                <div class="text-yellow-600 mt-0.5 flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <p class="text-xs text-yellow-800 leading-relaxed">
                    Pastikan nomor kontak yang Anda masukkan aktif agar kami dapat menghubungi Anda jika diperlukan verifikasi tambahan.
                </p>
            </div>
    
            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('user.listlayanan') }}" class="w-full sm:w-1/2 py-3 px-4 border border-gray-300 rounded-xl text-gray-700 font-medium text-center hover:bg-gray-50 focus:ring-4 focus:ring-gray-100 transition-all">
                    Nanti
                </a>
                <!-- Arahkan href ke route yang sesuai, misal dashboard atau history -->
                <a href="{{ route('user.riwayat') }}" class="w-full sm:w-1/2 py-3 px-4 bg-green-600 text-white rounded-xl font-medium text-center hover:bg-green-700 focus:ring-4 focus:ring-green-200 shadow-lg shadow-green-200 transition-all">
                    Lihat Status
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- JS PREVIEW FILE -->
    <script>
        const input = document.getElementById("file-input");
        const preview = document.getElementById("file-preview");

        let allFiles = []; // ← menyimpan seluruh file, tidak tertimpa

        input.addEventListener("change", function (event) {
            const newFiles = Array.from(event.target.files);

            // Tambahkan file baru ke list lama
            allFiles = [...allFiles, ...newFiles];

            // Update daftar file di UI
            preview.innerHTML = "";
            allFiles.forEach((file, index) => {
                const item = document.createElement("div");
                item.classList = "text-sm text-gray-700 flex justify-between items-center bg-gray-100 px-3 py-2 rounded";

                item.innerHTML = `
                    <span>${index + 1}. ${file.name}</span>
                `;
                preview.appendChild(item);
            });

            // Buat DataTransfer agar input bisa menyimpan banyak file meski upload satu-satu
            const dataTransfer = new DataTransfer();
            allFiles.forEach(f => dataTransfer.items.add(f));
            input.files = dataTransfer.files;
        });
    </script>

</x-app-layout>
