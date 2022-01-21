@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Register For') }} {{ ' : ' . $order_details->title }}
@endsection
@section('site-title')
    {{ $order_details->title }} - {{ get_static_option('price_plan_page_name') }}
@endsection

@section('style')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css'
        crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css'
        crossorigin="anonymous">
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #f4f7fc;
            height: 50px;
            border: none;
            border-radius: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 300%;
            color: #495057;
            margin-left: 5%;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            top: 90%;
        }

        .select2-dropdown {
            background-color: #f4f7fc;
            border: none;
            border-radius: none;
        }

        .form-row .eye {
            cursor: pointer;
            position: absolute;
            margin-top: -14%;
            margin-left: 80%;
        }

        @media screen and (min-width: 320px) {
            .form-row .eye {
                margin-top: -20%;
                margin-left: 76%;
            }
        }

        @media screen and (min-width: 375px) {
            .form-row .eye {
                margin-top: -18%;
            }
        }

        @media screen and (min-width: 425px) {
            .form-row .eye {
                margin-top: -16%;
            }
        }

        @media screen and (min-width: 768px) {
            .form-row .eye {
                margin-left: 87%;
                margin-top: -9%;
            }
        }

        @media screen and (min-width: 1024px) {
            .form-row .eye {
                margin-left: 83%;
                margin-top: -12%;
            }
        }

    </style>
@endsection
@section('content')
    <section class="order-service-page-content-area padding-100">
        <div class="container">
            <div class="row reorder-xs justify-content-between ">
                <div class="col-lg-6">
                    <div class="order-content-area padding-top-70">
                        <h3 class="order-title">{{ 'Registration' }}</h3>
                        @include('backend.partials.message')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('frontend.order.message') }}" method="post" enctype="multipart/form-data"
                            class="contact-form order-form"
                            oninput='password2.setCustomValidity(password2.value != password.value ? "Passwords do not match." : "")'>
                            @csrf
                            <input type="hidden" name="package" value="{{ $order_details->id }}">
                            @if( $order_details->id == 2 )
                                <input type="hidden" name="selected_payment_gateway" value="manual_payment" >
                            @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    @include('frontend.pages.register')
                                    @if( $order_details->id != 2 )
                                    @if (!empty(get_static_option('site_payment_gateway')))
                                        <div class="payment-gateway-wrapper margin-top-20">
                                            <small>Select Cheque for Free Registration.</small>
                                            <input type="hidden" name="selected_payment_gateway" value="">
                                            <ul>
                                                <label class="text-body">
                                                    {{ 'Payment Gateway:' }}
                                                </label>
                                                @if (!empty(get_static_option('paytm_gateway')))
                                                    <li data-gateway="paytm">
                                                        <div class="img-select">
                                                            @php
                                                                $paytm_logo = get_attachment_image_by_id(get_static_option('paytm_preview_logo'), 'full', false);
                                                            @endphp
                                                            @if (!empty($paytm_logo))
                                                                <img src="{{ $paytm_logo['img_url'] }}" alt="site logo">
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endif
                                                @if (!empty(get_static_option('manual_payment_gateway')))
                                                    <li data-gateway="manual_payment">
                                                        <div class="img-select">
                                                            @php
                                                                $manual_payment_logo = get_attachment_image_by_id(get_static_option('manual_payment_preview_logo'), 'full', false);
                                                            @endphp
                                                            @if (!empty($manual_payment_logo))
                                                                <img src="{{ $manual_payment_logo['img_url'] }}"
                                                                    alt="site logo">
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @else
                                        <div class="col-lg-12 mx-auto">
                                            <div class="alert alert-warning d-block">
                                                {{ __('No Payment Gateway Found Contact +91-9100948181') }}</div>
                                        </div>
                                    @endif
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <button class="submit-btn" type="submit">{{ __('Register') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content-area">
                        <div class="pricing-table-15">
                            <div class="price-header">
                                <div class="icon"><i class="{{ $order_details->icon }}"></i></div>
                                <h3 class="title">{{ $order_details->title }}</h3>
                            </div>
                            <div class="price">
                                <span class="dollar"></span>{{ $order_details->price }}<span
                                    class="month">{{ $order_details->type }}</span>
                            </div>
                            <div class="price-body">
                                <ul>
                                    @php
                                        $features = explode(';', $order_details->features);
                                    @endphp
                                    @foreach ($features as $item)
                                        <li>{!! $item !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="price-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@if( $order_details->id != 2 )
    <script>
        $(document).ready(function($) {
            $('.payment-gateway-wrapper ul > li:first-child').addClass('').siblings().removeClass('');
            $(document).on('click', '.payment-gateway-wrapper > ul > li', function(e) {
                e.preventDefault();
                $(this).addClass('selected').siblings().removeClass('selected');
                $('.payment-gateway-wrapper').find(('input')).val($(this).data('gateway'));
            })
        });

    </script>
@endif
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js' crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js' crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".responsiveChosen").chosen({
                width: "50%"
            });
            $(".responsiveSelect2").select2();
        });

    </script>
    <script>
        $("#clinichospital").change(function() {
            if ($(this).val() == "New Clinic") {
                $('#newclinichospital').show();
                $('#clinicname').attr('required', '');
                $('#location').attr('required', '');
            } else {
                $('#newclinichospital').hide();
                $('#clinicname').removeAttr('required');
                $('#location').removeAttr('required');
            }
        });
        $("#clinichospital").trigger("change");

    </script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

    </script>
@endsection
