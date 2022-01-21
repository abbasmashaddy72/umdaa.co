@extends('backend.admin-master')
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

    </style>
@endsection
@section('site-title')
    {{ __('Registered Clinics List') }}
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
            <div class="col-lg-12 col-ml-12 padding-bottom-30">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Registered Clinic List') }}</h4>

                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default">
                                        <thead>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Clinic Name') }}</th>
                                            <th>{{ __('Location') }}</th>
                                            <th>{{ __('Contact No.') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($allclinic as $data)
                                                <tr>
                                                    <td>{{ $data->clinic_id }}</td>
                                                    <td>{{ $data->clinic_name }}</td>
                                                    <td>{{ $data->location }}</td>
                                                    <td>{{ $data->clinic_phone }}</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#exp_info_item_edit_modal"
                                                            class="btn btn-lg btn-primary btn-sm mb-3 mr-1 clinic_info_edit_btn"
                                                            data-id="{{ $data->clinic_id }}" data-clinic_name="{{ $data->clinic_name }}"
                                                            data-location="{{ $data->location }}"
                                                            data-clinic_phone="{{ $data->clinic_phone }}">
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
        </div>
    </div>

    <div class="modal fade" id="exp_info_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edit Clinic DEtails') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.clinic.details.update') }}" id="clinic_info_edit_modal_form"
                    method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="contact_info_id" value="">
    
                        <div class="form-group">
                            <label for="edit_title">{{ __('Clinci Name') }}</label>
                            <input type="text" class="form-control" id="edit_clinic_name" name="clinic_name"
                                placeholder="{{ __('Clinic Name') }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_title">{{ __('Location') }}</label>
                            <input type="text" class="form-control" id="edit_location" name="location"
                                placeholder="{{ __('Clinic Location') }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_title">{{ __('Contact Number') }}</label>
                            <input type="text" class="form-control" id="edit_clinic_phone" name="clinic_phone"
                                placeholder="{{ __('Clinic Contcat No.') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.table-wrap > table').DataTable( {
                "order": [[ 0, "desc" ]]
            } );
        } );
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.clinic_info_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var clinic_name = el.data('clinic_name');
                var location = el.data('location');
                var clinic_phone = el.data('clinic_phone');
                var form = $('#clinic_info_edit_modal_form');

                form.find('#contact_info_id').val(id);
                form.find('#edit_clinic_name').val(clinic_name);
                form.find('#edit_location').val(location);
                form.find('#edit_clinic_phone').val(clinic_phone);

            });
        });

    </script>
@endsection
