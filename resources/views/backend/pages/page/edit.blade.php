@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
@endsection
@section('site-title')
    {{ 'Edit Page' }}
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
                        <h4 class="header-title">{{ 'Edit Page' }}</h4>
                        <form action="{{ route('admin.page.update', $page_post->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="title">{{ 'Title' }}</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $page_post->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ 'Content' }}</label>
                                        <input type="hidden" name="page_content" value="{{ $page_post->content }}">
                                        <div class="summernote" data-content='{{ $page_post->content }}'></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>{{ 'Status' }}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="publish">{{ 'Publish' }}</option>
                                            <option value="draft">{{ 'Draft' }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">{{ 'Page Meta Tags' }}</label>
                                        <input type="text" name="meta_tags" class="form-control"
                                            value="{{ $page_post->meta_tags }}" data-role="tagsinput" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">{{ 'Page Meta Description' }}</label>
                                        <textarea name="meta_description" class="form-control"
                                            id="meta_description">{{ $page_post->meta_description }}</textarea>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Page' }}</button>
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
    <script src="{{ asset('assets/backend/js/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 400, //set editable area's height
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
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
