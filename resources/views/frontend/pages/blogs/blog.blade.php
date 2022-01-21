@extends('frontend.frontend-page-master')
@section('site-title')
    {{ 'Blogs' }}
@endsection
@section('page-title')
    {{ 'Blogs' }}
@endsection
@section('style')
    <style>
        .single-blog-grid-01 .content .title {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .single-blog-grid-01 .content p {
            display: -webkit-box;
            -webkit-line-clamp: 6;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

    </style>
@endsection
@section('content')
    <section class="d-none d-lg-block d-xl-block d-md-block d-xs-none d-sm-none blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @foreach ($all_blogs as $data)
                            <div class="col-lg-6 col-md-6">
                                <div class="single-blog-grid-01 margin-bottom-30">
                                    <div class="thumb">
                                        @if ($data->article_type == 'video' || $data->article_type == 'Video')
                                            @if (!empty($data->video_image))
                                                <img src="{{ 'https://clinic.umdaa.co/uploads/thumbnails/' . $data->video_image }}"
                                                    style="height:216px; width:100%; object-fit:cover;">
                                            @else
                                                <img src="{{ $data->article_image != '' ? $data->article_image : url('assets/uploads/default/' . $data->category->department_name . '.jpg') }}"
                                                    style="height:216px; width:100%; object-fit:cover;">
                                            @endif
                                        @elseif ($data->article_type == 'pdf')
                                            <img src={{ url('assets/uploads/default/' . $data->category->department_name . '.jpg') }}
                                                style="height:216px; width:100%; object-fit:cover;">
                                        @else
                                            <img src="{{ $data->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $data->posted_url : url('assets/uploads/default/' . $data->category->department_name . '.jpg') }}"
                                                style="height:216px; width:100%; object-fit:cover;">
                                        @endif
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><a
                                                href="{{ route('frontend.blog.single', ['id' => $data->article_id, 'any' => str_replace(' ', '-', $data->article_title)]) }}">{{ $data->article_title }}</a>
                                        </h4>
                                        <ul class="post-meta">
                                            <li><a><i class="fa fa-calendar"></i>
                                                    {{ date('d M Y', strtotime($data->posted_date)) }}</a></li>
                                            @if (!empty($data->user->first_name))
                                                <li><a><i class="fa fa-user"></i> {{ $data->user->first_name }}</a>
                                                </li>
                                            @else
                                                <li><a><i class="fa fa-user"></i> {{ 'Admin' }}</a></li>
                                            @endif
                                            <li>
                                                <div class="cats"><i class="fas fa-id-card-alt"></i><a
                                                        href="{{ route('frontend.blog.category', ['id' => $data->category->department_id, 'any' => $data->category->department_name]) }}">
                                                        {{ $data->category->department_name }}</a></div>
                                            </li>
                                        </ul>
                                        <p>{{ $data->short_description }}</p>
                                        <ul class="post-meta " style="margin-bottom:0">
                                            <li><a href="{{ $data->read_article_link }}"><i>Source:
                                                    </i>{{ $data->article_author }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper" aria-label="Page navigation ">
                            {{ $all_blogs->links() }}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </section>
    <section class="d-block d-lg-none d-xl-none d-md-none d-xs-block d-sm-block" style="min-height: 75vh;">
        <div id="myCarousel" class="carousel slide" data-interval="false" data-wrap="false">
            <div class="mx-auto carousel-inner row w-100" id="post-data">
                @include('frontend.pages.blogs.mobile_blog')
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
    </section>
@endsection
