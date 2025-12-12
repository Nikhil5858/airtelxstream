const numberInput = document.getElementById("mobileInput");     
const errorMessage = document.getElementById("mobileError"); 
const otpError = document.getElementById("otpError");   
const otpModal = new bootstrap.Modal(document.getElementById("otpModal"));
const loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
const otpTriggerButton = document.getElementById("continueBtn"); 
const otpInputs = document.querySelectorAll(".otp-input");
const resendTimer = document.getElementById("resendTimer");

let timerInterval;

// Open OTP Modal
otpTriggerButton.addEventListener("click", () => {
    const number = numberInput.value.trim();

    if (number.length !== 10 || isNaN(number)) {
        errorMessage.style.display = "block";
        errorMessage.textContent = "Enter a valid 10-digit mobile number";
        return;
    }

    errorMessage.style.display = "none";
    document.getElementById("otpMobile").textContent = number;

    loginModal.hide();
    otpModal.show();

    startOTPTimer();
});

// Auto move + backspace handling
otpInputs.forEach((input, index) => {
    input.addEventListener("input", () => {
        if (input.value.length === 1 && index < otpInputs.length - 1) {
            otpInputs[index + 1].focus();
        }
    });

    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && input.value === "" && index > 0) {
            otpInputs[index - 1].focus();
        }
    });
});

// VERIFY button action
document.querySelector("#otpModal button.btn").addEventListener("click", () => {
    let otp = "";
    otpInputs.forEach(i => otp += i.value);

    if (otp.length === 4 && !isNaN(otp)) {
        otpError.style.display = "none";
        alert("OTP verified successfully!");

        otpModal.hide();
        otpInputs.forEach(i => i.value = "");
    } else {
        otpError.style.display = "block";
        otpError.textContent = "Please enter a valid 4-digit OTP.";
    }
});


// Start OTP countdown
function startOTPTimer() {
    let time = 60;
    resendTimer.textContent = `Resend OTP in (0:${time})`;
    resendTimer.style.pointerEvents = "none";
    resendTimer.style.opacity = "0.5";

    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        time--;
        resendTimer.textContent = `Resend OTP in (0:${time < 10 ? "0" + time : time})`;

        if (time === 0) {
            clearInterval(timerInterval);
            resendTimer.innerHTML = `<a href="#" id="resendBtn" style="color:#fff;">Resend OTP</a>`;
            resendTimer.style.pointerEvents = "auto";
            resendTimer.style.opacity = "1";

            document.getElementById("resendBtn").addEventListener("click", () => {
                startOTPTimer(); // restart timer
                otpInputs.forEach(i => i.value = "");
                otpInputs[0].focus();
            });
        }
    }, 1000);
}

const scrollers = document.querySelectorAll(".movie-scroll-container");

scrollers.forEach(container => {
    const scroller = container.querySelector(".movie-scroller");
    const leftBtn = container.querySelector(".left-btn");
    const rightBtn = container.querySelector(".right-btn");

    const scrollAmount = 300; // how much scroll per click

    leftBtn.addEventListener("click", () => {
        scroller.scrollBy({
            left: -scrollAmount,
            behavior: "smooth"
        });
    });

    rightBtn.addEventListener("click", () => {
        scroller.scrollBy({
            left: scrollAmount,
            behavior: "smooth"
        });
    });
});

document.querySelector(".left-btn").addEventListener("click", function () {
    document.querySelector(".live-scroller").scrollBy({
        left: -300,
        behavior: "smooth"
    });
});

document.querySelector(".right-btn").addEventListener("click", function () {
    document.querySelector(".live-scroller").scrollBy({
        left: 300,
        behavior: "smooth"
    });
});

document.querySelector(".lang-left").addEventListener("click", function () {
    document.querySelector(".lang-scroller").scrollBy({
        left: -300,
        behavior: "smooth"
    });
});

document.querySelector(".lang-right").addEventListener("click", function () {
    document.querySelector(".lang-scroller").scrollBy({
        left: 300,
        behavior: "smooth"
    });
});

document.querySelector(".top10-left-btn").addEventListener("click", function () {
    document.querySelector(".top10-scroller").scrollBy({
        left: -300,
        behavior: "smooth"
    });
});

document.querySelector(".top10-right-btn").addEventListener("click", function () {
    document.querySelector(".top10-scroller").scrollBy({
        left: 300,
        behavior: "smooth"
    });
});
document.querySelector(".ott-left-btn").addEventListener("click", function () {
    document.querySelector(".ott-scroller").scrollBy({
        left: -300,
        behavior: "smooth"
    });
});

document.querySelector(".ott-right-btn").addEventListener("click", function () {
    document.querySelector(".ott-scroller").scrollBy({
        left: 300,
        behavior: "smooth"
    });
});