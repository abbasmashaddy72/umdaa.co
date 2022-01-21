@extends('backend.admin-master')
@section('site-title')
    {{ 'Contact Info' }}
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
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Contact Info Items' }}</h4>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <table class="table table-default">
                                    <thead>
                                        <th>{{ 'ID' }}</th>
                                        <th>{{ 'Title' }}</th>
                                        <th>{{ 'Icon' }}</th>
                                        <th>{{ 'Description' }}</th>
                                        <th>{{ 'Action' }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_contact_info as $data)
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td><i class="{{ $data->icon }}"></i></td>
                                                <td>{{ $data->title }}</td>
                                                <td>{{ $data->description }}</td>
                                                <td>
                                                    <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                        role="button" data-toggle="popover" data-trigger="focus"
                                                        data-html="true" title="" data-content="
                                                    <h6>Are you sure to delete this contact info item ?</h6>
                                                    <form method='post' action='{{ route('admin.contact.info.delete', $data->id) }}'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <br>
                                                    <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                    </form>
                                                    ">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#contact_info_item_edit_modal"
                                                        class="btn btn-lg btn-primary btn-sm mb-3 mr-1 contact_info_edit_btn"
                                                        data-id="{{ $data->id }}" data-title="{{ $data->title }}"
                                                        data-description="{{ $data->description }}"
                                                        data-icon="{{ $data->icon }}">
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
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'New Contact Info' }}</h4>
                        <form action="{{ route('admin.contact.info') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{ 'Title' }}</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="{{ 'Title' }}">
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
                                <label for="description">{{ 'Description' }}</label>
                                <textarea id="description" name="description" class="form-control max-height-120" cols="30"
                                    rows="10" placeholder="{{ 'Description' }}"></textarea>
                                <small class="info-text">{{ 'to break a new line use semicolon (;).' }}</small>
                            </div>
                            <button type="submit"
                                class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add Contact Info Item' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contact_info_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Edit Key Feature Item' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.contact.info.update') }}" id="contact_info_edit_modal_form" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="contact_info_id" value="">
                        <div class="form-group">
                            <label for="edit_title">{{ 'Title' }}</label>
                            <input type="text" class="form-control" id="edit_title" name="title"
                                placeholder="{{ 'Title' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon" class="d-block">{{ 'Icon' }}</label>
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
                            <input type="hidden" class="form-control" id="edit_icon" value="fas fa-exclamation-triangle"
                                name="icon">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">{{ 'Description' }}</label>
                            <textarea id="edit_description" name="description" class="form-control max-height-120" cols="30"
                                rows="10" placeholder="{{ 'Description' }}"></textarea>
                            <small class="info-text">{{ 'to break a new line use semicolon (;).' }}</small>
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
            $(document).on('click', '.contact_info_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var icon = el.data('icon');
                var description = el.data('description');
                var form = $('#contact_info_edit_modal_form');

                form.find('#contact_info_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_icon').val(icon);
                form.find('#edit_description').val(description);
            });
            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function(e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });
        });

    </script>
@endsection
