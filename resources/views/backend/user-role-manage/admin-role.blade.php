@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/nice-select.css') }}">
@endsection
@section('site-title')
    {{ 'All Admin Role' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                @include('backend/partials/message')
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'All Admin Role' }}</h4>
                        <div class="data-tables datatable-primary">
                            <table id="all_user_table" class="table table-default">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th>{{ 'ID' }}</th>
                                        <th>{{ 'Role' }}</th>
                                        <th>{{ 'Permissions' }}</th>
                                        <th>{{ 'Action' }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_role as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <div class="permission-show">
                                                    @php $all_per = json_decode($data->permission); @endphp
                                                    @foreach ($all_per as $per)
                                                        <span
                                                            class="text text-success">{{ ucwords(str_replace('_', ' ', $per)) }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1" role="button"
                                                    data-toggle="popover" data-trigger="focus" data-html="true" title=""
                                                    data-content="
                                                    <h6>Are you sure to delete this role?</h6>
                                                    <form method='post' action='{{ route('admin.user.role.delete', $data->id) }}'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <br>
                                                    <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                    </form>
                                                    " data-original-title="">
                                                    <i class="ti-trash"></i>
                                                </a>
                                                <a href="#" data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                                                    data-permission="{{ $data->permission }}" data-toggle="modal"
                                                    data-target="#user_edit_modal"
                                                    class="btn btn-lg btn-primary btn-sm mb-3 mr-1 user_edit_btn">
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
            <div class="col-lg-6  mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Add New Admin Role' }}</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.all.user.role') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ 'Role Name' }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ 'Enter Role name' }}">
                            </div>
                            <div class="form-group">
                                <label for="permission">{{ 'Permissions' }}</label>
                                @php
                                    $all_permission_list = ['Admin Role Manage', 'Popup Builder', 'Newsletter Manage', 'Home Variant', 'Nabvar Settings', 'Home Page Manage', 'About Page Manage', 'Contact Page Manage', 'Quote Page Manage', 'Order Page Manage', 'Price Plan Page Manage', 'Work Single Page Manage', 'Top Bar Settings', 'Services', 'Works', 'FAQ', 'Price Plan', 'Blog Settings', 'Counterup', 'Blogs', 'Form Builder', 'Footer Area', 'Menus Manage', 'Pages', 'General Settings', 'Quote Manage', 'Order Manage', 'Job Post Manage', 'Events Manage', 'Knowledgebase'];
                                @endphp
                                <select name="permission[]" multiple id="permission" class="form-control nice-select wide">
                                    @foreach ($all_permission_list as $per)
                                        <option value="{{ strtolower(str_replace(' ', '_', $per)) }}">{{ $per }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="info-text">
                                    {{ 'assign permission to role, which page can seen by the this role' }}</div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add New Role' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ 'Admin Role Edit' }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.user.role.edit') }}" id="user_edit_modal_form" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="admin_role_id" id="admin_role_id">
                        @csrf
                        <div class="form-group">
                            <label for="edit_name">{{ 'Role Name' }}</label>
                            <input type="text" class="form-control" id="edit_name" name="name"
                                placeholder="{{ 'Enter Role name' }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_permission">{{ 'Permissions' }}</label>
                            @php
                                $all_permission_list = ['Admin Role Manage', 'Doctor Details Manage', 'Popup Builder', 'Newsletter Manage', 'Home Variant', 'Nabvar Settings', 'Home Page Manage', 'About Page Manage', 'Contact Page Manage', 'Quote Page Manage', 'Order Page Manage', 'Price Plan Page Manage', 'Work Single Page Manage', 'Top Bar Settings', 'Services', 'Works', 'FAQ', 'Price Plan', 'Blog Settings', 'Counterup', 'Blogs', 'Form Builder', 'Footer Area', 'Menus Manage', 'Pages', 'General Settings', 'Quote Manage', 'Order Manage', 'Job Post Manage', 'Events Manage', 'Knowledgebase'];
                            @endphp
                            <select name="permission[]" multiple id="edit_permission" class="form-control nice-select wide">
                                @foreach ($all_permission_list as $per)
                                    <option value="{{ strtolower(str_replace(' ', '_', $per)) }}">{{ $per }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="info-text">
                                {{ 'assign permission to role, which page can seen by the this role' }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' }}</button>
                        <button type="submit" class="btn btn-primary">{{ 'Save changes' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/jquery.nice-select.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.user_edit_btn', function() {
                var el = $(this);
                var form = $('#user_edit_modal_form');
                var permission = el.data('permission');
                form.find('#admin_role_id').val(el.data('id'));
                form.find('#edit_name').val(el.data('name'));
                $.each(permission, function(index, value) {
                    form.find('#edit_permission option[value="' + value + '"]').attr('selected',
                        true);
                });
                $('#edit_permission').niceSelect('update');
            });

            if ($('.nice-select').length > 0) {
                $('.nice-select').niceSelect();
            }
        });

    </script>
@endsection
