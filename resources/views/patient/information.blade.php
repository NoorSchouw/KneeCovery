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

    <!-- *************
		************ CSS Files *************
	  ************* -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- *************
		************ Vendor Css Files *************
	  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

    <!-- Date Range CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/daterange/daterange.css') }}">

    <!-- Uploader CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone/dropzone.min.css') }}">

    <!-- Quill Editor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/quill/quill.core.css') }}">
</head>

<body>

<!-- Page wrapper starts -->
<div class="page-wrapper">

    <!-- Main container starts -->
    <div class="main-container">

        <!-- Sidebar Component -->
        <x-sidebar-patient/>

        <!-- App container starts -->
        <div class="app-container">

            <!-- Header Component -->
            <x-header/>

            <!-- App hero header starts -->
            <div class="app-hero-header d-flex align-items-center">

                <!-- Breadcrumb starts -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/homepage">
                            <i class="ri-home-3-line"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-primary" aria-current="page">
                        Personal Information
                    </li>
                </ol>
                <!-- Breadcrumb ends -->

            </div>
            <!-- App Hero header ends -->

            <!-- App body starts -->
            <div class="app-body">

                <!-- Row starts -->
                <div class="row gx-4">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- Custom tabs starts -->
                                <div class="custom-tabs-container">

                                    <!-- Nav tabs starts -->
                                    <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                               aria-controls="oneA" aria-selected="true"><i class="ri-briefcase-4-line"></i> Personal
                                                Details</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab-fourA" data-bs-toggle="tab" href="#fourA" role="tab"
                                               aria-controls="fourA" aria-selected="false"><i class="ri-lock-password-line"></i> Account
                                                Details</a>
                                        </li>
                                    </ul>
                                    <!-- Nav tabs ends -->

                                    <!-- Tab content starts -->
                                    <div class="tab-content h-350">
                                        <div class="tab-pane fade show active" id="oneA" role="tabpanel">

                                            <!-- Row starts -->
                                            <div class="row gx-4">
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a1">First Name <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-account-circle-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a1" placeholder="Enter First Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a2">Last Name <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-account-circle-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a2" placeholder="Enter Last Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a3">Age <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-flower-line"></i>
                                  </span>
                                                            <select class="form-select" id="a3">
                                                                <option value="0">Select Age</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                                <option value="26">26</option>
                                                                <option value="27">27</option>
                                                                <option value="28">28</option>
                                                                <option value="29">29</option>
                                                                <option value="30">30</option>
                                                                <option value="31">31</option>
                                                                <option value="32">32</option>
                                                                <option value="33">33</option>
                                                                <option value="34">34</option>
                                                                <option value="35">35</option>
                                                                <option value="36">36</option>
                                                                <option value="37">37</option>
                                                                <option value="38">38</option>
                                                                <option value="39">39</option>
                                                                <option value="40">40</option>
                                                                <option value="41">41</option>
                                                                <option value="42">42</option>
                                                                <option value="43">43</option>
                                                                <option value="44">44</option>
                                                                <option value="45">45</option>
                                                                <option value="46">46</option>
                                                                <option value="47">47</option>
                                                                <option value="48">48</option>
                                                                <option value="49">49</option>
                                                                <option value="50">50</option>
                                                                <option value="51">51</option>
                                                                <option value="52">52</option>
                                                                <option value="53">53</option>
                                                                <option value="54">54</option>
                                                                <option value="55">55</option>
                                                                <option value="56">56</option>
                                                                <option value="57">57</option>
                                                                <option value="58">58</option>
                                                                <option value="59">59</option>
                                                                <option value="60">60</option>
                                                                <option value="61">61</option>
                                                                <option value="62">62</option>
                                                                <option value="63">63</option>
                                                                <option value="64">64</option>
                                                                <option value="65">65</option>
                                                                <option value="66">66</option>
                                                                <option value="67">67</option>
                                                                <option value="68">68</option>
                                                                <option value="69">69</option>
                                                                <option value="70">70</option>
                                                                <option value="71">71</option>
                                                                <option value="72">72</option>
                                                                <option value="73">73</option>
                                                                <option value="74">74</option>
                                                                <option value="75">75</option>
                                                                <option value="76">76</option>
                                                                <option value="77">77</option>
                                                                <option value="78">78</option>
                                                                <option value="79">79</option>
                                                                <option value="80">80</option>
                                                                <option value="81">81</option>
                                                                <option value="82">82</option>
                                                                <option value="83">83</option>
                                                                <option value="84">84</option>
                                                                <option value="85">85</option>
                                                                <option value="86">86</option>
                                                                <option value="87">87</option>
                                                                <option value="88">88</option>
                                                                <option value="89">89</option>
                                                                <option value="90">90</option>
                                                                <option value="91">91</option>
                                                                <option value="92">92</option>
                                                                <option value="93">93</option>
                                                                <option value="94">94</option>
                                                                <option value="95">95</option>
                                                                <option value="96">96</option>
                                                                <option value="97">97</option>
                                                                <option value="98">98</option>
                                                                <option value="99">99</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="selectGender1">Gender<span
                                                                class="text-danger">*</span></label>
                                                        <div class="m-0">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="selectGenderOptions"
                                                                       id="selectGender1" value="male">
                                                                <label class="form-check-label" for="selectGender1">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="selectGenderOptions"
                                                                       id="selectGender2" value="female">
                                                                <label class="form-check-label" for="selectGender2">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a5">Email ID <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-mail-open-line"></i>
                                  </span>
                                                            <input type="email" class="form-control" id="a5" placeholder="Enter Email ID">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a6">Mobile Number <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-phone-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a6" placeholder="Enter Mobile Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a7">Injured Knee <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                      <img src="{{ asset('assets/images/icons/knee2.png') }}"
                                           alt="Injured Knee"
                                           width="14.4"
                                           height="14.4">

                                  </span>
                                                            <select class="form-select" id="a7">
                                                                <option value="0">Select</option>
                                                                <option value="1">Left Knee</option>
                                                                <option value="2">Right Knee</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a11">Address <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-projector-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a11" placeholder="Enter Address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a12">Country <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-flag-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a14" placeholder="Enter Country">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a14">City <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-scan-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a14" placeholder="Enter City">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="a15">Postal Code <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-qr-scan-line"></i>
                                  </span>
                                                            <input type="text" class="form-control" id="a15" placeholder="Enter Postal Code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row ends -->

                                        </div>
                                        <div class="tab-pane fade" id="twoA" role="tabpanel">

                                            <!-- Row starts -->
                                            <div class="row gx-4">
                                                <div class="col-sm-2">
                                                    <div id="dropzone" class="mb-3">
                                                        <label class="form-label">Upload Profile</label>
                                                        <form action="/upload" class="dropzone dz-clickable" id="demo-upload">
                                                            <div class="dz-message">
                                                                <button type="button" class="dz-button">
                                                                    Click here to upload your photo.</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="form-label">Write Bio</label>
                                                    <div id="fullEditor">
                                                        <h1>Hello,</h1>
                                                        <br>
                                                        <p>My name is <strong>Dr. David Kemrin</strong>. Write your bio here.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row ends -->

                                        </div>
                                        <div class="tab-pane fade" id="threeA" role="tabpanel">

                                            <!-- Row starts -->
                                            <div class="row gx-4">
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="d1">Sunday</label>
                                                        <div class="input-group">
                                                            <select class="form-select" id="d1">
                                                                <option value="0">From</option>
                                                                <option value="1">7AM</option>
                                                                <option value="2">8AM</option>
                                                                <option value="3">9AM</option>
                                                            </select>
                                                            <select class="form-select" id="d1X">
                                                                <option value="0">To</option>
                                                                <option value="1">3PM</option>
                                                                <option value="2">4PM</option>
                                                                <option value="3">5PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="d2">Monday</label>
                                                        <div class="input-group">
                                                            <select class="form-select" id="d2">
                                                                <option value="0">From</option>
                                                                <option value="1">7AM</option>
                                                                <option value="2">8AM</option>
                                                                <option value="3">9AM</option>
                                                            </select>
                                                            <select class="form-select" id="d2X">
                                                                <option value="0">To</option>
                                                                <option value="1">3PM</option>
                                                                <option value="2">4PM</option>
                                                                <option value="3">5PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="d3">Tuesday</label>
                                                        <div class="input-group">
                                                            <select class="form-select" id="d3">
                                                                <option value="0">From</option>
                                                                <option value="1">7AM</option>
                                                                <option value="2">8AM</option>
                                                                <option value="3">9AM</option>
                                                            </select>
                                                            <select class="form-select" id="d3X">
                                                                <option value="0">To</option>
                                                                <option value="1">3PM</option>
                                                                <option value="2">4PM</option>
                                                                <option value="3">5PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="d4">Wednesday</label>
                                                        <div class="input-group">
                                                            <select class="form-select" id="d4">
                                                                <option value="0">From</option>
                                                                <option value="1">7AM</option>
                                                                <option value="2">8AM</option>
                                                                <option value="3">9AM</option>
                                                            </select>
                                                            <select class="form-select" id="d4X">
                                                                <option value="0">To</option>
                                                                <option value="1">3PM</option>
                                                                <option value="2">4PM</option>
                                                                <option value="3">5PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="d5">Thursday</label>
                                                        <div class="input-group">
                                                            <select class="form-select" id="d5">
                                                                <option value="0">From</option>
                                                                <option value="1">7AM</option>
                                                                <option value="2">8AM</option>
                                                                <option value="3">9AM</option>
                                                            </select>
                                                            <select class="form-select" id="d5X">
                                                                <option value="0">To</option>
                                                                <option value="1">3PM</option>
                                                                <option value="2">4PM</option>
                                                                <option value="3">5PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="d6">Friday</label>
                                                        <div class="input-group">
                                                            <select class="form-select" id="d6">
                                                                <option value="0">From</option>
                                                                <option value="1">7AM</option>
                                                                <option value="2">8AM</option>
                                                                <option value="3">9AM</option>
                                                            </select>
                                                            <select class="form-select" id="d6X">
                                                                <option value="0">To</option>
                                                                <option value="1">3PM</option>
                                                                <option value="2">4PM</option>
                                                                <option value="3">5PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="d7">Saturday</label>
                                                        <div class="input-group">
                                                            <select class="form-select" id="d7">
                                                                <option value="0">From</option>
                                                                <option value="1">7AM</option>
                                                                <option value="2">8AM</option>
                                                                <option value="3">9AM</option>
                                                            </select>
                                                            <select class="form-select" id="d7X">
                                                                <option value="0">To</option>
                                                                <option value="1">3PM</option>
                                                                <option value="2">4PM</option>
                                                                <option value="3">5PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row ends -->

                                        </div>
                                        <div class="tab-pane fade" id="fourA" role="tabpanel">

                                            <!-- Row starts -->
                                            <div class="row gx-4 justify-content-center">
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="u1">User Name</label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-account-pin-circle-line"></i>
                                  </span>
                                                            <input type="text" id="u1" placeholder="Enter username" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="u2">Password</label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-lock-password-line"></i>
                                  </span>
                                                            <input type="password" id="u2" class="form-control" placeholder="New Password">
                                                            <button class="btn btn-outline-secondary" type="button">
                                                                <i class="ri-eye-line"></i>
                                                            </button>
                                                        </div>
                                                        <div class="form-text">
                                                            Your password must be 8-20 characters long, contain letters and numbers, and must not
                                                            contain spaces, special characters.
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="u3">Confirm Password</label>
                                                        <div class="input-group">
                                  <span class="input-group-text">
                                    <i class="ri-lock-password-line"></i>
                                  </span>
                                                            <input type="password" id="u3" placeholder="Confirm new password"
                                                                   class="form-control">
                                                            <button class="btn btn-outline-secondary" type="button">
                                                                <i class="ri-eye-off-line"></i>
                                                            </button>
                                                        </div>
                                                        <div class="form-text">
                                                            Your password must be 8-20 characters long, contain letters and numbers, and must not
                                                            contain spaces, special characters.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row ends -->

                                        </div>
                                    </div>
                                    <!-- Tab content ends -->

                                </div>
                                <!-- Custom tabs ends -->

                                <!-- Card actions starts -->
                                <div class="d-flex gap-2 justify-content-end mt-4">
                                    <a href="#" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                    <a href="#" class="btn btn-primary">
                                        Save
                                    </a>
                                </div>
                                <!-- Card actions ends -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row ends -->

            </div>
            <!-- App body ends -->

        </div>
        <!-- App container ends -->

    </div>
    <!-- Main container ends -->

</div>
<!-- Page wrapper ends -->

<!-- *************
        ************ JavaScript Files *************
    ************* -->
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<!-- *************
        ************ Vendor Js Files *************
    ************* -->

<!-- Overlay Scroll JS -->
<script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

<!-- Date Range JS -->
<script src="{{ asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ asset('assets/vendor/daterange/custom-daterange.js') }}"></script>

<!-- Dropzone JS -->
<script src="{{ asset('assets/vendor/dropzone/dropzone.min.js') }}"></script>

<!-- Quill Editor JS -->
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/custom.js') }}"></script>

<!-- Custom JS files -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
