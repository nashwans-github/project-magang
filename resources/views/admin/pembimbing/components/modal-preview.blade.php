<div id="fileModal" class="fixed inset-0 z-[99] hidden bg-black/70 flex items-center justify-center p-4 transition-opacity duration-300 opacity-0 md:pl-64">
    <div class="relative bg-[#262626] rounded-xl border border-[#0066FF]/50 max-w-5xl w-full h-[85vh] flex flex-col transform scale-95 transition-transform duration-300 shadow-2xl" id="fileModalContent">
        
        {{-- Header --}}
        <div class="flex justify-between items-center p-4 border-b border-white/10 bg-[#1F1F1F] rounded-t-xl">
            <h3 class="text-white font-semibold text-lg flex items-center gap-2">
                File Preview
            </h3>
            <div class="flex items-center gap-3">
                <a id="downloadBtn" href="#" download target="_blank" class="text-white hover:text-[#0066FF] transition-colors flex items-center gap-1 text-sm font-semibold mr-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Download
                </a>
                <button onclick="closeFileModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        {{-- Body Modal --}}
        <div class="flex-1 bg-black/50 overflow-hidden flex justify-center items-center relative p-1">
            <img id="filePreviewImage" src="" class="max-w-full max-h-full object-contain hidden">
            <iframe id="filePreviewPdf" src="" class="w-full h-full hidden border-none" title="PDF Preview"></iframe>
            <div id="fileNoPreview" class="text-gray-400 hidden flex flex-col items-center">
                <svg class="w-16 h-16 mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <p>Preview tidak tersedia.</p>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT KHUSUS MODAL INI --}}
<script>
    function showFileModal(url, ext) {
        const modal = document.getElementById('fileModal');
        const content = document.getElementById('fileModalContent');
        const img = document.getElementById('filePreviewImage');
        const pdf = document.getElementById('filePreviewPdf');
        const noPreview = document.getElementById('fileNoPreview');
        const downloadBtn = document.getElementById('downloadBtn');

        const mainContent = document.getElementById('mainContent');
        if(mainContent) mainContent.style.overflow = 'hidden';

        downloadBtn.href = url;
        img.classList.add('hidden'); pdf.classList.add('hidden'); noPreview.classList.add('hidden');

        const cleanExt = ext ? ext.toLowerCase() : '';
        if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(cleanExt)) {
            img.src = url; img.classList.remove('hidden');
        } else if (cleanExt === 'pdf') {
            pdf.src = url; pdf.classList.remove('hidden');
        } else {
            noPreview.classList.remove('hidden');
        }

        modal.classList.remove('hidden');
        setTimeout(() => { modal.classList.remove('opacity-0'); content.classList.remove('scale-95'); content.classList.add('scale-100'); }, 10);
    }

    function closeFileModal() {
        const modal = document.getElementById('fileModal');
        const content = document.getElementById('fileModalContent');
        
        const mainContent = document.getElementById('mainContent');
        if(mainContent) mainContent.style.overflow = 'auto';

        const img = document.getElementById('filePreviewImage');
        const pdf = document.getElementById('filePreviewPdf');
        if(img) img.src = "";
        if(pdf) pdf.src = "";
        
        modal.classList.add('opacity-0'); content.classList.remove('scale-100'); content.classList.add('scale-95');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }

    document.addEventListener('keydown', function(event) { 
        if (event.key === "Escape") { 
            closeFileModal(); 
        } 
    });
</script>