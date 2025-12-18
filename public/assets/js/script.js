const BASE_URL = "http://localhost/airtelxstream/public";
const emailInput = document.getElementById("emailInput");
const nameInput = document.getElementById("nameInput");
const errorMessage = document.getElementById("mobileError");
const otpError = document.getElementById("otpError");
const otpModal = new bootstrap.Modal(document.getElementById("otpModal"));
const loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
const otpTriggerButton = document.getElementById("continueBtn");
const otpInputs = document.querySelectorAll(".otp-input");
const resendTimer = document.getElementById("resendTimer");

let timerInterval;

/* =======================
   SEND OTP
======================= */
otpTriggerButton.addEventListener("click", () => {
  const email = emailInput.value.trim();
  const name  = nameInput.value.trim();
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  errorMessage.style.display = "none";

  if (!emailPattern.test(email)) {
    errorMessage.textContent = "Enter a valid email address";
    errorMessage.style.display = "block";
    return;
  }

  if (name === "") {
    errorMessage.textContent = "Enter your name";
    errorMessage.style.display = "block";
    return;
  }

  otpTriggerButton.disabled = true;
  otpTriggerButton.textContent = "Sending OTP...";

  fetch(BASE_URL + "/auth/send-otp", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ email, name })
  })
    .then(r => r.json())
    .then(res => {
      otpTriggerButton.disabled = false;
      otpTriggerButton.textContent = "Continue";

      if (!res.status) {
        errorMessage.textContent = res.msg || "Failed to send OTP";
        errorMessage.style.display = "block";
        return;
      }

      document.getElementById("otpMobile").textContent = email;
      otpInputs.forEach(i => i.value = "");
      otpError.style.display = "none";

      loginModal.hide();
      otpModal.show();
      startOTPTimer();
    })
    .catch(() => {
      otpTriggerButton.disabled = false;
      otpTriggerButton.textContent = "Continue";
      errorMessage.textContent = "Server error. Try again.";
      errorMessage.style.display = "block";
    });
});

/* =======================
   OTP INPUT UX
======================= */
otpInputs.forEach((input, index) => {
  input.addEventListener("input", () => {
    input.value = input.value.replace(/\D/g, "");
    if (input.value && index < otpInputs.length - 1) {
      otpInputs[index + 1].focus();
    }
  });

  input.addEventListener("keydown", e => {
    if (e.key === "Backspace" && !input.value && index > 0) {
      otpInputs[index - 1].focus();
    }
  });
});

/* =======================
   VERIFY OTP
======================= */
document.querySelector("#otpModal .btn").addEventListener("click", () => {
  otpError.style.display = "none";

  let otp = "";
  otpInputs.forEach(i => otp += i.value);

  if (otp.length !== 4) {
    otpError.textContent = "Enter the 4-digit OTP";
    otpError.style.display = "block";
    return;
  }

  fetch(BASE_URL + "/auth/verify-otp", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ otp })
  })
    .then(r => r.json())
    .then(res => {
      if (!res.status) {
        otpError.textContent = res.msg || "Invalid OTP";
        otpError.style.display = "block";
        return;
      }

      otpModal.hide();
      window.location.reload();
    })
    .catch(() => {
      otpError.textContent = "Verification failed. Try again.";
      otpError.style.display = "block";
    });
});

/* =======================
   OTP TIMER + RESEND
======================= */
function startOTPTimer() {
  let time = 60;
  resendTimer.style.pointerEvents = "none";
  resendTimer.style.opacity = "0.5";

  clearInterval(timerInterval);

  timerInterval = setInterval(() => {
    resendTimer.textContent = `Resend OTP in (0:${time < 10 ? "0" : ""}${time})`;
    time--;

    if (time < 0) {
      clearInterval(timerInterval);
      resendTimer.innerHTML = `<a href="#" id="resendBtn" style="color:#fff;">Resend OTP</a>`;
      resendTimer.style.pointerEvents = "auto";
      resendTimer.style.opacity = "1";

      document.getElementById("resendBtn").onclick = e => {
        e.preventDefault();
        resendOtp();
      };
    }
  }, 1000);
}

function resendOtp() {
  otpError.style.display = "none";

  fetch(BASE_URL + "/auth/send-otp", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({
      email: emailInput.value.trim(),
      name: nameInput.value.trim()
    })
  })
    .then(r => r.json())
    .then(res => {
      if (!res.status) {
        otpError.textContent = res.msg || "Failed to resend OTP";
        otpError.style.display = "block";
        return;
      }

      otpInputs.forEach(i => i.value = "");
      otpInputs[0].focus();
      startOTPTimer();
    });
}

const scrollers = document.querySelectorAll(".movie-scroll-container");

scrollers.forEach((container) => {
  const scroller = container.querySelector(".movie-scroller");
  const leftBtn = container.querySelector(".left-btn");
  const rightBtn = container.querySelector(".right-btn");

  const scrollAmount = 300; // how much scroll per click

  leftBtn.addEventListener("click", () => {
    scroller.scrollBy({
      left: -scrollAmount,
      behavior: "smooth",
    });
  });

  rightBtn.addEventListener("click", () => {
    scroller.scrollBy({
      left: scrollAmount,
      behavior: "smooth",
    });
  });
});

document.querySelector(".left-btn").addEventListener("click", function () {
  document.querySelector(".live-scroller").scrollBy({
    left: -300,
    behavior: "smooth",
  });
});

document.querySelector(".right-btn").addEventListener("click", function () {
  document.querySelector(".live-scroller").scrollBy({
    left: 300,
    behavior: "smooth",
  });
});

document.querySelector(".lang-left").addEventListener("click", function () {
  document.querySelector(".lang-scroller").scrollBy({
    left: -300,
    behavior: "smooth",
  });
});

document.querySelector(".lang-right").addEventListener("click", function () {
  document.querySelector(".lang-scroller").scrollBy({
    left: 300,
    behavior: "smooth",
  });
});

document
  .querySelector(".top10-left-btn")
  .addEventListener("click", function () {
    document.querySelector(".top10-scroller").scrollBy({
      left: -300,
      behavior: "smooth",
    });
  });

document
  .querySelector(".top10-right-btn")
  .addEventListener("click", function () {
    document.querySelector(".top10-scroller").scrollBy({
      left: 300,
      behavior: "smooth",
    });
  });
document.querySelector(".ott-left-btn").addEventListener("click", function () {
  document.querySelector(".ott-scroller").scrollBy({
    left: -300,
    behavior: "smooth",
  });
});

document.querySelector(".ott-right-btn").addEventListener("click", function () {
  document.querySelector(".ott-scroller").scrollBy({
    left: 300,
    behavior: "smooth",
  });
});
