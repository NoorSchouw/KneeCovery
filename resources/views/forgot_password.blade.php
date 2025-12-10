<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KneeCovery - Forgot Password</title>

    <!-- Meta -->
    <meta name="description" content="Forgot Password for KneeCovery - Smart ACL Rehabilitation">
    <link rel="shortcut icon" href="{{ asset ('assets/images/favicon.svg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset ('assets/css/main.css') }}">
</head>

<body class="body-auth">

<div class="auth-wrapper">

    <!-- Alleen het logo, geen grote tekst -->
    <div class="auth-branding">
        <img src="{{ asset('assets/images/logo.png') }}" alt="KneeCovery Logo">
    </div>

    <!-- Forgot Password Form -->
{{--    <form action="{{ url('/homepage') }}" method="GET">--}}
    <form action="{{ route('password.update') }}" method="POST">
    @csrf

            <div class="auth-box gradient-box">

            <h4>Reset Password</h4>

            <p class="fw-light mb-4">
                Enter your email and choose a new password.
            </p>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label" for="email">Your email <span class="text-danger">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label class="form-label" for="new-password">New password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input
                        type="password"
                        id="new-password"
                        name="password"
                        class="form-control"
                        placeholder="Enter new password"
                        minlength="8"
                        required
                    >
                    <button type="button" class="btn btn-outline-secondary toggle-password">
                        <i class="ri-eye-line"></i>
                    </button>
                </div>
                <div class="form-text">
                    Your password must be 8-20 characters long.
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="form-label" for="confirm-password">Confirm password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input
                        type="password"
                        id="confirm-password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Re-enter your new password"
                        minlength="8"
                        required
                    >
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="ri-eye-line"></i>
                    </button>
                </div>
            </div>

            <!-- Submit and go to homepage, cancel password change -->
            <div class="mb-3 d-grid gap-2">
                <button type="submit" class="btn btn-light">Reset Password</button>
                <a href="{{ url('/') }}" class="btn btn-secondary">Cancel reset password</a>
            </div>

{{--            Error melding--}}
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

    </form>

</div>

<!-- Toggle JS -->
<script src="{{ asset('assets/js/authentification.js') }}"></script>

</body>
</html>
