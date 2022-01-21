@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Confirm Registration Confirm') }}
@endsection
@section('site-title')
    {{ __('Confirm Registration Confirm') }}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-confirm-area">
                        <h4 class="title">{{ __('Confirm Registration Details') }}</h4>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('frontend.order.payment.form') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @php
                                $custom_fields = unserialize($order_details->custom_fields);
                                $first_name = !empty($custom_fields['firstname']) ? $custom_fields['firstname'] : '';
                                $last_name = !empty($custom_fields['lastname']) ? $custom_fields['lastname'] : '';
                                $name = $first_name . ' ' . $last_name;
                                $phone_number = !empty($custom_fields['phonenumber']) ? $custom_fields['phonenumber'] : '';
                                $email = !empty($custom_fields['email']) ? $custom_fields['email'] : '';
                                $qualification = !empty($custom_fields['qualification']) ? $custom_fields['qualification'] : '';
                                $reg_number = !empty($custom_fields['regnumber']) ? $custom_fields['regnumber'] : '';
                                $clinic_hospital = !empty($custom_fields['clinichospital']) ? $custom_fields['clinichospital'] : '';
                                $clinic_name = !empty($custom_fields['clinicname']) ? $custom_fields['clinicname'] : '';
                                $location = !empty($custom_fields['location']) ? $custom_fields['location'] : '';
                                $password = !empty($custom_fields['password']) ? $custom_fields['password'] : '';
                                $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';
                            @endphp
                            <input type="hidden" name="name" value="{{ $name }}">
                            <input type="hidden" name="firstname" value="{{ $first_name }}">
                            <input type="hidden" name="lastname" value="{{ $last_name }}">
                            <input type="hidden" name="phonenumber" value="{{ $phone_number }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="qualification" value="{{ $qualification }}">
                            <input type="hidden" name="regnumber" value="{{ $reg_number }}">
                            @foreach ($clinics as $cli)
                            <input type="hidden" name="clinichospital" value="{{ $cli->clinic_id }}">
                            @endforeach
                            <input type="hidden" name="clinicname" value="{{ $clinic_name }}">
                            <input type="hidden" name="location" value="{{ $location }}">
                            @foreach ($deptartment as $dep)
                                <input type="hidden" name="department" value="{{ $dep->department_id }}">
                            @endforeach
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="password" value="{{ $password }}">
                            <input type="hidden" name="order_id" value="{{ $order_details->id }}">
                            <input type="hidden" name="payment_gateway" value="{{ $payment_gateway }}">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>{{ __('Name') }}</td>
                                        <td>{{ $name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Mobile Number') }}</td>
                                        <td>{{ $phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Email') }}</td>
                                        <td>{{ $email }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Qualification') }}</td>
                                        <td>{{ $qualification }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Registration Number') }}</td>
                                        <td>{{ $reg_number }}</td>
                                    </tr>
                                    @if ($clinic_hospital != 'New Clinic')
                                        <tr>
                                            <td>{{ __('Clinic/Hospital Name') }}</td>
                                            @foreach ($clinics as $cli)
                                                <td>{{ $cli->clinic_name }}</td>
                                            @endforeach
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ __('New Clinic/Hospital Name') }}</td>
                                            <td>{{ $clinic_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('New Clinic/Hospital Location') }}</td>
                                            <td>{{ $location }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>{{ __('Department') }}</td>
                                        @foreach ($deptartment as $dep)
                                            <td>{{ $dep->department_name }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>{{ __('Package Name') }}</td>
                                        <td>{{ $order_details->package_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Package Price') }}</td>
                                        <td>{{ $order_details->package_price }}</td>
                                    </tr>
                                    @if($order_details->package_price != 'Free')
                                    <tr>
                                        @php $gstpackage_price = $order_details->package_price * '0.18' @endphp
                                        <td>{{ __('GST 18%') }}</td>
                                        <td>{{ $gstpackage_price }}</td>
                                    </tr>
                                    <tr>
                                        @php $wgstpackage_price = $order_details->package_price * '1.18' @endphp
                                        <td>{{ __('Total Amount Payable') }}</td>
                                        <td>{{ $wgstpackage_price }}</td>
                                    </tr>
                                    @endif
                                    @if( $order_details->package_price != 'Free' )
                                    <tr>
                                        <td>{{ __('Selected Payment Gateway') }}</td>
                                        <td class="text-capitalize">
                                            @if ($payment_gateway == 'manual_payment')
                                                {{ get_static_option('site_manual_payment_name') }}
                                            @else
                                                {{ $payment_gateway }}
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($payment_gateway == 'manual_payment')
                                        <tr>
                                            <td>{{ __('Cheque Details') }}</td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea type="text" name="trasaction_id" class="form-control"
                                                        rows="3"></textarea>
                                                    <small>{!! 'Please enter CHEQUE details here.<br>Example.: Date, Bank & Cheque No.' !!}</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @endif
                                </table>
                            </div>
                            <div class="btn-wrapper">
                                <button type="submit" class="submit-btn">{{ __('Confirm Registration Details') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Registration Failed</h5>
                </div>
                <div class="modal-body"></div>
                @php
                    if ($order_details->package_name == 'Freemium') {
                        $planid = 2;
                    } elseif ($order_details->package_name == 'Basic') {
                        $planid = 3;
                    } elseif ($order_details->package_name == 'Premium') {
                        $planid = 4;
                    } else {
                        $planid = 5;
                    }
                @endphp
                <div class="modal-footer">
                    <a href="{{ route('frontend.plan.order', $planid) }}"
                        class="btn btn-secondary">{{ __('Register Again') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (session('message'))
        <script>
            $(function() {
                var body = '{{ session('message') }}';
                $('.modal-body').html(body);
                $('#exampleModalCenter').modal('show');
            });

        </script>
    @endif
@endsection
