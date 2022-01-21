@extends('backend.admin-master')
@section('site-title')
    {{ 'Faq Area' }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
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
                        <h4 class="header-title">{{ 'Faq Area Settings' }}</h4>
                        <form action="{{ route('admin.homeone.faq.area') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="myTabContent">
                                <div class="tab-pane fade show active" role="tabpanel">
                                    <div class="form-group">
                                        <label for="home_page_01_faq_area_title">{{ 'Title' }}</label>
                                        <input type="text" name="home_page_01_faq_area_title" class="form-control"
                                            value="{{ get_static_option('home_page_01_faq_area_title') }}"
                                            id="home_page_01_faq_area_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_faq_area_description">{{ 'Description' }}</label>
                                        <textarea name="home_page_01_faq_area_description"
                                            class="form-control max-height-150" id="home_page_01_faq_area_description"
                                            cols="30"
                                            rows="10">{{ get_static_option('home_page_01_faq_area_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_faq_area_form_title">{{ 'Form Title' }}</label>
                                        <input type="text" name="home_page_01_faq_area_form_title" class="form-control"
                                            value="{{ get_static_option('home_page_01_faq_area_form_title') }}"
                                            id="home_page_01_faq_area_form_title">
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="home_page_01_faq_area_form_description">{{ 'Form Description' }}</label>
                                        <textarea name="home_page_01_faq_area_form_description"
                                            class="form-control max-height-150" id="home_page_01_faq_area_form_description"
                                            cols="30"
                                            rows="10">{{ get_static_option('home_page_01_faq_area_form_description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="home_page_01_faq_area_items">{{ 'FAQ Items' }}</label>
                                <input type="text" name="home_page_01_faq_area_items" class="form-control"
                                    value="{{ get_static_option('home_page_01_faq_area_items') }}"
                                    id="home_page_01_faq_area_items">
                                <small class="info-text">{{ 'enter how many faq show in frontend' }}</small>
                            </div>

                            <div class="form-group">
                                <label for="home_page_01_faq_area_form_mail">{{ 'Faq Form Mail' }}</label>
                                <input type="text" class="form-control" id="home_page_01_faq_area_form_mail"
                                    value="{{ get_static_option('home_page_01_faq_area_form_mail') }}"
                                    name="home_page_01_faq_area_form_mail">
                                <small>{{ 'faq form mail will be send to this account' }}</small>
                            </div>
                            <div class="form-group">
                                <label for="home_page_01_faq_area_background_image">{{ 'Faq Background Image' }}</label>
                                @php $cta_image_upload_btn_label = 'Upload Background Image'; @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $cta_bg_img = get_attachment_image_by_id(get_static_option('home_page_01_faq_area_background_image'), null, false);
                                        @endphp
                                        @if (!empty($cta_bg_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{ $cta_bg_img['img_url'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @php $cta_image_upload_btn_label = 'Change Background Image'; @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" name="home_page_01_faq_area_background_image"
                                        value="{{ get_static_option('home_page_01_faq_area_background_image') }}">
                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="Select Background Image" data-modaltitle="Upload Background Image"
                                        data-imgid="{{ get_static_option('home_page_01_faq_area_background_image') }}"
                                        data-toggle="modal" data-target="#media_upload_modal">
                                        {{ $cta_image_upload_btn_label }}
                                    </button>
                                </div>
                                <small>{{ 'recommended image size is 1920x875 pixel' }}</small>
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
