@extends('frontend.frontend-page-master')
@section('site-title')
{{__('Registration Success For:'.' '.$order_details->package_name)}}
@endsection
@section('page-title')
{{__('Registration Success For:'.' '.$order_details->package_name)}}
@endsection
@section('content')
<div class="error-page-content padding-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="order-success-area">
                    <h1 class="title">{{get_static_option('site_order_success_page_title')}}</h1>
                    <h3 class="sub-title">
                        @php
                        $subtitle = get_static_option('site_order_success_page_subtitle');
                        $subtitle = str_replace('{pkname}',$order_details->package_name,$subtitle);
                        @endphp
                        {{$subtitle}}
                    </h3>
                    <p>{{get_static_option('site_order_success_page_description')}}</p>
                    <div class="btn-wrapper">
                        <a href="{{url('https://doctor.umdaa.co')}}" class="boxed-btn" target="_blank" >{{__('Login Now')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection