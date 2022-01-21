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
        <meta property="og:image" content="{{ 'https://clinic.umdaa.co/uploads/doctors' . $data->profile_image }}" />
        <!-- Twitter -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:url"
            content="{{ route('frontend.doctor.website', ['id' => $data->doctor_id, 'any' => Str::slug(str_replace(' ', '', 'Dr.' . $data->first_name . $data->last_name))]) }}" />
        <meta name="twitter:title" content="Dr. {{ $data->first_name }} {{ $data->last_name }}" />
        <meta name="twitter:description" content="{{ $data->about }}" />
        <meta name="twitter:image"
            content="{{ 'https://clinic.umdaa.co/uploads/doctors' . $data->profile_image }}" />
    @endforeach
    @php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    @endphp
    @if (!empty($site_favicon))
        <link rel="icon" href="{{ $site_favicon['img_url'] }}" type="image/png">
    @endif

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"
        rel="stylesheet">
    <link rel="preload" href="{{ asset('assets/frontend/website1/vendor/aos/aos.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website1/vendor/bootstrap/css/bootstrap.min.css') }}"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website1/vendor/bootstrap-icons/bootstrap-icons.css') }}"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website1/vendor/boxicons/css/boxicons.min.css') }}"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website1/vendor/glightbox/css/glightbox.min.css') }}"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website1/vendor/swiper/swiper-bundle.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/frontend/website1/css/style.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"
            rel="stylesheet">
        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/frontend/website1/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/website1/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/website1/vendor/bootstrap-icons/bootstrap-icons.css') }}"
            rel="stylesheet">
        <link href="{{ asset('assets/frontend/website1/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/website1/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/website1/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/frontend/website1/css/style.css') }}" rel="stylesheet">
    </noscript>
    <style>
        .banner-img img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        div.footer {
            text-align: center;
            position: relative;
            margin: 5px;
        }

        .card {
            padding: 10px;
        }

        .card1 {
            display: block;
            position: relative;
            background-color: #f5f8fd;
            border-radius: 4px;
            padding: 5px;
            text-decoration: none;
            z-index: 0;
            overflow: hidden;
            max-width: 355px;
            margin: 5px;
        }

        .card1:before {
            content: "";
            position: absolute;
            z-index: -1;
            top: -16px;
            right: -16px;
            background: #00838d;
            height: 32px;
            width: 35px;
            border-radius: 32px;
            transform: scale(1);
            transform-origin: 50% 50%;
            transition: transform 0.25s ease-out;
        }

        #work .card1:before {
            content: "";
            position: absolute;
            z-index: -1;
            top: -16px;
            right: -16px;
            background: #00838d;
            height: 32px;
            width: 80px;
            border-radius: 32px;
            transform: scale(1);
            transform-origin: 50% 50%;
            transition: transform 0.25s ease-out;
        }

        b,
        strong {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 5px;
        }

        .card1:hover:before {
            transform: scale(21);
        }

        #work .card1:hover:before {
            transform: scale(21);
        }

        .card1:hover p {
            transition: all 0.3s ease-out;
            color: rgba(255, 255, 255, 0.8);
        }

        .card1:hover h4 {
            transition: all 0.3s ease-out;
            color: rgba(255, 255, 255, 0.8);
        }

        .card1:hover h3 {
            transition: all 0.3s ease-out;
            color: white;
        }

        .card1:hover span {
            transition: all 0.3s ease-out;
            color: rgba(255, 255, 255, 0.8);
        }

        .card1:hover span a {
            transition: all 0.3s ease-out;
            color: rgba(255, 255, 255, 0.8);
        }

        .card1 span a {
            transition: all 0.3s ease-out;
            color: #123456;
            font-weight: bold;
        }

        .card1:hover h5 a {
            transition: all 0.3s ease-out;
            color: #ffffff;
        }

        .services .title a {
            color: #173b6c;
        }

        .services .title {
            font-weight: 700;
            font-size: 18px;
            margin-top: .5rem;
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

    </style>
</head>

<body>
    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex flex-column justify-content-center">

        <nav id="navbar" class="navbar nav-menu">
            <ul>
                <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a>
                </li>
                <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a></li>
                <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i>
                        <span>Details</span></a>
                </li>
                <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i>
                        <span>Blog</span></a></li>
                <li><a href="#work" class="nav-link scrollto"><i class='bx bx-current-location'></i> <span>Practice
                            Loction</span></a>
                </li>
                <li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i>
                        <span>Services</span></a>
                </li>
            </ul>
        </nav>

    </header>

    <!-- ======= Hero Section ======= -->
    @foreach ($singleDetails as $data)
        <section id="hero" class="d-flex flex-column justify-content-center">
            <div class="container" data-aos="zoom-in" data-aos-delay="100">
                <h1>Dr. {{ $data->first_name }} {{ $data->last_name }}</h1>
                @if (!empty($Listdocsavedservicess))
                    <p> Services Offered <span class="typed"
                            data-typed-items="{{ $Listdocsavedservicess }}"></span>
                    </p>
                @else
                    <p> Services Offered <span class="typed"
                            data-typed-items="{{ $ListdocServices }}"></span></p>
                @endif
                @if (!empty($data->doctor_id))
                    <a href="{{ '//citizen.umdaa.co/#/bookwebslot/' . $data->doctor_id }}"
                        class="btn btn-primary">Book Appointment</a>
                @endif
                <div class="social-links">
                    @foreach ($singleDetails as $data)
                        @if (!empty($data->fb_url))
                            <a href="{{ $data->fb_url }}" target="_blank" rel="noopener">
                                <i class="bx bxl-facebook" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if (!empty($data->li_url))
                            <a href="{{ $data->li_url }}" target="_blank" rel="noopener">
                                <i class="bx bxl-linkedin" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if (!empty($data->tw_url))
                            <a href="{{ $data->tw_url }}" target="_blank" rel="noopener">
                                <i class="bx bxl-twitter" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if (!empty($data->in_url))
                            <a href="{{ $data->in_url }}" target="_blank" rel="noopener">
                                <i class="bx bxl-instagram" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if (!empty($data->gb_url))
                            <a href="{{ $data->gb_url }}" target="_blank" rel="noopener">
                                <i class="bx bxl-google" aria-hidden="true"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            @foreach ($singleDetails as $data)
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>About</h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            @if (!empty($data->profile_image))
                                <img src="{{ 'https://clinic.umdaa.co/uploads/doctors' . $data->profile_image }}"
                                    alt="{{ __($data->first_name) }}" class="img-fluid" />
                            @endif
                        </div>
                        <div class="col-lg-8 pt-4 pt-lg-0 content">
                            <h3>{{ $data->dept }} ( {{ $data->qualification }} )</h3>
                            <p class="fst-italic">
                                {{ $data->about }}
                            </p>
                        </div>
                    </div>

                </div>
            @endforeach
        </section>

        <!-- ======= Resume Section ======= -->
        <section id="resume" class="resume">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="resume-title">Education</h3>
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
                            <div class="alert alert-warning d-block">{{ __('No Education Data Found') }}</div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <h3 class="resume-title">Professional Experience</h3>
                        @if (count($docExp) > 0)
                            @foreach ($docExp as $data)
                                <div class="resume-item">
                                    <h4>{{ $data->exp_designation }}</h4>
                                    <h5>{{ $data->exp_timeline }}</h5>
                                    <p>{{ $data->exp_location_about }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning d-block">{{ __('No Experience Data Found') }}</div>
                        @endif
                    </div>
                </div>

            </div>
        </section>

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Blogs</h2>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        @if (count($docBlogs) > 0)
                            @foreach ($docBlogs as $data)
                                @php
                                    $data = (object) $data;
                                @endphp
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="tile">
                                        <div class="card wrapper section-bg">
                                            <h6 class="header"><b>{{ $data->article_title }}</b></h6>

                                            <div class="banner-img">
                                                @if ($data->article_type == 'video' || $data->article_type == 'Video')
                                                    <img
                                                        src="{{ $data->article_image != '' ? $data->article_image : url('assets/uploads/default/' . $data->dept . '.jpg') }}">
                                                @elseif ($data->article_type == 'pdf')
                                                    <img
                                                        src={{ url('assets/uploads/default/' . $data->dept . '.jpg') }}>
                                                @else
                                                    <img
                                                        src="{{ $data->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $data->posted_url : url('assets/uploads/default/' . $data->dept . '.jpg') }}">
                                                @endif
                                            </div>

                                            <p>{{ Illuminate\Support\Str::limit($data->short_description, 150) }}</p>

                                            <div class="footer">
                                                <a href="{{ route('frontend.blog.single', ['id' => $data->article_id, 'any' => Str::slug($data->article_title)]) }}"
                                                    class="btn btn-primary">View</a>
                                            </div>
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

            </div>
        </section>

        <div id="work" class="background-alt">
            <div class="section-title">
                <h2>Practice Location</h2>
            </div>
            @if (count($docWrk) > 0)
                @foreach ($docWrk as $data)
                    <div class="education-block card1">
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

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Services</h2>
                </div>

                <div class="row m-1">
                    @php
                        $delay_count = 0;
                    @endphp

                    @if (!empty($docsavedservicess))
                        @foreach ($docsavedservicess as $data)
                            @if ($data->service_status == 1)
                                <div class="col-lg-4 col-md-6 card1" data-aos="fade-up"
                                    data-aos-delay=" {{ $delay_count * 300 }}">
                                    <h5 class="title"><a
                                            href="{{ route('frontend.services.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">{{ $data->title }}</a>
                                    </h5>
                                </div>
                            @endif
                            @php
                                $delay_count++;
                            @endphp
                        @endforeach
                    @elseif (count($docServices) > 0)
                        @foreach ($docServices as $data)
                            <div class="col-lg-4 col-md-6 card1" data-aos="fade-up"
                                data-aos-delay=" {{ $delay_count * 300 }}">
                                <h5 class="title"><a
                                        href="{{ route('frontend.services.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">{{ $data->title }}</a>
                                </h5>
                            </div>
                            @php
                                $delay_count++;
                            @endphp
                        @endforeach
                    @else
                        <div class="col-lg-12 mx-auto">
                            <div class="alert alert-warning d-block">{{ __('No Services Found') }}</div>
                        </div>
                    @endif
                </div>

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="social-links">
                @foreach ($singleDetails as $data)
                    @if (!empty($data->fb_url))
                        <a href="{{ $data->fb_url }}" target="_blank" rel="noopener">
                            <i class="bx bxl-facebook" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if (!empty($data->li_url))
                        <a href="{{ $data->li_url }}" target="_blank" rel="noopener">
                            <i class="bx bxl-linkedin" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if (!empty($data->tw_url))
                        <a href="{{ $data->tw_url }}" target="_blank" rel="noopener">
                            <i class="bx bxl-twitter" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if (!empty($data->in_url))
                        <a href="{{ $data->in_url }}" target="_blank" rel="noopener">
                            <i class="bx bxl-instagram" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if (!empty($data->gb_url))
                        <a href="{{ $data->gb_url }}" target="_blank" rel="noopener">
                            <i class="bx bxl-google" aria-hidden="true"></i>
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="copyright">
                @php
                    $footer_text = '{year} {copy} UMDAA Health Care';
                    $footer_text = str_replace('{copy}', '&copy;', $footer_text);
                    $footer_text = str_replace('{year}', date('Y'), $footer_text);
                @endphp
                {!! $footer_text !!}
            </div>
        </div>
    </footer>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/frontend/website1/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/typed.js/typed.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/website1/vendor/waypoints/noframework.waypoints.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/frontend/website1/js/main.js') }}"></script>

</body>

</html>
