@extends('backend.admin-master')
@section('site-title')
    {{('Useful Links Widget Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{('Useful Link Widget Settings')}}</h4>
                        <form action="{{route('admin.footer.useful.link.widget')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30 " id="nav-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="useful_link_widget_title">{{('Widget Title')}}</label>
                                        <input type="text" class="form-control"  id="useful_link_widget_title" value="{{get_static_option('useful_link_widget_title')}}" name="useful_link_widget_title" >
                                    </div>
                                    <div class="form-group">
                                        <label for="useful_link_widget_menu_id">{{('Select Menu')}}</label>
                                        <select name="useful_link_widget_menu_id" data-value="{{get_static_option('useful_link_widget_menu_id')}}" id="useful_link_widget_menu_id" class="form-control">
                                            <option value="">{{('Select Menu')}}</option>
                                            @foreach($all_menu as $data)
                                                <option value="{{$data->id}}" @if($data->id == get_static_option('useful_link_widget_menu_id')) selected @endif >{{$data->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

