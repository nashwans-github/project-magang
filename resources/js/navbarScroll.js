document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.getElementById("navbar");
    if (!navbar) return;

    const links = document.querySelectorAll("a.scroll-link");

    /* ========================= */
    /* NAVBAR SHRINK             */
    /* ========================= */
    function updateNavbar() {
        if (window.scrollY > 20) {
            navbar.classList.add("navbar-shrink", "bg-black/85");
            navbar.classList.remove("bg-white/50", "backdrop-blur-md");
        } else {
            navbar.classList.remove("navbar-shrink", "bg-black/85");
            navbar.classList.add("bg-white/50", "backdrop-blur-md");
        }
    }

    window.addEventListener("scroll", updateNavbar);
    updateNavbar();

    /* ========================= */
    /* ACTIVE LINK (SCROLL ONLY) */
    /* ========================= */
    function setActiveLink(targetId) {
        links.forEach(l => l.classList.remove("active-nav"));

        links.forEach(l => {
            const href = l.getAttribute("href");
            if (href === `#${targetId}`) {
                l.classList.add("active-nav");
            }
        });
    }

    /* ========================= */
    /* CLICK HANDLER (SMART)     */
    /* ========================= */
    links.forEach(link => {
        link.addEventListener("click", e => {
            const href = link.getAttribute("href");
            if (!href || !href.startsWith("#")) return;

            const targetId = href.replace("#", "");
            const target = document.getElementById(targetId);

            // ✅ JIKA SECTION ADA → SCROLL
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: "smooth" });
                return;
            }

            // ❗ JIKA TIDAK ADA → REDIRECT KE HOME + SECTION
            e.preventDefault();
            window.location.href = `/?section=${targetId}`;
        });
    });

    /* ========================= */
    /* SCROLLSPY (HOME ONLY)     */
    /* ========================= */
    const sections = Array.from(links)
        .map(link => {
            const id = link.getAttribute("href")?.replace("#", "");
            return id ? document.getElementById(id) : null;
        })
        .filter(Boolean);

    if (sections.length) {
        const observer = new IntersectionObserver(
            entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setActiveLink(entry.target.id);
                    }
                });
            },
            { threshold: 0.6 }
        );

        sections.forEach(sec => observer.observe(sec));
    }

    /* ========================= */
    /* AUTO SCROLL FROM ?section */
    /* ========================= */
    const params = new URLSearchParams(window.location.search);
    const requested = params.get("section");

    if (requested) {
        const target = document.getElementById(requested);
        if (target) {
            setTimeout(() => {
                target.scrollIntoView({ behavior: "smooth" });
                history.replaceState(null, "", window.location.pathname);
            }, 100);
        }
    }
});