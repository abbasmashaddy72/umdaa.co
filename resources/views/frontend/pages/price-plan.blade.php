@extends('frontend.frontend-page-master')
@section('site-title')
    {{ 'Pricing' }}
@endsection
@section('page-title')
    {{ 'Pricing' }}
@endsection
@section('style')
    <style>
        /* medium - display 2  */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(50%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-50%);
            }
        }

        /* large - display 3 */
        @media (min-width: 992px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next {
                transform: translateX(33%);
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-inner .carousel-item-prev {
                transform: translateX(-33%);
            }
        }

        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left {
            transform: translateX(0);
        }
        .carousel-control-prev {
            left: -70px;
        }
        .carousel-control-next {
            right: -70px;
        }
    </style>
@endsection
@section('content')
    <section class="price-plan-page-content  padding-top-110 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h2 class="title">{{ get_static_option('price_plan_page_section_title') }}</h2>
                        <p>{{ get_static_option('price_plan_page_section_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mx-auto my-auto">
                <div id="myCarousel" class="carousel slide w-100">
                    <div class="carousel-inner w-100" role="listbox">
                        @foreach ($all_price_plan as $key => $data)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <div class="col-lg-4 col-md-6">
                                    <div class="pricing-table-15 margin-bottom-30">
                                        <div class="price-header">
                                            <div class="icon"><i class="{{ $data->icon }}"></i></div>
                                            <h3 class="title">{{ $data->title }}</h3>
                                        </div>
                                        <div class="price">
                                            <span class="dollar"></span>{{ $data->price }}<span
                                                class="month">{{ $data->type }}</span>
                                        </div>
                                        <div class="price-body">
                                            <ul>
                                                @php
                                                    $features = explode(';', $data->features);
                                                @endphp
                                                @foreach ($features as $item)
                                                    <li>{!! $item !!}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="price-footer">
                                            @if (!empty($data->url_status))
                                                <a class="order-btn"
                                                    href="{{ route('frontend.plan.order', $data->id) }}">{{ $data->btn_text }}</a>
                                            @else
                                                <a class="order-btn"
                                                    href="{{ $data->btn_url }}">{{ $data->btn_text }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $('#myCarousel').carousel({
            interval: false,
        })

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });

    </script>
    <script>
        $('.carousel').on('touchstart', function(event) {
            const xClick = event.originalEvent.touches[0].pageX;
            $(this).one('touchmove', function(event) {
                const xMove = event.originalEvent.touches[0].pageX;
                const sensitivityInPx = 5;

                if (Math.floor(xClick - xMove) > sensitivityInPx) {
                    $(this).carousel('next');
                } else if (Math.floor(xClick - xMove) < -sensitivityInPx) {
                    $(this).carousel('prev');
                }
            });
            $(this).on('touchend', function() {
                $(this).off('touchmove');
            });
        });

    </script>
@endsection
