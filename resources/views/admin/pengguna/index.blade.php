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
                <p class="text-xs text-gray-400 font-medium">Manajemen</p>
                <h1 class="text-lg font-black text-[#6b1a1a] leading-tight">Pengguna</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pengguna.create') }}"
                    class="inline-flex items-center gap-2 bg-[#6b1a1a] hover:bg-[#8b0000] text-white text-xs font-black rounded-xl px-4 py-2.5 transition">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Pengguna
                </a>
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
            </div>
        </header>

        <main class="flex-1 px-8 py-6">

            @if(session('success'))
                <div class="mb-4 px-5 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl font-medium">
                    <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 px-5 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl font-medium">
                    <i class="fa-solid fa-circle-xmark mr-2"></i>{{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-3 gap-4 mb-6">
                <a href="{{ route('admin.pengguna.index')}}" class="bg-[#6b1a1a] rounded-2xl border border-gray-100 shadow-sm px-5 py-4 flex items-center gap-3 transition duration-150 {{ $levelFilter == 'semua' ? 'bg-[#6b1a1a] border-[#6b1a1a] ring-2 ring-[#6b1a1a] ring-offset-2' : 'bg-white border-gray-200 hover:border-gray-300 ring-1 ring-gray-200' }}">

                    <div class="w-10 h-10 rounded-xl {{ $levelFilter == 'semua' ? 'bg-white bg-opacity-20' : 'bg-[#6b1a1a] bg-opacity-10' }} flex items-center justify-center">
                        <i class="fa-solid fa-users {{ $levelFilter == 'semua' ? 'text-white' : 'text-[#6b1a1a]' }} text-base"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium {{ $levelFilter == 'semua' ? 'text-white opacity-80' : 'text-gray-400' }}">Total Pengguna</p>
                        <p class="text-xl font-black {{ $levelFilter == 'semua' ? 'text-white' : 'text-gray-800' }}">{{ $totalSemua }}</p>
                    </div>
                </a>
                <a href="{{ route('admin.pengguna.index', ['level' => 'admin']) }}"
                class="rounded-2xl border shadow-sm px-5 py-4 flex items-center gap-3 transition duration-150
                {{ $levelFilter == 'admin' ? 'bg-yellow-400 border-yellow-400 ring-2 ring-yellow-400 ring-offset-2' : 'bg-white border-gray-200 hover:border-yellow-200 ring-1 ring-gray-200' }}">
                <div class="w-10 h-10 rounded-xl {{ $levelFilter == 'admin' ? 'bg-white bg-opacity-30' : 'bg-yellow-50' }} flex items-center justify-center">
                    <i class="fa-solid fa-user-shield {{ $levelFilter == 'admin' ? 'text-white' : 'text-yellow-400' }} text-base"></i>
                </div>
                <div>
                    <p class="text-[10px] font-medium {{ $levelFilter == 'admin' ? 'text-white opacity-80' : 'text-gray-400' }}">Admin</p>
                    <p class="text-xl font-black {{ $levelFilter == 'admin' ? 'text-white' : 'text-gray-800' }}">{{ $totalAdmin }}</p>
                </div>
            </a>
            <a href="{{ route('admin.pengguna.index', ['level' => 'siswa']) }}"
                class="rounded-2xl border shadow-sm px-5 py-4 flex items-center gap-3 transition duration-150
                {{ $levelFilter == 'siswa' ? 'bg-blue-400 border-blue-400 ring-2 ring-lue-400 ring-offset-2' : 'bg-white border-gray-100 hover:border-blue-200 ring-1 ring-gray-200' }}">
                <div class="w-10 h-10 rounded-xl {{ $levelFilter == 'siswa' ? 'bg-white bg-opacity-30' : 'bg-blue-50' }} flex items-center justify-center">
                    <i class="fa-solid fa-user-graduate {{ $levelFilter == 'siswa' ? 'text-white' : 'text-blue-500' }} text-base"></i>
                </div>
                <div>
                    <p class="text-[10px] font-medium {{ $levelFilter == 'siswa' ? 'text-white' : 'text-gray-400' }}">Siswa</p>
                    <p class="text-xl font-black {{ $levelFilter == 'siswa' ? 'text-white' : 'text-blue-500' }}">{{ $totalSiswa }}</p>
                </div>
            </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between gap-4">
                    <h2 class="text-sm font-bold text-gray-800 whitespace-nowrap">
                        @if($levelFilter == 'semua') Semua Pengguna
                        @elseif($levelFilter == 'siswa') Daftar Siswa
                        @elseif($levelFilter == 'admin') Daftar Admin
                        @endif
                    </h2>

                    <form method="GET" action="{{ route('admin.pengguna.index') }}" class="flex items-center gap-2 flex-1 justify-end">
                        @if($levelFilter !== 'semua')
                            <input type="hidden" name="level" value="{{ $levelFilter }}">
                        @endif
                        <div class="relative w-full max-w-xs">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-[10px]"></i>
                            <input type="text" name="search" value="{{ $searchQuery }}"
                                placeholder="Cari nama, email, kelas..."
                                class="w-full pl-8 pr-3 py-1.5 text-[11px] border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#6b1a1a] transition">
                        </div>
                        <button type="submit" class="bg-[#6b1a1a] text-white py-2 px-3 rounded-lg hover:bg-[#8b0000] transition">
                            <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                        </button>
                        @if(!empty($searchQuery))
                            <a href="{{ route('admin.pengguna.index', ['level' => $levelFilter]) }}"
                                class="bg-gray-100 text-gray-500 p-2 rounded-lg hover:bg-gray-200 transition">
                                <i class="fa-solid fa-rotate-left text-[10px]"></i>
                            </a>
                        @endif
                    </form>
                </div>

                @if(!empty($searchQuery))
                    <div class="px-6 py-2 bg-gray-50 border-b border-gray-100">
                        <p class="text-[10px] text-gray-400">
                            Hasil untuk: <span class="font-bold text-[#6b1a1a]">"{{ $searchQuery }}"</span>
                            ({{ $users->total() }} pengguna)
                        </p>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">NIS/NIP</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Level</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal Daftar</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition {{ $user->id === Auth::id() ? 'bg-yellow-50' : '' }}">
                                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-gray-500 text-xs font-mono">{{ $user->nis_nip }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-[#6b1a1a] flex items-center justify-center text-white text-[10px] font-bold shrink-0">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span class="font-semibold text-gray-800 text-xs">{{ $user->name }}</span>
                                        @if($user->id === Auth::id())
                                            <span class="text-[9px] bg-yellow-100 text-yellow-600 px-1.5 py-0.5 rounded font-bold">Kamu</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-gray-500 text-xs">{{ $user->kelas ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($user->level === 'admin')
                                        <span class="px-2 py-1 rounded-full text-[10px] font-bold bg-[#6b1a1a] bg-opacity-10 text-[#6b1a1a] uppercase">Admin</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-blue-600 uppercase">Siswa</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs">
                                    {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                                            class="inline-flex items-center gap-1 text-xs font-bold text-white bg-blue-500 hover:bg-blue-600 px-3 py-1.5 rounded-lg transition">
                                            <i class="fa-solid fa-pen text-[10px]"></i> Edit
                                        </a>
                                        @if($user->id !== Auth::id())
                                        <form method="POST" action="{{ route('admin.pengguna.destroy', $user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Hapus pengguna {{ $user->name }}?')"
                                                class="inline-flex items-center gap-1 text-xs font-bold text-white bg-red-400 hover:bg-red-500 px-3 py-1.5 rounded-lg transition">
                                                <i class="fa-solid fa-trash text-[10px]"></i> Hapus
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400 text-sm">
                                    Belum ada pengguna ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
                @endif
            </div>

        </main>
    </div>
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
</script>

@endsection