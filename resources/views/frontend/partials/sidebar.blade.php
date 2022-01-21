<div class="widget-area">
    <div class="widget widget_search">
        <form action="{{ route('frontend.blog.search') }}" method="get" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="{{ __('Search') }}">
            </div>
            <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="widget widget_nav_menu">
        <h2 class="widget-title">{{ 'Departments' }}</h2>
        <ul>
            @foreach ($all_categories as $data)
                <li><a
                        href="{{ route('frontend.blog.category', ['id' => $data->department_id, 'any' => Str::slug($data->department_name, '-')]) }}">{{ ucfirst($data->department_name) }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="widget widget_recent_posts">
        <h4 class="widget-title">{{ 'Recent Posts' }}</h4>
        <ul class="recent_post_item">
            @foreach ($all_recent_blogs as $data)
                <li class="single-recent-post-item">
                    <div class="thumb">
                        @if ($data->article_type == 'video' || $data->article_type == 'Video')
                            <img src="{{ $data->article_image != '' ? $data->article_image : url('assets/uploads/default/'.$data->category->department_name.'.jpg') }}" style="height:60px; width:100%; object-fit:cover;">
                            @elseif ($data->article_type == 'pdf')
                            <img src={{ url('assets/uploads/default/'.$data->category->department_name.'.jpg') }} style="height:60px; width:100%; object-fit:cover;" >
                        @else
                            <img src="{{ $data->posted_url != '' ? ('https://clinic.umdaa.co/uploads/article_images/'.$data->posted_url) : url('assets/uploads/default/'.$data->category->department_name.'.jpg') }}" style="height:60px; width:100%; object-fit:cover;">
                        @endif
                    </div>
                    <div class="content">
                        <h4 class="title"><a
                                href="{{ route('frontend.blog.single', ['id' => $data->article_id, 'any' => Str::slug($data->article_title, '-')]) }}">{{ Illuminate\Support\Str::limit($data->article_title, 60) }}</a>
                        </h4>
                        <span class="time">{{ date('d M Y', strtotime($data->posted_date)) }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
