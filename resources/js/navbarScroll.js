document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.getElementById("navbar");
    if (!navbar) return;

    const links = document.querySelectorAll("a.scroll-link");

    const sectionMap = {
        hero: "hero",
        instansi: "instansi",
        langkah: "langkah",
        faq: "faq",
    };

    const isHome =
        window.location.pathname === "/" ||
        window.location.pathname === "/index";

    /* ========================= */
    /* NAVBAR SHRINK */
    /* ========================= */
    const updateNavbar = () => {
        const shrink = window.scrollY > 20;

        navbar.classList.toggle("navbar-shrink", shrink);
        navbar.classList.toggle("bg-black/85", shrink);
        navbar.classList.toggle("bg-white/50", !shrink);
        navbar.classList.toggle("backdrop-blur-md", !shrink);
    };

    window.addEventListener("scroll", updateNavbar);
    updateNavbar();

    /* ========================= */
    /* ACTIVE LINK */
    /* ========================= */
    const setActiveLink = (key) => {
        links.forEach((l) => l.classList.remove("active-nav"));

        const active = document.querySelector(
            `a.scroll-link[href="/?section=${key}"]`
        );
        active?.classList.add("active-nav");
    };

    /* ========================= */
    /* CLICK HANDLER */
    /* ========================= */
links.forEach((link) => {
    link.addEventListener("click", (e) => {
        const url = new URL(link.href);

        // ✅ biarkan link eksternal jalan normal
        if (url.origin !== window.location.origin) return;

        const section = url.searchParams.get("section");
        const targetId = sectionMap[section];

        if (!targetId || !isHome) return;

        const target = document.getElementById(targetId);
        if (!target) return;

        e.preventDefault();
        target.scrollIntoView({ behavior: "smooth" });
    });
});

    /* ========================= */
    /* SCROLLSPY */
    /* ========================= */
    if (isHome) {
        const sections = Object.entries(sectionMap)
            .map(([key, id]) => ({
                key,
                el: document.getElementById(id),
            }))
            .filter((s) => s.el);

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    const match = sections.find((s) => s.el === entry.target);
                    if (match) setActiveLink(match.key);
                });
            },
            { threshold: 0.6 }
        );

        sections.forEach((s) => observer.observe(s.el));
    }

    /* ========================= */
    /* AUTO SCROLL FROM ?section */
    /* ========================= */
    const params = new URLSearchParams(window.location.search);
    const requested = params.get("section");

    if (isHome && requested && sectionMap[requested]) {
        const target = document.getElementById(sectionMap[requested]);

        if (target) {
            setTimeout(() => {
                target.scrollIntoView({ behavior: "smooth" });
                setActiveLink(requested);
                history.replaceState(null, "", "/");
            }, 100);
        }
    }
});