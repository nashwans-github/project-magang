<section class="bg-black flex flex-col px-5 py-5 mb-20">
    <div class="max-w-[1230px] mx-auto">

        <div class="text-center mb-12">
            <div id="faq" class="w-44 h-[3.3px] bg-[#0554F2] mx-auto mt-[50px] mb-[30px]"></div>

            <h1 class="text-center text-white text-3xl md:text-[40px] font-medium leading-[55px]">
                <span class="font-medium">Apa saja hal yang </span>
                <span class="font-bold">sering ditanyakan</span>
                <span class="font-medium"> ketika akan <br class="hidden md:block"> magang di </span>
                <span class="font-bold">Pemerintah Kota Surabaya?</span>
            </h1>
        </div>

        {{-- FAQ CONTENT --}}
        @include('user.tamu.component.faq.content')

    </div>
</section>