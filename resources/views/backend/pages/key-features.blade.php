@extends('backend.admin-master')
@section('site-title')
    {{ 'Key Features' }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
div.dataTables_wrapper div.dataTables_info {
    color: #d6d7d9;
}

    </style>
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
                        <h4 class="header-title">{{__('New Key Features Section Settings')}}</h4>

                        <form action="{{route('admin.keyfeature.section')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" >
                                    <div class="form-group">
                                        <label for="home_01_key_feature_section_title">{{__('Title')}}</label>
                                        <input type="text" class="form-control"  id="home_01_key_feature_section_title"  name="home_01_key_feature_section_title" value="{{get_static_option('home_01_key_feature_section_title')}}" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_01_key_feature_section_description">{{__('Description')}}</label>
                                        <textarea  id="home_01_key_feature_section_description"  name="home_01_key_feature_section_description" class="form-control max-height-120"  cols="30" rows="10" placeholder="{{__('Description')}}">{{get_static_option('home_01_key_feature_section_description')}}</textarea>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Key Features Items' }}</h4>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default">
                                        <thead>
                                            <th>{{ 'ID' }}</th>
                                            <th>{{ 'Icon' }}</th>
                                            <th>{{ 'Title' }}</th>
                                            <th>{{ 'Image' }}</th>
                                            <th>{{ 'Description' }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_key_features as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td><i class="{{ $data->icon }}"></i></td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>
                                                        @php
                                                            $key_feature_img = get_attachment_image_by_id($data->image, null, true);
                                                            $img_url = '';
                                                        @endphp
                                                        @if (!empty($key_feature_img))
                                                            <div class="attachment-preview">
                                                                <div class="thumbnail">
                                                                    <div class="centered">
                                                                        <img class="avatar user-thumb"
                                                                            src="{{ $key_feature_img['img_url'] }}"
                                                                            alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php  $img_url = $key_feature_img['img_url']; @endphp
                                                        @endif
                                                    </td>
                                                    <td>{{ $data->description }}</td>
                                                    <td>
                                                        <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                            role="button" data-toggle="popover" data-trigger="focus"
                                                            data-html="true" title="" data-content="
                                                                    <h6>Are you sure to delete this key features item ?</h6>
                                                                    <form method='post' action='{{ route('admin.keyfeatures.delete', $data->id) }}'>
                                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                                    <br>
                                                                    <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                                    </form>">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#key_features_item_edit_modal"
                                                            class="btn btn-lg btn-primary btn-sm mb-3 mr-1 key_features_edit_btn"
                                                            data-id="{{ $data->id }}" data-image="{{ $img_url }}"
                                                            data-imageid="{{ $data->image }}"
                                                            data-title="{{ $data->title }}"
                                                            data-description="{{ $data->description }}"
                                                            data-icon="{{ $data->icon }}">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'New Key Features' }}</h4>
                        <form action="{{ route('admin.keyfeatures') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{ 'Title' }}</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="{{ 'Title' }}">
                            </div>
                            <div class="form-group">
                                <label for="icon" class="d-block">{{ 'Icon' }}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="icon" value="fas fa-exclamation-triangle"
                                    name="icon">
                            </div>
                            <div class="form-group">
                                <label for="description">{{ 'Description' }}</label>
                                <textarea id="description" name="description" class="form-control max-height-120" cols="30"
                                    rows="10" placeholder="{{ 'Description' }}"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap"></div>
                                    <input type="hidden" name="image">
                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="Select Key Feature Image" data-modaltitle="Upload Key Feature Image"
                                        data-toggle="modal" data-target="#media_upload_modal">
                                        {{ 'Upload Image' }}
                                    </button>
                                </div>
                                <small>{{ 'recommended image size is 370x250 pixel' }}</small>
                            </div>
                            <button type="submit"
                                class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add  New Key Features' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="key_features_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Edit Key Feature Item' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.keyfeatures.update') }}" id="key_featrues_edit_modal_form" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="key_features_id" value="">
                        <div class="form-group">
                            <label for="edit_title">{{ 'Title' }}</label>
                            <input type="text" class="form-control" id="edit_title" name="title"
                                placeholder="{{ 'Title' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon" class="d-block">{{ 'Icon' }}</label>
                            <div class="btn-group ">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                    data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control" id="edit_icon" value="fas fa-exclamation-triangle"
                                name="icon">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">{{ 'Description' }}</label>
                            <textarea id="edit_description" name="description" class="form-control max-height-120" cols="30"
                                rows="10" placeholder="{{ 'Description' }}"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" name="image">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                    data-btntitle="Select Key Feature Image" data-modaltitle="Upload Key Feature Image"
                                    data-toggle="modal" data-target="#media_upload_modal">
                                    {{ 'Upload Image' }}
                                </button>
                            </div>
                            <small>{{ 'recommended image size is 370x250 pixel' }}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                        <button type="submit" class="btn btn-primary">{{ 'Save Changes' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.key_features_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var icon = el.data('icon');
                var description = el.data('description');
                var form = $('#key_featrues_edit_modal_form');
                var image = el.data('image');
                var imageid = el.data('imageid');

                form.find('#key_features_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_icon').val(icon);
                form.find('#edit_description').val(description);
                form.find('.icp-dd').attr('data-selected', el.data('icon'));
                form.find('.iconpicker-component i').attr('class', el.data('icon'));
                form.find('#preview_image').attr('src', image);
                if (imageid != '') {
                    form.find('.media-upload-btn-wrapper .img-wrap').html(
                        '<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' +
                        image + '" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
            });

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function(e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });
        });

    </script>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.table-wrap > table').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });


        });

    </script>
@endsection
