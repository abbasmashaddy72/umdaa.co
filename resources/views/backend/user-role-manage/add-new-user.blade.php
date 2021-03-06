@extends('backend.admin-master')
@section('site-title')
    {{ 'Add New User' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'New User' }}</h4>
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
                        <form action="{{ route('admin.new.user') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ 'Name' }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ 'Enter name' }}">
                            </div>
                            <div class="form-group">
                                <label for="username">{{ 'Username' }}</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="{{ 'Username' }}">
                                <small
                                    class="text text-danger">{{ 'Remember this username, user will login using this username' }}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ 'Email' }}</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ 'Email' }}">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ 'Password' }}</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="{{ 'Password' }}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{ 'Password Confirm' }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="{{ 'Password Confirmation' }}">
                            </div>
                            <div class="form-group">
                                <label for="role">{{ 'Role' }}</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach ($all_admin_role as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image">
                                <label class="custom-file-label" for="image">{{ 'Image' }}</label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add New User' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
