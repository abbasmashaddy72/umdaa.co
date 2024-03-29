@extends('backend.admin-master')
@section('site-title')
    {{ 'Header Slider' }}
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

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'All Header Slider' }}</h4>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default">
                                        <thead>
                                            <th>{{ 'ID' }}</th>
                                            <th>{{ 'Image' }}</th>
                                            <th>{{ 'Title' }}</th>
                                            <th>{{ 'Description' }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_header_slider as $data)
                                                @php $img_url =''; @endphp
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>
                                                        @php
                                                            $header_bg_img = get_attachment_image_by_id($data->image, null, true);
                                                            $img_url = '';
                                                        @endphp
                                                        @if (!empty($header_bg_img))
                                                            <div class="attachment-preview">
                                                                <div class="thumbnail">
                                                                    <div class="centered">
                                                                        <img class="avatar user-thumb"
                                                                            src="{{ $header_bg_img['img_url'] }}" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php  $img_url = $header_bg_img['img_url']; @endphp
                                                        @endif
                                                    </td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>{{ $data->description }}</td>
                                                    <td>
                                                        <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                            role="button" data-toggle="popover" data-trigger="focus"
                                                            data-html="true" title="" data-content="
                                                    <h6>Are you sure to delete this header slider item?</h6>
                                                    <form method='post' action='{{ route('admin.header.delete', $data->id) }}'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <br>
                                                    <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                    </form>
                                                    ">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#header_slider_item_edit_modal"
                                                            class="btn btn-lg btn-primary btn-sm mb-3 mr-1 header_slider_edit_btn"
                                                            data-id="{{ $data->id }}" data-title="{{ $data->title }}"
                                                            data-imageid="{{ $data->image }}"
                                                            data-image="{{ $img_url }}"
                                                            data-description="{{ $data->description }}"
                                                            data-btn_01_status="{{ $data->btn_01_status }}"
                                                            data-btn_01_text="{{ $data->btn_01_text }}"
                                                            data-btn_01_url="{{ $data->btn_01_url }}">
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
                        <h4 class="header-title">{{ 'New Header Slider' }}</h4>
                        <form action="{{ route('admin.header') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{ 'Title' }}</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="{{ 'Title' }}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{ 'Description' }}</label>
                                <textarea class="form-control max-height-150" id="description" name="description"
                                    placeholder="{{ 'Description' }}" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="btn_01_status">{{ 'Button Show/Hide' }}</label>
                                <label class="switch">
                                    <input type="checkbox" name="btn_01_status" id="btn_01_status">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="btn_01_text">{{ 'Button Text' }}</label>
                                <input type="text" class="form-control" id="btn_01_text" name="btn_01_text"
                                    placeholder="{{ 'Button Text' }}">
                            </div>
                            <div class="form-group">
                                <label for="btn_01_url">{{ 'Button URL' }}</label>
                                <input type="text" class="form-control" id="btn_01_url" name="btn_01_url"
                                    placeholder="{{ 'Button URL' }}">
                            </div>

                            <div class="form-group">
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap"></div>
                                    <input type="hidden" name="image">
                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="Select Slider Background" data-modaltitle="Upload Slider Background"
                                        data-toggle="modal" data-target="#media_upload_modal">
                                        {{ 'Upload Image' }}
                                    </button>
                                </div>
                                <small>{{ 'recommended image size is 1920x900 pixel' }}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add  New Slider' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="header_slider_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Edit Header Slider Item' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.header.update') }}" id="header_slider_edit_modal_form" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="header_slider_id" value="">
                        <div class="form-group">
                            <label for="edit_title">{{ 'Title' }}</label>
                            <input type="text" class="form-control" id="edit_title" name="title"
                                placeholder="{{ 'Title' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">{{ 'Description' }}</label>
                            <textarea class="form-control max-height-150" id="edit_description" name="description"
                                placeholder="{{ 'Description' }}" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_01_status">{{ 'Button Show/Hide' }}</label>
                            <label class="switch">
                                <input type="checkbox" name="btn_01_status" id="edit_btn_01_status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_01_text">{{ 'Button Text' }}</label>
                            <input type="text" class="form-control" id="edit_btn_01_text" name="btn_01_text"
                                placeholder="{{ 'Button Text' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_01_url">{{ 'Button URL' }}</label>
                            <input type="text" class="form-control" id="edit_btn_01_url" name="btn_01_url"
                                placeholder="{{ 'Button URL' }}">
                        </div>
                        <div class="form-group">
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" id="edit_image" name="image" value="">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                    data-btntitle="Select Slider Background" data-modaltitle="Upload Slider Background"
                                    data-imgid="{{ auth()->user()->image }}" data-toggle="modal"
                                    data-target="#media_upload_modal">
                                    {{ 'Upload Image' }}
                                </button>
                            </div>
                            <small>{{ 'recommended image size is 1920x900 pixel' }}</small>
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
            $(document).on('click', '.header_slider_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var action = el.data('action');
                var image = el.data('image');
                var imageid = el.data('imageid');
                var form = $('#header_slider_edit_modal_form');

                form.attr('action', action);
                form.find('#header_slider_id').val(id);
                form.find('#edit_title').val(el.data('title'));
                form.find('#edit_description').val(el.data('description'));
                form.find('#edit_btn_01_text').val(el.data('btn_01_text'));
                form.find('#edit_btn_01_url').val(el.data('btn_01_url'));

                if (imageid != '') {
                    form.find('.media-upload-btn-wrapper .img-wrap').html(
                        '<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' +
                        image + '" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }

                if (el.data('btn_01_status') != '') {
                    $('#edit_btn_01_status').prop('checked', true);
                }
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
