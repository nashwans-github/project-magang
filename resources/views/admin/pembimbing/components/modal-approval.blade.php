<div id="approvalModal" class="fixed inset-0 z-[99] hidden bg-black/70 flex items-center justify-center p-4 transition-opacity duration-300 opacity-0 md:pl-64">
    
    <div class="relative bg-[#262626] rounded-xl border border-[#0066FF]/50 max-w-lg w-full transform scale-95 transition-transform duration-300 shadow-2xl" id="approvalContent">
        
        {{-- Header --}}
        <div class="flex justify-between items-center p-5 border-b border-white/10 bg-[#1F1F1F] rounded-t-xl">
            <h3 class="text-white font-semibold text-lg flex items-center gap-2">
                Update Status Progres
            </h3>
            <button onclick="closeApprovalModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        {{-- Form Body --}}
        <form onsubmit="submitApproval(event)" class="p-6">
            @csrf
            {{-- ID Hidden --}}
            <input type="hidden" id="progresId" name="id">

            {{-- Pilihan Status --}}
            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-semibold mb-3">Pilih Status:</label>
                <div class="grid grid-cols-2 gap-4">
                    {{-- Opsi 1: Terima (Approved) --}}
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="approved" class="peer sr-only">
                        <div class="peer-checked:bg-green-500/20 peer-checked:border-green-500 peer-checked:text-green-400 border border-white/20 bg-[#333] rounded-lg p-3 text-center transition-all hover:border-green-500/50">
                            <span class="font-bold">Diterima</span>
                        </div>
                    </label>

                    {{-- Opsi 2: Revisi --}}
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="revisi" class="peer sr-only">
                        <div class="peer-checked:bg-orange-500/20 peer-checked:border-orange-500 peer-checked:text-orange-400 border border-white/20 bg-[#333] rounded-lg p-3 text-center transition-all hover:border-orange-500/50">
                            <span class="font-bold">Revisi</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Input Catatan --}}
            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-semibold mb-2">Catatan (Opsional):</label>
                <textarea id="catatanInput" name="catatan" rows="3" 
                    class="w-full bg-[#1A1A1A] border border-white/10 rounded-lg p-3 text-white focus:outline-none focus:border-[#0066FF] focus:ring-1 focus:ring-[#0066FF] transition-all placeholder-gray-600 resize-none"
                    placeholder="Tambahkan catatan"></textarea>
            </div>

            {{-- Footer / Tombol Aksi --}}
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeApprovalModal()" class="bg-[#FF0000] hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-bold shadow-lg shadow-blue-500/20 transition-all transform hover:scale-105">
                    Batal
                </button>
                <button type="submit" class="bg-[#0066FF] hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-bold shadow-lg shadow-blue-500/20 transition-all transform hover:scale-105">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT KHUSUS APPROVAL --}}
<script>
    function openApprovalModal(id, currentStatus, currentNote) {
        const modal = document.getElementById('approvalModal');
        const content = document.getElementById('approvalContent');
        const mainContent = document.getElementById('mainContent');

        // Lock Scroll
        if(mainContent) mainContent.style.overflow = 'hidden';

        // Isi Data
        document.getElementById('progresId').value = id;
        
        // Isi Catatan
        const noteField = document.getElementById('catatanInput');
        noteField.value = (currentNote === '-' || currentNote === null) ? '' : currentNote;
        
        // Pilih Radio Button
        const radios = document.getElementsByName('status');
        for(let r of radios) {
            r.checked = false;
            if(r.value === currentStatus) {
                r.checked = true;
            }
        }

        // Animasi Buka
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
    }

    function closeApprovalModal() {
        const modal = document.getElementById('approvalModal');
        const content = document.getElementById('approvalContent');
        const mainContent = document.getElementById('mainContent');

        // Unlock Scroll
        if(mainContent) mainContent.style.overflow = 'auto';

        // Animasi Tutup
        modal.classList.add('opacity-0');
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }

    // Simulasi Submit
    function submitApproval(e) {
        e.preventDefault();
        
        // --- LOGIKA SIMULASI ---
        const status = document.querySelector('input[name="status"]:checked')?.value;
        if(!status) {
            alert("Harap pilih status terlebih dahulu!");
            return;
        }

        closeApprovalModal();
        
        // Refresh Halaman (Simulasi Update Berhasil)
        setTimeout(() => {
            location.reload(); 
        }, 300);
    }
    
    // Shortcut ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
             // Cek modal mana yang terbuka
             const approvalModal = document.getElementById('approvalModal');
             if (approvalModal && !approvalModal.classList.contains('hidden')) {
                 closeApprovalModal();
             }
        }
    });
</script>