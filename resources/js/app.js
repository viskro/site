import "./bootstrap";
import "./components/FaqAccordion";

// Global Alpine component factory for product card audio player
window.productCardPlayer = function (audioUrl) {
    return {
        isPlaying: false,
        audio: null,
        init() {
            if (audioUrl) {
                this.audio = new Audio(audioUrl);
                this.audio.addEventListener("ended", () => {
                    this.isPlaying = false;
                });
            }

            // Stop this audio when another card starts playing
            window.addEventListener("stop-all-audios", () => {
                if (this.audio && this.isPlaying) {
                    this.audio.pause();
                    this.audio.currentTime = 0;
                    this.isPlaying = false;
                }
            });
        },
        toggle() {
            if (!this.audio) return;
            if (this.isPlaying) {
                this.audio.pause();
                this.audio.currentTime = 0;
                this.isPlaying = false;
            } else {
                window.dispatchEvent(new CustomEvent("stop-all-audios"));
                this.audio.play();
                this.isPlaying = true;
            }
        },
    };
};

// JS vanilla pour les boutons audio des cartes, indépendant d'Alpine
document.addEventListener("DOMContentLoaded", () => {
    let currentAudio = null;
    let currentBtn = null;

    function stopCurrent() {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.currentTime = 0;
            if (currentBtn) {
                const play = currentBtn.querySelector(".js-icon-play");
                const pause = currentBtn.querySelector(".js-icon-pause");
                if (play && pause) {
                    play.classList.remove("hidden");
                    pause.classList.add("hidden");
                }
            }
            currentAudio = null;
            currentBtn = null;
        }
    }

    document.body.addEventListener("click", (e) => {
        const btn = e.target.closest(".js-card-audio-btn");
        if (!btn) return;

        const url = btn.getAttribute("data-audio");
        if (!url) return;

        if (currentBtn === btn && currentAudio) {
            stopCurrent();
            return;
        }

        stopCurrent();
        currentAudio = new Audio(url);
        currentBtn = btn;
        const play = btn.querySelector(".js-icon-play");
        const pause = btn.querySelector(".js-icon-pause");
        if (play && pause) {
            play.classList.add("hidden");
            pause.classList.remove("hidden");
        }

        currentAudio.addEventListener("ended", () => {
            stopCurrent();
        });
        currentAudio.play();
    });
});
