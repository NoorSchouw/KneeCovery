<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clove Dental Care Admin Template</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">

</head>

<body>

<!-- Loading animation -->
<div id="loading-wrapper">
    <div class="spin-wrapper"><div class="circle"></div><div class="circle"></div></div>
    <div class="spin-wrapper"><div class="circle"></div><div class="circle"></div></div>
    <div class="spin-wrapper"><div class="circle"></div><div class="circle"></div></div>
    <div class="spin-wrapper"><div class="circle"></div><div class="circle"></div></div>
</div>

<div class="page-wrapper">

    <div class="main-container">

        <x-sidebar-patient/>

        <div class="app-container">

            <x-header/>

            <div class="app-hero-header d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/homepage">
                            <i class="ri-home-3-line"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-primary" aria-current="page">
                        Privacy Policy
                    </li>
                </ol>
            </div>

            <div class="card p-4" style="max-width: 900px; margin: auto;">
                <h2 class="mb-3">Privacy Policy</h2>
                <p><strong>Last updated:</strong> 23 November 2025</p>

                <p>
                    This Privacy Policy describes how this prototype website, developed by students of
                    Fontys University of Applied Sciences (“we”, “our”, or “the project team”), collects,
                    uses, stores, and protects your information. This platform has been created for
                    educational and research purposes and is designed to support physiotherapy exercises
                    by allowing users to record themselves performing assigned exercises and receive
                    system-generated feedback.
                </p>

                <p>
                    By using this platform, you acknowledge that this system is a student prototype and
                    not a commercially deployed product. Although we take your privacy seriously, certain
                    functionalities, security measures, and data handling processes may differ from those
                    found in production-level healthcare applications.
                </p>

                <hr>

                <h3>1. Information We Collect</h3>
                <p>
                    We collect only the information necessary to deliver the functionality of the platform
                    and support the physiotherapy feedback process. This includes:
                </p>
                <ul>
                    <li><strong>Video recordings</strong> you create using your device’s camera while completing exercises.</li>
                    <li><strong>Exercise data</strong> provided by your physiotherapist and assigned to your profile.</li>
                    <li><strong>Performance and feedback data</strong> generated automatically based on your movements.</li>
                    <li><strong>Account-related information</strong> such as your user ID, email address, or authentication details.</li>
                    <li><strong>Technical information</strong> used for functionality and debugging purposes, such as timestamps or error logs.</li>
                </ul>

                <p>
                    We do not collect unnecessary personal information such as your address, phone number,
                    medical history, or location data.
                </p>

                <hr>

                <h3>2. How We Use Your Information</h3>
                <p>Your information is used exclusively for the following purposes:</p>
                <ul>
                    <li>To analyze recorded exercises and provide automated feedback.</li>
                    <li>To link you to the physiotherapy program created by your physiotherapist.</li>
                    <li>To store exercise progress and performance results.</li>
                    <li>To improve the prototype and evaluate its functionality for educational purposes.</li>
                    <li>To address technical issues, ensure the website works properly, and enhance system stability.</li>
                </ul>

                <p>
                    Your data will <strong>never</strong> be sold, shared, or used for commercial purposes.
                </p>

                <hr>

                <h3>3. How Your Information Is Stored</h3>
                <p>
                    As this platform is a prototype, the storage methods used during development differ
                    from final production systems. Your data may be stored using the following methods:
                </p>
                <ul>
                    <li><strong>Local repository storage:</strong> Video recordings are temporarily stored on the developer's local environment as part of the prototype development process.</li>
                    <li><strong>Cloud storage (future version):</strong> Video files may later be stored in Amazon S3 for increased reliability and security.</li>
                    <li><strong>MySQL Database:</strong> Exercise data, performance results, user identifiers, and system metadata are stored in a MySQL database.</li>
                    <li><strong>Hashed sensitive data:</strong> Important identifying information is hashed before storage to prevent misuse or unauthorized access.</li>
                </ul>

                <p>
                    We apply basic security measures appropriate for an educational project, but the system
                    may not meet all industry-grade security and compliance requirements found in
                    commercial medical applications.
                </p>

                <hr>

                <h3>4. Legal Basis for Processing</h3>
                <p>
                    Because this is an educational prototype, your participation is voluntary. By using
                    the platform, you provide your consent for us to process your data in the ways
                    described in this Privacy Policy. You may withdraw this consent at any time.
                </p>

                <hr>

                <h3>5. Data Retention</h3>
                <p>
                    Your information will be retained only for as long as the project is active or until
                    it is no longer required for evaluation and development. When the project concludes:
                </p>

                <ul>
                    <li>All locally stored data will be deleted.</li>
                    <li>All database records will be removed.</li>
                    <li>Any cloud-stored video files (if applicable) will be permanently deleted.</li>
                </ul>

                <p>
                    No long-term storage or archival of your data will occur once the educational
                    objectives of the project are completed.
                </p>

                <hr>

                <h3>6. Data Security</h3>
                <p>
                    While this system is not a commercial product and does not include full production-grade
                    security measures, the project team takes reasonable steps to protect your information.
                    This includes:
                </p>
                <ul>
                    <li>Restricting access to only authorized project members.</li>
                    <li>Using hashed formats for sensitive data where applicable.</li>
                    <li>Limiting data collection to the minimum required for functionality.</li>
                    <li>Securing local development environments and repositories.</li>
                </ul>

                <p>
                    However, because this is a prototype, we cannot guarantee complete protection against
                    all potential security risks.
                </p>

                <hr>

                <h3>7. Your Rights</h3>
                <p>You have the following rights regarding your data:</p>
                <ul>
                    <li>The right to access the data we hold about you.</li>
                    <li>The right to request correction of inaccurate data.</li>
                    <li>The right to request deletion of your data.</li>
                    <li>The right to withdraw your consent at any time.</li>
                    <li>The right to ask questions about how your data is used.</li>
                </ul>

                <p>
                    To exercise any of these rights, please contact us at:
                    <strong>577581@student.fontys.nl</strong>
                </p>

                <hr>

                <h3>8. Third-Party Sharing</h3>
                <p>
                    We do not sell, rent, or share your information with third parties.
                    Your data may only be viewed by:
                </p>
                <ul>
                    <li>The project development team</li>
                    <li>Supervising teachers or assessors at Fontys (if required for evaluation)</li>
                </ul>

                <p>
                    No other parties will ever receive or access your information without explicit
                    consent from you.
                </p>

                <hr>

                <h3>9. Changes to This Policy</h3>
                <p>
                    Because this is an ongoing educational project, the Privacy Policy may be updated
                    as features change or new technologies are implemented. Any significant changes
                    will be reflected by updating the “Last updated” date above.
                </p>

                <hr>

                <h3>10. Contact Information</h3>
                <p>
                    If you have questions, concerns, or requests related to your privacy or data handling,
                    you can contact us at:
                </p>
                <p>
                    <strong>Email:</strong> 577581@student.fontys.nl<br>
                    <strong>Institution:</strong> Fontys University of Applied Sciences
                </p>

                <p>We are committed to handling your data with care, transparency, and respect.</p>
            </div>


        </div>
    </div>

</div>

<!-- JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<!-- Vendor JS -->
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/custom-daterange.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
