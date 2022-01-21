@extends('frontend.frontend-page-master')
@php
$post_img = null;
if ($blog_post->article_type == 'video' || $blog_post->article_type == 'Video') {
    $blog_image = url('assets/uploads/default/thumb/' . $blog_post->category->department_name . '.jpg');
} elseif ($blog_post->article_type == 'image') {
    $blog_image = $blog_post->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $blog_post->posted_url : url('assets/uploads/default/thumb/' . $blog_post->category->department_name . '.jpg');
} else {
    $blog_image = url('assets/uploads/default/thumb/' . $blog_post->category->department_name . '.jpg');
}
if ($blog_post->article_id == 1574) {
    $blog_image = url('assets/uploads/staticblog/docmorris.jpeg');
}
if ($blog_post->article_id == 1575) {
    $blog_image = url('assets/uploads/media-uploader/maxresdefault-11642501011.jpg');
}
$post_img = $blog_image;
@endphp
@section('og-meta')
    <meta property="og:title" content="{{ $blog_post->article_title }}" />
    <meta property="og:url"
        content="{{ route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title)]) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ Illuminate\Support\Str::limit($blog_post->short_description, 100) }}" />
    <meta property="og:image" content="{{ $post_img }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $blog_post->article_title }}" />
    <meta name="twitter:description" content="{{ Illuminate\Support\Str::limit($blog_post->short_description, 100) }}" />
    <meta name="twitter:url"
        content="{{ route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title)]) }}" />
    <meta name="twitter:image" content="{{ $post_img }}" />
    <meta name="description" content="{{ Illuminate\Support\Str::limit($blog_post->short_description, 100) }}">
    <meta name="keywords" content="{{ $blog_post->tags }}">
    <meta property="url"
        content="{{ route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title)]) }}" />
    <meta property="type" content="website" />
    <meta property="title" content="{{ $blog_post->article_title }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="image" content="{{ $post_img }}" />
@endsection
@section('site-title')
    {{ $blog_post->article_title }}
@endsection
@section('page-title')
    {{ Illuminate\Support\Str::limit($blog_post->article_title, 100) }}
@endsection
@section('style')
    <style>
        .content-area {
            text-align: justify;
        }

        .content-area h1,
        h2,
        h3,
        h4,
        h6,
        p * {
            font-family: Poppins !important;
        }

        .content-area p,
        li * {
            font-size: 16px !important;
        }

    </style>
