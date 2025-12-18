document.addEventListener("submit", function (event) {

    const form = event.target;
    const requiredInputs = form.querySelectorAll("[data-required='true']");
    if (requiredInputs.length === 0) return;

    let isValid = true;

    requiredInputs.forEach(input => {

        const errorMessage = input.dataset.error || "This field is required";

        let errorSpan =
            input.previousElementSibling?.querySelector(".error-message") ||
            input.parentElement?.querySelector(".error-message") ||
            input.closest("div")?.querySelector(".error-message") ||
            null;

        hideError(input, errorSpan);

        /* CHECKBOX */
        if (input.type === "checkbox") {
            if (!input.checked) {
                isValid = false;
                showError(input, errorSpan, errorMessage);
            }
            return;
        }

        /* SELECT */
        if (input.tagName === "SELECT") {
            if (input.value === "" || input.selectedIndex === 0) {
                isValid = false;
                showError(input, errorSpan, errorMessage);
            }
            return;
        }

        /* TEXT */
        if (input.value.trim() === "") {
            isValid = false;
            showError(input, errorSpan, errorMessage);
        }
    });

    if (!isValid) {
        event.preventDefault();
        event.stopPropagation();
    }

}, true);



/* ===== Helpers ===== */

function showError(input, span, msg) {
    if (!span) return;
    span.textContent = msg;
    span.classList.remove("d-none");
    input.classList.add("is-invalid");
}

function hideError(input, span) {
    if (!span) return;
    span.classList.add("d-none");
    input.classList.remove("is-invalid");
}
