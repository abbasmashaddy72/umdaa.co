@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/summernote-bs4.css') }}">
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
@section('site-title')
    {{ 'All Completed Quotes' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
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
                                    <h4 class="header-title">{{ 'All Completed Quotes' }}</h4>
                                    <div class="data-tables datatable-primary table-responsive">
                                        <table id="all_user_table">
                                            <thead class="text-capitalize">
                                                <tr>
                                                    <th>{{ 'ID' }}</th>
                                                    <th>{{ 'Status' }}</th>
                                                    <th>{{ 'Date' }}</th>
                                                    <th>{{ 'Action' }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_quotes as $data)
                                                    <tr>
                                                        <td>{{ $data->id }}</td>
                                                        <td>
                                                            @if ($data->status == 'pending')
                                                                <span
                                                                    class="alert alert-warning text-capitalize">{{ $data->status }}</span>
                                                            @elseif($data->status == 'canceled')
                                                                <span
                                                                    class="alert alert-danger text-capitalize">{{ $data->status }}</span>
                                                            @else
                                                                <span
                                                                    class="alert alert-success text-capitalize">{{ $data->status }}</span>
                                                            @endif
                                                        </td>
                                                        @php
                                                            $all_custom_fields = [];
                                                            $all_custom_fields_un = unserialize($data->custom_fields);
                                                            $all_custom_fields = json_encode($all_custom_fields_un);
                                                        @endphp
                                                        <td>{{ date_format($data->created_at, 'd M Y') }}</td>
                                                        <td>
                                                            <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                                role="button" data-toggle="popover" data-trigger="focus"
                                                                data-html="true" title="" data-content="
                                                            <h6>Are you sure to delete this quote?</h6>
                                                            <form method='post' action='{{ route('admin.quote.manage.delete', $data->id) }}'>
                                                            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                            <br>
                                                            <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                            </form>
                                                            " data-original-title="">
                                                                <i class="ti-trash"></i>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#user_edit_modal"
                                                                class="btn btn-lg btn-primary btn-sm mb-3 mr-1 user_edit_btn">
                                                                <i class="ti-email"></i>
                                                            </a>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#view_quote_details_modal"
                                                                data-status="{{ $data->status }}"
                                                                data-customfield="{{ $all_custom_fields }}"
                                                                data-date="{{ date_format($data->created_at, 'd M Y') }}"
                                                                data-attachment="{{ json_encode(unserialize($data->attachment)) }}"
                                                                class="btn btn-lg btn-primary btn-sm mb-3 mr-1 view_quote_details_btn">
                                                                <i class="ti-eye"></i>
                                                            </a>
                                                            <a href="#" data-id="{{ $data->id }}"
                                                                data-status="{{ $data->status }}" data-toggle="modal"
                                                                data-target="#quote_status_change_modal"
                                                                class="btn btn-lg btn-info btn-sm mb-3 mr-1 quote_status_change_btn">
                                                                {{ 'Update Status' }}
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
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_quote_details_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="view-quote-details-info">
                    <h4 class="title">{{ 'View Quote Details Information' }}</h4>
                    <div class="view-quote-top-wrap">
                        <div class="status-wrap">
                            Status: <span class="quote-status-span"></span>
                        </div>
                        <div class="data-wrap">
                            Date: <span class="quote-date-span"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="quote-all-custom-fields table-striped table-bordered"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Send Mail To Quote Sender' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>

                <form action="{{ route('admin.quote.manage.send.mail') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ 'Name' }}</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ 'Enter name' }}">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ 'Email' }}</label>
                            <input type="text" class="form-control" name="email" placeholder="{{ 'Email' }}">
                        </div>
                        <div class="form-group">
                            <label for="Subject">{{ 'Subject' }}</label>
                            <input type="text" class="form-control" name="subject"
                                value="{{ 'Your Quote Replay From {site}' }}">
                            <small class="info-text">{{ '{site} will be replaced by site title' }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ 'Message' }}</label>
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

    <div class="modal fade" id="quote_status_change_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Quote Status Change' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.quote.manage.change.status') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="quote_id" id="quote_id">
                        <div class="form-group">
                            <label for="quote_status">{{ 'Quote Status' }}</label>
                            <select name="quote_status" class="form-control" id="quote_status">
                                <option value="pending">{{ 'Pending' }}</option>
                                <option value="canceled">{{ 'Canceled' }}</option>
                                <option value="completed">{{ 'Completed' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                        <button type="submit" class="btn btn-primary">{{ 'Change Status' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap-tagsinput.js') }}"></script>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.view_quote_details_btn', function(e) {
                e.preventDefault();
                var el = $(this);
                var allData = el.data();
                var parent = $('#view_quote_details_modal');
                var statusClass = allData.status == 'pending' ? 'alert alert-warning' :
                    'alert alert-success';

                parent.find('.quote-status-span').text(allData.status).addClass(statusClass);
                parent.find('.quote-date-span').text(allData.date);
                parent.find('.quote-all-custom-fields').html('');
                $.each(allData.customfield, function(index, value) {
                    parent.find('.quote-all-custom-fields').append('<tr><td class="fname">' + index
                        .replace('-', ' ') + '</td> <td class="fvalue">' + value + '</td></tr>');
                });
                if (allData.attachment) {
                    $.each(allData.attachment, function(index, value) {
                        parent.find('.quote-all-custom-fields tbody').append(
                            '<tr class="attachment_list"><td class="fname">' + index.replace(
                                '-', ' ') + '</td><td class="fvalue"><a href="' + value +
                            '" download>' + value.substr(26) + '</a></td></tr>');
                    });
                }
            })
            $(document).on('click', '.quote_status_change_btn', function(e) {
                e.preventDefault();
                var el = $(this);
                var form = $('#quote_status_change_modal');
                form.find('#quote_id').val(el.data('id'));
                form.find('#quote_status option[value="' + el.data('status') + '"]').attr('selected', true);
            });

            $('#all_user_table').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
            $('.summernote').summernote({
                height: 250, //set editable area's height
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
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
