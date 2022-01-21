@extends('frontend.frontend-page-master')
@section('site-title')
    {{ 'Quote Request' }}
@endsection
@section('page-title')
    {{ 'Quote Request' }}
@endsection
@section('content')
    <section class="order-service-page-content-area padding-100">
        <div class="container">
            <div class="row">
                @foreach ($all_contact_info as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info-02">
                            <div class="icon">
                                <i class="{{ $data->icon }}"></i>
                            </div>
                            <div class="content">
                                <h4 class="title">{{ $data->title }}</h4>
                                @php $desc = explode(';',$data->description) @endphp
                                @foreach ($desc as $item)
                                    <span class="details">{{ $item }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="quote-content-area padding-top-70">
                        <h3 class="quote-title">{{ get_static_option('quote_page_form_title') }}</h3>
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
                        <form action="{{ route('frontend.quote.message') }}" method="post" enctype="multipart/form-data"
                            class="contact-form quote-form">
                            @csrf
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <div class="row">
                                <div class="col-lg-12">
                                    @php
                                        $form_fields = json_decode(get_static_option('quote_page_form_fields'));
                                        $select_index = 0;
                                        $options = [];
                                    @endphp
                                    @foreach ($form_fields->field_type as $key => $value)
                                        @if (!empty($value))
                                            @if ($value == 'select') @php $options = explode(';',$form_fields->select_options[$select_index]);@endphp
                                            @endif
                                            @php $required = isset($form_fields->field_required->$key) ? $form_fields->field_required->$key : '' @endphp
                                            @php $mimes = isset($form_fields->mimes_type->$key) ? $form_fields->mimes_type->$key : '' @endphp
                                            {!! get_field_by_type($value, $form_fields->field_name[$key], $form_fields->field_placeholder[$key], $options, $required, $mimes) !!}
                                            @if ($value == 'select') @php $select_index++@endphp
                                            @endif
                                        @endif
                                    @endforeach
                                </div>

                                <div class="col-lg-12">
                                    <div class="btn-wrapper text-center">
                                        <button class="submit-btn" type="submit">{{ 'Send Quote' }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ '6Ld5wHMaAAAAAFBju32Zky6GNf8bZWyvOJme0JON' }}">
    </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ '6Ld5wHMaAAAAAFBju32Zky6GNf8bZWyvOJme0JON' }}", {
                action: 'homepage'
            }).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });

    </script>
@endsection
