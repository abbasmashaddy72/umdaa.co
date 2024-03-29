@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
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
@section('site-title')
    {{ 'All Newsletter' }}
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
                        <h4 class="header-title">{{ 'All Newsletter Subscriber' }}</h4>
                        <div class="table-wrap">
                            <table class="table table-default">
                                <thead>
                                    <th>{{ 'ID' }}</th>
                                    <th>{{ 'Email' }}</th>
                                    <th>{{ 'Action' }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_subscriber as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1" role="button"
                                                    data-toggle="popover" data-trigger="focus" data-html="true" title=""
                                                    data-content="
                                                    <h6>Are you sure to delete this subscriber?</h6>
                                                    <form method='post' action='{{ route('admin.newsletter.delete', $data->id) }}'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <br>
                                                    <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                    </form>
                                                    ">
                                                    <i class="ti-trash"></i>
                                                </a>
                                                <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1 send_mail_modal_btn"
                                                    href="#" data-toggle="modal"
                                                    data-target="#send_mail_to_subscriber_modal"
                                                    data-email="{{ $data->email }}">
                                                    <i class="ti-email"></i>
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
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Add New Subscriber' }}</h4>
                        <form action="{{ route('admin.newsletter.new.add') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ 'Email' }}</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ 'Email' }}">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ 'Submit' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="send_mail_to_subscriber_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Send Mail To Subscriber' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.newsletter.single.mail') }}" id="send_mail_to_subscriber_edit_modal_form"
                    method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ 'Email' }}</label>
                            <input type="text" readonly class="form-control" id="email" name="email"
                                placeholder="{{ 'Email' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon">{{ 'Subject' }}</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="{{ 'Subject' }}">
                        </div>
                        <div class="form-group">
                            <label for="message">{{ 'Message' }}</label>
                            <input type="hidden" name="message">
                            <div class="summernote"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                        <button type="submit" class="btn btn-primary">{{ 'Send Mail' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.send_mail_modal_btn', function() {
                var el = $(this);
                var email = el.data('email');
                var form = $('#send_mail_to_subscriber_edit_modal_form');
                form.find('#email').val(email);
            });
            $('.summernote').summernote({
                height: 300, //set editable area's height
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
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
