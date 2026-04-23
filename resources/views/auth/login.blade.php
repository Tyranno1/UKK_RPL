<x-guest-layout>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    </head>

    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100" style="font-family: 'Poppins', sans-serif;">

        <div class="flex w-[1000px] h-[620px] rounded-2xl overflow-hidden shadow-2xl">

            <div class="w-1/2 relative overflow-hidden flex flex-col items-center justify-center" style="background-color: #5e0000;">
                <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full opacity-10" style="background-color: #fff;"></div>
                <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full opacity-10" style="background-color: #fff;"></div>
                <h1 class="text-white text-5xl font-black tracking-widest opacity-30 z-10" style="font-family: 'Poppins', sans-serif;">SILOKA</h1>
                <p class="text-white text-xs text-center opacity-20 mt-2 px-8 z-10" style="font-family: 'Poppins', sans-serif;">Sistem Informasi Lapor & Kelola Aset</p>
            </div>

            <div class="w-1/2 bg-white px-14 py-10 flex flex-col justify-center relative">

                <div class="absolute top-5 right-7">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto">
                    </a>
                </div>

                <h2 class="text-5xl font-black text-gray-900" style="font-family: 'Poppins', sans-serif;">
                    SILOKA
                </h2>
                <p class="text-lg font-medium text-[#9e7a7a] mb-8" style="font-family: 'Poppins', sans-serif;">
                    Sistem Informasi Lapor & Kelola Aset
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf

                    <div class="mb-5">
                        <label for="nis_nip" class="block text-md font-semibold text-gray-600 mb-2" style="font-family: 'Poppins', sans-serif;">
                            NIS / NIP :
                        </label>
                        <input
                            id="nis_nip" type="text" name="nis_nip"
                            value="{{ old('nis_nip') }}" required autofocus
                            style="font-family: 'Poppins', sans-serif;"
                            class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2.5 mb-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 text-md"
                        >
                        <x-input-error :messages="$errors->get('nis_nip')" class="mt-1" />
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-md font-semibold text-gray-600" mb-2 style="font-family: 'Poppins', sans-serif;">
                            Password :
                        </label>
                        <div class="relative">
                            <input
                                id="password" type="password" name="password" required
                                style="font-family: 'Poppins', sans-serif;"
                                class="w-full rounded-full bg-[#e6fffa] border-none px-5 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-400 pr-12"
                            >
                            <button
                                type="button"
                                onclick="togglePassword('password', 'password-icon')"
                                class="absolute right-5 top-1/2 -translate-y-1/2 mb-1 flex items-center text-gray-500 hover:text-[#6b1a1a] transition"
                            >
                                <i id="password-icon" class="fa-solid fa-eye-slash text-lg"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex items-center mb-7">
                        <input
                            id="remember_me" type="checkbox" name="remember"
                            class="rounded border-gray-300 text-[#6b1a1a] shadow-sm focus:ring-[#6b1a1a]"
                        >
                        <label for="remember_me" class="ms-2 text-xs text-gray-500 font-medium" style="font-family: 'Poppins', sans-serif;">
                            Ingat Saya
                        </label>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            style="font-family: 'Poppins', sans-serif;"
                            class="bg-[#6b1a1a] hover:bg-[#8b0000] text-white text-sm font-bold rounded-full px-9 py-3 tracking-wide transition duration-150 shadow-md">
                            Masuk
                        </button>
                    </div>

                </form>
            </div>
        </div>  

        <p class="mt-6 text-xs text-emerald-800 opacity-50 font-medium" style="font-family: 'Poppins', sans-serif;">
            &copy; {{ date('Y') }} UKK Paket 3 - Aplikasi Pengaduan Sarana & Prasarana Sekolah
        </p>
    </div>

    <script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById('password');
        const icon = document.getElementById('password-icon'); 

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
    </script>

</x-guest-layout>