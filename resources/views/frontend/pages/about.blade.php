@extends('frontend.frontend-page-master')
@section('site-title')
    {{ 'About Us' }}
@endsection
@section('page-title')
    {{ 'About Us' }}
@endsection
@section('content')
    <div class="who-we-area padding-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="left-content-area">
                        <div class="aboutus-content-block margin-bottom-50">
                            <h4 class="title">{{ get_static_option('about_page_about_section_title') }}</h4>
                            <p>{!! get_static_option('about_page_about_section_description') !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="img-wrapper">
                        @php
                            $home_about_right_image = get_attachment_image_by_id(get_static_option('about_page_about_section_right_image'), null, false);
                        @endphp
                        @if (!empty($home_about_right_image))
                            <img src="{{ $home_about_right_image['img_url'] }}" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="our-work-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h2 class="title">{{ get_static_option('about_page_know_about_section_title') }}</h2>
                        <p>{{ get_static_option('about_page_know_about_section_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($all_know_about as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-work-item-02">
                            <div class="thumb">
                                @php
                                    $know_bout_image = get_attachment_image_by_id($data->image, 'grid', false);
                                @endphp
                                @if (!empty($know_bout_image))
                                    <img src="{{ $know_bout_image['img_url'] }}" alt="{{ $data->name }}">
                                @endif
                            </div>
                            <div class="content">
                                <a href="{{ $data->link }}">
                                    <h4 class="title">{{ $data->title }}</h4>
                                </a>
                                <p>{{ $data->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
