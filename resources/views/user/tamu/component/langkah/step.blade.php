@props(['number', 'title', 'text', 'image', 'position' => 'right', 'numberImage'])

@php
// --- Nilai top yang DISEJARASKAN ---
$numberTop = 'top-[70px]';
$boxTop = 'top-[40px]';

// --- Posisi kiri/kanan (left) tetap berbeda ---
if ($position === 'right') {

// right tetap kanan
$numberPosClass = "$numberTop left-[calc(50%_-_110px)]";
$boxPosClass = "$boxTop left-[calc(50%_+_40px)]";
$flexReverse = '';
$textAlignClass = '';

} else {

// left tetap kiri
$numberPosClass = "$numberTop left-[calc(50%_-_9px)]";
$boxPosClass = "$boxTop left-[calc(50%_-_450px_-_40px)]";
$flexReverse = 'flex-row-reverse';
$textAlignClass = 'items-end text-right';
}
@endphp

<div class="relative w-full h-[200px] mt-10">

    {{-- KOTAK ANGKA --}}
    <div class="absolute {{ $numberPosClass }}">
        <div class="relative w-[120px] h-[95px]">
            <img src="{{ $numberImage }}" class="w-full h-full object-contain" alt="nomor-{{ $number }}">
            <span class="absolute inset-0 flex items-center justify-center text-black font-bold text-3xl">
                {{ $number }}
            </span>
        </div>
    </div>

    {{-- BOX --}}
    <div class="absolute bg-black text-white rounded-[35px] w-[450px] p-6 flex items-center gap-6 {{ $flexReverse }} {{ $boxPosClass }}">
        <img src="{{ $image }}" class="w-16 h-16 object-contain" alt="{{ Str::slug($title) }}">
        <div class="flex flex-col {{ $textAlignClass }}">
            <h3 class="font-bold text-xl mb-[6px]">{{ $title }}</h3>
            <div class="w-[180px] h-[0.5px] bg-white mb-[10px]"></div>
            <p class="font-semibold text-sm leading-relaxed">
                {!! nl2br(e($text)) !!}
            </p>
        </div>
    </div>

</div>