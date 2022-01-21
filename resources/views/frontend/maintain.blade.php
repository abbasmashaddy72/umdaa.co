<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ get_static_option('site_meta_description') }}">
    <meta name="tags" content="{{ get_static_option('site_meta_tags') }}">

    @php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    @endphp
    @if (!empty($site_favicon))
        <link rel="icon" href="{{ $site_favicon['img_url'] }}" type="image/png">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dynamic-style.css') }}">
    <style>
        .maintenance-page-content-area {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 0;
            background-size: cover;
            background-position: center;
        }

        .maintenance-page-content-area:after {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: -1;
            content: '';
        }

        .page-content-wrap {
            text-align: center;
        }

        .page-content-wrap .logo-wrap {
            margin-bottom: 30px;
        }

        .page-content-wrap .maintain-title {
            font-size: 45px;
            font-weight: 700;
            color: #fff;
            line-height: 50px;
            margin-bottom: 20px;
        }

        .page-content-wrap p {
            font-size: 16px;
            line-height: 28px;
            color: rgba(255, 255, 255, .7);
            font-weight: 400;
        }

        .page-content-wrap .subscriber-form {
            position: relative;
            z-index: 0;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 40px;
        }

        .page-content-wrap .subscriber-form .submit-btn {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 60px;
            height: 50px;
            text-align: center;
            border: none;
            background-color: #2685f9;
            color: #fff;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .page-content-wrap .subscriber-form .form-group .form-control {
            height: 50px;
            padding: 0 20px;
            padding-right: 80px;
        }

    </style>
    @yield('style')
    @if (request()->is('blog/*') || request()->is('work/*') || request()->is('service/*'))
        @yield('og-meta')
        <title>@yield('site-title')</title>
    @elseif(request()->is('about') || request()->is('service') || request()->is('work') || request()->is('team') ||
        request()->is('faq') || request()->is('blog') || request()->is('contact') || request()->is('p/*') ||
        request()->is('blog/*') || request()->is('services/*'))
        <title>@yield('site-title') - {{ 'UMDAA Health Care' }} </title>
    @else
        <title>{{ 'UMDAA Health Care' }} - {{ get_static_option('site_tag_line') }}</title>
    @endif
</head>

<body>

    <div class="maintenance-page-content-area" @php
        $maintain_page_background_image = get_attachment_image_by_id(get_static_option('maintain_page_background_image'), 'full', false);
    @endphp @if (!empty($maintain_page_background_image)) style="background-image: url({{ $maintain_page_background_image['img_url'] }})" @endif>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="maintenance-page-inner-content">
                        <div class="page-content-wrap">
                            <div class="logo-wrap">
                                @php
                                    $maintain_page_logo = get_attachment_image_by_id(get_static_option('maintain_page_logo'), 'full', false);
                                @endphp
                                @if (!empty($maintain_page_logo))
                                    <img src="{{ $maintain_page_logo['img_url'] }}" alt="site logo">
                                @endif
                            </div>
                            <h2 class="maintain-title">{!! get_static_option('maintain_page_title') !!}</h2>
                            <p>{!! get_static_option('maintain_page_description') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="whatsdiv">
    </div>

    <script src="{{ asset('assets/frontend/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery-migrate-3.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/dynamic-script.js') }}"></script>

    <script type="text/javascript">
        $(function() {
            $('#whatsdiv').floatingWhatsApp({
                phone: "{{get_static_option('whats_app_number')}}",
                popupMessage: "{{get_static_option('whats_app_message')}}",
                showPopup: true
            });
        });
    </script>
</body>

</html>
