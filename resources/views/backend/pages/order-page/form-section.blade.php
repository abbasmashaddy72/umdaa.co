@extends('backend.admin-master')
@section('site-title')
    {{ 'Order Page Settings' }}
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
                        <h4 class="header-title">{{ 'Order Page Settings' }}</h4>
                        <form action="{{ route('admin.order.page') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="order_page_form_title">{{ 'Order Form Title' }}</label>
                                        <input type="text" name="order_page _form_title"
                                            value="{{ get_static_option('order_page_form_title') }}" class="form-control"
                                            id="order_page _form_title">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order_page_form_mail">{{ 'Email Address For Order Message' }}</label>
                                <input type="text" name="order_page_form_mail"
                                    value="{{ get_static_option('order_page_form_mail') }}" class="form-control"
                                    id="order_page_form_mail">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Update Settings' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
