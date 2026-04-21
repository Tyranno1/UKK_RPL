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
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm font-black text-black">Semua Riwayat Pengaduan Saya</h2>
                    <a href="{{ route('siswa.dashboard') }}" class="text-xs text-gray-500 hover:text-[#6b1a1a] font-semibold hover:underline transition">Kembali</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="px-6 py-3 text-xs font-bold text-black-200 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-xs font-bold text-black-200 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-xs font-bold text-black-200 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-xs font-bold text-black-200 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-xs font-bold text-black-200 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-xs font-bold text-black-200 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($pengaduans as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $item->judul_laporan }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-400 text-xs">{{ $item->tgl_pengaduan }}</td>
                                <td class="px-6 py-4">
                                    @if($item->status == '0')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Menunggu</span>
                                    @elseif($item->status == '1')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Diproses</span>
                                    @elseif($item->status == '2')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Selesai</span>
                                    @elseif($item->status == '3')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('pengaduan.show', $item->id) }}"
                                        class="text-xs font-semibold text-[#6b1a1a] hover:underline">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                    Belum ada pengaduan.
                                    <a href="{{ route('pengaduan.create') }}" class="text-[#6b1a1a] font-semibold underline">Buat sekarang</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
</div>

@endsection