@endsection
@section('content')
    <section
        class="blog-details-content-area d-none d-lg-block d-xl-block d-md-block d-xs-none d-sm-none blog-content-area padding-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-item">
                        <div class="thumb">
                            @if ($blog_post->article_type == 'video' || $blog_post->article_type == 'Video')
                                <iframe width="800" height="420"
                                    src="{{ $blog_post->video_url != '' ? url('https://www.youtube.com/embed/' . $blog_post->video_url . '?controls=0') : url('assets/uploads/default/' . $blog_post->category->department_name . '.jpg') }}"></iframe>
                            @elseif ($blog_post->article_type == 'pdf')
                                <div class="text-center border border-light padding-50 mb-4 btn-ds">
                                    <a href="{{ $blog_post->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_pdf/' . $blog_post->posted_url : url('assets/uploads/default/' . $blog_post->category->department_name . '.jpg') }}"
                                        class="btn btn-primary active" role="button" aria-pressed="true">View PDF</a>
                                </div>
                            @else
                                <img
                                    src="{{ $blog_post->posted_url != '' ? 'https://clinic.umdaa.co/uploads/article_images/' . $blog_post->posted_url : url('assets/uploads/default/' . $blog_post->category->department_name . '.jpg') }}">
                            @endif
                        </div>
                        <div class="entry-content">
                            <h5 class="margin-bottom-30">{!! $blog_post->article_title !!}</h5>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar"></i>
                                    {{ date('d M Y', strtotime($blog_post->posted_date)) }}</li>
                                @if (!empty($blog_post->user->first_name))
                                    <li><a><i class="fa fa-user"></i> {{ $blog_post->user->first_name }}</a></li>
                                @else
                                    <li><a><i class="fa fa-user"></i> {{ 'Admin' }}</a></li>
                                @endif
                                <li>
                                    <div class="cats">
                                        <i class="fa fa-calendar"></i>
                                        <a
                                            href="{{ route('frontend.blog.category', ['id' => $blog_post->category->department_id, 'any' => Str::slug($blog_post->category->department_name, '-')]) }}">
                                            {{ $blog_post->category->department_name }}</a>
                                    </div>
                                </li>
                            </ul>
                            @if (!empty($blog_post->article_description))
                                <div class="content-area">{!! $blog_post->article_description !!}</div>
                            @else
                                <div class="content-area">{!! $blog_post->short_description !!}</div>
                            @endif
                        </div>
                        <div class="blog-details-footer">
                            <!-- entry footer -->
                            <div class="left">
                                <ul class="tags">
                                    <li class="title">{{ 'Tags:' }}</li>
                                    @php
                                        $all_tags = explode(',', $blog_post->tags);
                                    @endphp
                                    @foreach ($all_tags as $tag)
                                        <li><a
                                                href="{{ route('frontend.blog.tags.page', ['name' => Str::slug($tag)]) }}">{{ $tag }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="right">
                                <ul class="social-share">
                                    <li class="title">{{ 'Share:' }}</li>
                                    {!! single_post_share(route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title, '-')]), $blog_post->short_description, $post_img) !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="related-post-area margin-top-40">
                        <div class="section-title ">
                            <h4 class="title ">{{ get_static_option('blog_single_page_related_post_title') }}
                            </h4>
                            <div class="related-news-carousel margin-top-50">
                                @foreach ($all_related_blog as $data)
                                    @if ($data->article_id === $blog_post->article_id) @continue
                                    @endif
                                    <div class="single-blog-grid-01">
                                        <div class="thumb">
                                            @if ($data->article_type == 'video' || $data->article_type == 'Video')
                                                <img src="{{ $data->article_image != '' ? $data->article_image : url('assets/uploads/default/' . $data->category->department_name . '.jpg') }}"
                                                    style="height:216px; width:100%; object-fit:cover;">
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
                                                    href="{{ route('frontend.blog.single', ['id' => $data->article_id, 'any' => Str::slug($data->article_title)]) }}">{{ $data->article_title }}</a>
                                            </h4>
                                            <ul class="post-meta">
                                                <li><a href="#"><i class="fa fa-calendar"></i>
                                                        {{ date('d M Y', strtotime($data->posted_date)) }}</a></li>
                                                @if (!empty($data->user->first_name))
                                                    <li><a><i class="fa fa-user"></i>
                                                            {{ $data->user->first_name }}</a>
                                                    </li>
                                                @else
                                                    <li><a><i class="fa fa-user"></i> {{ 'Admin' }}</a></li>
                                                @endif
                                                <li>
                                                    <div class="cats"><i class="fa fa-calendar"></i><a
                                                            href="{{ route('frontend.blog.category', ['id' => $data->category->department_id, 'any' => Str::slug($data->category->department_name)]) }}">
                                                            {{ $data->category->department_name }}</a></div>
                                                </li>
                                            </ul>
                                            <p>{{ $data->short_description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="disqus-comment-area margin-top-40">
                        <div id="disqus_thread"></div>
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
            <div class="carousel-inner row w-100 mx-auto" id="post-data">
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

@section('scripts')
    <script>
        var disqus_config = function() {
            this.page.url =
                "{{ route('frontend.blog.single', ['id' => $blog_post->article_id, 'any' => Str::slug($blog_post->article_title, '-')]) }}";
            this.page.identifier = "{{ $blog_post->article_id }}";
        };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = "https://umdaa-1.disqus.com/embed.js";
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
@endsection
