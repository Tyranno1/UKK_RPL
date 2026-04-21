@extends('layouts.app')

@section('content')

<div class="min-h-screen flex bg-gray-50" style="font-family: 'Poppins', sans-serif;">

    <aside class="w-64 min-h-screen flex flex-col fixed top-0 left-0 z-30"
        style="background: linear-gradient(150deg, #fefefe 1%, #b2f0d8 65%, #6b1a1a 100%);">
        <div class="flex items-center gap-3 px-6 py-6 border-b border-white border-opacity-30">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
            <div>
                <p class="text-xs font-black text-[#6b1a1a] tracking-widest leading-none">SILOKA</p>
                <p class="text-[10px] text-gray-500 leading-tight">Sistem Informasi Lapor & Kelola Aset</p>
            </div>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-2">
            <a href="{{ route('siswa.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition duration-150
                {{ request()->routeIs('siswa.dashboard') ? 'bg-[#6b1a1a] text-white shadow-md' : 'text-gray-700 hover:bg-white hover:bg-opacity-50' }}">
                <i class="fa-solid fa-house w-5 text-center"></i>
                Dashboard
            </a>
            <a href="{{ route('pengaduan.create') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition duration-150
                {{ request()->routeIs('pengaduan.create') ? 'bg-[#6b1a1a] text-white shadow-md' : 'text-gray-700 hover:bg-white hover:bg-opacity-50' }}">
                <i class="fa-solid fa-pen-to-square w-5 text-center"></i>
                Buat Pengaduan
            </a>
            <a href="{{ route('pengaduan.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition duration-150
                {{ request()->routeIs('pengaduan.index') || request()->routeIs('pengaduan.show') ? 'bg-[#6b1a1a] text-white shadow-md' : 'text-gray-700 hover:bg-white hover:bg-opacity-50' }}">
                <i class="fa-solid fa-clipboard-list w-5 text-center"></i>
                Riwayat Pengaduan
            </a>
        </nav>
        <div class="px-6 py-4">
            <p class="text-[9px] text-black opacity-50 text-center">© {{ date('Y') }} UKK Paket 3 - Aplikasi Pengaduan Sarana & Prasarana Sekolah</p>
        </div>
    </aside>

    
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

    
        <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between sticky top-0 z-20">
            <div class="flex items-center gap-3">
                <a href="{{ route('siswa.dashboard') }}"
                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition">
                    <i class="fa-solid fa-arrow-left text-gray-500 text-xs"></i>
                </a>
                <div>
                    <p class="text-xs text-gray-400 font-medium">Detail Pengaduan</p>
                    <h1 class="text-base font-bold text-[#6b1a1a] leading-tight">{{ $pengaduan->judul_laporan }}</h1>
                </div>
            </div>
            <div class="relative">
                <button onclick="toggleDropdown()"
                    class="flex items-center gap-3 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-full px-4 py-2 transition">
                    <div class="w-8 h-8 rounded-full bg-[#6b1a1a] flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-bold text-gray-800 leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-400">{{ Auth::user()->kelas ?? 'Siswa' }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                    <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 font-medium">
                        <i class="fa-solid fa-user w-4 text-center"></i>
                        Profil Saya
                    </a>
                    <hr class="my-1 border-gray-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium">
                            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 px-8 py-6">
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-2 space-y-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-gray-800">Isi Laporan</h3>
                            @if($pengaduan->status == '0')
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-yellow-100 text-yellow-700">Menunggu</span>
                            @elseif($pengaduan->status == '1')
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-blue-100 text-blue-700">Diproses</span>
                            @elseif($pengaduan->status == '2')
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-green-100 text-green-700">Selesai</span>
                            @elseif($pengaduan->status == '3')
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-gray-100 text-gray-700">Ditolak</span>
                            @endif
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div>
                                <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">Kategori</p>
                                <p class="text-sm font-semibold text-gray-700 mt-0.5">{{ $pengaduan->kategori->nama_kategori ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">Tanggal Lapor</p>
                                <p class="text-sm font-semibold text-gray-700 mt-0.5">
                                    {{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">Lokasi</p>
                                <p class="text-sm font-semibold text-gray-700 mt-0.5">{{ $pengaduan->lokasi }}</p>
                            </div>
                        </div>
                        <h2 class="text-sm font-bold text-gray-800 mb-2">{{ $pengaduan->judul_laporan }}</h2>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $pengaduan->isi_laporan }}</p>
                        @if($pengaduan->foto)
                            <div class="mt-4">
                                <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider mb-2">Foto Bukti</p>
                                <img src="{{ asset('storage/' . $pengaduan->foto) }}"
                                    alt="Foto Bukti"
                                    class="rounded-xl max-h-72 object-cover border border-gray-100 cursor-pointer hover:opacity-90 transition"
                                    onclick="openLightbox(this.src)">
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">
                        <h3 class="text-sm font-bold text-gray-800 mb-3">Tanggapan Admin</h3>

                        @if($pengaduan->tanggapan)
                            <div class="bg-gray-50 rounded-xl px-4 py-3">
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $pengaduan->tanggapan->tanggapan }}</p>
                                <p class="text-[10px] text-gray-400 mt-2">
                                    {{ \Carbon\Carbon::parse($pengaduan->tanggapan->tgl_tanggapan)->translatedFormat('d F Y') }}
                                    — oleh <span class="font-semibold">{{ $pengaduan->tanggapan->petugas->name ?? '-' }}</span>
                                </p>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-xl px-4 py-4 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-clock text-gray-400 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-400">Belum ada tanggapan</p>
                                    <p class="text-[10px] text-gray-300 mt-0.5">Admin sedang meninjau pengaduanmu</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="space-y-6">
                
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-5">
                        <h3 class="text-sm font-bold text-gray-800 mb-5">Timeline</h3>
                        <div class="flex flex-col">

                            <div class="flex gap-3 items-start">
                                <div class="flex flex-col items-center pt-1">
                                    <div class="w-4 h-4 rounded-full bg-[#6b1a1a] ring-4 ring-[#6b1a1a] ring-opacity-10 shrink-0"></div>
                                    <div class="w-px flex-1 bg-gray-200 my-2"></div>
                                </div>
                                <div class="pb-6">
                                    <p class="text-xs font-bold text-gray-800">Pengaduan Dibuat</p>
                                    <p class="text-[10px] text-gray-400 mt-1 mb-4">
                                        {{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-3 items-start">
                                <div class="flex flex-col items-center pt-1">
                                    <div class="w-4 h-4 rounded-full shrink-0
                                        {{ $pengaduan->processed_at
                                            ? 'bg-blue-400 ring-4 ring-blue-400 ring-opacity-10'
                                            : 'bg-gray-200' }}">
                                    </div>
                                    <div class="w-px flex-1 bg-gray-200 my-2"></div>
                                </div>
                                <div class="pb-6">
                                    <p class="text-xs {{ $pengaduan->processed_at ? 'font-bold text-gray-800' : 'font-medium text-gray-300' }}">
                                        Mulai Diproses
                                    </p>
                                    <p class="text-[10px] mt-1 mb-4 {{ $pengaduan->processed_at ? 'text-gray-400' : 'text-gray-200' }}">
                                        {{ $pengaduan->processed_at
                                            ? \Carbon\Carbon::parse($pengaduan->processed_at)->translatedFormat('d F Y, H:i') . ' WIB'
                                            : 'Belum diproses' }}
                                    </p>
                                </div>
                            </div>

                            @if($pengaduan->status == '3')
                            <div class="flex gap-3 items-start">
                                <div class="flex flex-col items-center pt-1">
                                    <div class="w-4 h-4 rounded-full bg-red-400 ring-4 ring-red-400 ring-opacity-10 shrink-0"></div>
                                </div>
                                <div class="pb-6">
                                    <p class="text-xs font-bold text-gray-800">Ditolak</p>
                                    <p class="text-[10px] text-gray-400 mt-1 mb-4">
                                        {{ \Carbon\Carbon::parse($pengaduan->rejected_at)->translatedFormat('d F Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                            @else
                            <div class="flex gap-3 items-start">
                                <div class="flex flex-col items-center pt-1">
                                    <div class="w-4 h-4 rounded-full shrink-0
                                        {{ $pengaduan->completed_at
                                            ? 'bg-green-400 ring-4 ring-green-400 ring-opacity-10'
                                            : 'bg-gray-200' }}">
                                    </div>
                                </div>
                                <div class="pb-6">
                                    <p class="text-xs {{ $pengaduan->completed_at ? 'font-bold text-gray-800' : 'font-medium text-gray-300' }}">
                                        Selesai
                                    </p>
                                    <p class="text-[10px] mt-1 mb-4 {{ $pengaduan->completed_at ? 'text-gray-400' : 'text-gray-200' }}">
                                        {{ $pengaduan->completed_at
                                            ? \Carbon\Carbon::parse($pengaduan->completed_at)->translatedFormat('d F Y, H:i') . ' WIB'
                                            : 'Belum selesai' }}
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<div id="lightbox" class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center"
    onclick="closeLightbox()">
    <img id="lightbox-img" src="" class="max-h-[90vh] max-w-[90vw] rounded-2xl shadow-2xl">
</div>

<script>
    function toggleDropdown() {
        document.getElementById('dropdown-menu').classList.toggle('hidden');
    }
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('dropdown-menu');
        const btn = e.target.closest('button[onclick="toggleDropdown()"]');
        if (!btn && !menu.classList.contains('hidden')) menu.classList.add('hidden');
    });
    function openLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox').classList.remove('hidden');
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
    }
</script>

@endsection