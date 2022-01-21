@extends('backend.admin-master')
@section('site-title')
    {{ 'New Knowledgebase Article' }}
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
                        <h4 class="header-title">{{ 'Add New Knowledgebase Article' }}</h4>
                        <form action="{{ route('admin.knowledge.new') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title">{{ 'Title' }}</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title') }}" placeholder="{{ 'Title' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="topic">{{ 'Topic' }}</label>
                                        <select name="topic_id" class="form-control" id="topic">
                                            <option value="">{{ 'Select Topic' }}</option>
                                            @foreach ($all_topics as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ 'Content' }}</label>
                                        <input type="hidden" name="content">
                                        <div class="summernote"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{ 'Status' }}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="publish">{{ 'Publish' }}</option>
                                            <option value="draft">{{ 'Draft' }}</option>
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add New Article' }}</button>
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
        });

    </script>
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
