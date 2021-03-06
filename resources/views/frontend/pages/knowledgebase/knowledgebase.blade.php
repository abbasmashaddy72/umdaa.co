@extends('frontend.frontend-page-master')
@section('site-title')
    {{ 'KnowledgeBase' }}
@endsection
@section('page-title')
    {{ 'KnowledgeBase' }}
@endsection
@section('content')
    <section class="knowledgebase-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="main-title">{{ get_static_option('site_knowledgebase_article_topic_title') }}</h4>
                    <div class="row">
                        @foreach ($all_knowledgebase as $topic => $articles)
                            <div class="col-lg-6">
                                <div class="article-with-topic-title-style-01">
                                    <a
                                        href="{{ route('frontend.knowledgebase.category', ['id' => $topic, 'any' => Str::slug(get_topic_name_by_id($topic))]) }}">
                                        <h4 class="topic-title"><i class="fas fa-folder"></i>
                                            {{ get_topic_name_by_id($topic) }}</h4>
                                    </a>
                                    <ul class="know-articles-list">
                                        @foreach ($articles as $art)
                                            <li><a
                                                    href="{{ route('frontend.knowledgebase.single', ['id' => $art->id, 'any' => Str::slug($art->title)]) }}"><i
                                                        class="far fa-file-alt"></i> {{ $art->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="widget widget_search">
                            <form action="{{ route('frontend.knowledgebase.search') }}" method="get" class="search-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="{{ 'Search...' }}">
                                </div>
                                <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_nav_menu">
                            <h2 class="widget-title">{{ get_static_option('site_knowledgebase_category_title') }}</h2>
                            <ul>
                                @foreach ($all_knowledgebase_category as $data)
                                    <li><a
                                            href="{{ route('frontend.knowledgebase.category', ['id' => $data->id, 'any' => Str::slug($data->title, '-')]) }}"><i
                                                class="fas fa-folder base-color"></i> {{ ucfirst($data->title) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_nav_menu">
                            <h2 class="widget-title">{{ get_static_option('site_knowledgebase_popular_widget_title') }}
                            </h2>
                            <ul>
                                @foreach ($popular_articles as $data)
                                    <li><a
                                            href="{{ route('frontend.knowledgebase.single', ['id' => $data->id, 'any' => Str::slug($data->title, '-')]) }}"><i
                                                class="far fa-file-alt base-color"></i> {{ ucfirst($data->title) }}</a>
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
