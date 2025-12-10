<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
</head>

<body>
<div class="page-wrapper">

    <div class="main-container">

        <!-- Sidebar for patient -->
        <x-sidebar-patient/>

        <div class="app-container">

            <x-header/>

            <!-- Hero header -->
            <div class="app-hero-header d-flex justify-content-between align-items-center">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/homepage') }}"><i class="ri-home-3-line"></i></a>
                    </li>
                    <li class="breadcrumb-item text-primary">Contact</li>
                </ol>
            </div>

            <!-- MAIN BODY -->
            <div class="app-body p-4">

                <!-- Patient title -->
                <div class="mb-3">
                    <h2 class="patient-name">Contact</h2>
                </div>


                <div class="container mt-4">
                    <div class="row g-4 d-flex align-items-start">

                        <!-- Links: Google Maps -->
                        <div class="col-lg-6">
                            <div class="card contact-map h-100 p-0">
                                <div class="map-container">
                                    <iframe
                                        loading="lazy"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2484.998163439439!2d5.483744976541032!3d51.47654801295681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6df0058aed4d9%3A0xe072c671dd3f2d72!2sBasis%20Fysiotherapie!5e0!3m2!1snl!2snl!4v1765394521702!5m2!1snl!2snl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                        title="Basis Fysiotherapie"
                                        style="border:0; width:100%; height:100%; min-height:300px;">
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <!-- Rechts: Contactgegevens -->
                        <div class="col-lg-6">
                            <div class="card contact-info h-100 p-4">

                                <!-- Adres -->
                                <div class="contact-card-item mb-3">
                                    <div class="contact-card-icon"><i class="ri-map-pin-line"></i></div>
                                    <div class="contact-card-content">
                                        <h4 class="contact-card-title mb-0">Address</h4>
                                        <p class="contact-card-text mb-0">Ukkelstraat 12</p>
                                        <p class="contact-card-sub mb-0">5628 TE Eindhoven</p>
                                    </div>
                                </div>

                                <!-- E-mail -->
                                <div class="contact-card-item mb-3">
                                    <div class="contact-card-icon"><i class="ri-mail-line"></i></div>
                                    <div class="contact-card-content">
                                        <h4 class="contact-card-title mb-0">Email</h4>
                                        <a href="mailto:info@basisfysiotherapie.nl" class="contact-card-text">info@basisfysiotherapie.nl</a>
                                    </div>
                                </div>

                                <!-- Telefoon -->
                                <div class="contact-card-item mb-3">
                                    <div class="contact-card-icon"><i class="ri-phone-line"></i></div>
                                    <div class="contact-card-content">
                                        <h4 class="contact-card-title mb-0">Phone number</h4>
                                        <a href="tel:0402025087" class="contact-card-text">040 – 202 50 87</a>
                                    </div>
                                </div>

                                <!-- Openingstijden -->
                                <div class="contact-card-item">
                                    <div class="contact-card-icon"><i class="ri-time-line"></i></div>
                                    <div class="contact-card-content">
                                        <h4 class="contact-card-title mb-2">Opening hours</h4>

                                        <div class="hours-row"><span class="day">Monday:</span> <span class="hours">08:00 – 20:00</span></div>
                                        <div class="hours-row"><span class="day">Tuesday:</span> <span class="hours">08:00 – 19:00</span></div>
                                        <div class="hours-row"><span class="day">Wednesday:</span> <span class="hours">08:00 – 17:00</span></div>
                                        <div class="hours-row"><span class="day">Thursday:</span> <span class="hours">08:00 – 19:00</span></div>
                                        <div class="hours-row"><span class="day">Friday:</span> <span class="hours">08:00 – 17:00</span></div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>



            </div><!-- /app-body -->

        </div><!-- /app-container -->

    </div><!-- /main-container -->

</div><!-- /page-wrapper -->

<!-- JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>

<!-- Your logic -->
<script src="{{ asset('assets/js/Fysio.js') }}"></script>

</body>
</html>
