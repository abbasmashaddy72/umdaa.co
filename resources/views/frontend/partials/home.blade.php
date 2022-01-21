@extends('frontend.frontend-page-master')
@section('og-meta')
    <meta name="title" content="{{ 'UMDAA Health Care' }} - {{ get_static_option('site_tag_line') }}" />
    <meta name="description" content="{{ get_static_option('about_widget_description') }}">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:title" content="{{ 'UMDAA Health Care' }} - {{ get_static_option('site_tag_line') }}" />
    <meta property="og:description" content="{{ get_static_option('about_widget_description') }}" />
    <meta property="og:image" content="{{ url('assets/uploads/media-uploader/thumb-logo.png') }}" />
    <!-- Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="{{ url('/') }}" />
    <meta name="twitter:title" content="{{ 'UMDAA Health Care' }} - {{ get_static_option('site_tag_line') }}" />
    <meta name="twitter:description" content="{{ get_static_option('about_widget_description') }}" />
    <meta name="twitter:image" content="{{ url('assets/uploads/media-uploader/thumb-logo.png') }}" />
@endsection
@section('style')
    @foreach ($all_header_slider as $data)
        @php
            $header_bg_img = get_attachment_image_by_id($data->image, null, false);
        @endphp
        <style>
            #hero {
                color: white;
                background-image: url({{ $header_bg_img['img_url'] }});
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                height: 88vh;
                box-shadow: inset 0 0 0 1000px rgb(0 0 0 / 50%);
            }

        </style>
    @endforeach
    <style>
        .btn-colour-1 {
            color: #fff;
            background-color: #2685f9;
            border-color: #2685f9;
            border-radius: 4px;
            font-weight: bold;
            letter-spacing: 0.05em;
        }

        .btn-colour-1:hover,
        .btn-colour-1:active,
        .btn-colour-1:focus,
        .btn-colour-1.active {
            /* let's darken #004E64 a bit for hover effect */
            background: #111d5c;
            color: #ffffff;
            border-color: #111d5c;
        }

    </style>
