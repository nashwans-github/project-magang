<div class="bg-[#232226] p-6 border-[3px] border-[#011640] h-full flex flex-col shadow-lg">
    <h3 class="text-[#0554F2] font-bold mb-6 text-xl tracking-wide">Aktivitas Terbaru</h3>
    
    <div class="space-y-6 relative flex-1 overflow-y-auto pr-2 custom-scrollbar">
        @forelse($activities as $act)
            <div class="flex items-start space-x-4 relative z-10">
                {{-- Logic Warna berdasarkan Theme --}}
                @php
                    $bgClass = 'bg-gray-500';
                    $borderClass = 'border-gray-500/20';
                    if($act['theme'] == 'yellow') { $bgClass = 'bg-[#facc15]'; $borderClass = 'border-yellow-500/20'; }
                    if($act['theme'] == 'orange') { $bgClass = 'bg-[#fb923c]'; $borderClass = 'border-orange-500/20'; }
                    if($act['theme'] == 'green')  { $bgClass = 'bg-[#4ade80]'; $borderClass = 'border-green-500/20'; }
                @endphp

                <div class="{{ $bgClass }} p-2 rounded-full border {{ $borderClass }} flex-shrink-0">
                    <img src="{{ asset('vector/' . $act['icon']) }}" class="w-5 h-5 object-contain" alt="Icon">
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-200">
                        <span class="font-bold">{{ $act['user'] }}</span> {{ $act['action'] }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">{{ $act['time'] }}</p>
                </div>
            </div>
        @empty
            <p class="text-white/40 italic text-center">Belum ada aktivitas.</p>
        @endforelse
    </div>
</div>