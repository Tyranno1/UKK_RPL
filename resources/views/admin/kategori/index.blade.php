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
                <h1 class="text-lg font-bold text-[#6b1a1a] leading-tight">Kategori Pengaduan</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.kategori.create') }}"
                    class="inline-flex items-center gap-2 bg-[#6b1a1a] hover:bg-[#8b0000] text-white text-xs font-bold rounded-xl px-4 py-2.5 transition">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Kategori
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

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm font-bold text-gray-800">Daftar Kategori</h2>
                    <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-1 rounded-md font-bold uppercase tracking-wider">
                        {{ $kategoris->total() }} kategori
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">Jml Pengaduan</th>
                                <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider">Dibuat</th>
                                <th class="pl-12 py-3 text-xs font-bold text-gray-600 uppercase tracking-wider text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($kategoris as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->nama_kategori }}</td>
                                <td class="px-6 py-4 text-gray-500 text-xs">{{ $item->deskripsi ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold
                                        {{ $item->pengaduan_count > 0 ? 'bg-[#6b1a1a] bg-opacity-10 text-[#6b1a1a]' : 'bg-gray-100 text-gray-400' }}">
                                        {{ $item->pengaduan_count }} pengaduan
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs">
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.kategori.edit', $item->id) }}"
                                            class="inline-flex items-center gap-1 text-xs font-bold text-white bg-blue-500 hover:bg-blue-600 px-3 py-1.5 rounded-lg transition">
                                            <i class="fa-solid fa-pen text-[10px]"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.kategori.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Hapus kategori {{ $item->nama_kategori }}?')"
                                                class="inline-flex items-center gap-1 text-xs font-bold text-white bg-red-400 hover:bg-red-500 px-3 py-1.5 rounded-lg transition">
                                                <i class="fa-solid fa-trash text-[10px]"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                    Belum ada kategori. <a href="{{ route('admin.kategori.create') }}" class="text-[#6b1a1a] font-semibold underline">Tambah sekarang</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($kategoris->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $kategoris->links() }}
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