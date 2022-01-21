@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
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

    </style>
@endsection
@section('site-title')
    {{ __('Regstered Doctor List') }}
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
            @foreach ($singleDetails as $data)
            <div class="col-lg-12 col-sm-4 clearfix margin-bottom-20">
                <ul class="pull-right">
                    <li><a class="btn btn-primary" target="_blank"
                            href="{{ route('frontend.doctor.website', ['id' => $data->doctor_id, 'any' => Str::slug(str_replace(' ','','Dr.'.$data->first_name.$data->last_name))]) }}">{{ 'View Doctors Site' }}</a></li>
                </ul>
            </div>
            @endforeach
            @include('backend.pages.doc-web.doctor-details')
            @include('backend.pages.doc-web.dr-wrk')
            @include('backend.pages.doc-web.dr-exp')
            @include('backend.pages.doc-web.dr-edu')
            @include('backend.pages.doc-web.doc-services')
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{ asset('assets/backend/js/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.exp_info_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var timeline = el.data('timeline');
                var designation = el.data('designation');
                var location_about = el.data('location_about');
                var form = $('#exp_info_edit_modal_form');

                form.find('#contact_info_id').val(id);
                form.find('#edit_timeline').val(timeline);
                form.find('#edit_designation').val(designation);
                form.find('#edit_location_about').val(location_about);

            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edu_info_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var timeline = el.data('timeline');
                var university = el.data('university');
                var degree = el.data('degree');
                var location_about = el.data('location_about');
                var form = $('#edu_info_edit_modal_form');

                form.find('#contact_info_id').val(id);
                form.find('#edit_timeline').val(timeline);
                form.find('#edit_university').val(university);
                form.find('#edit_degree').val(degree);
                form.find('#edit_location_about').val(location_about);
            });
        });

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
