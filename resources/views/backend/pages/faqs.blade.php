@extends('backend.admin-master')
@section('site-title')
    {{ 'Faq' }}
@endsection
@section('style')
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
                        <h4 class="header-title">{{ 'Faq Items' }}</h4>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default">
                                        <thead>
                                            <th>{{ 'ID' }}</th>
                                            <th>{{ 'Title' }}</th>
                                            <th>{{ 'Status' }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_faqs as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>
                                                        @if ($data->status == 'publish')
                                                            <span class="alert alert-success">{{ 'Publish' }}</span>
                                                        @else <span
                                                                class="alert alert-warning">{{ 'Draft' }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                            role="button" data-toggle="popover" data-trigger="focus"
                                                            data-html="true" title="" data-content="
                                                    <h6>Are you sure to delete this faq item ?</h6>
                                                    <form method='post' action='{{ route('admin.faq.delete', $data->id) }}'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <br>
                                                    <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                    </form>
                                                    ">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#faq_item_edit_modal"
                                                            class="btn btn-lg btn-primary btn-sm mb-3 mr-1 faq_edit_btn"
                                                            data-id="{{ $data->id }}" data-title="{{ $data->title }}"
                                                            data-is_open="{{ $data->is_open }}"
                                                            data-description="{{ $data->description }}"
                                                            data-status="{{ $data->status }}">
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
                        <h4 class="header-title">{{ 'New Faq' }}</h4>
                        <form action="{{ route('admin.faq') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{ 'Title' }}</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="{{ 'Title' }}">
                            </div>
                            <div class="form-group">
                                <label for="is_open">{{ 'Is Open' }}</label>
                                <label class="switch">
                                    <input type="checkbox" name="is_open" id="is_open">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ 'Description' }}</label>
                                <textarea name="description" id="description" cols="30" rows="10"
                                    class="form-control max-height-150" placeholder="{{ 'Description' }}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">{{ 'Status' }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="publish">{{ 'Publish' }}</option>
                                    <option value="draft">{{ 'Draft' }}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add New Faq' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="faq_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Edit Faq Item' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.faq.update') }}" id="faq_edit_modal_form" enctype="multipart/form-data"
                    method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="faq_id" value="">
                        <div class="form-group">
                            <label for="edit_title">{{ 'Title' }}</label>
                            <input type="text" class="form-control" id="edit_title" name="title"
                                placeholder="{{ 'Title' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_is_open">{{ 'Is Open' }}</label>
                            <label class="switch">
                                <input type="checkbox" name="is_open" id="edit_is_open">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">{{ 'Description' }}</label>
                            <textarea name="description" id="edit_description" cols="30" rows="10"
                                class="form-control max-height-150" placeholder="{{ 'Description' }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_status">{{ 'Status' }}</label>
                            <select name="status" id="edit_status" class="form-control">
                                <option value="publish">{{ 'Publish' }}</option>
                                <option value="draft">{{ 'Draft' }}</option>
                            </select>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.faq_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var form = $('#faq_edit_modal_form');
                form.find('#faq_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_description').val(el.data('description'));
                form.find('#edit_status option[value="' + el.data('status') + '"]').attr('selected', true);
                if (el.data('is_open') != '') {
                    form.find('#edit_is_open').attr('checked', true);
                } else {
                    form.find('#edit_is_open').attr('checked', false);
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
