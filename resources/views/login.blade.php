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
</head>

<body class="body-auth">

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
                <button type="submit" class="btn btn-light">Login</button>
                <a href="{{ url('/') }}" class="btn btn-secondary">Not registered? Signup</a>
            </div>

        </div>

    </form>
    <!-- Form ends -->

</div> <!-- Auth wrapper ends -->

<!-- Custom JS files -->
<script src="{{ asset('assets/js/authentification.js') }}"></script>

</body>

</html>
