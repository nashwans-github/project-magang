document.addEventListener("DOMContentLoaded", () => {
    initFaqToggle();
    initFaqTabs();
});

/* ===============================
   FAQ ACCORDION
================================ */
function initFaqToggle() {
    document.querySelectorAll(".faq-toggle").forEach((button) => {
        button.addEventListener("click", () => {
            const item = button.closest(".faq-item");
            const answer = item.querySelector(".faq-answer");
            const icon = button.querySelector("svg");

            const open =
                answer.style.maxHeight && answer.style.maxHeight !== "0px";

            if (open) {
                answer.style.maxHeight = "0px";
                icon?.classList.remove("rotate-180");
            } else {
                answer.style.maxHeight = answer.scrollHeight + "px";
                icon?.classList.add("rotate-180");
            }
        });
    });
}

/* ===============================
   FAQ TABS
================================ */
function initFaqTabs() {
    document.querySelectorAll(".tab-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const tab = button.dataset.tab;

            // reset tab button
            document.querySelectorAll(".tab-btn").forEach((b) => {
                b.classList.remove("bg-[#0554f2]");
                b.classList.add("bg-[#b6b6b6]");
            });

            button.classList.remove("bg-[#b6b6b6]");
            button.classList.add("bg-[#0554f2]");

            // reset FAQ
            document
                .querySelectorAll(".faq-answer")
                .forEach((a) => (a.style.maxHeight = "0px"));

            document
                .querySelectorAll(".faq-question svg")
                .forEach((i) => i.classList.remove("rotate-180"));

            // switch content
            document.querySelectorAll(".faq-group").forEach((g) => {
                g.classList.add("hidden");
                g.classList.remove("block");
            });

            const content = document.getElementById("content-" + tab);
            content?.classList.remove("hidden");
            content?.classList.add("block");
        });
    });
}