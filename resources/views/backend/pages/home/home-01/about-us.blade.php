@extends('backend.admin-master')
@section('site-title')
    {{('About Us Area')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{('About Us Area Settings')}}</h4>
                        <form action="{{route('admin.homeone.about.us')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="myTabContent">
                                <div class="tab-pane fade show active" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_01_about_us_title">{{('Title')}}</label>
                                        <input type="text" name="home_page_01_about_us_title" class="form-control" value="{{get_static_option('home_page_01_about_us_title')}}" id="home_page_01_about_us_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_about_us_description">{{('Description')}}</label>
                                        <textarea name="home_page_01_about_us_description" class="form-control" rows="10" id="home_page_01_about_us_description">{{get_static_option('home_page_01_about_us_description')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_about_us_button_status"><strong>{{('Button Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_01_about_us_button_status"  @if(!empty(get_static_option('home_page_01_about_us_button_status'))) checked @endif id="home_page_01_about_us_button_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_about_us_button_title">{{('Button Title')}}</label>
                                        <input type="text" name="home_page_01_about_us_button_title" class="form-control" value="{{get_static_option('home_page_01_about_us_button_title')}}" id="home_page_01_about_us_button_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_about_us_button_url">{{('Button URL')}}</label>
                                        <input type="text" name="home_page_01_about_us_button_url" class="form-control" value="{{get_static_option('home_page_01_about_us_button_url')}}" id="home_page_01_about_us_button_url">
                                    </div>
                                    <div class="form-group">
                                        <label>{{('Background Image')}}</label>
                                        @php $background_image_upload_btn_label = 'Upload Background Image'; @endphp
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $background_img = get_attachment_image_by_id(get_static_option('home_page_01_about_us_background_image'),null,false);
                                                @endphp
                                                @if (!empty($background_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="{{$background_img['img_url']}}" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php $background_image_upload_btn_label = 'Change Background Image'; @endphp
                                                @endif
                                            </div>
                                            <input type="hidden" name="home_page_01_about_us_background_image" value="{{get_static_option('home_page_01_about_us_background_image')}}">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Background Image" data-modaltitle="Upload Background Image" data-imgid="{{get_static_option('home_page_01_about_us_background_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                {{($background_image_upload_btn_label)}}
                                            </button>
                                        </div>
                                        <small>{{('recommended image size is 572x470 pixel')}}</small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection

