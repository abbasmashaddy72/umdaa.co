@extends('backend.admin-master')

@section('site-title')
    {{ 'Newsletter Area' }}
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
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Newsletter Area Settings' }}</h4>
                        <form action="{{ route('admin.homeone.newsletter') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="myTabContent">
                                <div class="tab-pane fade show active" role="tabpanel">
                                    <div class="form-group">
                                        <label for="home_page_01_newsletter_area_title">{{ 'Title' }}</label>
                                        <input type="text" name="home_page_01_newsletter_area_title" class="form-control"
                                            value="{{ get_static_option('home_page_01_newsletter_area_title') }}"
                                            id="home_page_01_newsletter_area_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_newsletter_area_description">{{ 'Description' }}</label>
                                        <textarea name="home_page_01_newsletter_area_description"
                                            class="form-control max-height-150" rows="10"
                                            id="home_page_01_newsletter_area_description">{{ get_static_option('home_page_01_newsletter_area_description') }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Settings' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
