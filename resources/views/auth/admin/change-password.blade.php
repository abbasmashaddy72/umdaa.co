@extends('backend.admin-master')
@section('site-title')
    {{ ('Change Password') }}
@endsection
@section('content')
    <div class="main-content-inner margin-top-30">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.password.change') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="old_password">{{ ('Old Password') }}</label>
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                    placeholder="{{ ('Old Password') }}">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ ('New Password') }}</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="{{ ('New Password') }}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{ ('Confirm Password') }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="{{ ('Confirm Password') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ ('Save changes') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
