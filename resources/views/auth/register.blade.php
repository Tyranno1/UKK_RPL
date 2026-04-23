<x-guest-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100" style="font-family: 'Poppins', sans-serif;">

        <div class="flex w-[1000px] h-[620px] rounded-2xl overflow-hidden shadow-2xl">

            <div class="w-1/2 bg-white px-14 py-10 flex flex-col justify-center relative">

                <div class="absolute top-5 left-7">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto">
                    </a>
                </div>

                <h2 class="text-5xl font-black text-gray-900 text-right" style="font-family: 'Poppins', sans-serif;">
                    DAFTAR
                </h2>
                <p class="text-lg font-medium text-[#9e7a7a] mb-5 text-right" style="font-family: 'Poppins', sans-serif;">
                    Buat akun siswa baru
                </p>

                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="block text-xs font-semibold text-gray-600 mb-1" style="font-family: 'Poppins', sans-serif;">Nama Lengkap :</label>
                        <input
                            id="name" type="text" name="name"
                            value="{{ old('name') }}" required autofocus autocomplete="name"
                            style="font-family: 'Poppins', sans-serif;"
                            class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400"
                        >
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div class="mb-3">
                        <label for="nis_nip" class="block text-xs font-semibold text-gray-600 mb-1" style="font-family: 'Poppins', sans-serif;">NIS (Nomor Induk Siswa) :</label>
                        <input
                            id="nis_nip" type="text" name="nis_nip"
                            value="{{ old('nis_nip') }}" required
                            style="font-family: 'Poppins', sans-serif;"
                            class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400"
                        >
                        <x-input-error :messages="$errors->get('nis_nip')" class="mt-1" />
                    </div>

                    <div class="flex gap-3 mb-3">
                        <div class="w-1/2">
                            <label for="kelas" class="block text-xs font-semibold text-gray-600 mb-1" style="font-family: 'Poppins', sans-serif;">Kelas :</label>
                            <input
                                id="kelas" type="text" name="kelas"
                                value="{{ old('kelas') }}" required placeholder="XII RPL 3"
                                style="font-family: 'Poppins', sans-serif;"
                                class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400"
                            >
                            <x-input-error :messages="$errors->get('kelas')" class="mt-1" />
                        </div>
                        <div class="w-1/2">
                            <label for="telp" class="block text-xs font-semibold text-gray-600 mb-1" style="font-family: 'Poppins', sans-serif;">No. Telepon / WA :</label>
                            <input
                                id="telp" type="text" name="telp"
                                value="{{ old('telp') }}" required
                                style="font-family: 'Poppins', sans-serif;"
                                class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400"
                            >
                            <x-input-error :messages="$errors->get('telp')" class="mt-1" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="block text-xs font-semibold text-gray-600 mb-1" style="font-family: 'Poppins', sans-serif;">Email :</label>
                        <input
                            id="email" type="email" name="email"
                            value="{{ old('email') }}" required autocomplete="email"
                            style="font-family: 'Poppins', sans-serif;"
                            class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400"
                        >
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="flex gap-3 mb-5">
                        <div class="w-1/2">
                            <label for="password" class="block text-xs font-semibold text-gray-600 mb-1" style="font-family: 'Poppins', sans-serif;">Password :</label>
                            <div class="relative">
                                <input
                                    id="password" type="password" name="password" required autocomplete="new-password"
                                    style="font-family: 'Poppins', sans-serif;"
                                    class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 pr-10"
                                >
                                <button type="button" onclick="togglePassword('password', 'icon-hide-1', 'icon-show-1')"
                                    class="absolute bottom-[8px] right-3 flex items-center text-gray-400 hover:text-[#6b1a1a] transition">
                                    <svg id="icon-hide-1" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-7s4-7 9-7a9.96 9.96 0 015.657 1.757M15 12a3 3 0 11-4.5-2.598M3 3l18 18" />
                                    </svg>
                                    <svg id="icon-show-1" class="h-4 w-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                        <div class="w-1/2">
                            <label for="password_confirmation" class="block text-xs font-semibold text-gray-600 mb-1" style="font-family: 'Poppins', sans-serif;">Konfirmasi Password :</label>
                            <div class="relative">
                                <input
                                    id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                    style="font-family: 'Poppins', sans-serif;"
                                    class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 pr-10"
                                >
                                <button type="button" onclick="togglePassword('password_confirmation', 'icon-hide-2', 'icon-show-2')"
                                    class="absolute bottom-[8px] right-3 flex items-center text-gray-400 hover:text-[#6b1a1a] transition">
                                    <svg id="icon-hide-2" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-7s4-7 9-7a9.96 9.96 0 015.657 1.757M15 12a3 3 0 11-4.5-2.598M3 3l18 18" />
                                    </svg>
                                    <svg id="icon-show-2" class="h-4 w-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}"
                           class="text-xs text-emerald-700 font-semibold hover:text-[#6b1a1a] underline transition leading-5"
                           style="font-family: 'Poppins', sans-serif;">
                            Sudah punya akun?<br>Masuk Sekarang
                        </a>
                        <button type="submit"
                            style="font-family: 'Poppins', sans-serif;"
                            class="bg-[#6b1a1a] hover:bg-[#8b0000] text-white text-sm font-bold rounded-full px-9 py-3 tracking-wide transition duration-150 shadow-md">
                            Daftar
                        </button>
                    </div>

                </form>
            </div>

            <div class="w-1/2 relative overflow-hidden flex flex-col items-center justify-center" style="background-color: #5e0000;">
                <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full opacity-10" style="background-color: #fff;"></div>
                <div class="absolute -bottom-20 -left-20 w-96 h-96 rounded-full opacity-10" style="background-color: #fff;"></div>
                <div class="absolute top-1/3 right-1/4 w-32 h-32 rounded-full opacity-5" style="background-color: #fff;"></div>
                <h1 class="text-white text-5xl font-black tracking-widest opacity-30 z-10" style="font-family: 'Poppins', sans-serif;">SILOKA</h1>
                <p class="text-white text-xs text-center opacity-20 mt-2 px-8 z-10" style="font-family: 'Poppins', sans-serif;">Sistem Informasi Lapor & Kelola Aset</p>
            </div>

        </div>

        <p class="mt-6 text-xs text-emerald-800 opacity-50 font-medium" style="font-family: 'Poppins', sans-serif;">
            &copy; {{ date('Y') }} UKK Paket 3 - Aplikasi Pengaduan
        </p>

    </div>

    <script>
        function togglePassword(inputId, hideIconId, showIconId) {
            const input = document.getElementById(inputId);
            const iconHide = document.getElementById(hideIconId);
            const iconShow = document.getElementById(showIconId);

            if (input.type === 'password') {
                input.type = 'text';
                iconHide.classList.add('hidden');
                iconShow.classList.remove('hidden');
            } else {
                input.type = 'password';
                iconHide.classList.remove('hidden');
                iconShow.classList.add('hidden');
            }
        }
    </script>

</x-guest-layout>