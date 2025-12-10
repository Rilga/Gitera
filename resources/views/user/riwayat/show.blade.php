<x-app-layout>
    <div class="bg-gray-100 min-h-screen font-sans">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Header --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail Pengajuan Surat</h1>
                <p class="text-gray-500 mt-1 text-base">Informasi lengkap pengajuan surat Anda</p>
            </div>

            {{-- Card --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">

                {{-- Info Surat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-500 text-sm">ID Surat</p>
                        <p class="text-gray-900 font-medium">#{{ $surat->slug }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Jenis Surat</p>
                        <p class="text-gray-900 font-medium">{{ $surat->title }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tanggal Pengajuan</p>
                        <p class="text-gray-900 font-medium">{{ $surat->created_at->format('d-m-Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Status</p>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-{{ $status['color'] }}-50 text-{{ $status['color'] }}-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-{{ $status['color'] }}-500"></span> {{ $status['label'] }}
                        </span>
                    </div>

                    {{-- Catatan / Alasan Penolakan --}}
                    @if($surat->status === 'rejected' && $surat->notes)
                        <div class="md:col-span-2 mt-2">
                            <p class="text-red-500 text-sm font-semibold">Alasan Penolakan:</p>
                            <p class="text-gray-900 font-medium">{{ $surat->notes }}</p>
                        </div>
                    @elseif($surat->notes)
                        <div class="md:col-span-2 mt-2">
                            <p class="text-gray-500 text-sm">Catatan:</p>
                            <p class="text-gray-900 font-medium">{{ $surat->notes }}</p>
                        </div>
                    @endif
                </div>

                {{-- Data Warga --}}
                <div>
                    <h2 class="text-gray-700 font-semibold mb-2">Data Warga</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php
                            $formData = is_array($surat->data) ? $surat->data : json_decode($surat->data, true) ?? [];
                        @endphp

                        @forelse($formData as $key => $value)
                            <div>
                                <p class="text-gray-500 text-sm">{{ ucwords(str_replace('_',' ',$key)) }}</p>
                                <p class="text-gray-900 font-medium">{{ $value }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Tidak ada data warga</p>
                        @endforelse
                    </div>
                </div>

                {{-- File Unggahan --}}
                <div>
                    <p class="text-gray-500 text-sm mb-2">Lampiran File</p>
                    <div class="flex flex-col gap-4">
                        @php
                            $files = is_array($surat->files) ? $surat->files : json_decode($surat->files, true) ?? [];
                        @endphp

                        @forelse($files as $index => $file)
                            @php
                                $extension = pathinfo($file['original_name'] ?? '', PATHINFO_EXTENSION);
                                $fileId = "filePreview{$index}";
                            @endphp

                            <div class="border rounded-lg p-3 bg-gray-50">
                                {{-- Tombol untuk lihat file --}}
                                <button type="button" onclick="document.getElementById('{{ $fileId }}').classList.toggle('hidden')"
                                        class="px-4 py-2 bg-[#00C07F] text-white rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                                    <i class="fas fa-eye"></i> Lihat {{ $file['original_name'] ?? 'file' }}
                                </button>

                                {{-- Preview hidden --}}
                                <div id="{{ $fileId }}" class="mt-3 hidden">
                                    @if(in_array(strtolower($extension), ['pdf']))
                                        <iframe src="{{ asset('storage/' . ($file['path'] ?? '')) }}" class="w-full h-96 border rounded-lg"></iframe>
                                    @elseif(in_array(strtolower($extension), ['jpg','jpeg','png','gif']))
                                        <img src="{{ asset('storage/' . ($file['path'] ?? '')) }}" alt="{{ $file['original_name'] }}" class="w-full max-w-md border rounded-lg">
                                    @else
                                        <p class="text-gray-500 text-sm">Tidak dapat menampilkan file: {{ $file['original_name'] }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Tidak ada file</p>
                        @endforelse
                    </div>
                </div>

                {{-- Notifikasi jika sudah di approve --}}
                @if($surat->status === 'verified')
                    <div class="p-4 bg-green-50 text-green-700 rounded-lg text-sm font-medium">
                        Pengajuan Anda sudah disetujui. Silakan segera datang ke kantor untuk proses selanjutnya.
                    </div>
                @endif

                {{-- Kembali --}}
                <div class="flex justify-end">
                    <a href="{{ route('user.riwayat') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300 transition">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
