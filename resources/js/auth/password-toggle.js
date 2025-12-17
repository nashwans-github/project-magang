export function initPasswordToggle() {
    document.querySelectorAll("[data-password-toggle]").forEach((toggle) => {
        const targetId = toggle.dataset.passwordToggle;
        const input = document.getElementById(targetId);

        if (!input) return;

        toggle.addEventListener("click", () => {
            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";

            const paths = toggle.querySelectorAll("path");

            if (paths.length < 2) return;

            if (isPassword) {
                // mata terbuka
                paths[0].setAttribute("d", "M15 12a3 3 0 11-6 0 3 3 0 016 0z");
                paths[1].setAttribute(
                    "d",
                    "M2.458 12C3.732 7.824 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.076-5.064 7-9.542 7s-8.268-2.924-9.542-7z"
                );
            } else {
                // mata tertutup
                paths[0].setAttribute(
                    "d",
                    "M13.875 18.825A10.015 10.015 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.516-2.583"
                );
                paths[1].setAttribute(
                    "d",
                    "M2.458 12C3.732 7.824 7.522 5 12 5c2.478 0 4.75 1.155 6.31 2.915M3 3l18 18"
                );
            }
        });
    });
}