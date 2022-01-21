@extends('backend.admin-master')
@section('site-title')
    {{__('Popup Settings')}}
@endsection
{{-- @php
    echo($all_popup);
    exit();
@endphp --}}
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Popup Settings")}}</h4>
                        <form action="{{route('admin.general.popup.settings')}}" method="Post" enctype="multipart/form-data">
                            @csrf
                                    <div class="form-group">
                                        <label for="popup_selected_id">{{__('Select Popup')}}</label>
                                        <select name="popup_selected_id" class="form-control" id="popup_selected_id">
                                            @foreach($all_popup as $item)
                                                <option @if(get_static_option('popup_selected_id') == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            <div class="form-group">
                                <label for="popup_enable_status"><strong>{{__('Popup Enable/Disable')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="popup_enable_status" @if(!empty(get_static_option('popup_enable_status'))) checked @endif id="popup_enable_status">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="popup_delay_time">{{__('Popup Delay Time')}}</label>
                                <input type="text" class="form-control" name="popup_delay_time" id="popup_delay_time" value="{{get_static_option('popup_delay_time')}}">
                                <p class="info-text">{{__('put number in miliseconds')}}</p>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 margin-bottom-40" id="db_backup_btn">{{__('Save Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
