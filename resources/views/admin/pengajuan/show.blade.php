<x-app-layout>
    {{-- Header Section --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-clipboard-list text-green-600 w-5"></i>
            Data Pengajuan <br>
            <p class="text-gray-500 text-xs mt-1">Semua surat penting ada di sini, siap untuk ditinjau!</p>
        </h2>
    </x-slot>
    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-6">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#00C07F] transition-colors">Dashboard</a>
                <span class="mx-2 text-gray-400">/</span>
            </li>
            <li class="flex items-center">
                <a href="{{ route('admin.pengajuan.index') }}" class="hover:text-[#00C07F] transition-colors">Data Pengajuan</a>
                <span class="mx-2 text-gray-400">/</span>
            </li>
            <li>
                <span class="text-[#00C07F] font-semibold">Detail Pengajuan Surat</span>
            </li>
        </ol>
    </nav>

    {{-- Notification Success/Error --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- KOLOM KIRI (Informasi Utama) --}}
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card Informasi Pengajuan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-bold text-lg text-gray-900 mb-6">Informasi Pengajuan</h3>
                
                <!-- User Profile & Status Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b border-gray-100">
                    
                    <!-- Avatar & Nama -->
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($pengajuan->user->name) }}&background=random&color=fff&size=128" 
                            alt="Avatar" class="w-16 h-16 rounded-full object-cover border border-gray-200 shadow-sm">
                        <div>
                            <h4 class="font-bold text-lg text-gray-900">{{ $pengajuan->user->name }}</h4>
                            <p class="text-sm text-gray-500 mt-1 font-medium">Warga Desa Banjarsari</p>
                        </div>
                    </div>

                    <!-- ID Surat & Status Sejajar -->
                    <div class="mt-4 sm:mt-0 flex flex-row items-center gap-6">
                        
                        <!-- ID Surat -->
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-400 uppercase tracking-wide font-semibold mb-1 mr-1">ID Surat</span>
                            <span class="text-base font-bold text-orange-500 ml-2">#U{{ $pengajuan->id }}</span>
                        </div>

                        <!-- Status -->
                        <div class="flex flex-col mr-2">
                            <span class="text-xs text-gray-400 uppercase tracking-wide font-semibold mb-1 ml-4">Status</span>
                            @php $status = strtolower($pengajuan->status); @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                @if(in_array($status, ['pending', 'menunggu'])) bg-orange-100 text-orange-700
                                @elseif(in_array($status, ['verified', 'disetujui', 'approved'])) bg-green-100 text-green-700
                                @elseif(in_array($status, ['rejected', 'ditolak'])) bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700 @endif">
                                <span class="w-2 h-2 rounded-full mr-2
                                    @if(in_array($status, ['pending', 'menunggu'])) bg-orange-500
                                    @elseif(in_array($status, ['verified', 'disetujui', 'approved'])) bg-green-500
                                    @elseif(in_array($status, ['rejected', 'ditolak'])) bg-red-500
                                    @else bg-gray-500 @endif"></span>
                                {{ ucfirst($status) }}
                            </span>
                        </div>

                    </div>
                </div>


                <!-- Detail Grid (NIK, Nama, Keperluan) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                    {{-- 1. LOOPING DATA JSON --}}
                    {{-- Kita cek dulu apakah data ada dan berbentuk array --}}
                    @if(isset($pengajuan->data) && is_array($pengajuan->data))
                        @foreach($pengajuan->data as $key => $value)
                            <div class="{{ $key == 'keperluan' ? 'md:col-span-2' : '' }}"> <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2 flex items-center gap-2">
                                    {{-- Icon Generic untuk data dinamis --}}
                                    <i class="far fa-dot-circle text-gray-400"></i> 
                                    
                                    {{-- Ubah format key: 'tempat_lahir' -> 'Tempat Lahir' --}}
                                    {{ ucwords(str_replace(['_', '-'], ' ', $key)) }}
                                </p>
                                <p class="text-base font-bold text-gray-900 font-mono tracking-wide">
                                    {{ $value }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <div class="md:col-span-2">
                            <p class="text-red-500 italic">Data JSON tidak ditemukan atau format salah.</p>
                        </div>
                    @endif

                    {{-- 2. DATA STATIS (Di luar kolom JSON, seperti created_at & title) --}}
                    
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2 flex items-center gap-2">
                            <i class="far fa-calendar text-gray-400"></i> Tanggal Pengajuan
                        </p>
                        <p class="text-base font-bold text-gray-900">
                            {{ $pengajuan->created_at->format('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2 flex items-center gap-2">
                            <i class="far fa-file-alt text-gray-400"></i> Jenis Surat
                        </p>
                        <p class="text-base font-bold text-gray-900">
                            {{ $pengajuan->title }}
                        </p>
                    </div>
                </div>
                @if(in_array($status, ['rejected', 'ditolak']) && !empty($pengajuan->notes))
                    <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mt-3">
                        <h3 class="font-bold text-red-700 text-lg flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            Alasan Penolakan
                        </h3>

                        <p class="text-sm text-red-800 leading-relaxed whitespace-pre-line">
                            {{ $pengajuan->notes }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- Card Lampiran Berkas -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-bold text-lg text-gray-900 mb-6">Lampiran Berkas</h3>
                
                <div class="space-y-4">
                    @if(!empty($pengajuan->files) && is_array($pengajuan->files))
                        @foreach($pengajuan->files as $index => $file)
                            <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition group">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-green-50 text-[#00C07F] rounded-lg flex items-center justify-center text-2xl group-hover:bg-green-100 transition-colors">
                                        <i class="far fa-file-pdf"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $file['original_name'] ?? 'Dokumen '.($index+1) }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">PDF • {{ isset($file['size']) ? round($file['size']/1024, 0) : '245' }} KB</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($file['path'] ?? $file) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-[#00C07F] text-white text-xs font-bold rounded-lg hover:bg-green-700 transition shadow-sm hover:shadow transform hover:-translate-y-0.5">
                                    <i class="fas fa-download mr-2"></i> Unduh
                                </a>
                            </div>
                        @endforeach
                    @else
                        {{-- Fallback jika file kosong --}}
                        <div class="p-8 text-center border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
                            <i class="far fa-folder-open text-gray-400 text-3xl mb-2"></i>
                            <p class="text-gray-500 text-sm">Tidak ada lampiran berkas.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons Bottom -->
            <div class="flex flex-col sm:flex-row gap-4 pt-2">

                {{-- Jika status masih pending → tampilkan tombol Approve dan Reject --}}
                @if(in_array($status, ['pending', 'menunggu']))
                    
                    {{-- Tombol Setujui --}}
                    <form action="{{ route('admin.pengajuan.approve', $pengajuan->id) }}" method="POST" class="w-full sm:w-1/2">
                        @csrf
                        <button type="submit"
                            class="w-full justify-center inline-flex items-center px-6 py-3.5 bg-[#00C07F] text-white font-bold text-sm rounded-xl shadow-md hover:bg-green-700 transition transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="far fa-check-circle mr-2 text-lg"></i> Setujui Pengajuan
                        </button>
                    </form>

                    {{-- Tombol Tolak --}}
                    <button type="button" onclick="openRejectModal()"
                        class="w-full sm:w-1/2 justify-center inline-flex items-center px-6 py-3.5 bg-white border-2 border-red-100 text-red-500 font-bold text-sm rounded-xl hover:bg-red-50 hover:border-red-200 transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="far fa-times-circle mr-2 text-lg"></i> Tolak Pengajuan
                    </button>

                {{-- Jika sudah APPROVED → tampilkan tombol download --}}
                @elseif(in_array($status, ['verified', 'disetujui', 'approved']))
                    
                    <a href="{{ route('admin.pengajuan.download', $pengajuan->id) }}"
                        class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-blue-600 text-white font-bold text-sm rounded-xl shadow-md hover:bg-blue-700 transition transform hover:-translate-y-0.5 hover:shadow-lg">
                        <i class="fas fa-file-download mr-2"></i> Download Surat PDF
                    </a>

                @endif
            </div>
            
            <!-- Form Tolak Hidden -->
            <div id="rejectModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-[9999] hidden">
                <div class="bg-white w-full max-w-lg mx-4 rounded-2xl shadow-lg p-6 animate-scaleIn">

                    <h3 class="text-lg font-bold text-red-600 flex items-center gap-2 mb-4">
                        <i class="fas fa-exclamation-triangle"></i>
                        Alasan Penolakan Pengajuan
                    </h3>

                    <form action="{{ route('admin.pengajuan.reject', $pengajuan->id) }}" method="POST">
                        @csrf

                        <textarea name="alasan" rows="4"
                            class="w-full border border-red-200 bg-red-50/40 rounded-xl focus:ring-red-500 focus:border-red-500 text-sm p-4 placeholder-gray-400"
                            placeholder="Jelaskan alasan penolakan agar pemohon dapat memperbaikinya..."></textarea>

                        <div class="flex justify-end gap-3 mt-5">
                            <button type="button"
                                onclick="closeRejectModal()"
                                class="px-4 py-2 text-gray-500 hover:text-gray-700 text-sm">
                                Batal
                            </button>

                            <button type="submit"
                                class="px-6 py-2 bg-red-600 text-white text-sm font-bold rounded-lg hover:bg-red-700 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">
                                Kirim Penolakan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Animation --}}
            <style>
            @keyframes scaleIn {
                from { opacity: 0; transform: scale(0.9); }
                to { opacity: 1; transform: scale(1); }
            }
            .animate-scaleIn { animation: scaleIn 0.18s ease-out; }
            </style>

            <script>
            function openRejectModal() {
                document.getElementById('rejectModal').classList.remove('hidden');
            }
            function closeRejectModal() {
                document.getElementById('rejectModal').classList.add('hidden');
            }
            </script>
        </div>

        {{-- KOLOM KANAN (Sidebar Timeline) --}}
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Card Timeline -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="font-bold text-lg text-gray-900 mb-6">Timeline Proses</h3>
                
                <div class="relative pl-4 border-l-2 border-gray-100 space-y-10 ml-2">
                    
                    <!-- Item 1: Pengajuan Diterima -->
                    <div class="relative group">
                        <div class="absolute -left-[23px] bg-[#00C07F] h-8 w-8 rounded-full flex items-center justify-center border-4 border-white shadow-sm z-10">
                            <i class="fas fa-check text-white text-[10px]"></i>
                        </div>
                        <div class="pl-4 -mt-1">
                            <p class="text-sm font-bold text-gray-900">Pengajuan diterima</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $pengajuan->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <!-- Item 2: Status Saat Ini -->
                    <div class="relative group">
                        @if(in_array($status, ['verified', 'disetujui', 'approved']))
                             <div class="absolute -left-[23px] bg-[#00C07F] h-8 w-8 rounded-full flex items-center justify-center border-4 border-white shadow-sm z-10">
                                <i class="fas fa-check text-white text-[10px]"></i>
                            </div>
                             <div class="pl-4 -mt-1">
                                <p class="text-sm font-bold text-gray-900">Pengajuan Disetujui</p>
                                <p class="text-xs text-gray-500 mt-1">Surat telah diterbitkan</p>
                            </div>
                        @elseif(in_array($status, ['rejected', 'ditolak']))
                            <div class="absolute -left-[23px] bg-red-500 h-8 w-8 rounded-full flex items-center justify-center border-4 border-white shadow-sm z-10">
                                <i class="fas fa-times text-white text-[10px]"></i>
                            </div>
                             <div class="pl-4 -mt-1">
                                <p class="text-sm font-bold text-red-600">Pengajuan Ditolak</p>
                                <p class="text-xs text-gray-500 mt-1">Periksa alasan penolakan</p>
                            </div>
                        @else
                             <div class="absolute -left-[23px] bg-blue-500 h-8 w-8 rounded-full flex items-center justify-center border-4 border-white shadow-sm ring-4 ring-blue-50 z-10 animate-pulse">
                                <i class="far fa-clock text-white text-[10px]"></i>
                            </div>
                            <div class="pl-4 -mt-1">
                                <p class="text-sm font-bold text-blue-600">Menunggu Persetujuan</p>
                                <p class="text-xs text-gray-500 mt-1">Sedang ditinjau petugas</p>
                            </div>
                        @endif
                    </div>

                    <!-- Item 3: Selesai -->
                    <div class="relative group">
                        @if(in_array($status, ['verified', 'disetujui', 'approved']))
                            {{-- STATUS SELESAI --}}
                            <div class="absolute -left-[23px] bg-[#00C07F] h-8 w-8 rounded-full 
                                        flex items-center justify-center border-4 border-white shadow-sm z-10">
                                <i class="fas fa-flag-checkered text-white text-[10px]"></i>
                            </div>
                            <div class="pl-4 -mt-1">
                                <p class="text-sm font-bold text-gray-900">Selesai</p>
                                <p class="text-xs text-gray-500 mt-1">Surat berhasil diproses</p>
                            </div>

                        @elseif(in_array($status, ['rejected', 'ditolak']))
                            {{-- STATUS DITOLAK → tidak selesai --}}
                            <div class="absolute -left-[23px] bg-gray-300 h-8 w-8 rounded-full 
                                        flex items-center justify-center border-4 border-white z-10">
                                <i class="far fa-flag text-gray-500 text-[10px]"></i>
                            </div>
                            <div class="pl-4 -mt-1 opacity-70">
                                <p class="text-sm font-bold text-gray-700">Tidak Selesai</p>
                                <p class="text-xs text-gray-500 mt-1">Pengajuan dihentikan</p>
                            </div>

                        @else
                            {{-- STATUS MENUNGGU / PENDING --}}
                            <div class="absolute -left-[23px] bg-gray-200 h-8 w-8 rounded-full 
                                        flex items-center justify-center border-4 border-white z-10 opacity-50">
                                <i class="far fa-flag text-gray-400 text-[10px]"></i>
                            </div>
                            <div class="pl-4 -mt-1 opacity-50">
                                <p class="text-sm font-bold text-gray-900">Selesai</p>
                                <p class="text-xs text-gray-500 mt-1">Proses berakhir</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Card Estimasi & Petugas -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-2">Estimasi Selesai</p>
                    <div class="flex items-center gap-2 text-gray-900">
                        <i class="far fa-calendar-alt text-[#00C07F]"></i>
                        <span class="text-base font-bold">
                            {{ $pengajuan->created_at->addDays(1)->format('d F Y') }}
                        </span>
                    </div>
                </div>
                
                <div>
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-4">Petugas Kelurahan</p>
                    <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff"
                            alt="{{ Auth::user()->name }}" 
                            class="w-10 h-10 rounded-full object-cover border border-white shadow-sm">
                        <div>
                            <span class="text-sm font-bold text-gray-900 block">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500">Staf Desa</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>