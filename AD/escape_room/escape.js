document.addEventListener("DOMContentLoaded", function () {
    // entrada animada del título y del contenido (animate.css)
    var titulo = document.querySelector("h1");
    if (titulo) {
        titulo.classList.add("animate__animated", "animate__fadeInDown");
    }
    document.querySelectorAll("p, form, h2").forEach(function (el, i) {
        el.classList.add("animate__animated", "animate__fadeInUp");
        el.style.animationDelay = (0.1 + i * 0.07) + "s";
    });

    // marcar los mensajes de acierto y de fallo
    var acierto = false;
    document.querySelectorAll("p").forEach(function (p) {
        if (p.textContent.indexOf("Correcto") === 0) {
            p.classList.add("correcto");
            acierto = true;
        } else if (p.textContent.indexOf("Incorrecto") === 0) {
            p.classList.add("incorrecto");
            var form = document.querySelector("form");
            if (form) {
                form.classList.add("temblor");
            }
        }
    });

    // confeti al abrir un candado (canvas-confetti)
    if (acierto && window.confetti) {
        confetti({ particleCount: 120, spread: 70, origin: { y: 0.7 } });
    }

    // fiesta en la habitación final
    if (document.body.dataset.final === "si" && window.confetti) {
        var fin = Date.now() + 3000;
        (function lanzar() {
            confetti({ particleCount: 6, angle: 60, spread: 60, origin: { x: 0 } });
            confetti({ particleCount: 6, angle: 120, spread: 60, origin: { x: 1 } });
            if (Date.now() < fin) {
                requestAnimationFrame(lanzar);
            }
        })();
    }
});
