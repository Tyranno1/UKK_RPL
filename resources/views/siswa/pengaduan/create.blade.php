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
            <div>
                <p class="text-xs text-gray-400 font-medium">Selamat Datang Kembali,</p>
                <h1 class="text-lg font-black text-[#6b1a1a] leading-tight">{{ Auth::user()->name }}</h1>
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
                    <a href="#"
                        class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 font-medium">
                        <i class="fa-solid fa-user w-4 text-center"></i>
                        Profil Saya
                    </a>
                    <hr class="my-1 border-gray-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium">
                            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 px-8 py-6">
        @if(session('success'))
            <div class="mb-4 px-5 py-3 bg-green-100 text-green-700 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-lg font-black text-gray-800 mb-1">Buat Pengaduan Baru</h2>
        <p class="text-xs text-gray-400 mb-6">Isi form berikut untuk melaporkan kerusakan sarana & prasarana</p>
        <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-black-200 mb-1">Judul Laporan :</label>
                    <input type="text" name="judul_laporan" value="{{ old('judul_laporan') }}" required
                        placeholder="Contoh: Kursi kelas XII RPL 3 patah"
                        class="w-full rounded-xl bg-[#e6fffa] border-none px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    @error('judul_laporan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-black-200 mb-1">Kategori :</label>
                    <select name="kategori_id" required
                        class="w-full rounded-xl bg-[#e6fffa] border-none px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <option value="" class="bg-white">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option class="bg-white" value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-black-200 mb-1">Tanggal Kejadian :</label>
                    <input type="date" name="tgl_pengaduan" value="{{ old('tgl_pengaduan', date('Y-m-d')) }}" required
                        class="w-full rounded-xl bg-[#e6fffa] border-none px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    @error('tgl_pengaduan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-black-200 mb-1">Lokasi Kejadian :</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" required
                        placeholder="Contoh: Kelas XII RPL 3"
                        class="w-full rounded-xl bg-[#e6fffa] border-none px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                    @error('lokasi')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-black-200 mb-1">Detail Laporan :</label>
                <textarea name="isi_laporan" rows="5" required
                    placeholder="Jelaskan kerusakan secara detail, termasuk penyebab, dampak, dan informasi penting lainnya..."
                    class="w-full rounded-xl bg-[#e6fffa] border-none px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 resize-none">{{ old('isi_laporan') }}</textarea>
                @error('isi_laporan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-black-200 mb-2">Foto Kerusakan :</label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#6b1a1a] file:text-white hover:file:bg-[#8b0000]">
                    @error('foto')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <a href="{{ route('siswa.dashboard') }}"
                    class="text-xs text-gray-500 hover:text-[#6b1a1a] font-semibold transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Dashboard
                </a>
                <button type="submit"
                    class="bg-[#6b1a1a] hover:bg-[#8b0000] text-white text-sm font-bold rounded-full px-8 py-2.5 tracking-wide transition duration-150 shadow-md">
                    Kirim Laporan
                </button>
            </div>

        </form>
    </div>
</main>
    </div>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdown-menu');
            menu.classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('dropdown-menu');
            const btn = e.target.closest('button[onclick="toggleDropdown()"]');
            if (!btn && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
    </script>

@endsection