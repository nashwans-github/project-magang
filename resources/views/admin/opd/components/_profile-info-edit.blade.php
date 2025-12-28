@php
    $inputs = [
        [
            'label' => 'Lokasi', 
            'name'  => 'lokasi', 
            'icon'  => 'Lokasi.svg', 
            'val'   => is_array($instansi['lokasi']) 
                    ? implode(', ', $instansi['lokasi']) 
                    : ($instansi['lokasi'] ?? '-')
        ],
        [
            'label' => 'No. Telepon', 
            'name'  => 'telepon', 
            'icon'  => 'Telfon.svg', 
            'val'   => is_array($instansi['telepon']) 
                    ? implode(', ', $instansi['telepon']) 
                    : ($instansi['telepon'] ?? '-')
        ],
        [
            'label' => 'Jam', 
            'name'  => 'jam', 
            'icon'  => 'Jam.svg', 
            'val'   => is_array($instansi['jam']) 
                    ? implode(', ', $instansi['jam']) 
                    : ($instansi['jam'] ?? '-')
        ],
        [
            'label' => 'Pendidikan', 
            'name'  => 'pendidikan', 
            'icon'  => 'Pendidikan.svg', 
            'val'   => is_array($instansi['pendidikan']) 
                    ? implode(', ', $instansi['pendidikan']) 
                    : ($instansi['pendidikan'] ?? '-')
        ],
        [
            'label' => 'Persyaratan Dokumen', 
            'name'  => 'persyaratan', 
            'icon'  => 'Dokumen.svg', 
            'val'   => is_array($instansi['persyaratan']) 
                    ? implode(', ', $instansi['persyaratan']) 
                    : ($instansi['persyaratan'] ?? '-')
        ],
    ];
@endphp

<div class="space-y-6 mb-8">
    @foreach($inputs as $inp)
    <div class="flex items-start gap-5">
        {{-- ICON --}}
        <img src="{{ asset('vector/' . $inp['icon']) }}" 
             class="w-8 h-8 flex-shrink-0 mt-2" 
             alt="{{ $inp['label'] }}">

        {{-- CONTAINER KANAN --}}
        <div class="w-full">
            <label class="block text-white/60 text-lg font-semibold mb-1">
                {{ $inp['label'] }}
            </label>
            
            <input type="text" 
                   name="{{ $inp['name'] }}" 
                   value="{{ $inp['val'] }}" 
                   class="w-full bg-[#FFFFFF] bg-opacity-30 border-none text-white placeholder-white/50 px-4 py-2 rounded-lg focus:ring-0 focus:outline-none transition leading-relaxed text-lg font-medium" 
                   placeholder="Masukkan {{ $inp['label'] }}">
        </div>
    </div>
    @endforeach
</div>

<div class="h-px w-full bg-white mb-6 border-b border-white opacity-50"></div>

<div class="mb-4">
    <p class="text-white/60 text-lg font-semibold mb-2">Deskripsi</p>
    <textarea name="deskripsi" 
              rows="4"
              class="w-full bg-[#FFFFFF] bg-opacity-30 border-none text-white placeholder-white/50 px-4 py-3 rounded-lg focus:ring-0 focus:outline-none transition resize-none leading-relaxed text-lg font-medium text-justify"
              placeholder="Masukkan deskripsi instansi...">{{ $instansi['deskripsi'] }}</textarea>
</div>