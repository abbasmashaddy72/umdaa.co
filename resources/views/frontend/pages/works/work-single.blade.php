@extends('frontend.frontend-page-master')
@section('og-meta')
    <meta property="og:title" content="{{ $work_item->title }}" />
    <meta property="og:url" content="{{ route('frontend.work.single', ['id' => $work_item->id, 'any' => Str::slug($work_item->title)]) }}" />
    <meta property="og:type" content="website" />
    @if (file_exists('assets/uploads/works/work-large-'.$work_item->id.'.'.$work_item->image))
        <meta property="og:image" content="{{ asset('assets/uploads/works/work-large-'.$work_item->id.'.'.$work_item->image) }}" />
    @endif
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $work_item->title }}" />
    <meta name="twitter:url" content="{{ route('frontend.work.single', ['id' => $work_item->id, 'any' => Str::slug($work_item->title)]) }}" />
    @if (file_exists('assets/uploads/works/work-large-'.$work_item->id.'.'.$work_item->image))
        <meta name="twitter:image" content="{{ asset('assets/uploads/works/work-large-'.$work_item->id.'.'.$work_item->image) }}" />
    @endif
    <meta property="url" content="{{ route('frontend.work.single', ['id' => $work_item->id, 'any' => Str::slug($work_item->title)]) }}" />
    <meta property="type" content="website" />
    <meta property="title" content="{{ $work_item->title }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (file_exists('assets/uploads/works/work-large-'.$work_item->id.'.'.$work_item->image))
        <meta name="image" content="{{ asset('assets/uploads/works/work-large-'.$work_item->id.'.'.$work_item->image) }}" />
    @endif
@endsection
@section('site-title')
    {{ $work_item->title }} - {{ 'Work' }}
@endsection
@section('page-title')
    {{ 'Work' }}: {{ $work_item->title }}
@endsection
@section('content')
    <div class="work-details-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="portfolio-details-item">
                        <div class="thumb">
                            @php $img_url = '';@endphp
                            @php
                                $work_image = get_attachment_image_by_id($work_item->image, 'large', false);
                                $img_url = $work_image['img_url'];
                            @endphp
                            @if (!empty($work_image))
                                <img src="{{ $work_image['img_url'] }}" alt="{{ $work_item->name }}">
                            @endif
                        </div>
                        <h2 class="main-title">{{ $work_item->title }}</h2>
                        <div class="post-description">
                            {!! $work_item->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="project-widget">
                        <div class="project-info-item">
                            <h4 class="title">{{ 'Project Details' }}</h4>
                            <ul>
                                <li>{{ 'Start Date:' }} <span class="right">{{ $work_item->start_date }} </span></li>
                                <li>{{ 'End Date:' }} <span class="right"> {{ $work_item->end_date }}</span></li>
                                <li>{{ 'Clients:' }} <span class="right">{{ $work_item->clients }} </span></li>
                                <li>{{ 'Category:' }} <span class="right">
                                        @php
                                            $all_cat_of_post = get_work_category_by_id($work_item->id);
                                        @endphp
                                        @foreach ($all_cat_of_post as $key => $work_cat)
                                            <a
                                                href="{{ route('frontend.works.category', ['id' => $key, 'any' => Str::slug($work_cat)]) }}">{{ $work_cat }}</a>
                                        @endforeach
                                    </span></li>
                            </ul>
                            <div class="share-area">
                                <h4 class="title">{{ 'Share' }}</h4>
                                <ul class="share-icon">
                                    {!! single_post_share(route('frontend.work.single', ['id' => $work_item->id, 'any' => Str::slug($work_item->title)]), $work_item->title, $img_url) !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="related-work-area padding-top-100">
                        <div class="section-title margin-bottom-55">
                            <h2 class="title">{{ 'Related' }}</h2>
                        </div>
                        <div class="our-work-carousel">
                            @foreach ($related_works as $data)
                                <div class="single-work-item">
                                    <div class="thumb">
                                        @php
                                            $related_work_image = get_attachment_image_by_id($data->image, 'grid', false);
                                        @endphp
                                        @if (!empty($related_work_image))
                                            <img src="{{ $related_work_image['img_url'] }}" alt="{{ $data->name }}">
                                        @endif
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><a
                                                href="{{ route('frontend.work.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">
                                                {{ $data->title }}</a></h4>
                                        <div class="cats">
                                            @php
                                                $all_cat_of_post = get_work_category_by_id($data->id);
                                            @endphp
                                            @foreach ($all_cat_of_post as $key => $work_cat)
                                                <a
                                                    href="{{ route('frontend.works.category', ['id' => $key, 'any' => Str::slug($work_cat)]) }}">{{ $work_cat }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
