{{-- ===================== BIDANG ===================== --}}
@php
$bidang = $instansi['bidang'] ?? [];
@endphp

<div class="w-full max-w-7xl mx-auto px-6 flex flex-col items-end">

    <div class="relative bg-[#0a0a0a] border border-yellow-600/30 shadow-[0_4px_80px_0_#FBCD35]
        rounded-[30px] 
        w-full lg:w-[750px]
        translate-x-6
        p-8 md:p-10
        flex flex-col
        mb-10">

        <h3 class="text-[#0554F2] text-2xl font-bold mb-8 ml-8">Bidang</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 relative z-10">

            @foreach($bidang as $index => $item)
            @php
            $colPos = $index % 3;
            $isLastCol = ($index + 1) % 3 == 0;
            $isLastRow = $index >= count($bidang) - 3;
            $translateClass = $colPos === 0 ? 'md:translate-x-4' : ($colPos === 2 ? 'md:-translate-x-4' : '');
            $lineClass = $colPos === 1
            ? 'left-1/2 -translate-x-1/2 w-[90%]'
            : ($colPos === 0 ? 'right-2.5 w-[75%]' : 'left-2.5 w-[75%]');
            @endphp

            <div class="relative flex flex-col items-center justify-center py-4 px-1 w-full min-h-[160px] group">

                <div class="flex flex-col items-center justify-center w-full transition-transform {{ $translateClass }}">

                    <div class="relative w-[60px] h-[60px] flex items-center justify-center mb-4 transition-transform group-hover:scale-110 duration-300">
                        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 56 56" fill="none">
                            <defs>
                                <linearGradient id="grad_{{ $loop->index }}" x1="50" y1="53" x2="2" y2="0" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="{{ $item['gradient_start'] }}" />
                                    <stop offset="100%" stop-color="{{ $item['gradient_end'] }}" />
                                </linearGradient>
                            </defs>

                            <rect
                                width="53"
                                height="53"
                                rx="20"
                                transform="matrix(0.98 0.18 -0.18 0.98 6.4 -3.3)"
                                fill="url(#grad_{{ $loop->index }})" />
                        </svg>

                        <img src="{{ asset('vector/' . $item['icon']) }}" class="relative z-10 w-8 h-8 object-contain">
                    </div>

                    <span class="text-white font-semibold text-center text-sm w-full">
                        {{ $item['name'] }}
                    </span>
                </div>

                @if(!$isLastRow)
                <div class="absolute bottom-0 h-[2px] bg-[#333333] rounded-full {{ $lineClass }}"></div>
                @endif

                @if(!$isLastCol)
                <div class="hidden md:block absolute right-0 top-1/2 -translate-y-1/2 h-[80%] w-[2px] bg-[#333333] rounded-full"></div>
                @endif

            </div>
            @endforeach

        </div>
    </div>
</div>