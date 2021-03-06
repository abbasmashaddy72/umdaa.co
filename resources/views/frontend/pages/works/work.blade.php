@extends('frontend.frontend-page-master')
@section('site-title')
    {{'Work'}}
@endsection
@section('page-title')
    {{'Work'}}
@endsection
@section('content')
    <div class="page-content portfolio padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-masonry-wrapper">
                        <ul class="portfolio-menu">
                            <li class="active" data-filter="*">{{__('All')}}</li>
                            @foreach($all_work_category as $data)
                                <li data-filter=".{{Str::slug($data->name)}}">{{$data->name}}</li>
                            @endforeach
                        </ul>
                        <div class="portfolio-masonry">
                            @foreach($all_work as $data)
                                <div class="col-lg-4 col-md-6 masonry-item {{get_work_category_by_id($data->id,'slug')}}">
                                    <div class="single-work-item">
                                        <div class="thumb">
                                            @php
                                                $related_work_image = get_attachment_image_by_id($data->image,"grid",false);
                                            @endphp
                                            @if (!empty($related_work_image))
                                                <img  src="{{$related_work_image['img_url']}}" alt="{{__($data->name)}}">
                                            @endif
                                        </div>
                                        <div class="content">
                                            <h4 class="title"><a href="{{route('frontend.work.single',['id' => $data->id,'any' => Str::slug($data->title)])}}"> {{$data->title}}</a></h4>
                                            <div class="cats">
                                                @php
                                                    $all_cat_of_post = get_work_category_by_id($data->id);
                                                @endphp
                                                @foreach($all_cat_of_post as $key => $work_cat)
                                                    <a href="{{route('frontend.works.category',['id' => $key,'any'=> Str::slug($work_cat)])}}">{{$work_cat}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="post-pagination-wrapper">
                        {{$all_work->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
