<footer class="footer-area">
    <div class="footer-top padding-top-50 d-none d-lg-block d-xl-block d-md-block d-xs-none d-sm-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget">
                        <div class="about_us_widget">
                            <a href="{{ url('/') }}" class="footer-logo">
                                @php
                                $site_logo = get_attachment_image_by_id(get_static_option('site_logo'), 'full', false);
                                @endphp
                                @if (!empty($site_logo))
                                <img src="{{ $site_logo['img_url'] }}" alt="">
                                @endif
                            </a>
                            <p>{{ get_static_option('about_widget_description') }}</p>
                            <ul class="social-icons">
                                @if (!empty(get_static_option('about_widget_social_icon_one')) &&
                                !empty(get_static_option('about_widget_social_icon_one_url')))
                                <li><a href="{{ get_static_option('about_widget_social_icon_one_url') }}"><i
                                            class="{{ get_static_option('about_widget_social_icon_one') }}"></i></a>
                                </li>
                                @endif
                                @if (!empty(get_static_option('about_widget_social_icon_two')) &&
                                !empty(get_static_option('about_widget_social_icon_two_url')))
                                <li><a href="{{ get_static_option('about_widget_social_icon_two_url') }}"><i
                                            class="{{ get_static_option('about_widget_social_icon_two') }}"></i></a>
                                </li>
                                @endif
                                @if (!empty(get_static_option('about_widget_social_icon_three')) &&
                                !empty(get_static_option('about_widget_social_icon_three_url')))
                                <li><a href="{{ get_static_option('about_widget_social_icon_three_url') }}"><i
                                            class="{{ get_static_option('about_widget_social_icon_three') }}"></i></a>
                                </li>
                                @endif
                                @if (!empty(get_static_option('about_widget_social_icon_four')) &&
                                !empty(get_static_option('about_widget_social_icon_four_url')))
                                <li><a href="{{ get_static_option('about_widget_social_icon_four_url') }}"><i
                                            class="{{ get_static_option('about_widget_social_icon_four') }}"></i></a>
                                </li>
                                @endif
                                @if (!empty(get_static_option('about_widget_social_icon_five')) &&
                                !empty(get_static_option('about_widget_social_icon_five_url')))
                                <li><a href="{{ get_static_option('about_widget_social_icon_five_url') }}"><i
                                            class="{{ get_static_option('about_widget_social_icon_five') }}"></i></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget widget_nav_menu">
                        <h2 class="widget-title">{{ get_static_option('useful_link_widget_title') }}</h2>
                        <ul>
                            @php
                            $useful_links_arr = json_decode($all_usefull_links->content);
                            @endphp
                            @foreach ($useful_links_arr as $data)
                            <li><a
                                    href="{{ str_replace('[url]', url('/'), $data->menuUrl) }}">{{ $data->menuTitle }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget widget_nav_menu">
                        <h2 class="widget-title">{{ get_static_option('important_link_widget_title') }}</h2>
                        <ul>
                            @php
                            $useful_links_arr = json_decode($all_important_links->content);
                            @endphp
                            @foreach ($useful_links_arr as $data)
                            <li><a
                                    href="{{ str_replace('[url]', url('/'), $data->menuUrl) }}">{{ $data->menuTitle }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget widget_nav_menu">
                        <h2 class="widget-title">{{ 'Others' }}</h2>
                        <ul>
                            <li>
                                <a href={{ url('sitemap.xml') }}>Sitemap</a>
                            </li>
                            <li>
                                <a href={{ 'tel:+91-910046-2015' }}>Call Us</a>
                            </li>
                            <li>
                                <a href={{ 'mailto:info@umdaa.co?Subject=Thanks%20for%20Connecting%20With%20Us' }}>Mail
                                    Us</a>
                            </li>
                            @if (!empty($other_links->content))
                            @php
                            $useful_links_arr = json_decode($other_links->content);
                            @endphp
                            @foreach ($useful_links_arr as $data)
                            <li><a
                                    href="{{ str_replace('[url]', url('/'), $data->menuUrl) }}">{{ $data->menuTitle }}</a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-area-inner">
                        If you like to get notifications for these type of blogs <a data-toggle="modal" data-target="#newslettermodal" style="cursor: pointer;">Click Here</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-area-inner">
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
    </div>
    <div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Search</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('frontend.team.search') }}" method="get" class="search-form example">
                        <input type="text" class="form-control" name="search" placeholder="{{ __('Search Doctors') }}"
                            required>
                        <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="modal-body">
                    <form action="{{ route('frontend.blog.search') }}" method="get" class="search-form example">
                        <input type="text" class="form-control" name="search" placeholder="{{ __('Search Blogs') }}"
                            required>
                        <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newslettermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Please Enter Email to Subscribe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('frontend.subscribe.newsletter') }}" method="post" class="search-form example">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                            <div class="input-group-append">
                                <button class="submit-btn" style="width: fit-content;" type="submit">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</footer>

