// Smooth accordion animation for <details> within .js-faq-accordion
document.addEventListener("DOMContentLoaded", () => {
    const container = document.querySelector(".js-faq-accordion");
    if (!container) return;

    const detailsList = Array.from(container.querySelectorAll("details"));

    detailsList.forEach((details) => {
        const summary = details.querySelector("summary");
        const answer = summary ? summary.nextElementSibling : null;
        if (!summary || !answer) return;

        // Base styles
        answer.style.overflow = "hidden";
        answer.style.transition = "max-height 300ms ease-in-out";
        answer.style.maxHeight = details.open ? "none" : "0px";

        summary.addEventListener("click", (event) => {
            event.preventDefault();

            if (details.open) {
                // Collapse from current height to 0 smoothly
                const current = answer.scrollHeight;
                answer.style.maxHeight = current + "px";
                requestAnimationFrame(() => {
                    answer.style.maxHeight = "0px";
                });
                answer.addEventListener(
                    "transitionend",
                    (e) => {
                        if (e.propertyName !== "max-height") return;
                        details.open = false;
                    },
                    { once: true }
                );
            } else {
                // Expand smoothly then allow natural height
                details.open = true;
                answer.style.maxHeight = "0px";
                requestAnimationFrame(() => {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                });
                answer.addEventListener(
                    "transitionend",
                    (e) => {
                        if (e.propertyName !== "max-height") return;
                        answer.style.maxHeight = "none";
                    },
                    { once: true }
                );
            }
        });
    });
});
