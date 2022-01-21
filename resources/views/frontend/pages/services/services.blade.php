@extends('frontend.frontend-page-master')
@section('page-title')
    {{ 'Service' }} {{ 'Category:' }} {{ $category_name }}
@endsection
@section('site-title')
    {{ 'Service' }} {{ 'Category:' }} {{ $category_name }}
@endsection
@section('content')
    <section class="blog-content-area padding-100">
        <div class="container">
            <div class="row">
                @if (empty($service_items))
                    <div class="col-lg-12">
                        <div class="alert alert-danger">{{ 'No Post Available In This Category' }}</div>
                    </div>
                @else
                @foreach ($service_items as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-work-item-02 margin-bottom-30 gray-bg">
                            <div class="thumb">
                                @if (!empty($service_image))
                                @php
                                    $service_image = get_attachment_image_by_id($data->image, 'grid', false);
                                @endphp
                                    <img src="{{ $service_image['img_url'] }}" alt="{{ $data->name }}">
                                @endif
                            </div>
                            <div class="content">
                                <a
                                    href="{{ route('frontend.services.single', ['id' => $data->id, 'any' => Str::slug($data->title)]) }}">
                                    <h4 class="title">{{ $data->title }}</h4>
                                </a>
                                <div class="post-description">
                                    <p>{{ $data->excerpt }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <nav class="pagination-wrapper" aria-label="Page navigation">
                    {{ $service_items->links() }}
                </nav>
            </div>
        </div>
    </section>
@endsection
