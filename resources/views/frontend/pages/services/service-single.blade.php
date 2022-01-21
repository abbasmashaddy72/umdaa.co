@extends('frontend.frontend-page-master')
@section('og-meta')
    <meta property="og:title" content="{{ $service_item->title }}" />
    <meta property="og:url" content="{{ route('frontend.services.single', ['id' => $service_item->id, 'any' => Str::slug($service_item->title)]) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{$service_item->excerpt}}" />
    @if (file_exists('assets/uploads/services/service-large-' . $service_item->id . '.' . $service_item->image))
        <meta property="og:image" content="{{ asset('assets/uploads/services/service-large-' . $service_item->id . '.' . $service_item->image) }}" />
    @endif
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $service_item->title }}" />
    <meta name="twitter:description" content="{{$service_item->excerpt}}" />
    <meta name="twitter:url" content="{{ route('frontend.services.single', ['id' => $service_item->id, 'any' => Str::slug($service_item->title)]) }}" />
    @if (file_exists('assets/uploads/services/service-large-' . $service_item->id . '.' . $service_item->image))
        <meta name="twitter:image" content="{{ asset('assets/uploads/services/service-large-' . $service_item->id . '.' . $service_item->image) }}" />
    @endif
    <meta name="description" content="{{$service_item->excerpt}}">
    <meta name="keywords" content="{{$service_item->tags}}">
    <meta property="url" content="{{ route('frontend.services.single', ['id' => $service_item->id, 'any' => Str::slug($service_item->title)]) }}" />
    <meta property="type" content="website" />
    <meta property="title" content="{{ $service_item->title }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (file_exists('assets/uploads/services/service-large-' . $service_item->id . '.' . $service_item->image))
        <meta name="image" content="{{ asset('assets/uploads/services/service-large-' . $service_item->id . '.' . $service_item->image) }}" />
    @endif
@endsection
@section('site-title')
    {{ $service_item->title }} - {{ 'Services' }}
@endsection
@section('page-title')
    {{ 'Services' }}: {{ $service_item->title }}
@endsection
@section('content')

    <div class="page-content service-details padding-top-120 padding-bottom-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="service-details-item">
                        <div class="thumb">
                            @if (!empty($service_image))
                            @php
                                $service_image = get_attachment_image_by_id($service_item->image, 'large', false);
                            @endphp
                                <img src="{{ $service_image['img_url'] }}" alt="{{ $service_item->name }}">
                            @endif
                        </div>
                        <h2 class="main-title">{{ $service_item->title }}</h2>
                        <div class="service-description">
                            {!! $service_item->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-widget">
                        <div class="widget widget_nav_menu">
                            <h3 class="widget-title">{{ 'Services' }}</h3>
                            <ul>
                                @foreach ($service_category as $data)
                                    <li @if ($data->id == $service_item->category->department_id) class="active" @endif><a
                                            href="{{ route('frontend.services.category', ['id' => $data->department_id, 'any' => Str::slug($data->department_name)]) }}">{{ $data->department_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
