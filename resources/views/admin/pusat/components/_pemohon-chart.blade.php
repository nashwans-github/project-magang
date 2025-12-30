<div class="bg-[#262626] p-6 border-[3px] border-[#011640] shadow-lg w-full relative overflow-hidden mb-6 rounded-sm">

    <div class="absolute inset-0 bg-gradient-to-br from-[#262626] via-[#2a2a2a] to-[#202020] opacity-50 pointer-events-none"></div>

    <div class="relative z-10">
        <h3 class="text-[#0066FF] text-xl font-bold mb-6">Jumlah Pemohon Magang Tiap Dinas</h3>

        <div class="p-8 pb-40"> 
            <div class="flex h-[350px]">
                
                {{-- LABEL Y-AXIS (Kiri) --}}
                <div class="w-8 h-full flex items-center justify-center pointer-events-none">
                    <span class="text-white text-lg font-semibold -rotate-90 whitespace-nowrap tracking-wider block">Jumlah Pemohon</span>
                </div>

                {{-- BAGIAN 1: LABEL ANGKA SUMBU Y (KIRI - DINAMIS) --}}
                <div class="flex flex-col justify-between h-full text-right pr-2 text-gray-400 text-sm font-medium" style="padding-bottom: 0;">
                    @for ($i = $max_scale; $i >= 0; $i -= $step_size)
                        <span class="transform translate-y-1/2">{{ $i }}</span>
                    @endfor
                </div>

                {{-- AREA CHART --}}
                <div class="relative flex-1 h-full ml-4">

                    {{-- BAGIAN 2: GARIS GRID --}}
                    <div class="absolute inset-0 flex flex-col justify-between pointer-events-none h-full border-l border-b border-gray-600">
                        @for ($i = $max_scale; $i >= 0; $i -= $step_size)
                            <div class="w-full border-t border-gray-700/50 {{ $i == 0 ? 'border-transparent' : '' }} h-0 relative"></div>
                        @endfor
                    </div>

                    {{-- BAGIAN 3: BATANG CHART --}}
                    <div class="absolute inset-0 flex items-end justify-around pl-2 pt-4 pb-0 h-full">
                        
                        @foreach($data_pendaftar as $dinas)
                            @php
                                $percent_height = 0;
                                if($max_scale > 0) {
                                    $percent_height = ($dinas['jumlah'] / $max_scale) * 100;
                                }
                            @endphp

                            <div class="relative w-full max-w-[40px] bg-[#60A5FA] hover:bg-[#3B82F6] transition-all rounded-t-sm group cursor-pointer" 
                                 style="height: {{ $percent_height }}%">
                                
                                {{-- Tooltip --}}
                                <span class="absolute -top-8 left-1/2 -translate-x-1/2 bg-black/80 px-2 py-1 rounded text-white text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity z-20 whitespace-nowrap">
                                    {{ $dinas['jumlah'] }}
                                </span>

                                {{-- Label Nama Dinas --}}
                                <div class="absolute bottom-0 left-1/2 w-0 h-0">
                                    <div class="w-32 -left-[136px] absolute top-0 origin-right -rotate-90 text-right transform translate-y-1/2 translate-x-2">
                                        <span class="text-white text-sm font-normal block truncate hover:text-blue-400 transition-colors">
                                            {{ $dinas['singkatan'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    
                    {{-- LABEL X-AXIS --}}
                    <div class="absolute -bottom-36 w-full text-center pointer-events-none">
                        <span class="text-white font-semibold text-lg tracking-wide">Instansi OPD</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>