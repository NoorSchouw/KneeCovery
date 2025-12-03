// ---------------------------------------------
// Toggle password visibility
// ---------------------------------------------
document.querySelectorAll('.toggle-password, #togglePassword').forEach(button => {
    button.addEventListener('click', () => {

        // Vind het wachtwoordveld binnen dezelfde input-group
        const input = button.closest('.input-group')
            .querySelector('input[type="password"], input[type="text"]');

        if (!input) return;

        // Toggle type
        const type = input.type === "password" ? "text" : "password";
        input.type = type;

        // Toggle icoon
        const icon = button.querySelector("i");
        if (icon) {
            icon.classList.toggle("ri-eye-line");
            icon.classList.toggle("ri-eye-off-line");
        }
    });
});


// ---------------------------------------------
// Password match validation (with green check)
// ---------------------------------------------
document.addEventListener("DOMContentLoaded", () => {

    const newPass = document.querySelector("#new-password");
    const confirmPass = document.querySelector("#confirm-password");
    const form = document.querySelector("form");

    // Live update: toon geldig/ongeldig tijdens typen
    function validatePasswords() {

        // Check new password
        if (newPass.value.trim().length >= 8) {
            newPass.classList.remove("is-invalid");
            newPass.classList.add("is-valid");
        } else {
            newPass.classList.remove("is-valid");
        }

        // Check confirm password
        if (confirmPass.value.trim() === "") {
            confirmPass.classList.remove("is-valid");
            confirmPass.classList.remove("is-invalid");
            return;
        }

        if (newPass.value === confirmPass.value) {
            confirmPass.classList.remove("is-invalid");
            confirmPass.classList.add("is-valid");
        } else {
            confirmPass.classList.remove("is-valid");
            confirmPass.classList.add("is-invalid");
        }
    }

    // Live validation
    newPass.addEventListener("input", validatePasswords);
    confirmPass.addEventListener("input", validatePasswords);

    // Final validation on submit
    form.addEventListener("submit", e => {
        let valid = true;

        if (newPass.value.length < 8) {
            newPass.classList.add("is-invalid");
            valid = false;
        }

        if (newPass.value !== confirmPass.value) {
            confirmPass.classList.add("is-invalid");
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
