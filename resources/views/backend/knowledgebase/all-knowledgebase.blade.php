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
div.dataTables_wrapper div.dataTables_info {
    color: #d6d7d9;
}

    </style>
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
@endsection
@section('site-title')
    {{ 'All Knoledgebase Article' }}
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
                        <h4 class="header-title">{{ 'All Knowledgebase Articles' }}</h4>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default" id="all_blog_table">
                                        <thead>
                                            <th>{{ 'ID' }}</th>
                                            <th>{{ 'Title' }}</th>
                                            <th>{{ 'Topics' }}</th>
                                            <th>{{ 'Views' }}</th>
                                            <th>{{ 'Created At' }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_article as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>{{ $data->topic->title }}</td>
                                                    <td>{{ $data->views }}</td>
                                                    <td>{{ date_format($data->created_at, 'D m Y') }}</td>
                                                    <td>
                                                        <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                            role="button" data-toggle="popover" data-trigger="focus"
                                                            data-html="true" title="" data-content="
                                                                <h6>Are you sure to delete this article?</h6>
                                                                <form method='post' action='{{ route('admin.knowledge.delete', $data->id) }}'>
                                                                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                                <br>
                                                                <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                                </form>
                                                                ">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                        <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1"
                                                            href="{{ route('admin.knowledge.edit', $data->id) }}">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                        <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1" target="_blank"
                                                            href="{{ route('frontend.knowledgebase.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">
                                                            <i class="ti-eye"></i>
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

            $('.table-wrap > table').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });

    </script>
@endsection
