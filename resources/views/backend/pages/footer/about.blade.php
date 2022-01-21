@extends('backend.admin-master')
@section('site-title')
    {{ 'About Widget Settings' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'About Widget Settings' }}</h4>
                        <form action="{{ route('admin.footer.about') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel">
                                    <div class="form-group">
                                        <label for="about_widget_description">{{ 'Widget Description' }}</label>
                                        <textarea class="form-control" id="about_widget_description"
                                            name="about_widget_description">{{ get_static_option('about_widget_description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_one" class="d-block">{{ 'Icon' }}</label>
                                <div class="btn-group about_widget_social_icon_one">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="about_widget_social_icon_one"
                                    value="{{ get_static_option('about_widget_social_icon_one') }}"
                                    name="about_widget_social_icon_one">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_one_url">{{ 'Social Icon One Url' }}</label>
                                <input type="text" class="form-control" id="about_widget_social_icon_one_url"
                                    value="{{ get_static_option('about_widget_social_icon_one_url') }}"
                                    name="about_widget_social_icon_one_url">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_two" class="d-block">{{ 'Icon' }}</label>
                                <div class="btn-group about_widget_social_icon_two">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="about_widget_social_icon_two"
                                    value="{{ get_static_option('about_widget_social_icon_two') }}"
                                    name="about_widget_social_icon_two">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_two_url">{{ 'Social Icon Two Url' }}</label>
                                <input type="text" class="form-control" id="about_widget_social_icon_two_url"
                                    value="{{ get_static_option('about_widget_social_icon_two_url') }}"
                                    name="about_widget_social_icon_two_url">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_three" class="d-block">{{ 'Icon' }}</label>
                                <div class="btn-group about_widget_social_icon_three">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="about_widget_social_icon_three"
                                    value="{{ get_static_option('about_widget_social_icon_three') }}"
                                    name="about_widget_social_icon_three">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_three_url">{{ 'Social Icon Three Url' }}</label>
                                <input type="text" class="form-control" id="about_widget_social_icon_three_url"
                                    value="{{ get_static_option('about_widget_social_icon_three_url') }}"
                                    name="about_widget_social_icon_three_url">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_three" class="d-block">{{ 'Icon' }}</label>
                                <div class="btn-group about_widget_social_icon_four">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="about_widget_social_icon_four"
                                    value="{{ get_static_option('about_widget_social_icon_four') }}"
                                    name="about_widget_social_icon_four">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_four_url">{{ 'Social Icon Four Url' }}</label>
                                <input type="text" class="form-control" id="about_widget_social_icon_four_url"
                                    value="{{ get_static_option('about_widget_social_icon_four_url') }}"
                                    name="about_widget_social_icon_four_url">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_five" class="d-block">{{ 'Icon' }}</label>
                                <div class="btn-group about_widget_social_icon_five">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="about_widget_social_icon_five"
                                    value="{{ get_static_option('about_widget_social_icon_five') }}"
                                    name="about_widget_social_icon_five">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_five_url">{{ 'Social Icon Five Url' }}</label>
                                <input type="text" class="form-control" id="about_widget_social_icon_five_url"
                                    value="{{ get_static_option('about_widget_social_icon_five_url') }}"
                                    name="about_widget_social_icon_five_url">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Settings' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')

    <script>
        $(document).ready(function() {

            $('.about_widget_social_icon_one').find('.icp-dd').attr('data-selected', $(
                '#about_widget_social_icon_one').val());
            $('.about_widget_social_icon_two').find('.icp-dd').attr('data-selected', $(
                '#about_widget_social_icon_two').val());
            $('.about_widget_social_icon_three').find('.icp-dd').attr('data-selected', $(
                '#about_widget_social_icon_three').val());
            $('.about_widget_social_icon_four').find('.icp-dd').attr('data-selected', $(
                '#about_widget_social_icon_four').val());
            $('.about_widget_social_icon_five').find('.icp-dd').attr('data-selected', $(
                '#about_widget_social_icon_five').val());

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function(e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

        });

    </script>
@endsection
