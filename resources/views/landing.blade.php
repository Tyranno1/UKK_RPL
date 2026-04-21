<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILOKA — Sistem Informasi Lapor & Kelola Aset</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800" style="font-family: 'Poppins';">

    <nav class="fixed top-0 left-0 right-0 z-50 bg-white bg-opacity-90 backdrop-blur border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                <div>
                    <p class="text-sm font-black text-[#6b1a1a] tracking-widest leading-none">SILOKA</p>
                    <p class="text-[10px] text-gray-400 leading-tight">Sistem Informasi Lapor & Kelola Aset</p>
                </div>
            </div>
            <a href="{{ route('login') }}" class="text-sm font-bold text-[#6b1a1a] hover:underline">
                Masuk →
            </a>
        </div>
    </nav>

    <section class="min-h-screen flex items-center">
        <div class="max-w-6xl mx-auto px-8 w-full grid grid-cols-2 gap-20 items-center">
            <div>
                <div class="flex items-center gap-2 mb-5">
                    <div class="w-6 h-px bg-[#6b1a1a]"></div>
                    <p class="text-[11px] font-semibold text-[#6b1a1a] tracking-wider italic">
                        "SMK Bisa, SMK Hebat, SMK Kuat, Menguatkan Indonesia!"
                    </p>
                </div>

                <h1 class="text-5xl font-black text-gray-900 leading-tight mb-6">
                    Laporkan.<br>
                    <span class="text-[#6b1a1a]">Pantau.</span><br>
                    Selesaikan.
                </h1>
                <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-sm">
                    SILOKA adalah platform pengaduan sarana dan prasarana sekolah.
                    Sampaikan laporanmu, pantau prosesnya secara transparan.
                </p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}"
                        class="px-8 py-3 bg-[#6b1a1a] hover:bg-[#8b0000] text-white text-sm font-bold rounded-xl transition">
                        Buat Laporan
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition">
                        Masuk sebagai Admin
                    </a>
                </div>
            </div>

        <div class="relative flex items-center justify-center h-96">

            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle, #6b1a1a18 2px, transparent 1.5px); background-size: 24px 24px;">
            </div>

            <div class="relative">
                
                <div class="absolute -top-6 -left-12 z-20 bg-white rounded-xl shadow-xl border border-gray-100 px-4 py-2 whitespace-nowrap">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-green-500 text-xs"></i>
                        <p class="text-[10px] font-bold text-gray-700">Laporan #021 selesai</p>
                    </div>
                </div>

                <div class="relative z-10 bg-white rounded-2xl shadow-2xl border border-gray-100 px-8 py-5 w-64">
                    <p class="text-[10px] text-gray-400 font-medium mb-4 uppercase tracking-wider">Status Pengaduan</p>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                                <span class="text-xs font-semibold text-gray-700">Menunggu</span>
                            </div>
                            <span class="text-xs font-black text-yellow-500">3</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                                <span class="text-xs font-semibold text-gray-700">Diproses</span>
                            </div>
                            <span class="text-xs font-black text-blue-500">5</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-400"></div>
                                <span class="text-xs font-semibold text-gray-700">Selesai</span>
                            </div>
                            <span class="text-xs font-black text-green-500">12</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                                <span class="text-xs font-semibold text-gray-700">Ditolak</span>
                            </div>
                            <span class="text-xs font-black text-gray-400">1</span>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-t border-gray-50">
                        <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                            <div class="h-1.5 rounded-full bg-gradient-to-r from-[#6b1a1a] to-red-400" style="width: 57%"></div>
                        </div>
                        <p class="text-[9px] text-gray-400 mt-2">57% pengaduan diselesaikan</p>
                    </div>
                </div>

                <div class="absolute -bottom-6 -right-12 z-20 bg-white rounded-xl border border-gray-200 px-4 py-2 whitespace-nowrap 
                            shadow-[-10px_-10px_30px_rgba(0,0,0,0.1),10px_10px_20px_rgba(0,0,0,0.05)]">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-bell text-[#6b1a1a] text-xs"></i>
                        <p class="text-[10px] font-bold text-gray-800">Tanggapan baru masuk</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-8">
        <div class="border-t border-gray-300"></div>
    </div>

    <section class="py-24">
        <div class="max-w-6xl mx-auto px-8">
            <div class="mb-12">
                <p class="text-xs font-bold text-[#6b1a1a] uppercase tracking-widest mb-2">Kenapa SILOKA?</p>
                <h2 class="text-3xl font-black text-gray-900">Laporan yang gak bakal<br>dicuekin.</h2>
            </div>

            <div class="grid grid-cols-3 gap-6">

                <div class="group bg-gray-50 hover:bg-[#6b1a1a] rounded-2xl px-8 py-6 border border-gray-100 hover:border-[#6b1a1a] transition-all duration-300 cursor-default">
                    <div class="w-10 h-10 rounded-xl bg-[#6b1a1a] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 flex items-center justify-center mb-4 transition-all duration-300">
                        <i class="fa-solid fa-inbox text-[#6b1a1a] group-hover:text-white text-sm transition-all duration-300"></i>
                    </div>
                    <h3 class="text-sm font-bold text-gray-800 group-hover:text-white mb-2 transition-all duration-300">Anti-Dicuekin</h3>
                    <p class="text-xs text-gray-400 group-hover:text-white group-hover:opacity-70 leading-relaxed transition-all duration-300">
                        Laporanmu langsung masuk ke sistem admin dan tercatat resmi — bukan cuma omongan di lorong sekolah.
                    </p>
                </div>

                <div class="group bg-gray-50 hover:bg-[#6b1a1a] rounded-2xl px-8 py-6 border border-gray-100 hover:border-[#6b1a1a] transition-all duration-300 cursor-default">
                    <div class="w-10 h-10 rounded-xl bg-[#6b1a1a] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 flex items-center justify-center mb-4 transition-all duration-300">
                        <i class="fa-solid fa-magnifying-glass text-[#6b1a1a] group-hover:text-white text-sm transition-all duration-300"></i>
                    </div>
                    <h3 class="text-sm font-bold text-gray-800 group-hover:text-white mb-2 transition-all duration-300">Transparan</h3>
                    <p class="text-xs text-gray-400 group-hover:text-white group-hover:opacity-70 leading-relaxed transition-all duration-300">
                        Kamu bisa lihat prosesnya sampai mana secara langsung — dari Menunggu, Diproses, sampai benar-benar Selesai.
                    </p>
                </div>

                <div class="group bg-gray-50 hover:bg-[#6b1a1a] rounded-2xl px-8 py-6 border border-gray-100 hover:border-[#6b1a1a] transition-all duration-300 cursor-default">
                    <div class="w-10 h-10 rounded-xl bg-[#6b1a1a] bg-opacity-10 group-hover:bg-white group-hover:bg-opacity-20 flex items-center justify-center mb-4 transition-all duration-300">
                        <i class="fa-solid fa-circle-check text-[#6b1a1a] group-hover:text-white text-sm transition-all duration-300"></i>
                    </div>
                    <h3 class="text-sm font-bold text-gray-800 group-hover:text-white mb-2 transition-all duration-300">Pasti Kelar</h3>
                    <p class="text-xs text-gray-400 group-hover:text-white group-hover:opacity-70 leading-relaxed transition-all duration-300">
                        Gak cuma lapor terus lupa. Admin akan kasih tanggapan resmi dan update status kalau sudah beres.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-8">
        <div class="border-t border-gray-100"></div>
    </div>

    <section class="py-24">
        <div class="max-w-6xl mx-auto px-8">
            <div class="mb-12">
                <p class="text-xs font-bold text-[#6b1a1a] uppercase tracking-widest mb-2">Cara Kerja</p>
                <h2 class="text-3xl font-black text-gray-900">Tiga langkah sederhana.</h2>
            </div>

            <div class="grid grid-cols-3 gap-8">

                <div class="relative">
                    <div class="w-10 h-10 rounded-xl bg-[#6b1a1a] bg-opacity-10 flex items-center justify-center mb-4">
                        <span class="text-sm font-black text-[#6b1a1a]">01</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Buat Laporan</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Isi formulir pengaduan dengan judul, deskripsi, lokasi, dan foto bukti kerusakan.
                    </p>
                    <div class="hidden md:block absolute top-5 left-full w-full h-px bg-gray-100 -translate-x-4"></div>
                </div>

                <div class="relative">
                    <div class="w-10 h-10 rounded-xl bg-[#6b1a1a] bg-opacity-10 flex items-center justify-center mb-4">
                        <span class="text-sm font-black text-[#6b1a1a]">02</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Admin Merespons</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Tim admin meninjau laporanmu dan memberikan tanggapan resmi beserta tindak lanjut.
                    </p>
                    <div class="hidden md:block absolute top-5 left-full w-full h-px bg-gray-100 -translate-x-4"></div>
                </div>

                <div>
                    <div class="w-10 h-10 rounded-xl bg-[#6b1a1a] bg-opacity-10 flex items-center justify-center mb-4">
                        <span class="text-sm font-black text-[#6b1a1a]">03</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Pantau Status</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Lacak perkembangan laporanmu secara real-time dari Menunggu hingga Selesai.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="pb-24">
        <div class="max-w-6xl mx-auto px-8">
            <div class="bg-[#6b1a1a] rounded-3xl px-12 py-12 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-black text-white mb-1">Ada yang perlu dilaporkan?</h2>
                    <p class="text-sm text-white opacity-60">Masuk dan buat laporan sekarang.</p>
                </div>
                <a href="{{ route('login') }}"
                    class="px-8 py-3 bg-white text-[#6b1a1a] text-sm font-black rounded-xl hover:bg-gray-100 transition shrink-0">
                    Mulai Sekarang
                </a>
            </div>
            <p class="text-center text-[10px] text-gray-500 mt-6">
                © {{ date('Y') }} UKK Paket 3 - Aplikasi Pengaduan Sarana & Prasarana Sekolah
            </p>
        </div>
    </section>

</body>
</html>