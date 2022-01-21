@extends('frontend.frontend-page-master')
@section('page-title')
    {{ 'Tags:' }} {{ $tag_name }}
@endsection
@section('site-title')
    {{ 'Tags:' }} {{ $tag_name }}
@endsection
@section('content')

    <section class="blog-content-area padding-120 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @if (count($all_blogs) < 1)
                            <div class="col-lg-12">
                                <div class="alert alert-danger">
                                    {{ 'No Post Available In ' . tag_name . __(' Tags') }}
                                </div>
                            </div>
                        @endif
                        @foreach ($all_blogs as $data)
                            <div class="col-lg-6 col-md-6">
                                <div class="single-blog-grid-01 margin-bottom-30">
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
                                                <div class="cats"><i class="fa fa-calendar"></i><a
                                                        href="{{ route('frontend.blog.category', ['id' => $data->category->department_id, 'any' => Str::slug($data->category->department_name)]) }}">
                                                        {{ $data->category->department_name }}</a></div>
                                            </li>
                                        </ul>
                                        <p>{{ Illuminate\Support\Str::limit($data->short_description, 150) }}</p>
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
@endsection
