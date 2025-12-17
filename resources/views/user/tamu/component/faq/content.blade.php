<div class="bg-[#111111] rounded-3xl md:p-12 faq-container-shadow" style="border: 5px solid #78CCE7;">
    <div class="flex flex-col lg:flex-row gap-12 items-center lg:items-center">

        <div class="flex-shrink-0 w-full lg:w-auto flex justify-center lg:justify-start">
            <img src="images/faq.png" alt="FAQ"
                class="w-96 h-96 lg:w-[500px] lg:h-[500px] object-contain">
        </div>

        <div class="flex-1 w-full self-center">
            <div class="flex flex-wrap gap-4 mb-6 justify-center">
                <button
                    class="tab-btn w-32 md:w-40 py-2.5 bg-[#0554f2] text-white rounded-t-[7px] text-[17px] font-medium"
                    data-tab="pendaftaran">Pendaftaran
                </button>

                <button
                    class="tab-btn w-32 md:w-40 py-2.5 bg-[#b6b6b6] text-white rounded-t-[7px] text-[17px] font-medium"
                    data-tab="program">Program
                </button>

                <button
                    class="tab-btn w-32 md:w-40 py-2.5 bg-[#b6b6b6] text-white rounded-t-[7px] text-[17px] font-medium"
                    data-tab="teknis">Teknis
                </button>
            </div>

            <div class="space-y-4">
                <div id="content-pendaftaran" class="faq-group block space-y-4">
                    @include('user.tamu.component.faq.pendaftaran')
                </div>

                <div id="content-program" class="faq-group hidden space-y-4">
                    @include('user.tamu.component.faq.program')
                </div>

                <div id="content-teknis" class="faq-group hidden space-y-4">
                    @include('user.tamu.component.faq.teknis')
                </div>
            </div>
        </div>
    </div>
</div>