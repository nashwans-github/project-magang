<div class="rounded-[45px] p-3.5"
    style="background:#414141; box-shadow:0 0 20px #FBCD35;">

    <div class="bg-black rounded-[45px] overflow-hidden flex flex-col">

        <!-- Gambar -->
        <img src="{{ $instansi['img'] }}" class="w-full h-48 object-cover" />

        <!-- Konten -->
        <div class="p-7 flex flex-col h-[300px]">

            <div class="flex-grow">

                <!-- Title -->
                <h3 class="text-center text-white text-lg font-bold leading-snug mb-4 min-h-[60px]"
                    style="font-family:'Poppins', sans-serif;">
                    {!! $instansi['title'] !!}
                </h3>

                <!-- Description -->
                <p class="text-center text-white text-xs leading-relaxed min-h-[110px]"
                    style="font-family:'Poppins', sans-serif;">
                    {!! $instansi['desc'] !!}
                </p>

            </div>

            <!-- Button -->
            <div class="flex justify-end mt-auto pt-4">
                <a href="{{ route(
                    'user.pemohon.instansi.homeinstansi',
                    $instansi['slug']
                ) }}"
                    class="flex items-center gap-1
                          h-[29px] px-3
                          rounded-full
                          bg-[#3E3E3E]
                          border-2 border-white
                          text-white text-xs font-medium transition">
                    Lihat <span class="text-base mb-0.5 leading-none">→</span>
                </a>
            </div>

        </div>

    </div>

</div>