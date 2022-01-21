<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @foreach ($singleDetails as $data)
        <!-- Primary Meta Tags -->
        <title>Dr. {{ $data->first_name }} {{ $data->last_name }} - {{ 'UMDAA Health Care' }}</title>
        <meta name="title" content="Dr. {{ $data->first_name }} {{ $data->last_name }}" />
        <meta name="description" content="{{ $data->about }}">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url"
            content="{{ route('frontend.doctor.website', ['id' => $data->doctor_id, 'any' => Str::slug(str_replace(' ', '', 'Dr.' . $data->first_name . $data->last_name))]) }}" />
        <meta property="og:title" content="Dr. {{ $data->first_name }} {{ $data->last_name }}" />
        <meta property="og:description" content="{{ $data->about }}" />
        <meta property="og:image"
            content="{{ 'https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image }}" />
        <!-- Twitter -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:url"
            content="{{ route('frontend.doctor.website', ['id' => $data->doctor_id, 'any' => Str::slug(str_replace(' ', '', 'Dr.' . $data->first_name . $data->last_name))]) }}" />
        <meta name="twitter:title" content="Dr. {{ $data->first_name }} {{ $data->last_name }}" />
        <meta name="twitter:description" content="{{ $data->about }}" />
        <meta name="twitter:image"
            content="{{ 'https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image }}" />
    @endforeach
    @php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    @endphp
    @if (!empty($site_favicon))
        <link rel="icon" href="{{ $site_favicon['img_url'] }}" type="image/png">
    @endif

    <link rel="preload" href="{{ asset('assets/frontend/website2/vendor/bootstrap/css/bootstrap.min.css') }}"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website2/vendor/bootstrap-icons/bootstrap-icons.css') }}"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website2/vendor/glightbox/css/glightbox.min.css') }}"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website2/vendor/swiper/swiper-bundle.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website2/css/style.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/frontend/website2/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/website2/vendor/bootstrap-icons/bootstrap-icons.css') }}"
            rel="stylesheet">
        <link href="{{ asset('assets/frontend/website2/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/website2/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/frontend/website2/css/style.css') }}" rel="stylesheet">
    </noscript>
    <style>
        .card-blog .card-title {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* number of lines to show */
            -webkit-box-orient: vertical;
        }

        .education-block {
            max-width: 800px;
            margin: 0 auto 30px auto;
            padding: 15px;
            border: 1px solid #dcd9d9;
            text-align: left;
        }

        .education-block h3 {
            font-weight: 500;
            float: left;
            margin: 0;
            color: #374054;
        }

        .education-block span {
            color: #74808a;
            float: right;
            font-weight: bold;
        }

        .education-block h4 {
            color: #74808a;
            clear: both;
            font-weight: 500;
            margin: 0 0 15px 0;
        }

        .education-block p,
        .education-block ul {
            margin: 0;
            color: #74808a;
            font-size: 0.9em;
        }

        .education-block ul {
            padding: 0 0 0 15px;
        }

        @media only screen and (max-width: 768px) {

            .education-block h3,
            .education-block span {
                float: none;
            }
        }

        .socials a {
            color: white;
        }

        .resume .resume-title {
            font-size: 26px;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 20px;
            color: #45505b;
        }

        .resume .resume-item {
            padding: 0 0 20px 20px;
            margin-top: -2px;
            border-left: 2px solid #0563bb;
            position: relative;
        }

        .resume .resume-item h4 {
            line-height: 18px;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            font-family: "Poppins", sans-serif;
            color: #0563bb;
            margin-bottom: 10px;
        }

        .resume .resume-item h5 {
            font-size: 16px;
            background: #f7f8f9;
            padding: 5px 15px;
            display: inline-block;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .resume .resume-item ul {
            padding-left: 20px;
        }

        .resume .resume-item ul li {
            padding-bottom: 10px;
        }

        .resume .resume-item:last-child {
            padding-bottom: 0;
        }

        .resume .resume-item::before {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50px;
            left: -9px;
            top: 0;
            background: #fff;
            border: 2px solid #0563bb;
        }

    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.html">Dr. {{ $data->first_name }} {{ $data->last_name }}</a>
            </h1>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto " href="#work">Work</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto " href="#blog">Blog</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Details</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <div id="hero" class="hero route bg-image" style="background-image: url(../../../../assets/uploads/website/4.png)">
        <div class="overlay-itro"></div>
        <div class="hero-content display-table">
            <div class="table-cell">
                <div class="container">
                    <!--<p class="display-6 color-d">Hello, world!</p>-->
                    <h1 class="hero-title mb-4">I am Dr. {{ $data->first_name }} {{ $data->last_name }}</h1>
                    @if (!empty($Listdocsavedservicess))
                        <p class="hero-subtitle"> Services Offered <span class="typed"
                                data-typed-items="{{ $Listdocsavedservicess }}"></span></p>
                    @else
                        <p class="hero-subtitle"> Services Offered <span class="typed"
                                data-typed-items="{{ $ListdocServices }}"></span></p>
                    @endif
                    <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4"
                            href="{{ '//citizen.umdaa.co/#/bookwebslot/' . $data->doctor_id }}" role="button">Book
                            Appointment</a></p>
                    <div class="socials">
                        <ul>
                            @foreach ($singleDetails as $data)
                                <li>
                                    @if (!empty($data->fb_url))
                                        <a href="{{ $data->fb_url }}" target="_blank" class="ico-circle"
                                            rel="noopener"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                                    @endif
                                </li>
                                <li>
                                    @if (!empty($data->li_url))
                                        <a href="{{ $data->li_url }}" target="_blank" class="ico-circle"
                                            rel="noopener"><i class="bi bi-linkedin" aria-hidden="true"></i></a>
                                    @endif
                                </li>
                                <li>
                                    @if (!empty($data->tw_url))
                                        <a href="{{ $data->tw_url }}" target="_blank" class="ico-circle"
                                            rel="noopener"><i class="bi bi-twitter" aria-hidden="true"></i></a>
                                    @endif
                                </li>
                                <li>
                                    @if (!empty($data->in_url))
                                        <a href="{{ $data->in_url }}" target="_blank" class="ico-circle"
                                            rel="noopener"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                                    @endif
                                </li>
                                <li>
                                    @if (!empty($data->gb_url))
                                        <a href="{{ $data->gb_url }}" target="_blank" class="ico-circle"
                                            rel="noopener"><i class="bi bi-google" aria-hidden="true"></i></a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about-mf sect-pt4 route">
            @foreach ($singleDetails as $data)
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-shadow-full">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="about-img">
                                                @if (!empty($data->profile_image))
                                                    <img src="{{ 'https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image }}"
                                                        alt="{{ __($data->first_name) }}"
                                                        class="img-fluid rounded b-shadow-a" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="about-me pt-4 pt-md-0">
                                            <div class="title-box-2">
                                                <h5 class="title-left">
                                                    About me
                                                </h5>
                                            </div>
                                            <h5>{{ $data->dept }} ( {{ $data->qualification }} )</h5>
                                            <p class="lead">
                                                {{ $data->about }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

        <div id="work" class="background-alt">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box text-center">
                            <h3 class="title-a">
                                Practice Location
                            </h3>
                            <div class="line-mf"></div>
                        </div>
                    </div>
                </div>
                @if (count($docWrk) > 0)
                    @foreach ($docWrk as $data)
                        <div class="education-block work-box">
                            <h3>{{ $data->clinic_name }}</h3>
                            @php
                                $min_from_time = explode(',', $data->from_time);
                                $max_to_time = explode(',', $data->to_time);
                            @endphp
                            <span class="education-date">{{ date('h:i A', strtotime(min($min_from_time))) }} -
                                {{ date('h:i A', strtotime(max($max_to_time))) }}</span>
                            @php
                                $explode = explode(',', $data->working_days);
                                $myArr = [];
                                for ($i = 0; $i < count($explode); $i++) {
                                    if ($explode[$i] == 1) {
                                        array_push($myArr, 'Mon');
                                    } elseif ($explode[$i] == 2) {
                                        array_push($myArr, 'Tue');
                                    } elseif ($explode[$i] == 3) {
                                        array_push($myArr, 'Wed');
                                    } elseif ($explode[$i] == 4) {
                                        array_push($myArr, 'Thu');
                                    } elseif ($explode[$i] == 5) {
                                        array_push($myArr, 'Fri');
                                    } elseif ($explode[$i] == 6) {
                                        array_push($myArr, 'Sat');
                                    } elseif ($explode[$i] == 7) {
                                        array_push($myArr, 'Sun');
                                    }
                                }
                                $implode = implode(', ', $myArr);
                            @endphp
                            <h4>{{ $data->location }}</h4>
                            @if (!empty($data->clinic_phone))
                                <span><a href="tel:{{ $data->clinic_phone }}">{{ $data->clinic_phone }}</a></span>
                            @endif
                            <p>{{ $implode }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-6 mx-auto">
                        <div class="alert alert-warning d-block">{{ __('No Practice Location Found') }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- ======= Services Section ======= -->
        <section id="services" class="services-mf pt-5 route">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box text-center">
                            <h3 class="title-a">
                                Services
                            </h3>
                            <div class="line-mf"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if (!empty($docsavedservicess))
                        @foreach ($docsavedservicess as $data)
                            @if ($data->service_status == 1)
                                <div class="col-md-4">
                                    <div class="service-box">
                                        <div class="service-content">
                                            <a
                                                href="{{ route('frontend.services.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">
                                                <h2 class="s-title">{{ $data->title }}</h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @elseif (count($docServices) > 0)
                        @foreach ($docServices as $data)
                            <div class="col-md-4">
                                <div class="service-box">
                                    <div class="service-content">
                                        <a
                                            href="{{ route('frontend.services.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">
                                            <h2 class="s-title">{{ $data->title }}</h2>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 mx-auto">
                            <div class="alert alert-warning d-block">{{ __('No Services Found') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog-mf sect-pt4 route">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box text-center">
                            <h3 class="title-a">
                                Blog
                            </h3>
                            <div class="line-mf"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if (count($docBlogs) > 0)
                        @foreach ($docBlogs as $data)
                            <div class="col-md-4">
                                @php
                                    $data = (object) $data;
                                @endphp
                                <div class="card card-blog">
                                    <div class="card-img">
                                        @if ($data->article_type == 'video' || $data->article_type == 'Video')
                                            <img class="img-fluid"
                                                src="{{ $data->article_image != '' ? $data->article_image : url('assets/uploads/default/' . $data->dept . '.jpg') }}">
                                        @elseif ($data->article_type == 'pdf')
                                            <img class="img-fluid"
                                                src={{ url('assets/uploads/default/' . $data->dept . '.jpg') }}>
                                        @else
                                            <img class="img-fluid"
                                                src="{{ $data->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $data->posted_url : url('assets/uploads/default/' . $data->dept . '.jpg') }}">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><a
                                                href="{{ route('frontend.blog.single', ['id' => $data->article_id, 'any' => Str::slug($data->article_title)]) }}">{{ $data->article_title }}</a>
                                        </h3>
                                        <p class="card-description">
                                            {{ Illuminate\Support\Str::limit($data->short_description, 150) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-9 mx-auto">
                            <div class="alert alert-warning d-block">{{ __('No Blogs Found') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </section><!-- End Blog Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="paralax-mf footer-paralax bg-image sect-mt4 route"
            style="background-image: url(assets/img/overlay-bg.jpg)">
            <div class="overlay-mf"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="contact-mf resume">
                            <div id="contact" class="box-shadow-full">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="title-box-2">
                                            <h5 class="title-left">
                                                Education
                                            </h5>
                                        </div>
                                        @if (count($docEdu) > 0)
                                            @foreach ($docEdu as $data)
                                                <div class="resume-item">
                                                    <h4>{{ $data->degree }}</h4>
                                                    <h5>{{ $data->edu_timeline }}</h5>
                                                    <p><em>{{ $data->university }}</em></p>
                                                    <p>{{ $data->edu_location_about }}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-warning d-block">
                                                {{ __('No Education Data Found') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="title-box-2 pt-4 pt-md-0">
                                            <h5 class="title-left">
                                                Experience
                                            </h5>
                                        </div>
                                        @if (count($docExp) > 0)
                                            @foreach ($docExp as $data)
                                                <div class="resume-item">
                                                    <h4>{{ $data->exp_designation }}</h4>
                                                    <h5>{{ $data->exp_timeline }}</h5>
                                                    <p>{{ $data->exp_location_about }}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-warning d-block">
                                                {{ __('No Experience Data Found') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="copyright-box">
                        <p class="copyright">
                            @php
                                $footer_text = '{year} {copy} UMDAA Health Care';
                                $footer_text = str_replace('{copy}', '&copy;', $footer_text);
                                $footer_text = str_replace('{year}', date('Y'), $footer_text);
                            @endphp
                            {!! $footer_text !!}
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End  Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/frontend/website1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/typed.js/typed.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/frontend/website1/js/main.js') }}"></script>

</body>

</html>
