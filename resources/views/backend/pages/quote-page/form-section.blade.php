@extends('backend.admin-master')
@section('site-title')
    {{ 'Quote Page Settings' }}
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
                        <h4 class="header-title">{{ 'Quote Page Settings' }}</h4>
                        <form action="{{ route('admin.quote.page') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel">
                                    <div class="form-group">
                                        <label for="quote_page _page_title">{{ 'Quote Page Title' }}</label>
                                        <input type="text" name="quote_page _page_title"
                                            value="{{ get_static_option('quote_page_page_title') }}" class="form-control"
                                            id="quote_page _page_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="quote_page _form_title">{{ 'Quote Form Title' }}</label>
                                        <input type="text" name="quote_page _form_title"
                                            value="{{ get_static_option('quote_page_form_title') }}" class="form-control"
                                            id="quote_page _form_title">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quote_page_form_mail">{{ 'Email Address For Quote Message' }}</label>
                                <input type="text" name="quote_page_form_mail"
                                    value="{{ get_static_option('quote_page_form_mail') }}" class="form-control"
                                    id="quote_page_form_mail">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Settings' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
