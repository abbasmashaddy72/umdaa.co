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
    {{ __('Registered Doctor List') }}
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
                        <h4 class="header-title">{{ __('Registered Doctor List') }}</h4>

                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default">
                                        <thead>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Depertment') }}</th>
                                            <th>{{ __('About') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($alldoc as $data)
                                                <tr>
                                                    <td>{{ $data->doctor_id }}</td>
                                                    <td>{{ 'Dr. ' }}{{ $data->first_name }}{{ ' ' }}{{ $data->last_name }}
                                                    </td>
                                                    <td>{{ $data->dept }}</td>
                                                    <td>
                                                        @if(!empty($data->about))
                                                        {{ $data->about }}
                                                        @else {{'Please Add About Data of Doctors'}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if (!empty($data->profile_image))
                                                        <img src="{{ ('https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image) }}"
                                                            alt="{{ __($data->first_name) }}" class="rounded bg-light" />
                                                    @else {{'No Image Added'}}
                                                    @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.doctor.details.edit', $data->doctor_id) }}"
                                                            class="btn btn-lg btn-primary btn-sm mb-3 mr-1 contact_info_edit_btn">
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
@endsection