@endsection
@section('content')
    <section id="hero" class="d-flex align-items-center jumbotron">
        <div class="container">
            @foreach ($all_header_slider as $data)
                <div class="row">
                    <div class="col-lg-8 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        @if (!empty($data->title))
                            <h1>
                                {{ $data->title }}
                            </h1>
                        @endif
                        @if (!empty($data->description))
                            <h2>
                                {{ $data->description }}
                            </h2>
                        @endif
                        <div class="d-flex">
                            @if (!empty($data->btn_01_status))
                                <a href="{{ $data->btn_01_url }}"
                                    class="btn-get-started scrollto">{{ $data->btn_01_text }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="our-cover-area padding-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h2 class="title">{{ get_static_option('home_page_01_service_area_title') }}</h2>
                        <p>{{ get_static_option('home_page_01_service_area_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($all_service as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="icon-box-two margin-bottom-30">
                            <div class="icon">
                                <i class="{{ $data->icon }}"></i>
                            </div>
                            <div class="content">
                                <h4 class="title">{{ $data->title }}</h4>
                                <p> {{ $data->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @if (count($all_testimonial) > 0)
        <section class="testimonial-area testimonial-bg padding-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="testimonial-carousel">
                            @foreach ($all_testimonial as $data)
                                <div class="single-testimonial-item white">
                                    <div class="icon">
                                        <i class="flaticon-quote"></i>
                                    </div>
                                    <p>{{ $data->testimonial }} </p>
                                    <div class="author-meta">
                                        <h4 class="name">{{ 'Dr.' }} {{ $data->first_name }}
                                            {{ $data->last_name }}</h4>
                                        <span class="designation">{{ $data->qualification }}</span>
                                    </div>
                                    <div class="thumb">
                                        @if (!empty($data->profile_image))
                                            <img src="{{ 'https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image }}"
                                                alt="{{ __($data->first_name) }}" />
                                        @endif
                                        @php
                                            $testimonial_image = get_attachment_image_by_id($data->image, 'full', false);
                                        @endphp
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <div class="aboutus-two-area aboutus-bg padding-50" @php
        $about_us_background_image = get_attachment_image_by_id(get_static_option('home_page_01_about_us_background_image'), null, false);
    @endphp @if (!empty($about_us_background_image)) style="background-image: url({{ $about_us_background_image['img_url'] }})" @endif>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-6">
                    <div class="aboutus-content-block">
                        <h4 class="title">{{ get_static_option('home_page_01_about_us_title') }}</h4>
                        <p>{{ get_static_option('home_page_01_about_us_description') }}</p>
                        @if (get_static_option('home_page_01_about_us_button_status'))
                            <div class="btn-wrapper desktop-left">
                                <a href="{{ get_static_option('home_page_01_about_us_button_url') }}"
                                    class="boxed-btn btn-rounded">{{ get_static_option('home_page_01_about_us_button_title') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="counterup-area counterup-bg padding-top-115 padding-bottom-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="singler-counterup-item-01 white">
                        <div class="icon">
                            <i class="fas fa-user-md" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num">{{ $doc_count }}</span></div>
                            <h4 class="title">{{ 'No. of Doctors' }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="singler-counterup-item-01 white">
                        <div class="icon">
                            <i class="fas fa-university" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num">{{ $dep_count }}</span></div>
                            <h4 class="title">{{ 'No. of Dept.' }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="singler-counterup-item-01 white">
                        <div class="icon">
                            <i class="fas fa-ambulance" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num">{{ $clinic_count }}</span></div>
                            <h4 class="title">{{ 'No. of Clinics' }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="singler-counterup-item-01 white">
                        <div class="icon">
                            <i class="fas fa-diagnoses" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num">{{ $app_count }}</span>{{ '+' }}
                            </div>
                            <h4 class="title">{{ 'No. of Consultations' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="faq-area bg-image padding-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <div class="section-title desktop-left tablet-center mobile-center">
                            <h2 class="title">{{ get_static_option('home_page_01_faq_area_title') }}</h2>
                            <p>{{ get_static_option('home_page_01_faq_area_description') }}</p>
                        </div>
                        <div class="accordion-wrapper">
                            @php $rand_number = rand(9999,99999999); @endphp
                            <div id="accordion_{{ $rand_number }}">
                                @foreach ($all_faq as $key => $data)
                                    @php
                                        $aria_expanded = 'false';
                                        if ($data->is_open == 'on') {
                                            $aria_expanded = 'true';
                                        }
                                    @endphp
                                    <div class="card">
                                        <div class="card-header" id="headingOne_{{ $key }}">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" data-target="#collapseOne_{{ $key }}"
                                                    role="button" aria-expanded="{{ $aria_expanded }}"
                                                    aria-controls="collapseOne_{{ $key }}">
                                                    {{ $data->title }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne_{{ $key }}" class="collapse @if ($data->is_open == 'on') show @endif
                                            "
                                            aria-labelledby="headingOne_{{ $key }}"
                                            data-parent="#accordion_{{ $rand_number }}">
                                            <div class="card-body">
                                                {{ $data->description }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <div class="request-call">
                            <h4 class="title">{{ get_static_option('home_page_01_faq_area_form_title') }}</h4>
                            <p>{{ get_static_option('home_page_01_faq_area_form_description') }}</p>
                            @include('backend.partials.message')
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <form action="{{ route('frontend.call.back.message') }}"
                                class="request-call-form margin-top-60" enctype="multipart/form-data" method="post">
                                @csrf
                                @php
                                    $form_fields = json_decode(get_static_option('call_back_page_form_fields'));
                                    $select_index = 0;
                                    $options = [];
                                @endphp
                                @foreach ($form_fields->field_type as $key => $value)
                                    @if (!empty($value))
                                        @if ($value == 'select') @php $options = explode(';',$form_fields->select_options[$select_index]);@endphp
                                        @endif
                                        @php $required = isset($form_fields->field_required->$key) ? $form_fields->field_required->$key : '' @endphp
                                        @php $mimes = isset($form_fields->mimes_type->$key) ? $form_fields->mimes_type->$key : '' @endphp
                                        {!! get_field_by_type($value, $form_fields->field_name[$key], $form_fields->field_placeholder[$key], $options, $required, $mimes) !!}
                                        @if ($value == 'select') @php $select_index++@endphp
                                        @endif
                                    @endif
                                @endforeach
                                <button type="submit" class="submit-btn white">{{ 'Submit' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-area-one cta-bg-one padding-top-95 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="left-content-area">
                        <h3 class="title">{{ get_static_option('home_page_01_cta_area_title') }}</h3>
                        <p>{{ get_static_option('home_page_01_cta_area_description') }}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-content-area">
                        <div class="btn-wrapper">
                            <a href="{{ get_static_option('home_page_01_cta_area_button_url') }}"
                                class="boxed-btn btn-rounded white">{{ get_static_option('home_page_01_cta_area_button_title') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(".jumbotron").css({
            height: $(window).height() + "px"
        });

        $(window).on("resize", function() {
            $(".jumbotron").css({
                height: $(window).height() + "px"
            });
        });

    </script>
@endsection
