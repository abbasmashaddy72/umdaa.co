@extends('backend.admin-master')
@section('site-title')
    {{('Site Identity')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{("Site Identity Settings")}}</h4>
                        <form action="{{route('admin.general.site.identity')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_logo"><strong>{{('Site Logo')}}</strong></label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $blog_img = get_attachment_image_by_id(get_static_option('site_logo'),null,true);
                                            $blog_image_btn_label = 'Upload Image';
                                        @endphp
                                        @if (!empty($blog_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$blog_img['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $blog_image_btn_label = 'Change Image'; @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="site_logo" name="site_logo" value="{{get_static_option('site_logo')}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Site Logo Image" data-modaltitle="Upload Site Logo Image" data-toggle="modal" data-target="#media_upload_modal">
                                        {{($blog_image_btn_label)}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{('allowed image format: jpg,jpeg,png. Recommended image size 160x50')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_favicon">{{('Favicon')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'),null,true);
                                            $site_favicon_btn_label = 'Upload Image';
                                        @endphp
                                        @if (!empty($site_favicon))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$site_favicon['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $site_favicon_btn_label = 'Change Image'; @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="site_favicon" name="site_favicon" value="{{get_static_option('site_favicon')}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Site Favicon Image" data-modaltitle="Upload Site Favicon Image" data-toggle="modal" data-target="#media_upload_modal">
                                        {{($site_favicon_btn_label)}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{('allowed image format: jpg,jpeg,png. Recommended image size 40x40')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{('Update Changes')}}</button>
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
