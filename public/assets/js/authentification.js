// Toggle password visibility
const togglePassword = document.querySelector('#togglePassword');
const passwordInput = document.querySelector('#pwd');

togglePassword?.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePassword.querySelector('i').classList.toggle('ri-eye-off-line');
});

// Password Reset Validation
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    if (!form) return;

    const email = document.querySelector("#email");
    const newPass = document.querySelector("#new-password");
    const confirmPass = document.querySelector("#confirm-password");

    // Reset alle rode velden live tijdens typen
    [email, newPass, confirmPass].forEach(input => {
        input.addEventListener("input", () => {
            input.classList.remove("is-invalid");
            input.classList.remove("is-valid");
        });
    });

    form.addEventListener("submit", function (e) {
        let valid = true;

        // EMAIL
        if (!email.value.trim()) {
            email.classList.add("is-invalid");
            email.setCustomValidity("Please enter your email.");
            valid = false;
        } else {
            email.setCustomValidity("");
            email.classList.add("is-valid");
        }

        // NEW PASSWORD
        if (!newPass.value.trim()) {
            newPass.classList.add("is-invalid");
            newPass.setCustomValidity("Please enter a password.");
            valid = false;
        } else {
            newPass.setCustomValidity("");
            newPass.classList.add("is-valid");
        }

        // CONFIRM PASSWORD
        if (!confirmPass.value.trim()) {
            confirmPass.classList.add("is-invalid");
            confirmPass.setCustomValidity("Please confirm your password.");
            valid = false;

        } else if (confirmPass.value !== newPass.value) {
            confirmPass.classList.add("is-invalid");
            confirmPass.setCustomValidity("Passwords do not match.");
            valid = false;

        } else {
            confirmPass.setCustomValidity("");
            confirmPass.classList.remove("is-invalid");   // <--- BELANGRIJK
            confirmPass.classList.add("is-valid");
        }


        // Stop form if invalid
        if (!valid) {
            e.preventDefault();
            form.reportValidity();
        }
    });
});

// Succesmelding wanneer wachtwoord correct verandert is
if (valid) {
    const successDiv = document.querySelector('#successMessage');
    if (successDiv) {
        successDiv.classList.remove('d-none');
    }
}

/* ------------------------
   Validation: check matching passwords
------------------------- */
(function () {
    const form = document.getElementById("signupForm");
    const email = document.getElementById("email");
    const pass1 = document.getElementById("password");
    const pass2 = document.getElementById("password_confirm");

    function clearValidity() {
        [email, pass1, pass2].forEach(el => el.setCustomValidity(""));
    }

    function setValidation() {
        clearValidity();

        if (!email.value.trim()) {
            email.setCustomValidity("Please enter your email address.");
        } else if (email.validity.typeMismatch) {
            email.setCustomValidity("Please enter a valid email address.");
        }

        if (pass1.value.length < 8) {
            pass1.setCustomValidity("Password must be at least 8 characters.");
        }

        if (pass1.value !== pass2.value) {
            pass2.setCustomValidity("Passwords do not match.");
        }
    }

    [email, pass1, pass2].forEach(input => {
        input.addEventListener("input", () => input.setCustomValidity(""));
    });

    form.addEventListener("submit", e => {
        setValidation();
        if (!form.checkValidity()) {
            e.preventDefault();
            form.reportValidity();
        }
    });
})();
