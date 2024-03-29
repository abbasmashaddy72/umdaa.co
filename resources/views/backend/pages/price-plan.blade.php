@extends('backend.admin-master')
@section('site-title')
    {{ 'Price Plan' }}
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
div.dataTables_wrapper div.dataTables_info {
    color: #d6d7d9;
}

    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
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

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Price Plan Items' }}</h4>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default">
                                        <thead>
                                            <th>{{ 'ID' }}</th>
                                            <th>{{ 'Title' }}</th>
                                            <th>{{ 'Price' }}</th>
                                            <th>{{ 'Icon' }}</th>
                                            <th>{{ 'Type' }}</th>
                                            <th>{{ 'Action' }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_price_plan as $data)
                                                @php $img_url =''; @endphp
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>
                                                        {{ $data->title }}
                                                    </td>
                                                    <td>{{ $data->price }}</td>
                                                    <td><i class="{{ $data->icon }}" style="font-size: 30px"></i></td>
                                                    <td>{{ $data->type }}</td>
                                                    <td>
                                                        <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                            role="button" data-toggle="popover" data-trigger="focus"
                                                            data-html="true" title="" data-content="
                                                    <h6>Are you sure to delete this price plan item?</h6>
                                                    <form method='post' action='{{ route('admin.price.plan.delete', $data->id) }}'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <br>
                                                    <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                    </form>">
                                                            <i class="ti-trash"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#price_plan_item_edit_modal"
                                                            class="btn btn-lg btn-primary btn-sm mb-3 mr-1 price_plan_edit_btn"
                                                            data-id="{{ $data->id }}"
                                                            data-action="{{ route('admin.price.plan.update') }}"
                                                            data-title="{{ $data->title }}"
                                                            data-icon="{{ $data->icon }}"
                                                            data-type="{{ $data->type }}"
                                                            data-price="{{ $data->price }}"
                                                            data-features="{{ $data->features }}"
                                                            data-btnText="{{ $data->btn_text }}"
                                                            data-btnUrl="{{ $data->btn_url }}"
                                                            data-urlStatus="{{ $data->url_status }}">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'New Price Plan' }}</h4>
                        <form action="{{ route('admin.price.plan') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{ 'Title' }}</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="{{ 'Title' }}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{ 'Price' }}</label>
                                <input type="text" class="form-control" id="price" name="price"
                                    placeholder="{{ 'Price' }}">
                            </div>
                            <div class="form-group">
                                <label for="icon" class="d-block">{{ 'Icon' }}</label>
                                <div class="btn-group">
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
                                <input type="hidden" class="form-control" id="icon" value="fas fa-exclamation-triangle"
                                    name="icon">
                            </div>

                            <div class="form-group">
                                <label for="type">{{ 'Type' }}</label>
                                <input type="text" class="form-control" id="type" name="type"
                                    placeholder="{{ 'Type' }}">
                            </div>
                            <div class="form-group">
                                <label for="features">{{ 'Features' }}</label>
                                <textarea class="form-control" id="features" name="features"
                                    placeholder="{{ 'Features' }}" cols="30" rows="10"></textarea>
                                <small class="info=text">{{ 'Separate feature by semicolon ( ; ).' }}</small>
                            </div>
                            <div class="form-group">
                                <label for="btn_text">{{ 'Button Text' }}</label>
                                <input type="text" class="form-control" id="btn_text" name="btn_text"
                                    placeholder="{{ 'Button Text' }}">
                            </div>
                            <div class="form-group">
                                <label for="url_status"><strong>{{ 'Plan Detail Page' }}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="url_status" id="url_status">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="btn_url">{{ 'Button URL' }}</label>
                                <input type="text" class="form-control" id="btn_url" name="btn_url"
                                    placeholder="{{ 'Button URL' }}">
                            </div>
                            <button type="submit"
                                class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add New Price Plan' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="price_plan_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Edit Price Plan Item' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="#" id="price_plan_edit_modal_form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="price_plan_id" value="">
                        <div class="form-group">
                            <label for="edit_title">{{ 'Title' }}</label>
                            <input type="text" class="form-control" id="edit_title" name="title"
                                placeholder="{{ 'Title' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_price">{{ 'Price' }}</label>
                            <input type="text" class="form-control" id="edit_price" name="price"
                                placeholder="{{ 'Price' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon" class="d-block">{{ 'Icon' }}</label>
                            <div class="btn-group ">
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
                            <input type="hidden" class="form-control" id="edit_icon" value="fas fa-exclamation-triangle"
                                name="icon">
                        </div>
                        <div class="form-group">
                            <label for="edit_type">{{ 'Type' }}</label>
                            <input type="text" class="form-control" id="edit_type" name="type"
                                placeholder="{{ 'Type' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_features">{{ 'Features' }}</label>
                            <textarea class="form-control" id="edit_features" name="features"
                                placeholder="{{ 'Features' }}" cols="30" rows="10"></textarea>
                            <small class="info=text">{{ 'Separate feature by semicolon ( ; ).' }}</small>
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_text">{{ 'Button Text' }}</label>
                            <input type="text" class="form-control" id="edit_btn_text" name="btn_text"
                                placeholder="{{ 'Button Text' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_url_status"><strong>{{ 'Plan Detail Page' }}</strong></label>
                            <label class="switch">
                                <input type="checkbox" name="url_status" id="edit_url_status">
                                <span class="slider onff"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="edit_btn_url">{{ 'Button URL' }}</label>
                            <input type="text" class="form-control" id="edit_btn_url" name="btn_url"
                                placeholder="{{ 'Button URL' }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                        <button type="submit" class="btn btn-primary">{{ 'Save Changes' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $(document).on('click', '.price_plan_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var action = el.data('action');
                var form = $('#price_plan_edit_modal_form');
                form.attr('action', action);
                form.find('#price_plan_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_price').val(el.data('price'));
                form.find('#edit_icon').val(el.data('icon'));
                form.find('#edit_type').val(el.data('type'));
                form.find('#edit_btn_text').val(el.data('btntext'));
                form.find('#edit_btn_url').val(el.data('btnurl'));
                form.find('#edit_features').val(el.data('features'));
                form.find('.icp-dd').attr('data-selected', el.data('icon'));
                form.find('.iconpicker-component i').attr('class', el.data('icon'));
                if (el.data('urlstatus') != '') {
                    form.find('#edit_url_status').attr('checked', true);
                    form.find('#edit_url_status').parent().parent().next().hide();
                }
            });
            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function(e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

            $(document).on('change', 'input[name="url_status"]', function(e) {
                e.preventDefault();
                if ($('input[name="url_status"]').is(":checked")) {
                    $(this).parent().parent().next().hide();
                } else {
                    $(this).parent().parent().next().show();
                }
            });

        });

    </script>
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.table-wrap > table').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });


        });

    </script>
@endsection
