<!DOCTYPE html>
<!-- Maud's code, deze code heeft nu de juiste layour en style -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery - Login</title>

    <!-- Meta -->
    <meta name="description" content="Login for KneeCovery - Smart ACL Rehabilitation">
    <link rel="shortcut icon" href="{{ asset ('assets/images/favicon.svg') }}">

    <!-- CSS bestanden -->
    <link rel="stylesheet" href="{{ asset ('assets/fonts/remix/remixicon.css') }}">
    <!-- Belangrijk: dezelfde CSS als in signup -->
    <link rel="stylesheet" href="{{ asset ('assets/css/main.css') }}">

    <style>
        /* Algemene achtergrond en body */
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

        /* Linkerzijde (logo & branding) */
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

        /* Log in box */
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

<!-- Auth wrapper (geen container!) -->
<div class="auth-wrapper">

    <!-- Logo en tekstje -->
    <div class="auth-branding">
        <img src="{{ asset('assets/images/logo.png') }}" alt="KneeCovery Logo">
        <h2>Welcome to KneeCovery</h2>
        <p>Your personalised platform for smart ACL rehabilitation. Track your progress, connect with your care team, and recover stronger every day.</p>
    </div>

    <!-- Log in -->
    <form action="{{ url('/homepage') }}" method="GET">   <!-- Deze regel laat zien waar de gebruiker heen gaat wanneer deze op login knop drukt -->

        <div class="auth-box gradient-box">
            <h4>Login</h4> <!-- De tekst bovenin wat het blokje is -->

            <!-- Hier wordt het email veld geschreven -->
            <div class="mb-3">  <!-- mb-3 is de maat van het veld, dus uiterlijk -->
                <label class="form-label" for="email">Your email <span class="text-danger">*</span></label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <!-- Hier wordt het veld PassWord beschreven -->
            <div class="mb-3">
                <label class="form-label" for="pwd">Your password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" id="pwd" class="form-control" placeholder="Enter password" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="ri-eye-line"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <a href="#" class="text-decoration-underline">Forgot password?</a>
            </div>

            <div class="mb-3 d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ url('/') }}" class="btn btn-secondary">Not registered? Signup</a>
            </div>

        </div>

    </form>
    <!-- Form ends -->

</div> <!-- Auth wrapper ends -->


<script>
    // Toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#pwd');

    togglePassword?.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.querySelector('i').classList.toggle('ri-eye-off-line');
    });
</script>

</body>

</html>
