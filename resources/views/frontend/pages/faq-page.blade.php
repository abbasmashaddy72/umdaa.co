@extends('frontend.frontend-page-master')
@section('site-title')
    {{ 'FAQs' }}
@endsection
@section('page-title')
    {{ 'FAQs' }}
@endsection
@section('content')
    <div class="faq-page-content-area padding-120">
        <div class="container">
            <div class="row">
                @foreach ($all_faqs->chunk(100) as $chunked_faq)
                    <div class="col-lg-12">
                        <div class="accordion-wrapper">
                            @php $rand_number = rand(9999,99999999); @endphp
                            <div id="accordion_{{ $rand_number }}">
                                @foreach ($all_faqs as $key => $data)
                                    @php
                                        $aria_expanded = 'false';
                                        if ($data->is_open == 'on') {
                                            $aria_expanded = 'true';
                                        }
                                    @endphp
                                    <div class="card">
                                        <div class="card-header" id="headingOne_{{ $key }}">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" data-target="#collapseOne_{{ $key }}"
                                                    role="button" aria-expanded="{{ $aria_expanded }}"
                                                    aria-controls="collapseOne_{{ $key }}">
                                                    {{ $data->title }}
                                                </a>
                                            </h5>
                                        </div>

                                        <div id="collapseOne_{{ $key }}" class="collapse @if ($data->is_open == 'on') show @endif "
                                            aria-labelledby="headingOne_{{ $key }}"
                                            data-parent="#accordion_{{ $rand_number }}">
                                            <div class="card-body">
                                                {{ $data->description }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
