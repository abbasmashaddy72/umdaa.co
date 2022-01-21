@extends('backend.admin-master')
@section('site-title')
    {{('Service Area')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
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
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{('Service Area Settings')}}</h4>
                        <form action="{{route('admin.homeone.service.area')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="myTabContent">
                                <div class="tab-pane fade show active" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_01_service_area_title">{{('Title')}}</label>
                                        <input type="text" name="home_page_01_service_area_title" class="form-control" value="{{get_static_option('home_page_01_service_area_title')}}" id="home_page_01_service_area_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_service_area_description">{{('Description')}}</label>
                                        <textarea name="home_page_01_service_area_description" class="form-control max-height-150" id="home_page_01_service_area_description" cols="30" rows="10">{{get_static_option('home_page_01_service_area_description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
