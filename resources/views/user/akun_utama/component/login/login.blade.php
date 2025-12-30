<section class="w-full bg-black py-5 px-5">

    <!-- GARIS BIRU (KONSISTEN DENGAN SECTION LAIN) -->
    <div id="login" class="w-44 h-[3.3px] bg-[#0554F2] mx-auto mt-[50px] mb-16"></div>

    <!-- KONTEN ASLI (TIDAK DIUBAH DESAINNYA) -->
    <div class="bg-black pt-[40px] pb-[60px] mb-20 border-[3px] border-[#786321] rounded-[30px] max-w-[1235px] mx-auto shadow-[0_0_40px_rgba(184,134,11,0.3)] relative">

        <h2 class="text-center text-[32px] font-bold mb-[50px] text-white">
            Profile Login
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[40px] max-w-[900px] mx-auto">

            <!-- CARD 1 -->
            <div onclick="openModal('Nashwan Bima Andika', 'peserta01@gmail.com', 'blue', 1)" 
                 class="cursor-pointer group bg-gradient-to-br from-gray-600 to-gray-800 rounded-[25px] p-[45px] border-2 border-[#786321] text-center shadow-[0_0_30px_rgba(184,134,11,0.2)] hover:-translate-y-2 hover:shadow-[0_0_50px_rgba(184,134,11,0.4)] transition-all">
                <div class="w-[100px] h-[100px] bg-gradient-to-br from-blue-600 to-blue-800 rounded-full mx-auto flex items-center justify-center mb-[25px] text-[50px] shadow-lg group-hover:scale-110 transition-transform">👤</div>
                <h3 class="text-[20px] font-semibold text-white">Nashwan Bima Andika</h3>
                <p class="text-[16px] text-gray-300 mb-[30px] font-semibold">peserta01@gmail.com</p>
                <div class="inline-block bg-gradient-to-br from-blue-600 to-blue-900 text-white px-14 py-3 rounded-[25px] font-semibold text-[14px] uppercase tracking-wide group-hover:shadow-blue-500/50 group-hover:scale-105 transition shadow-lg">
                    WEBSITE
                </div>
            </div>

            <!-- CARD 2 -->
            <div onclick="openModal('Vanezza Brilliance', 'peserta02@gmail.com', 'red', 2)" 
                 class="cursor-pointer group bg-gradient-to-br from-gray-600 to-gray-800 rounded-[25px] p-[45px] border-2 border-[#786321] text-center shadow-[0_0_30px_rgba(184,134,11,0.2)] hover:-translate-y-2 hover:shadow-[0_0_50px_rgba(184,134,11,0.4)] transition-all">
                <div class="w-[100px] h-[100px] bg-gradient-to-br from-red-600 to-red-500 rounded-full mx-auto flex items-center justify-center mb-[25px] text-[50px] shadow-lg group-hover:scale-110 transition-transform">👤</div>
                <h3 class="text-[20px] font-semibold text-white">Vanezza Brilliance</h3>
                <p class="text-[16px] text-gray-300 mb-[30px] font-semibold">peserta02@gmail.com</p>
                <div class="inline-block bg-gradient-to-br from-blue-600 to-blue-900 text-white px-10 py-3 rounded-[25px] font-semibold text-[14px] uppercase tracking-wide group-hover:shadow-blue-500/50 group-hover:scale-105 transition shadow-lg">
                    MEDIA SOSIAL
                </div>
            </div>

        </div>

    {{-- ======================================================== --}}
    {{-- MODAL 1: LOGIN (DEFAULT)                                 --}}
    {{-- ======================================================== --}}
    <div id="loginModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity"
            onclick="closeAllModals()"></div>
        
        <div class="relative bg-black border-[3px] border-[#B8860B] w-[450px] rounded-[30px] p-8 text-center
                    shadow-[0_0_50px_rgba(184,134,11,0.6)] animate-fade-in-up">

            <div id="modalAvatarBg"
                class="w-[80px] h-[80px] rounded-full flex items-center justify-center mx-auto mb-4
                        text-[40px] shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                👤
            </div>

            <h3 class="text-[#B8860B] text-[24px] font-bold mb-1">Login</h3>
            <p class="text-white text-base mb-6">
                Login sebagai <span id="modalNameText" class="font-bold">User</span>
            </p>

            <form method="POST" action="{{ route('peserta.login') }}">
                @csrf
                <input type="hidden" name="peserta_id" id="pesertaIdInput">

                {{-- PASSWORD --}}
                <div class="text-left mb-6">
                    <label class="block text-gray-400 text-sm font-semibold mb-2 ml-1">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="Masukkan password..."
                        class="w-full px-5 py-3 rounded-xl bg-[#222] text-white
                            border border-gray-600 focus:border-[#B8860B]
                            focus:outline-none transition-colors"
                    >

                    {{-- LUPA PASSWORD (DIKEMBALIKAN) --}}
                    <div class="text-right mt-2">
                        <button type="button"
                                onclick="switchModal('loginModal', 'otpModal')"
                                class="text-gray-400 text-xs hover:text-[#B8860B] underline transition">
                            Lupa Password?
                        </button>
                    </div>
                </div>

                {{-- ACTION BUTTON --}}
                <div class="flex gap-4">
                    <button type="button"
                            onclick="closeAllModals()"
                            class="flex-1 py-3 rounded-xl bg-[#444] text-white
                                font-semibold hover:bg-[#555] transition">
                        Batal
                    </button>

                    <button type="submit"
                            class="flex-1 py-3 rounded-xl bg-[#B8860B] text-white
                                font-semibold hover:bg-[#cf980c]
                                hover:shadow-[0_0_15px_#B8860B] transition">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ======================================================== --}}
    {{-- MODAL 2: VERIFIKASI OTP (LUPA PASSWORD)                  --}}
    {{-- ======================================================== --}}
    <div id="otpModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeAllModals()"></div>
        
        <div class="relative bg-black border-[3px] border-[#B8860B] w-[450px] rounded-[30px] p-8 text-left shadow-[0_0_50px_rgba(184,134,11,0.6)] animate-fade-in-up">
            <h3 class="text-[#B8860B] text-[22px] font-bold mb-1">Verifikasi Reset Password</h3>
            <p class="text-white text-sm mb-6">Masukkan email untuk dikirim kode OTP</p>

            <div class="text-left mb-6">
                <label class="block text-gray-400 text-sm font-semibold mb-2 ml-1">Email</label>
                <input type="email" placeholder="Masukkan email..." class="w-full px-5 py-3 rounded-xl bg-[#222] text-white border border-gray-600 focus:border-[#B8860B] focus:outline-none transition-colors">
            </div>

            <div class="mb-8">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Kode OTP</label>
                <div class="flex gap-3">
                    <input type="text" placeholder="Kode OTP..." class="w-full px-5 py-3 rounded-xl bg-[#222] text-white border border-gray-600 focus:border-[#B8860B] focus:outline-none transition-colors">
                    <button class="bg-[#856404] hover:bg-[#B8860B] text-white px-6 py-3 rounded-xl font-semibold transition shadow-md whitespace-nowrap">Kirim</button>
                </div>
            </div>

            <div class="flex gap-4">
                <button onclick="switchModal('otpModal', 'loginModal')" class="flex-1 py-3 rounded-xl bg-[#444] text-white font-semibold hover:bg-[#555] transition">Batal</button>
                <button onclick="switchModal('otpModal', 'resetModal')" class="flex-1 py-3 rounded-xl bg-[#B8860B] text-white font-semibold hover:bg-[#cf980c] transition shadow-[0_0_10px_#B8860B]">Lanjutkan</button>
            </div>
        </div>
    </div>

    {{-- ======================================================== --}}
    {{-- MODAL 3: RESET PASSWORD (INPUT BARU)                     --}}
    {{-- ======================================================== --}}
    <div id="resetModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeAllModals()"></div>
        
        <div class="relative bg-black border-[3px] border-[#B8860B] w-[450px] rounded-[30px] p-8 text-center shadow-[0_0_50px_rgba(184,134,11,0.6)] animate-fade-in-up">
            
            <h3 class="text-[#B8860B] text-[24px] font-bold mb-1">Reset Password</h3>
            <p class="text-white text-sm mb-6">Masukkan password baru Anda</p>

            <div class="text-left mb-4">
                <label class="block text-white text-sm mb-2">Password Baru</label>
                <input type="password" placeholder="Masukkan Password Baru..." class="w-full px-5 py-3 rounded-xl bg-[#222] text-white border border-gray-600 focus:border-[#B8860B] focus:outline-none transition-colors">
            </div>

            <div class="text-left mb-8">
                <label class="block text-white text-sm mb-2">Konfirmasi Password Baru</label>
                <input type="password" placeholder="Konfirmasi Password Baru..." class="w-full px-5 py-3 rounded-xl bg-[#222] text-white border border-gray-600 focus:border-[#B8860B] focus:outline-none transition-colors">
            </div>

            <button onclick="closeAllModals()" class="w-full py-3 rounded-xl bg-[#B8860B] text-white font-bold hover:bg-[#cf980c] hover:shadow-[0_0_15px_#B8860B] transition">
                Lanjutkan
            </button>

        </div>
    </div>

{{-- SCRIPT JAVASCRIPT --}}
<script>
    // 1. Fungsi Buka Modal Login Awal (Dipanggil saat klik kartu)
    function openModal(name, email, colorTheme, pesertaId) {
        document.getElementById('loginModal').classList.remove('hidden');
        document.getElementById('otpModal').classList.add('hidden');
        document.getElementById('resetModal').classList.add('hidden');

        document.getElementById('modalNameText').innerText = name;
        document.getElementById('pesertaIdInput').value = pesertaId;

        const avatarBg = document.getElementById('modalAvatarBg');
        avatarBg.className = "w-[80px] h-[80px] rounded-full flex items-center justify-center mx-auto mb-4 text-[40px]";

        avatarBg.classList.add(
            'bg-gradient-to-br',
            colorTheme === 'red' ? 'from-red-600' : 'from-blue-600',
            colorTheme === 'red' ? 'to-red-500' : 'to-blue-800'
        );
    }

    // 2. Fungsi Pindah Antar Modal (Kunci Flow)
    function switchModal(hideId, showId) {
        // Sembunyikan modal saat ini
        document.getElementById(hideId).classList.add('hidden');
        // Munculkan modal tujuan
        document.getElementById(showId).classList.remove('hidden');
    }

    // 3. Fungsi Tutup Semua Modal
    function closeAllModals() {
        document.getElementById('loginModal').classList.add('hidden');
        document.getElementById('otpModal').classList.add('hidden');
        document.getElementById('resetModal').classList.add('hidden');
    }
</script>