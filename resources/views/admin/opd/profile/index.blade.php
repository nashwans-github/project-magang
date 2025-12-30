@extends('layout.admin-layout')

@section('title', 'Profile - Admin OPD')
@section('header-title', 'Profile')

@section('content')
    {{-- JUDUL HALAMAN --}}
    <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl mb-6">
        <h2 class="text-[#0554f2] text-4xl font-bold tracking-wide">Profile</h2>
    </div>

    {{-- FORM PEMBUNGKUS UTAMA --}}
    <form id="profile-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <div class="flex flex-col gap-8 pb-10">
            {{-- 1. INFO INSTANSI --}}
            <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl">
                <div id="info-view-mode">
                    @include('admin.opd.components._profile-info')
                </div>
                <div id="info-edit-mode" class="hidden">
                    @include('admin.opd.components._profile-info-edit')
                </div>
            </div>

            {{-- 2. KOTAK DOKUMENTASI --}}
            <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl">
                @include('admin.opd.components._profile-documentation')
            </div>

            {{-- 3. KOTAK BIDANG --}}
            <div class="bg-[#232226] border-[3px] border-[#011640] p-8 shadow-xl" id="fields-container">
                @include('admin.opd.components._profile-fields')
            </div>

            {{-- TOMBOL ACTION --}}
            <div class="flex justify-end gap-4">
                <button type="button" id="btn-cancel" onclick="toggleEditMode(false)"
                        class="hidden bg-[#FF0000] text-white font-semibold py-3 px-12 rounded-[15px] shadow-lg transition transform hover:scale-105 text-[24px] tracking-wide">
                    Batal
                </button>

                <button type="button" id="btn-edit" onclick="toggleEditMode(true)"
                        class="bg-[#0554f2] text-white font-semibold py-3 px-12 rounded-[15px] shadow-lg transition transform hover:scale-105 text-[24px] tracking-wide">
                    Edit
                </button>

                <button type="submit" id="btn-save" 
                        class="hidden bg-[#00B65A] text-white font-semibold py-3 px-12 rounded-[15px] shadow-lg transition transform hover:scale-105 text-[24px] tracking-wide">
                    Simpan
                </button>
            </div>
        </div>
    </form>

    {{-- ========================================================================================== --}}
    {{-- MODALS PINDAH KE SINI (DI LUAR FORM & CONTAINER) --}}
    {{-- ========================================================================================== --}}

    {{-- 1. MODAL RENAME --}}
    <div id="rename-modal" onclick="closeModalOutside(event)" class="hidden fixed inset-0 z-[9999] bg-black/70 backdrop-blur-sm flex items-center justify-center">
        <div id="rename-modal-content" class="bg-white shadow-2xl w-[450px] p-8 rounded-none relative" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-black text-xl font-semibold">Rename Bidang</h3>
                <button type="button" onclick="closeModal('rename-modal')" class="w-8 h-8 bg-[#D9D9D9] hover:bg-gray-400 flex items-center justify-center transition">
                    <img src="{{ asset('vector/Cancel.svg') }}" class="w-4 h-4" alt="Close">
                </button>
            </div>
            <div class="space-y-4">
                <div class="flex flex-col items-start w-full">
                    <label class="text-black text-[15px] font-medium text-left">Nama Baru</label>
                    <input type="text" id="rename-input" class="w-full bg-white border-[2px] border-black text-black px-4 py-3 transition rounded-none mt-2 focus:outline-none" placeholder="Masukkan nama baru...">
                </div>
            </div>
            <div class="flex justify-center gap-3 mt-10">
                <button type="button" onclick="closeModal('rename-modal')" class="w-[159px] py-3 bg-[#D9D9D9] hover:bg-gray-400 text-black font-regular text-[15px] rounded-none transition">Cancel</button>
                <button type="button" onclick="saveRename(event)" class="w-[159px] py-3 bg-[#D9D9D9] hover:bg-gray-400 text-black font-regular text-[15px] rounded-none transition">Save</button>
            </div>
        </div>
    </div>

    {{-- 2. MODAL TAMBAH --}}
    <div id="add-modal" onclick="closeModalOutside(event)" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black/70 backdrop-blur-sm">
        <div class="bg-white shadow-2xl w-[450px] p-8 transform transition-all scale-100 relative rounded-none" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-black text-xl font-semibold">Tambahkan Bidang</h3>
                <button type="button" onclick="closeModal('add-modal')" class="w-8 h-8 bg-[#D9D9D9] hover:bg-gray-400 flex items-center justify-center transition">
                    <img src="{{ asset('vector/Cancel.svg') }}" class="w-4 h-4" alt="Close">
                </button>
            </div>
            <div class="space-y-5">
                <div class="flex flex-col items-start w-full text-left">
                    <label class="text-black text-[15px] font-medium">Nama Bidang</label>
                    <input type="text" id="add-input" class="w-full bg-white border-[2px] border-black text-black px-4 py-3 transition rounded-none mt-2 focus:outline-none" placeholder="Masukkan nama bidang...">
                </div>
                <div class="flex flex-col items-start w-full text-left">
                    <label class="block text-black text-medium font-medium mb-2">Upload Ikon</label>
                    <div class="flex flex-col items-start">
                        <label id="state-default" for="add-icon-input" class="cursor-pointer inline-flex items-center justify-center gap-2 bg-[#0554F2] hover:bg-blue-600 text-white transition shadow-md w-[162px] h-[45px] rounded-[15px]">
                            <img src="{{ asset('vector/Upload File.svg') }}" class="w-5 h-5 filter brightness-0 invert" alt="Upload">
                            <span class="font-bold text-[15px] tracking-wide">Upload File</span>
                        </label>
                        <div id="state-uploaded" onclick="viewUploadedFile()" class="hidden relative cursor-pointer inline-flex items-center justify-start px-3 bg-[#0554F2] hover:bg-blue-600 text-white transition shadow-md w-[162px] h-[45px] rounded-[15px]">
                            <div class="flex items-center gap-2 overflow-hidden w-[85%]">
                                <img src="{{ asset('vector/Upload File.svg') }}" class="w-5 h-5 filter brightness-0 invert flex-shrink-0" alt="File">
                                <span id="file-name-text" class="text-[13px] font-bold truncate text-white select-none">Filename.png</span>
                            </div>
                            <div onclick="resetFileUpload(event)" class="absolute right-2 top-1/2 transform -translate-y-1/2 p-1 hover:bg-white/20 rounded-full transition z-20">
                                <img src="{{ asset('vector/Cancel.svg') }}" class="w-3 h-3 filter brightness-0 invert" alt="Remove">
                            </div>
                        </div>
                        <input type="file" id="add-icon-input" accept="image/*" class="hidden" onchange="handleFileSelect(event)">
                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-3 mt-10">
                <button type="button" onclick="closeModal('add-modal')" class="w-[159px] py-3 bg-[#D9D9D9] hover:bg-gray-400 text-black font-regular text-[15px] rounded-none transition">Cancel</button>
                <button type="button" onclick="saveAdd(event)" class="w-[159px] py-3 bg-[#D9D9D9] hover:bg-gray-400 text-black font-regular text-[15px] rounded-none transition">Add</button>
            </div>
        </div>
    </div>

    {{-- LOAD SEMUA LOGIKA JS DARI FILE EKSTERNAL --}}
    @vite(['resources/js/profile-handler.js'])
@endsection