<div class="bg-[#262626] p-6 border-[3px] border-[#011640] shadow-lg w-full rounded-sm mb-6">
    
    <h3 class="text-[#0066FF] text-xl font-bold mb-6">Jumlah Peserta Magang Tiap Dinas</h3>

    {{-- Container dengan Scroll --}}
    <div class="flex flex-col gap-6 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">

        {{-- LOOPING DATA DARI CONTROLLER --}}
        @foreach($chartData as $dinas)

            @php
                // Hitung Persentase Lebar Bar
                // Jika count 0, width jadi 0
                $width = 0;
                if($maxScale > 0) {
                    $width = ($dinas['count'] / $maxScale) * 100;
                }
            @endphp

            <div class="group">
                {{-- Baris Nama Dinas & Angka --}}
                <div class="flex justify-between items-end mb-2">
                    <a href="{{ route('pusat.manajemen-opd.detail', $dinas['slug'] ?? '#') }}" 
                        class="text-gray-200 text-sm font-medium tracking-wide group-hover:text-blue-400 transition-colors z-20 relative">
                        {{ $dinas['name'] }}
                    </a>
                    <span class="text-white font-medium text-sm">
                        {{ $dinas['count'] }} Peserta
                    </span>
                </div>

                {{-- Bar Horizontal --}}
                <div class="w-full bg-[#333333] rounded-full h-3 overflow-hidden">
                    <div class="bg-[#3B82F6] h-full rounded-full transition-all duration-1000 ease-out group-hover:bg-[#60A5FA]" 
                         style="width: {{ $width }}%">
                    </div>
                </div>
            </div>

        @endforeach

    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #262626; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #444; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #555; }
</style>