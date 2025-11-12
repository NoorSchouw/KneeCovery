<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery - Signup</title>

    <!-- Meta -->
    <meta name="description" content="Signup for KneeCovery - Smart Knee Rehabilitation">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">

    <style>
        /* Overall page gradient background */
        body {
            background: linear-gradient(135deg, #fce0e6 0%, #fde2c3 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Poppins", sans-serif;
        }

        /* Center container */
        .auth-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 60px;
            width: 100%;
            max-width: 1200px;
            padding: 40px;
        }

        /* Left side (logo & branding) */
        .auth-branding {
            flex: 1;
            text-align: right;
            color: #333;
        }

        .auth-branding img {
            max-width: 280px;
            margin-bottom: 20px;
        }

        .auth-branding h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #444;
        }

        .auth-branding p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
        }

        /* Signup box */
        .auth-box.gradient-box {
            flex: 1;
            background: linear-gradient(135deg, #fd7596 0%, #faaa89 100%);
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            border-radius: 20px;
            color: #fff;
            max-width: 420px;
        }

        .auth-box.gradient-box .form-control {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            color: #fff;
        }

        .auth-box.gradient-box .form-control::placeholder {
            color: rgba(255, 255, 255, 0.85);
        }

        .auth-box.gradient-box h4 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.8rem;
        }

        /* Buttons */
        .btn-primary {
            background: #fff;
            color: #f56b8c;
            border: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #ffe6eb;
            color: #f97793;
        }

        .btn-secondary {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #fff;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Password icon */
        .input-group .btn-outline-secondary {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            color: #fff;
        }

        .input-group .btn-outline-secondary:hover {
            background-color: rgba(255, 255, 255, 0.25);
        }

        /* Smooth fade-in animation */
        .auth-box,
        .auth-branding {
            animation: fadeIn 0.8s ease both;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(10px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>

<body>

<div class="auth-wrapper">

    <!-- Left branding section -->
    <div class="auth-branding">
        <img src="{{ asset('assets/images/logo.png') }}" alt="KneeCovery Logo">
        <h2>Welcome to KneeCovery</h2>
        <p>Your personalised platform for smart ACL rehabilitation. Track your progress, connect with your care team, and recover stronger every day.</p>
    </div>

    <!-- Signup form -->
    <form action="{{ url('/homepage') }}" method="GET">
        @csrf

        <div class="auth-box gradient-box">
            <h4>Create Account</h4>

            <div class="mb-3">
                <label class="form-label" for="name">Your name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">Your email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="pwd">Your password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" id="pwd" name="password" class="form-control" placeholder="Enter your password" minlength="8" maxlength="20" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="ri-eye-line"></i>
                    </button>
                </div>
                <div class="form-text">
                    Your password must be 8–20 characters long.
                </div>
            </div>

            <div class="mb-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">Sign up</button>
                <a href="{{ url('/') }}" class="btn btn-secondary">Already have an account? Login</a>
            </div>
        </div>
    </form>
</div>

<script>
    // Toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#pwd');

    togglePassword?.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.querySelector('i').classList.toggle('ri-eye-off-line');
    });

    // Force English validation messages using customValidity
    (function () {
        const form = document.querySelector('form');
        const nameInput = document.querySelector('#name');
        const emailInput = document.querySelector('#email');
        const pwdInput = document.querySelector('#pwd');

        if (!form) return;

        function clearAll() {
            [nameInput, emailInput, pwdInput].forEach(el => el && el.setCustomValidity(''));
        }

        function setMessages() {
            clearAll();
            if (nameInput && !nameInput.value.trim()) {
                nameInput.setCustomValidity('Please enter your name.');
            }
            if (emailInput) {
                if (!emailInput.value.trim()) {
                    emailInput.setCustomValidity('Please enter your email address.');
                } else if (emailInput.validity.typeMismatch) {
                    emailInput.setCustomValidity('Please enter a valid email address.');
                }
            }
            if (pwdInput) {
                if (!pwdInput.value.trim()) {
                    pwdInput.setCustomValidity('Please enter your password.');
                } else if (pwdInput.value.length < 8) {
                    pwdInput.setCustomValidity('Your password must be at least 8 characters.');
                }
            }
        }

        // On input, clear custom message so browser updates validity live
        [nameInput, emailInput, pwdInput].forEach(el => {
            el?.addEventListener('input', () => el.setCustomValidity(''));
        });

        form.addEventListener('submit', (e) => {
            setMessages();
            if (!form.checkValidity()) {
                e.preventDefault();
                // Show messages in English
                form.reportValidity();
            }
        });
    })();
</script>

</body>
</html>
