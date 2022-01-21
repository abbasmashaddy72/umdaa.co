@extends('backend.admin-master')
@section('site-title')
    {{ 'Basic Settings' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Basic Settings' }}</h4>
                        <form action="{{ route('admin.general.basic.settings') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="whats_app_number">{{__('WhatsApp Number')}}</label>
                                <input type="text" name="whats_app_number" class="form-control" value="{{get_static_option('whats_app_number')}}" id="whats_app_number">
                            </div>
                            <div class="form-group">
                                <label for="whats_app_message">{{__('WhatsApp Message')}}</label>
                                <input type="text" name="whats_app_message" class="form-control" value="{{get_static_option('whats_app_message')}}" id="whats_app_message">
                            </div>
                            <div class="form-group">
                                <label for="site_maintenance_mode"><strong>{{ 'Maintenance Mode' }}</strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="site_maintenance_mode" @if (!empty(get_static_option('site_maintenance_mode'))) checked @endif id="site_maintenance_mode">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label
                                    for="site_payment_gateway"><strong>{{ 'Enable/Disable Payment Gateway' }}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="site_payment_gateway" @if (!empty(get_static_option('site_payment_gateway'))) checked @endif id="site_payment_gateway">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Changes' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
