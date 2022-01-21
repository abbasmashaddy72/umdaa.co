@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
    <style>
        .dropdown-menu {
            color: rgba(255, 255, 255, .8);
            background-color: #242424;
            border: 1px solid rgba(255, 255, 255, .2);
        }

        .btn-group .btn {
            color: rgba(255, 255, 255, .8);
            background-color: #242424;
            border: 1px solid rgba(255, 255, 255, .2);
        }

        .btn-group ul {
            height: 350px;
            overflow-y: scroll;
        }

        .dropdown-menu.show {
            padding: 12px;
        }

        .dropdown-toggle::after {
            margin-left: 4.255em;
        }

        .btn-group b {
            margin: 50px;
        }

    </style>
@endsection
@section('site-title')
    {{ __('New Blog Post') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
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
                        <h4 class="header-title">{{ __('Add New Blog Post') }}</h4>
                        <form action="{{ route('admin.blog.new') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="article_type">{{ __('Article Type') }}</label><br>
                                            <select id="articletype" name="article_type" class="form-control">
                                                <option value="" selected disabled>Select Article Type</option>
                                                <option value="pdf">PDF</option>
                                                <option value="video">Video</option>
                                                <option value="image">Image</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col form-group">
                                    <label
                                        for="patient_visibility"><strong>{{ __('Patient Visibility') }}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="patient_visibility" checked id="patient_visibility">
                                        <span class="slider onff"></span>
                                    </label>
                                </div>
                                <div class="col form-group">
                                    <label for="doctor_visibility"><strong>{{ __('Doctor Visibility') }}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="doctor_visibility" checked id="doctor_visibility">
                                        <span class="slider onff"></span>
                                    </label>
                                </div>
                                <div class="col form-group">
                                    <label
                                        for="partner_visibility"><strong>{{ __('Partner Visibility') }}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="partner_visibility" checked id="partner_visibility">
                                        <span class="slider onff"></span>
                                    </label>
                                </div>
                                <div class="col form-group">
                                    <label for="department_id">{{ __('Select Doc Visible Departments') }}</label><br>
                                    <select name="department_id[]" class="form-control" multiple="multiple" id="multiselect">
                                        @foreach ($all_category as $category)
                                            <option value="{{ $category->department_id }}">
                                                {{ $category->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="article_title">{{ __('Title') }}</label>
                                        <input type="text" class="form-control" id="article_title" name="article_title"
                                            placeholder="{{ __('Title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">{{ __('Tags') }}</label>
                                        <input type="text" class="form-control" name="tags" data-role="tagsinput">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Content') }}</label>
                                        <input type="hidden" name="article_description">
                                        <div class="summernote"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="title">{{ __('Short Description') }}</label>
                                        <textarea name="short_description" id="short_description"
                                            class="form-control max-height-150" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="posted_dep">{{ __('Select Article Department') }}</label>
                                        <select name="posted_dep" class="form-control" id="posted_dep">
                                            <option value="" selected disabled>{{ __('Select Department') }}</option>
                                            @foreach ($all_category as $category)
                                                <option value="{{ $category->department_id }}">
                                                    {{ $category->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="article_author">{{ __('Author Name') }}</label>
                                        <input type="text" class="form-control" id="article_author" name="article_author"
                                            placeholder="{{ __('Author Name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="read_article_link">{{ __('Author Link / Read More Link') }}</label>
                                        <input type="text" class="form-control" id="read_article_link"
                                            name="read_article_link" placeholder="{{ __('Author Link') }}">
                                        <small>If you are writing in the content on left then don't enter any thing</small>
                                    </div>
                                    <div class="form-row" id="artyoutube">
                                        <div class="form-group">
                                            <label for="video_url">{{ __('Youtube Video ID') }}</label>
                                            <input type="text" class="form-control" id="video_url" name="video_url"
                                                placeholder="{{ __('Youtube Video ID') }}">
                                            <small>{{ 'Enter only the Text after = in Youtube URL ex.: https://www.youtube.com/watch?v=RA5YzeKn59M' }}</small>
                                        </div>
                                    </div>
                                    <div class="form-group" id="artimage">
                                        <label for="posted_url_img">{{ __('Upload Article Image') }}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <input type="file" name="posted_url_img" style="color: white">
                                        </div>
                                        <small>{{ __('Recommended image size 1920x1280') }}</small>
                                    </div>
                                    <div class="form-row" id="artpdf">
                                        <div class="form-group">
                                            <label for="posted_url_pdf">{{ __('Upload PDF') }}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <input type="file" name="posted_url_pdf" style="color: white">
                                            </div>
                                            <small>{{ __('Upload PDF Only') }}</small>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary mt-4 pr-4 pl-4">{{ __('Add New Post') }}</button>
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
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap-tagsinput.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.category_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var status = el.data('status');
                var modal = $('#category_edit_modal');
                modal.find('#category_id').val(id);
                modal.find('#edit_status option[value="' + status + '"]').attr('selected', true);
                modal.find('#edit_name').val(name);
            });
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
            if ($('.summernote').length > 1) {
                $('.summernote').each(function(index, value) {
                    $(this).summernote('code', $(this).data('content'));
                });
            }
        });

    </script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js'>
    </script>
    <script>
        $(document).ready(function() {
            $('#multiselect').multiselect({
                buttonWidth: '270px',
                includeSelectAllOption: true,
                nonSelectedText: 'Select an Option'
            });

        });

        function getSelectedValues() {
            var selectedVal = $("#multiselect").val();
            for (var i = 0; i < selectedVal.length; i++) {
                function innerFunc(i) {
                    setTimeout(function() {
                        location.href = selectedVal[i];
                    }, i * 2000);
                }
                innerFunc(i);
            }
        }

    </script>
    <script>
        $("#articletype").change(function() {
            if ($(this).val() == "pdf") {
                $('#artpdf').show();
            } else {
                $('#artpdf').hide();
            }
            if ($(this).val() == "image") {
                $('#artimage').show();
            } else {
                $('#artimage').hide();
            }
            if ($(this).val() == "video") {
                $('#artyoutube').show();
            } else {
                $('#artyoutube').hide();
            }
        });
        $("#articletype").trigger("change");

    </script>
    <script>
        $("form").submit(function() {

            var this_master = $(this);

            this_master.find('input[type="checkbox"]').each(function() {
                var checkbox_this = $(this);


                if (checkbox_this.is(":checked") == true) {
                    checkbox_this.attr('value', '1');
                } else {
                    checkbox_this.prop('checked', true);
                    checkbox_this.attr('value', '0');
                }
            })
        })

    </script>
@endsection
