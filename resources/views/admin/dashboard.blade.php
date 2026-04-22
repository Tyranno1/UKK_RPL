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

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition duration-150
                {{ request()->routeIs('admin.dashboard') ? 'bg-[#6b1a1a] text-white shadow-md' : 'text-gray-700 hover:bg-white hover:bg-opacity-50' }}">
                <i class="fa-solid fa-house w-5 text-center"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.kategori.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition duration-150
                {{ request()->routeIs('admin.kategori.*') ? 'bg-[#6b1a1a] text-white shadow-md' : 'text-gray-700 hover:bg-white hover:bg-opacity-50' }}">
                <i class="fa-solid fa-tags w-5 text-center"></i>
                Manajemen Kategori
            </a>

            <a href="{{ route('admin.pengguna.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition duration-150
                {{ request()->routeIs('admin.pengguna.*') ? 'bg-[#6b1a1a] text-white shadow-md' : 'text-gray-700 hover:bg-white hover:bg-opacity-50' }}">
                <i class="fa-solid fa-users w-5 text-center"></i>
                Manajemen User
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
                        <p class="text-[10px] text-gray-400">Admin</p>
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

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 ring-1 ring-gray-200 px-8 py-6 mb-6">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h3 class="text-sm font-black text-gray-800">Progress Tanggapan</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $ditanggapi }} dari {{ $totalAktif }} Pengaduan sudah diselesaikan</p>
                    </div>
                    <span class="text-3xl font-black text-[#6b1a1a]">{{ $persenDitanggapi }}%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden">
                    <div class="h-4 rounded-full transition-all duration-500"
                        style="width: {{ $persenDitanggapi }}%; background: linear-gradient(90deg, #6b1a1a, #b91c1c);">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-5 gap-4 mb-6">
                <a href="{{ route('admin.dashboard', ['status' => 'semua']) }}"
                    class="rounded-2xl shadow-sm border px-5 py-4 flex items-center gap-3 transition duration-150
                    {{ ($statusFilter ?? 'semua') == 'semua' ? 'bg-[#6b1a1a] border-[#6b1a1a] ring-2 ring-[#6b1a1a] ring-offset-2' : 'bg-white border-gray-200 hover:border-gray-300 ring-1 ring-gray-200' }}">
                    <div class="w-10 h-10 rounded-xl {{ ($statusFilter ?? 'semua') == 'semua' ? 'bg-white bg-opacity-20' : 'bg-[#6b1a1a] bg-opacity-10' }} flex items-center justify-center">
                        <i class="fa-solid fa-layer-group {{ ($statusFilter ?? 'semua') == 'semua' ? 'text-white' : 'text-[#6b1a1a]' }} text-base"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium {{ ($statusFilter ?? 'semua') == 'semua' ? 'text-white opacity-80' : 'text-gray-400' }}">Total</p>
                        <p class="text-xl font-black {{ ($statusFilter ?? 'semua') == 'semua' ? 'text-white' : 'text-gray-800' }}">{{ $total }}</p>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard', ['status' => '0']) }}"
                    class="rounded-2xl shadow-sm border px-5 py-4 flex items-center gap-3 transition duration-150
                    {{ ($statusFilter ?? '') == '0' ? 'bg-yellow-400 border-yellow-400 ring-2 ring-yellow-400 ring-offset-2' : 'bg-white border-gray-200 hover:border-yellow-200 ring-1 ring-gray-200' }}">
                    <div class="w-10 h-10 rounded-xl {{ ($statusFilter ?? '') == '0' ? 'bg-white bg-opacity-30' : 'bg-yellow-50' }} flex items-center justify-center">
                        <i class="fa-solid fa-clock {{ ($statusFilter ?? '') == '0' ? 'text-white' : 'text-yellow-500' }} text-base"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium {{ ($statusFilter ?? '') == '0' ? 'text-white' : 'text-gray-400' }}">Menunggu</p>
                        <p class="text-xl font-black {{ ($statusFilter ?? '') == '0' ? 'text-white' : 'text-yellow-500' }}">{{ $menunggu }}</p>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard', ['status' => '1']) }}"
                    class="rounded-2xl shadow-sm border px-5 py-4 flex items-center gap-3 transition duration-150
                    {{ ($statusFilter ?? '') == '1' ? 'bg-blue-400 border-blue-400 ring-2 ring-blue-400 ring-offset-2' : 'bg-white border-gray-200 hover:border-blue-200 ring-1 ring-gray-200' }}">
                    <div class="w-10 h-10 rounded-xl {{ ($statusFilter ?? '') == '1' ? 'bg-white bg-opacity-30' : 'bg-blue-50' }} flex items-center justify-center">
                        <i class="fa-solid fa-spinner {{ ($statusFilter ?? '') == '1' ? 'text-white' : 'text-blue-500' }} text-base"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium {{ ($statusFilter ?? '') == '1' ? 'text-white' : 'text-gray-400' }}">Diproses</p>
                        <p class="text-xl font-black {{ ($statusFilter ?? '') == '1' ? 'text-white' : 'text-blue-500' }}">{{ $diproses }}</p>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard', ['status' => '2']) }}"
                    class="rounded-2xl shadow-sm border px-5 py-4 flex items-center gap-3 transition duration-150
                    {{ ($statusFilter ?? '') == '2' ? 'bg-green-400 border-green-400 ring-2 ring-green-400 ring-offset-2' : 'bg-white border-gray-200 hover:border-green-200 ring-1 ring-gray-200' }}">
                    <div class="w-10 h-10 rounded-xl {{ ($statusFilter ?? '') == '2' ? 'bg-white bg-opacity-30' : 'bg-green-50' }} flex items-center justify-center">
                        <i class="fa-solid fa-circle-check {{ ($statusFilter ?? '') == '2' ? 'text-white' : 'text-green-500' }} text-base"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium {{ ($statusFilter ?? '') == '2' ? 'text-white' : 'text-gray-400' }}">Selesai</p>
                        <p class="text-xl font-black {{ ($statusFilter ?? '') == '2' ? 'text-white' : 'text-green-500' }}">{{ $selesai }}</p>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard', ['status' => '3']) }}"
                    class="rounded-2xl shadow-sm border px-5 py-4 flex items-center gap-3 transition duration-150
                    {{ ($statusFilter ?? '') == '3' ? 'bg-gray-400 border-gray-400 ring-2 ring-gray-400 ring-offset-2' : 'bg-white border-gray-200 hover:border-gray-300 ring-1 ring-gray-200' }}">
                    <div class="w-10 h-10 rounded-xl {{ ($statusFilter ?? '') == '3' ? 'bg-white bg-opacity-30' : 'bg-gray-50' }} flex items-center justify-center">
                        <i class="fa-solid fa-xmark {{ ($statusFilter ?? '') == '3' ? 'text-white' : 'text-gray-500' }} text-base"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium {{ ($statusFilter ?? '') == '3' ? 'text-white' : 'text-gray-400' }}">Ditolak</p>
                        <p class="text-xl font-black {{ ($statusFilter ?? '') == '3' ? 'text-white' : 'text-gray-500' }}">{{ $ditolak }}</p>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between gap-4">
                    <h2 class="text-sm font-black text-gray-800 whitespace-nowrap">
                        @if(($statusFilter ?? 'semua') == 'semua') Daftar Pengaduan Masuk
                        @elseif($statusFilter == '0') Pengaduan Menunggu
                        @elseif($statusFilter == '1') Pengaduan Diproses
                        @elseif($statusFilter == '2') Pengaduan Selesai
                        @elseif($statusFilter == '3') Pengaduan Ditolak
                        @endif
                    </h2>

                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2 flex-1 justify-end">

                        @if(($statusFilter ?? 'semua') !== 'semua')
                            <input type="hidden" name="status" value="{{ $statusFilter }}">
                        @endif

                        <div class="relative w-full max-w-xs">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-[10px]"></i>
                            <input
                                type="text"
                                name="search"
                                value="{{ $searchQuery ?? '' }}"
                                placeholder="Cari Nama, Judul, Kategori..."
                                class="w-full pl-8 pr-3 py-1.5 text-[11px] border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#6b1a1a] focus:border-transparent transition"
                            >
                        </div>
                        
                        <button type="submit" class="bg-[#6b1a1a] text-white py-2 px-3 rounded-lg hover:bg-[#8b0000] transition leading-none">
                            <i class="fa-solid fa-magnifying-glass text-[10px] mb-1"></i>
                        </button>

                        @if(!empty($searchQuery))
                            <a href="{{ route('admin.dashboard', ['status' => $statusFilter]) }}" 
                            class="bg-gray-100 text-gray-500 p-2 rounded-lg hover:bg-gray-200 transition leading-none" 
                            title="Reset">
                                <i class="fa-solid fa-rotate-left text-[10px]"></i>
                            </a>
                        @endif
                    </form>
                </div>

                @if(!empty($searchQuery))
                    <div class="px-6 py-2 bg-gray-50 border-b border-gray-100">
                        <p class="text-[10px] text-gray-400">
                            Hasil pencarian untuk: <span class="font-bold text-[#6b1a1a]">"{{ $searchQuery }}"</span> 
                            ({{ $pengaduans->total() }} data)
                        </p>
                    </div>
                @endif
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="px-6 py-3 text-xs font-bold text-black-200 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-xs font-bold text-black-200 uppercase tracking-wider">Pelapor</th>
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
                                <td class="px-6 py-4 text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-gray-700 font-medium">{{ $item->user->name }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $item->judul_laporan }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-400 text-xs">{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($item->status == '0')
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-yellow-100 text-yellow-700">Menunggu</span>
                                    @elseif($item->status == '1')
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-blue-100 text-blue-700">Diproses</span>
                                    @elseif($item->status == '2')
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-green-100 text-green-700">Selesai</span>
                                    @elseif($item->status == '3')
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-gray-100 text-gray-700">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <a href="{{ route('admin.pengaduan.show', $item->id) }}"
                                        class="inline-flex items-center gap-1 text-xs font-semibold font-black text-white bg-[#6b1a1a] hover:bg-[#8b0000] px-4 py-1.5 rounded-full transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400 text-sm">
                                    Belum ada pengaduan masuk untuk saat ini.
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