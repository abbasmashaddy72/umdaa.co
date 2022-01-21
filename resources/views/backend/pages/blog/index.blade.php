@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
@endsection
@section('site-title')
    {{__('Blog Page')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="mt-5 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Blog Items')}}</h4>

                        <div class="tab-content margin-top-40" id="myTabContent">
                                <div class="tab-pane fade show active" role="tabpanel" >
                                    <div class="table-wrap table-responsive">
                                    <table class="table table-default" id="all_blog_table">
                                        <thead>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Posted By')}}</th>
                                        <th>{{__('Category')}}</th>
                                        <th>{{__('Excerpt')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($all_blog as $data)
                                            <tr>
                                                <td>{{$data->article_id}}</td>
                                                <td>{{$data->article_title}}</td>
                                                <td>
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                            @if ($data->article_type == 'video' || $data->article_type == 'Video')
                                                                @if(!empty($data->category->department_name))
                                                                <img  class="avatar user-thumb" src="{{ $data->article_image != '' ? $data->article_image : url('assets/uploads/default/'.$data->category->department_name.'.jpg') }}" style="height:216px; width:100%; object-fit:cover;">
                                                                @endif
                                                                @elseif ($data->article_type == 'pdf')
                                                                @if(!empty($data->category->department_name))
                                                                <img  class="avatar user-thumb" src={{ url('assets/uploads/default/'.$data->category->department_name.'.jpg') }} style="height:216px; width:100%; object-fit:cover;" >
                                                                @endif
                                                            @else
                                                                <img  class="avatar user-thumb" src="{{ $data->posted_url != '' ? ('https://clinic.umdaa.co/uploads/article_images/'.$data->posted_url) : url('assets/uploads/default/'.$data->category->department_name.'.jpg') }}" style="height:216px; width:100%; object-fit:cover;">
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>@if(!empty($data->users->user_type)) {{$data->users->user_type}} @endif</td>
                                                <td>@if(!empty($data->category->department_name)) {{$data->category->department_name}} @endif</td>
                                                <td>{{$data->short_description}}</td>
                                                <td>
                                                    <a tabindex="0" class="mb-3 mr-1 btn btn-lg btn-danger btn-sm"
                                                       role="button"
                                                       data-toggle="popover"
                                                       data-trigger="focus"
                                                       data-html="true"
                                                       title=""
                                                       data-content="
                                                       <h6>Are you sure to delete this blog post?</h6>
                                                       <form method='post' action='{{route('admin.blog.delete',$data->article_id)}}'>
                                                       <input type='hidden' name='_token' value='{{csrf_token()}}'>
                                                       <br>
                                                        <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                        </form>
                                                        ">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                    <a class="mb-3 mr-1 btn btn-lg btn-primary btn-sm" href="{{route('admin.blog.edit',$data->article_id)}}">
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
