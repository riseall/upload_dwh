// const idleDuration = 1800;
let timer;
// let secondLeft = idleDuration;

// function updateCountdown() {
//     document.getElementById("timer-countdown").innerText = secondLeft;
//     secondLeft--;
// }

function logOut() {
    clearTimeout(timer);
    Swal.fire({
        icon: "warning",
        title: "Sesi Habis",
        text: "Anda telah tidak aktif terlalu lama dan akan logout secara otomatis.",
        showConfirmButton: false,
        timer: 3000,
    }).then(() => {
        const logoutForm = document.createElement("form");
        logoutForm.method = "POST";
        logoutForm.action = "/logout";

        const csrfToken = document.createElement("input");
        csrfToken.type = "hidden";
        csrfToken.name = "_token";
        csrfToken.value = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        logoutForm.appendChild(csrfToken);
        document.body.appendChild(logoutForm);
        logoutForm.submit();
    });
}

// function resetTimer() {
//     secondLeft = idleDuration;
//     clearTimeout(timer);
//     timer = setInterval(function () {
//         updateCountdown();
//         if (secondLeft === 0) {
//             logOut();
//         }
//     }, 1000);
// }

// document.addEventListener("mousemove", resetTimer);
// document.addEventListener("keydown", resetTimer);
// document.addEventListener("click", resetTimer);
// document.addEventListener("scroll", resetTimer);

// resetTimer();
