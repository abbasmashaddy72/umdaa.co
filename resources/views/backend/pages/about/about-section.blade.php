@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
@endsection
@section('site-title')
    {{ 'About Section' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'About Us Section Settings' }}</h4>
                        <form action="{{ route('admin.about.page.about') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="about_page_about_section_title">{{ 'Title' }}</label>
                                        <input type="text" name="about_page_about_section_title"
                                            value="{{ get_static_option('about_page_about_section_title') }}"
                                            class="form-control" id="about_page_about_section_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="about_page_about_section_description">{{ 'Description' }}</label>
                                        <textarea name="about_page_about_section_description"
                                            id="about_page_about_section_description" class="form-control max-height-150"
                                            cols="30"
                                            rows="10">{{ get_static_option('about_page_about_section_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="about_page_about_section_right_image">{{ 'Right Image' }}</label>
                                        @php $signature_image_upload_btn_label = 'Upload Right Image'; @endphp
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $signature_img = get_attachment_image_by_id(get_static_option('about_page_about_section_right_image'), null, false);
                                                @endphp
                                            </div>
                                            <input type="hidden" name="about_page_about_section_right_image"
                                                value="{{ get_static_option('about_page_about_section_right_image') }}">
                                            <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="Select Right Image" data-modaltitle="Upload Right Image"
                                                data-imgid="{{ get_static_option('about_page_about_section_right_image') }}"
                                                data-toggle="modal" data-target="#media_upload_modal">
                                                {{ $signature_image_upload_btn_label }}
                                            </button>
                                        </div>
                                        <small>{{ 'recommended image size is 470x590 pixel' }}</small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Settings' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
