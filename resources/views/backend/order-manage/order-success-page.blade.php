@extends('backend.admin-master')
@section('site-title')
    {{ 'Order Success Page Settings' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Order Success Page Settings' }}</h4>
                        <form action="{{ route('admin.order.success.page') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="site_order_success_page_title">{{ 'Main Title' }}</label>
                                        <input type="text" name="site_order_success_page_title" class="form-control"
                                            value="{{ get_static_option('site_order_success_page_title') }}"
                                            id="site_order_success_page_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="site_order_success_page_subtitle">{{ 'Subtitle' }}</label>
                                        <input type="text" name="site_order_success_page_subtitle" class="form-control"
                                            value="{{ get_static_option('site_order_success_page_subtitle') }}"
                                            id="site_order_success_page_subtitle">
                                        <small class="info-text">{{ '{pkname} will be replaced by package name' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="site_order_success_page_description">{{ 'Description' }}</label>
                                        <textarea name="site_order_success_page_description" class="form-control"
                                            id="site_order_success_page_description" cols="30"
                                            rows="10">{{ get_static_option('site_order_success_page_description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Changes' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
