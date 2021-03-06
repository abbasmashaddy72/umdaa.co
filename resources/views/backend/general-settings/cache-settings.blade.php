@extends('backend.admin-master')
@section('site-title')
    {{ 'Cache Settings' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Cache Settings' }}</h4>
                        <form action="{{ route('admin.general.cache.settings') }}" method="POST" id="cache_settings_form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="cache_type" id="cache_type" class="form-control">
                            <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn"
                                data-value="view">{{ 'Clear View Cache' }}</button><br>
                            <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn"
                                data-value="route">{{ 'Clear Route Cache' }}</button><br>
                            <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn"
                                data-value="config">{{ 'Clear Configure Cache' }}</button><br>
                            <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn"
                                data-value="cache">{{ 'Clear Cache' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                $(document).on('click', '.clear-cache-submit-btn', function(e) {
                    e.preventDefault();
                    $('#cache_type').val($(this).data('value'));
                    $('#cache_settings_form').submit();
                });
            });


        })(jQuery);

    </script>
@endsection
