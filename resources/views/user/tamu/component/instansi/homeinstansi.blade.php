<section class="w-full bg-black py-5 px-5">
    <div id="instansi" class="w-44 h-[3.3px] bg-[#0554F2] mx-auto mt-[25px] mb-[30px]"></div>

    <h2 class="text-center text-white text-3xl md:text-[40px] font-medium mb-14 leading-[55px]"
        style="font-family: 'Poppins', sans-serif;">
        Temukan <span class="font-bold">instansi</span> terbaik untuk mendukung pengalaman
        <br class="hidden md:block">
        magang Anda di <span class="font-bold">Pemerintah Kota Surabaya</span>
    </h2>

    {{-- GRID INSTANSI --}}
    @include('user.tamu.component.instansi.grid')

    {{-- PAGINATION --}}
    @include('user.tamu.component.instansi.pagination')

</section>