@extends('frontend.frontend-page-master')
@section('og-meta')
    <meta property="og:title" content="{{ $page_post->title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ $page_post->meta_description }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $page_post->title }}" />
    <meta name="twitter:description" content="{{ $page_post->meta_description }}" />
    <meta name="description" content="{{ $page_post->meta_description }}">
    <meta property="type" content="website" />
    <meta property="title" content="{{ $page_post->title }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection
@section('site-title')
    {{ $page_post->title }}
@endsection
@section('site-meta')
    <meta name="keywords" content="{{ $page_post->meta_tags }}">
@endsection
@section('page-title')
    {{ $page_post->title }}
@endsection
@section('content')
    <section class="dynamic-page-content-area padding-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dynamic-page-content-wrap">
                        {!! $page_post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
