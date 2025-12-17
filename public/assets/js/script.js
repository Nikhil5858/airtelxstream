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

// Open OTP Modal
otpTriggerButton.addEventListener("click", () => {
  const email = emailInput.value.trim();
  const name = nameInput.value.trim();
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(email)) {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Enter a valid email address";
    return;
  }

  if (name === "") {
    errorMessage.style.display = "block";
    errorMessage.textContent = "Enter Name";
    return;
  }

  errorMessage.style.display = "none";

  // Disable button
  otpTriggerButton.disabled = true;
  otpTriggerButton.textContent = "Sending OTP...";

  fetch(BASE_URL + "/auth/send-otp", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({ email, name }),
  })
    .then((res) => res.json())
    .then((res) => {
      if (!res.status) {
        errorMessage.style.display = "block";
        errorMessage.textContent = res.msg;

        otpTriggerButton.disabled = false;
        otpTriggerButton.textContent = "Continue";
        return;
      }

      document.getElementById("otpMobile").textContent = email;
      loginModal.hide();
      otpModal.show();
      startOTPTimer();
    })
    .catch(() => {
      errorMessage.style.display = "block";
      errorMessage.textContent = "Server error. Try again.";

      otpTriggerButton.disabled = false;
      otpTriggerButton.textContent = "Continue";
    });
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
  otpInputs.forEach((i) => (otp += i.value));

  if (otp.length !== 4 || isNaN(otp)) {
    otpError.style.display = "block";
    otpError.textContent = "Enter valid OTP";
    return;
  }

  fetch(BASE_URL+"/auth/verify-otp", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({ otp }),
  })
    .then((res) => res.json())
    .then((res) => {
      if (res.status) {
        otpModal.hide();
        window.location.reload(); // or redirect
      } else {
        otpError.style.display = "block";
        otpError.textContent = res.msg;
      }
    });
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
    resendTimer.textContent = `Resend OTP in (0:${
      time < 10 ? "0" + time : time
    })`;

    if (time === 0) {
      clearInterval(timerInterval);
      resendTimer.innerHTML = `<a href="#" id="resendBtn" style="color:#fff;">Resend OTP</a>`;
      resendTimer.style.pointerEvents = "auto";
      resendTimer.style.opacity = "1";

      document.getElementById("resendBtn").addEventListener("click", () => {
        const email = emailInput.value.trim();

        fetch(BASE_URL+"/auth/send-otp", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            email: email,
            name: nameInput.value.trim()
          })

        })
          .then((res) => res.json())
          .then((res) => {
            if (!res.status) {
              otpError.style.display = "block";
              otpError.textContent = res.msg;
              return;
            }

            otpError.style.display = "none";
            otpInputs.forEach((i) => (i.value = ""));
            otpInputs[0].focus();
            startOTPTimer();
          });
      });
    }
  }, 1000);
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
