@extends('backend.admin-master')
@section('site-title')
    {{ 'Price Plan Page Settings' }}
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
                        <h4 class="header-title">{{ 'Price Plan Page Settings' }}</h4>
                        <form action="{{ route('admin.price.plan.page.settings') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="price_plan_page _section_title">{{ 'Section Title' }}</label>
                                        <input type="text" name="price_plan_page _section_title"
                                            value="{{ get_static_option('price_plan_page_section_title') }}"
                                            class="form-control" id="price_plan_page _section_title">
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="price_plan_page _section_description">{{ 'Section Description' }}</label>
                                        <textarea name="price_plan_page _section_description"
                                            class="form-control max-height-150" id="price_plan_page _section_description"
                                            cols="30"
                                            rows="10">{{ get_static_option('price_plan_page_section_description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price_plan_page_items">{{ 'Price Plan Page Items' }}</label>
                                <input type="text" name="price_plan_page_items"
                                    value="{{ get_static_option('price_plan_page_items') }}" class="form-control"
                                    id="price_plan_page_items">
                                <small>{{ 'enter how many plan you want to show in the price plan page' }}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Settings' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
