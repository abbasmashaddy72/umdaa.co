@extends('backend.admin-master')
@section('site-title')
    {{ 'All Menus' }}
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
                        <h4 class="header-title">{{ 'All Menus' }}</h4>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel">
                                <table class="table table-default">
                                    <thead>
                                        <th>{{ 'ID' }}</th>
                                        <th>{{ 'Title' }}</th>
                                        <th>{{ 'Status' }}</th>
                                        <th>{{ 'Date' }}</th>
                                        <th>{{ 'Action' }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_menu as $data)
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->title }}</td>
                                                <td>
                                                    @if ($data->status == 'default')
                                                        <span class="alert alert-success">{{ 'Default Menu' }}</span>
                                                    @else
                                                        <form action="{{ route('admin.menu.default', $data->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-info btn-sm mb-3 mr-1 set_default_menu">{{ 'Set Default' }}</button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>{{ $data->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                        role="button" data-toggle="popover" data-trigger="focus"
                                                        data-html="true" title="" data-content="
                                                    <h6>Are you sure to delete this menu?</h6>
                                                    <form method='post' action='{{ route('admin.menu.delete', $data->id) }}'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    <br>
                                                    <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                    </form>
                                                    ">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                    <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1"
                                                        href="{{ route('admin.menu.edit', $data->id) }}">
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
                        <h4 class="header-title">{{ 'Add New Menu' }}</h4>
                        <form action="{{ route('admin.menu.new') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title">{{ 'Title' }}</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="{{ 'Title' }}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Create Menu' }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
