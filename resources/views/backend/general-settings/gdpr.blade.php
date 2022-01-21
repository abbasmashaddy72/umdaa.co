@extends('backend.admin-master')
@section('site-title')
    {{ 'GDPR Compliant Cookie Settings' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'GDPR Compliant Cookie Settings' }}</h4>
                        <form action="{{ route('admin.general.gdpr.settings') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="site_gdpr_cookie_title">{{ 'GDPR Title' }}</label>
                                        <input type="text" name="site_gdpr_cookie_title" class="form-control"
                                            value="{{ get_static_option('site_gdpr_cookie_title') }}"
                                            id="site_gdpr_cookie_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="site_gdpr_cookie_message">{{ 'GDPR Message' }}</label>
                                        <textarea name="site_gdpr_cookie_message" class="form-control" rows="5"
                                            id="site_gdpr_cookie_message">{{ get_static_option('site_gdpr_cookie_message') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="site_gdpr_cookie_more_info_label">{{ 'GDPR More Info Link Label' }}</label>
                                        <input type="text" name="site_gdpr_cookie_more_info_label" class="form-control"
                                            value="{{ get_static_option('site_gdpr_cookie_more_info_label') }}"
                                            id="site_gdpr_cookie_more_info_label">
                                    </div>
                                    <div class="form-group">
                                        <label for="site_gdpr_cookie_more_info_link">{{ 'GDPR More Info Link' }}</label>
                                        <input type="text" name="site_gdpr_cookie_more_info_link" class="form-control"
                                            value="{{ get_static_option('site_gdpr_cookie_more_info_link') }}"
                                            id="site_gdpr_cookie_more_info_link">
                                        <small
                                            class="form-text text-muted">{{ 'enter more info link user {url} to point the site address, example: {url}/about , it will be converted to www.yoursite.com/about' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="site_gdpr_cookie_accept_button_label">{{ 'GDPR Cookie Accept Button Label' }}</label>
                                        <input type="text" name="site_gdpr_cookie_accept_button_label" class="form-control"
                                            value="{{ get_static_option('site_gdpr_cookie_accept_button_label') }}"
                                            id="site_gdpr_cookie_accept_button_label">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label
                                    for="site_gdpr_cookie_enabled"><strong>{{ 'GDPR Cookie Enable/Disable' }}</strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="site_gdpr_cookie_enabled" @if (!empty(get_static_option('site_gdpr_cookie_enabled'))) checked @endif id="site_gdpr_cookie_enabled">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_expire">{{ 'Cookie Expire' }}</label>
                                <input type="text" name="site_gdpr_cookie_expire" class="form-control"
                                    value="{{ get_static_option('site_gdpr_cookie_expire') }}"
                                    id="site_gdpr_cookie_expire">
                                <small
                                    class="form-text text-muted">{{ 'set cookie expire time, eg: 30, means 30days' }}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_delay">{{ 'Show Delay' }}</label>
                                <input type="text" name="site_gdpr_cookie_delay" class="form-control"
                                    value="{{ get_static_option('site_gdpr_cookie_delay') }}" id="site_gdpr_cookie_delay">
                                <small
                                    class="form-text text-muted">{{ 'set GDPR cookie delay time, it mean the notification will show after this time. number count as mili seconds. eg: 5000, means 5seconds' }}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Changes' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
