@extends('frontend.frontend-page-master')
@section('site-title')
    {{ 'Services' }}
@endsection
@section('page-title')
    {{ 'Services' }}
@endsection
@section('style')
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

        .section-title {
            padding: 5px;
        }

    </style>
@endsection
@section('content')
    <section class="we-area-experience">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 margin-top-40">
                    @if (!empty(get_static_option('home_01_key_feature_section_title')))
                    <div class="section-title desktop-center">
                        <h2 class="title">{{ get_static_option('home_01_key_feature_section_title') }}</h2>
                        @if (!empty(get_static_option('home_01_key_feature_section_description')))
                        <p>{{ get_static_option('home_01_key_feature_section_description') }}</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @foreach ($all_key_features as $data)
                    <div class="col-lg-4 col-md-6 margin-bottom-50">
                        <div class="single-experience-item">
                            <div class="thumb">
                                <div class="hover">
                                    <div class="icon">
                                        <i class="{{ $data->icon }}"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{ $data->title }}</h4>
                                        <p>{{ $data->description }}</p>
                                        <button class="btn btn-colour-1 float-right"><a
                                                href="{{ route('frontend.dynamic.page', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">more..</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
