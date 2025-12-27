<div class="bg-[#262626] p-6 border-[3px] border-[#011640] shadow-lg w-full relative overflow-hidden rounded-sm min-h-[400px]">

    {{-- Background Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>

    <div class="relative z-10">
        <h3 class="text-[#0066FF] text-lg font-bold mb-6">Aktivitas Terbaru</h3>

        <div class="space-y-0">
            
            {{-- LOOPING DATA DINAMIS --}}
            {{-- Variabel $recentActivities dikirim dari Controller --}}
            @forelse($recentActivities as $item)
                
                {{-- ITEM ACTIVITY --}}
                <div class="flex items-start gap-4 p-4 rounded-lg transition-all duration-300 hover:bg-[#333] hover:shadow-md hover:scale-[1.02] cursor-pointer group">
                    
                    {{-- ICON BULAT (Warna dari Controller) --}}
                    <div class="w-12 h-12 rounded-full {{ $item['color_bg'] }} flex items-center justify-center shrink-0 text-black shadow-md transition-transform duration-300 group-hover:scale-110">
                        @if($item['type'] == 'presensi')
                            {{-- Icon Presensi (Jam / Checklist) --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @else
                            {{-- Icon Progres (Upload / Document) --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        @endif
                    </div>

                    {{-- TEXT CONTENT --}}
                    <div>
                        <p class="text-white text-sm font-bold transition-colors duration-300 group-hover:text-[#0066FF]">
                            <span class="hover:underline">
                                {{ $item['nama'] }}
                            </span>
                            
                            {{-- Deskripsi Aktivitas --}}
                            <span class="font-normal text-gray-300 transition-colors duration-300 group-hover:text-white block md:inline md:ml-1">
                                {{ $item['desc'] }}
                            </span>
                        </p>
                        
                        {{-- Waktu (Hari ini, 08.15) --}}
                        <p class="text-gray-500 text-xs mt-1 transition-colors duration-300 group-hover:text-gray-400">
                            {{ $item['time_ago'] }}
                        </p>
                    </div>
                </div>

                {{-- SEPARATOR LINE (Jangan tampilkan di item terakhir) --}}
                @if(!$loop->last)
                    <hr class="border-[#FFFFFF]/10 mx-4">
                @endif

            @empty
                {{-- STATE KOSONG --}}
                <div class="text-center py-12 flex flex-col items-center justify-center text-gray-500">
                    <svg class="w-12 h-12 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>Belum ada aktivitas terbaru hari ini.</p>
                </div>
            @endforelse

        </div>
    </div>
</div>