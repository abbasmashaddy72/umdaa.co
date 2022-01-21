@extends('backend.admin-master')
@section('site-title')
    {{ 'Edit Events Post' }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/summernote-bs4.css') }}">
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Add Edit Event Post' }}</h4>
                        <form action="{{ route('admin.events.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title">{{ 'Title' }}</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $event->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{ 'Category' }}</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">{{ 'Select Category' }}</option>
                                            @foreach ($all_categories as $category)
                                                <option @if ($category->id == $event->category_id) selected @endif value="{{ $category->id }}">
                                                    {{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ 'Content' }}</label>
                                        <input type="hidden" name="content" value="{{ $event->content }}">
                                        <div class="summernote" data-content='{{ $event->content }}'></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">{{ 'Location' }}</label>
                                        <input type="text" class="form-control" id="location" name="location"
                                            value="{{ $event->location }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">{{ 'Date' }}</label>
                                        <input type="date" class="form-control" value="{{ $event->date }}" id="date"
                                            name="date">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">{{ 'Image' }}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $event_img = get_attachment_image_by_id($event->image, null, false);
                                                    $event_img_btn_label = 'Upload Image';
                                                @endphp
                                                @if (!empty($event_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb"
                                                                    src="{{ $event_img['img_url'] }}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php  $event_img_btn_label = 'Change Image'; @endphp
                                                @endif
                                            </div>
                                            <input type="hidden" name="image" value="{{ $event->image }}">
                                            <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="Select Event Image" data-modaltitle="Upload Event Image"
                                                data-toggle="modal" data-target="#media_upload_modal">
                                                {{ $event_img_btn_label }}
                                            </button>
                                        </div>
                                        <small>{{ 'Recommended image size 1920x1280' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{ 'Status' }}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option @if ($event->status == 'publish') selected @endif value="publish">{{ 'Publish' }}
                                            </option>
                                            <option @if ($event->status == 'draft') selected @endif value="draft">{{ 'Draft' }}
                                            </option>
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add New Event' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('.summernote').summernote({
                height: 500, //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if ($('.summernote').length > 0) {
                $('.summernote').each(function(index, value) {
                    $(this).summernote('code', $(this).data('content'));
                });
            }
        });

    </script>
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
