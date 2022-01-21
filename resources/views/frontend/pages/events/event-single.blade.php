@extends('frontend.frontend-page-master')
@php
    $event_images = !empty($event->image) ? get_attachment_image_by_id($event->image, 'thumb', false) : '';
@endphp
@section('og-meta')
    <meta property="og:title" content="{{ $event->title }}" />
    <meta property="og:url" content="{{ route('frontend.blog.single', ['id' => $event->id, 'any' => Str::slug($event->title)]) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="{{ Illuminate\Support\Str::limit($event->content, 100) }}" />
    <meta property="og:image" content="{{ $event_images['img_url'] }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $event->title }}" />
    <meta name="twitter:description" content="{{ Illuminate\Support\Str::limit($event->content, 100) }}" />
    <meta name="twitter:url"
        content="{{ route('frontend.blog.single', ['id' => $event->id, 'any' => Str::slug($event->title)]) }}" />
    <meta name="twitter:image" content="{{ $event_images['img_url'] }}" />
    <meta name="description" content="{{ Illuminate\Support\Str::limit($event->content, 100) }}">
    <meta name="keywords" content="{{ $event->tags }}">
    <meta property="url"
        content="{{ route('frontend.blog.single', ['id' => $event->id, 'any' => Str::slug($event->title)]) }}" />
    <meta property="type" content="website" />
    <meta property="title" content="{{ $event->title }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="image" content="{{ $event_images['img_url'] }}" />
@endsection
@section('site-title')
    {{ $event->title }}
@endsection
@section('page-title')
    {{ $event->title }}
@endsection
@section('style')
    <style>
        ol li {
            list-style: inherit;
            margin-bottom: 1rem;
        }
        ol li:before {
            content: none;
            font-weight: 500;
            margin-right: 10px;
        }
    </style>
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-event-details">
                        @php
                            $event_image = !empty($event->image) ? get_attachment_image_by_id($event->image, 'full', false) : '';
                        @endphp
                        @if (!empty($event_image))
                            <div class="thumb">
                                <img src="{{ $event_image['img_url'] }}" alt="{{ $event->title }}">
                            </div>
                        @endif
                        <div class="content">
                            <div class="top-part">
                                <div class="time-wrap">
                                    <span class="date">{{ date('d', strtotime($event->date)) }}</span>
                                    <span class="month">{{ date('M', strtotime($event->date)) }}</span>
                                </div>
                                <div class="title-wrap">
                                    <span class="category">{{ $event->category->title }}</span>
                                    <span class="location"><i class="fas fa-map-marker-alt"></i>
                                        {{ $event->location }}</span>
                                </div>
                            </div>
                            <h3 class="margin-bottom-60"><b>{{ $event->title }}</b></h3>
                            <div class="details-content-area" style="text-align: justify">
                                {!! $event->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="widget widget_search">
                            <form action="{{ route('frontend.events.search') }}" method="get" class="search-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="{{ 'Search...' }}">
                                </div>
                                <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_nav_menu">
                            <h2 class="widget-title">{{ get_static_option('site_events_category_title') }}</h2>
                            <ul>
                                @foreach ($all_event_category as $data)
                                    <li><a
                                            href="{{ route('frontend.events.category', ['id' => $data->id, 'any' => Str::slug($data->title, '-')]) }}">{{ ucfirst($data->title) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
