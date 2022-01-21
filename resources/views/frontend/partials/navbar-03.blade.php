<nav class="navbar navbar-area navbar-expand-lg nav-style-02">
    <div class="container nav-container">
        <div class="navbar-brand">
            <a href="{{ url('/') }}" class="logo">
                @php
                    $site_logo = get_attachment_image_by_id(get_static_option('site_logo'), 'full', false);
                @endphp
                @if (!empty($site_logo))
                    <img src="{{ $site_logo['img_url'] }}" alt="site logo">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="main_menu">
            <ul class="navbar-nav">
                @if (!empty($primary_menu->content))
                    @php
                        $cc = 0;
                        $parent_item_count = 0;
                        $menu_content = json_decode($primary_menu->content);
                        // print_r ($menu_content);
                        // exit();
                    @endphp
                    @foreach ($menu_content as $data)
                        @php
                            if ($cc > 0 && $cc == $parent_item_count) {
                                print '</ul>';
                                $cc = 0;
                            }
                            if (!empty($data->parent_id) && $data->depth > 0) {
                                if ($cc == 0) {
                                    print '<ul class="sub-menu">';
                                    $parent_item_count = get_child_menu_count($menu_content, $data->parent_id);
                                } else {
                                    print '</li>';
                                }
                            } else {
                                print '</li>';
                            }
                        @endphp
                        <li class="@if (request()->path() == substr($data->menuUrl, 6)) current-menu-item @endif">
                            @if ($data->menuTitle == 'Home')
                                <a href="{{ str_replace('[url]', url('/'), $data->menuUrl) }}">{{ 'Home' }}</a>
                                <li>
                                    <a href="{{ route('frontend.services.page') }}">{{ 'Services' }}</a>
                                </li>
                            @else
                                <a href="{{ str_replace('[url]', url('/'), $data->menuUrl) }}">{{ $data->menuTitle }}</a>
                            @endif
                            @php
                                if (!empty($data->parent_id) && $data->depth > 0) {
                                    $cc++;
                                }
                            @endphp
                    @endforeach
                @else
                    <li class="@if (request()->path() == '/') current-menu-item @endif">
                        <a href="{{ url('/') }}">{{ 'Home' }}</a>
                    </li>
                @endif
            </ul>
        </div>
        <button class="btn btn-secondary brsearch d-block d-lg-none d-xl-none d-md-none d-xs-block d-sm-block"
            type="button" data-toggle="modal" data-target="#searchmodal">
            <i class="fa fa-search"></i>
        </button>
    </div>
</nav>
<!-- navbar area end -->
