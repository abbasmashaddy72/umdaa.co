@extends('frontend.frontend-page-master')
@section('page-title')
    {{ 'Search For: ' }} {{ $search_term }}
@endsection
@section('site-title')
    {{ 'Search For: ' }} {{ $search_term }}
@endsection
@section('content')
    <div class="padding-60 gray-bg">
        <div class="container">
            <form action="{{ route('frontend.team.search') }}" method="get" class="search-form">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <input class="form-control my-0 py-1" type="text" name="search"
                        placeholder="{{ __('Search Doctor') }}" aria-label="Search">
                    <div class="input-group-append">
                        <button class="input-group-text" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="team-member-area gray-bg team-page padding-10">
        <div class="container">
            <div class="row">
                @if (count($all_team_members) < 1)
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            {{ 'Nothing found related to ' . $search_term }}
                        </div>
                    </div>
                @endif
                @foreach ($all_team_members as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-team-member-one margin-bottom-30 gray-bg">
                            <div class="thumb">@if (!empty($data->first_name)) <a href="{{ route('frontend.doctor.website', ['id' => $data->doctor_id, 'any' => Str::slug(str_replace(' ', '', 'Dr.' . $data->first_name . $data->last_name))]) }}">@endif
                                @if (!empty($data->profile_image))
                                    <img src="{{ 'https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image }}"
                                        alt="{{ $data->first_name }} {{ $data->last_name }}">
                                @else
                                    <img src="{{ asset('assets/uploads/nodoc.png') }}">
                                @endif
                                </a>
                            </div>
                            <div class="content">
                                <h4 class="name">@if (!empty($data->first_name)) <a href="{{ route('frontend.doctor.website', ['id' => $data->doctor_id, 'any' => Str::slug(str_replace(' ', '', 'Dr.' . $data->first_name . $data->last_name))]) }}">@endif Dr. {{ $data->first_name }}
                                    {{ $data->last_name }}</a></h4>
                                @if (!empty($data->department->department_name))
                                    <span class="post">{{ $data->department->department_name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{ $all_team_members->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