<div class="back-to-top">
    <i class="fas fa-angle-up"></i>
</div>
<div id="whatsdiv">
</div>
<style>
    @media only screen and (max-width: 600px) {
        #whatsdiv {
            left: 15px !important;
            right: auto !important;
        }
    }
</style>
@if(!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_id'))))
@php
$popup_id = get_static_option('popup_selected_id');
$popup_details = \App\PopupBuilder::find($popup_id);
if(empty($popup_details)) {return;}
$website_url = url('/');
$popup_class = '';
if ($popup_details->type == 'notice'){
$popup_class = 'notice-modal';
}elseif($popup_details->type == 'only_image'){
$popup_class = 'only-image-modal';
}else{
$popup_class = 'discount-modal';
}
@endphp
@include('frontend.partials.popup')
@endif
<!-- jquery -->
<script src="{{ asset('assets/frontend/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-migrate-3.1.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.lazy.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/dynamic-script.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.magnific-popup.js') }}"></script>
<script src="{{ asset('assets/frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.waypoints.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.ihavecookies.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>
@if(!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_id'))))
<script src="{{asset('assets/frontend/js/countdown.jquery.js')}}"></script>
@endif

@yield('scripts')

@if (!empty(get_static_option('site_gdpr_cookie_enabled')))
@php $gdpr_cookie_link = str_replace('{url}',url('/'),get_static_option('site_gdpr_cookie_more_info_link')) @endphp
<script>
    $(document).ready(function () {
        $('body').ihavecookies({
            title: "{{ get_static_option('site_gdpr_cookie_title') }}",
            message: "{{ get_static_option('site_gdpr_cookie_message') }}",
            expires: "{{ get_static_option('site_gdpr_cookie_expire') }}",
            link: "{{ $gdpr_cookie_link }}",
            delay: "{{ get_static_option('site_gdpr_cookie_delay') }}",
            moreInfoLabel: "{{ get_static_option('site_gdpr_cookie_more_info_label') }}",
            acceptBtnLabel: "{{ get_static_option('site_gdpr_cookie_accept_button_label') }}"
        });
        $('body').on('click', '#gdpr-cookie-close', function (e) {
            e.preventDefault();
            $(this).parent().remove();
        });
    });
</script>
@endif
<!--Start of Whats App-->
<script type="text/javascript">
    $(function () {
        $('#whatsdiv').floatingWhatsApp({
            phone: "{{ get_static_option('whats_app_number') }}",
            popupMessage: "{{ get_static_option('whats_app_message') }}",
            message: "",
            showPopup: false
        });
    });
</script>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTV4366" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!--Lazy Loading-->
<script>
    $(function () {
        $('.lazy').lazy();
    });
</script>
<!--Text Loader-->
<script>
    var content = document.querySelector('p');
</script>
{{-- Pop Up --}}
<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {

            $('[data-toggle="popover"]').popover();

            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
            @if(!empty(get_static_option('popup_enable_status') && !empty(get_static_option(
                'popup_selected_id'))) && !empty($popup_details))

            var delayTime = "{{get_static_option('popup_delay_time')}}";
            delayTime = delayTime ? delayTime : 4000;

            if (getCookie('nx_popup_show') == '') {
                setTimeout(function () {
                    $('.nx-popup-backdrop').addClass('show');
                    $('.nx-popup-wrapper').addClass('show');

                }, parseInt(delayTime));
            }

            $(document).on('click', '.nx-popup-close,.nx-popup-backdrop', function (e) {
                e.preventDefault();
                $('.nx-modal-content').html('');
                $('.nx-popup-backdrop').removeClass('show');
                $('.nx-popup-wrapper').removeClass('show');
                setCookie('nx_popup_show', 'no', 1);
            });

            var offerTime = "{{$popup_details->offer_time_end}}";
            var year = offerTime.substr(0, 4);
            var month = offerTime.substr(5, 2);
            var day = offerTime.substr(8, 2);
            if (offerTime) {
                $('#countdown').countdown({
                    year: year,
                    month: month,
                    day: day,
                    labels: true,
                    labelText: {
                        'days': "{{__('days')}}",
                        'hours': "{{__('hours')}}",
                        'minutes': "{{__('min')}}",
                        'seconds': "{{__('sec')}}",
                    }
                });
            }
            @endif

        });
    }(jQuery));
</script>
{{-- CSRF --}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>

</html>