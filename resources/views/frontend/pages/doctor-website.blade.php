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
    <!-- all stylesheets -->
    <link rel="preload" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/web-style.css?version=2.2') }}">
    <link rel="preload" href="{{ asset('assets/frontend/css/fontawesome.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload"
        href="{{ asset('https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/web-style.css?version=2.2') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap">
    </noscript>
</head>

<body>
    <div id="mobile-menu-open" class="shadow-large">
        <i class="fas fa-bars" aria-hidden="true"></i>
    </div>
    <!-- End #mobile-menu-toggle -->
    <header>
        <div id="mobile-menu-close">
            <span>Close</span> <i class="fas fa-times" aria-hidden="true"></i>
        </div>
        <ul id="menu" class="shadow">
            <li>
                <a href="#work">Practice Details</a>
            </li>
            <li>
                <a href="#experience">Experience</a>
            </li>
            <li>
                <a href="#education">Education</a>
            </li>
            <li>
                <a href="#projects">Blogs</a>
            </li>
            <li>
                <a href="#skills">Services</a>
            </li>
        </ul>
    </header>
    <!-- End header -->
    @foreach ($singleDetails as $data)
        <div class="container">
            <div id="lead" class="row justify-content-center">
                <div id="lead-content" class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-5">
                            <div id="margin" class="class">
                                @if (!empty($data->profile_image))
                                    <img src="{{ 'https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image }}"
                                        alt="{{ __($data->first_name) }}" class="rounded bg-light" />
                                @endif
                                @if (!empty($data->doctor_id))
                                    <a href="{{ '//citizen.umdaa.co/#/bookwebslot/' . $data->doctor_id }}"
                                        class="btn-rounded-white">Book Appointment</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-7 h-100">
                            <h2 class="display-3">Dr. {{ $data->first_name }} {{ $data->last_name }}</h2>
                            <h3 class="display-3">{{ $data->dept }} ( {{ $data->qualification }} )</h3>
                            <p>{{ $data->about }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div id="work" class="background-alt">
        <h2 class="heading">Practice Location</h2>
        @if (count($docWrk) > 0)
            @foreach ($docWrk as $data)
                <div class="education-block">
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
            <div class="mx-auto col-lg-6">
                <div class="alert alert-warning d-block">{{ __('No Practice Location Found') }}</div>
            </div>
        @endif
    </div>
    <!-- End #work -->
    <div id="experience">
        <h2 class="heading">Experience</h2>
        @if (count($docExp) > 0)
            <div id="experience-timeline">
                @foreach ($docExp as $data)
                    <div data-date="{{ $data->exp_timeline }}">
                        <h3>{{ $data->exp_designation }}</h3>
                        <p>{{ $data->exp_location_about }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="mx-auto col-lg-6">
                <div class="alert alert-warning d-block">{{ __('No Experience Data Found') }}</div>
            </div>
        @endif
    </div>
    <!-- End #experience -->
    <div id="education" class="background-alt">
        <h2 class="heading">Education</h2>
        @if (count($docEdu) > 0)
            @foreach ($docEdu as $data)
                <div class="education-block">
                    <h3>{{ $data->university }}</h3>
                    <span class="education-date">{{ $data->edu_timeline }}</span>
                    <h4>{{ $data->degree }}</h4>
                    <p>{{ $data->edu_location_about }}</p>
                </div>
            @endforeach
        @else
            <div class="mx-auto col-lg-6">
                <div class="alert alert-warning d-block">{{ __('No Education Data Found') }}</div>
            </div>
        @endif
    </div>
    <!-- End #education -->
    <div id="projects">
        <h2 class="heading">Blogs</h2>
        <div class="container">
            @if (count($docBlogs) > 0)
                @foreach ($docBlogs as $data)
                    @php
                        $data = (object) $data;
                    @endphp
                    <div class="row no-gutters project shadow-large">
                        <div class="project-image">
                            @if ($data->article_type == 'video' || $data->article_type == 'Video')
                                <img
                                    src="{{ $data->article_image != '' ? $data->article_image : url('assets/uploads/default/' . $data->dept . '.jpg') }}">
                            @elseif ($data->article_type == 'pdf')
                                <img src={{ url('assets/uploads/default/' . $data->dept . '.jpg') }}>
                            @else
                                <img
                                    src="{{ $data->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $data->posted_url : url('assets/uploads/default/' . $data->dept . '.jpg') }}">
                            @endif
                        </div>
                        <!-- End .project-image -->
                        <div class="project-info">
                            <h3>{{ $data->article_title }}</h3>
                            <p>{{ Illuminate\Support\Str::limit($data->short_description, 150) }}</p>
                            <a
                                href="{{ route('frontend.blog.single', ['id' => $data->article_id, 'any' => Str::slug($data->article_title)]) }}">View
                                Blog</a>
                        </div>
                        <!-- End .project-info -->
                    </div>
                @endforeach
            @else
                <div class="mx-auto col-lg-9">
                    <div class="alert alert-warning d-block">{{ __('No Blogs Found') }}</div>
                </div>
            @endif
        </div>
    </div>
    <!-- End #projects -->
    <div id="skills" class="background-alt">
        <h2 class="heading">Services</h2>
        <ul>
            @if (!empty($docsavedservicess))
                @foreach ($docsavedservicess as $data)
                    @if ($data->service_status == 1)
                        <li><a
                                href="{{ route('frontend.services.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">{{ $data->title }}</a>
                        </li>
                    @endif
                @endforeach
            @elseif (count($docServices) > 0)
                @foreach ($docServices as $data)
                    <li><a
                            href="{{ route('frontend.services.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">{{ $data->title }}</a>
                    </li>
                @endforeach
            @else
                <div class="mx-auto col-lg-12">
                    <div class="alert alert-warning d-block">{{ __('No Services Found') }}</div>
                </div>
            @endif
        </ul>
    </div>
    <!-- End #skills -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-5 copyright">
                    <p>
                        @php
                            $footer_text = '{year} {copy} UMDAA Health Care';
                            $footer_text = str_replace('{copy}', '&copy;', $footer_text);
                            $footer_text = str_replace('{year}', date('Y'), $footer_text);
                        @endphp
                        {!! $footer_text !!}
                    </p>
                </div>
                <div class="col-sm-2 top">
                    <span id="to-top">
                        <i class="fas fa-chevron-up" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="col-sm-5 social">
                    <ul>
                        @foreach ($singleDetails as $data)
                            <li>
                                @if (!empty($data->fb_url))
                                    <a href="{{ $data->fb_url }}" target="_blank" rel="noopener"><i
                                            class="fab fa-facebook" aria-hidden="true"></i></a>
                                @endif
                            </li>
                            <li>
                                @if (!empty($data->li_url))
                                    <a href="{{ $data->li_url }}" target="_blank" rel="noopener"><i
                                            class="fab fa-linkedin" aria-hidden="true"></i></a>
                                @endif
                            </li>
                            <li>
                                @if (!empty($data->tw_url))
                                    <a href="{{ $data->tw_url }}" target="_blank" rel="noopener"><i
                                            class="fab fa-twitter" aria-hidden="true"></i></a>
                                @endif
                            </li>
                            <li>
                                @if (!empty($data->in_url))
                                    <a href="{{ $data->in_url }}" target="_blank" rel="noopener"><i
                                            class="fab fa-instagram" aria-hidden="true"></i></a>
                                @endif
                            </li>
                            <li>
                                @if (!empty($data->gb_url))
                                    <a href="{{ $data->gb_url }}" target="_blank" rel="noopener"><i
                                            class="fab fa-google" aria-hidden="true"></i></a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('assets/frontend/js/web-js.js') }}"></script>
</body>

</html>
