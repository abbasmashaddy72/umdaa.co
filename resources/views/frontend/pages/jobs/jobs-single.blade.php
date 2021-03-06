@extends('frontend.frontend-page-master')
@section('site-title')
    {{ $job->title }}
@endsection
@section('page-title')
    {{ $job->title }}
@endsection
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-job-details">
                        <ul class="job-meta-list">
                            @if (!empty($job->job_context))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"> {{ 'Job Context' }}</h4>
                                        <p>{{ $job->job_context }}</p>
                                    </div>
                                </li>
                            @endif
                            @if (!empty($job->job_responsibility))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title">{{ 'Job Responsibility' }}</h4>
                                        <ul class="job-details-list">
                                            @php $job_res = explode('|',$job->job_responsibility); @endphp
                                            @foreach ($job_res as $data)
                                                <li>{{ $data }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (!empty($job->education_requirement))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"> {{ 'Educational Requirement' }}</h4>
                                        <ul class="job-details-list">
                                            @php $job_res = explode('|',$job->education_requirement); @endphp
                                            @foreach ($job_res as $data)
                                                <li>{{ $data }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (!empty($job->experience_requirement))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"> {{ 'Experience Requirement' }}</h4>
                                        <ul class="job-details-list">
                                            @php $job_res = explode('|',$job->experience_requirement); @endphp
                                            @foreach ($job_res as $data)
                                                <li>{{ $data }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (!empty($job->additional_requirement))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"> {{ 'Additional Requirement' }}</h4>
                                        <ul class="job-details-list">
                                            @php $job_res = explode('|',$job->additional_requirement); @endphp
                                            @foreach ($job_res as $data)
                                                <li>{{ $data }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (!empty($job->other_benefits))
                                <li>
                                    <div class="single-job-meta-block">
                                        <h4 class="title"> {{ 'Others Benefits' }}</h4>
                                        <ul class="job-details-list">
                                            @php $job_res = explode('|',$job->other_benefits); @endphp
                                            @foreach ($job_res as $data)
                                                <li>{{ $data }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <div class="apply-procedure">
                            <p>{{ 'Send Your CV To:' }} <span>{{ $job->email }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="widget job_information">
                            <h2 class="widget-title">{{ 'Jobs Information' }}</h2>
                            <ul class="job-information-list">
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{ 'Company Name' }}</h4>
                                            <span class="details">{{ $job->company_name }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{ 'Job Category' }}</h4>
                                            <span class="details">{{ $job->category->title }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{ 'Job Position' }}</h4>
                                            <span class="details">{{ $job->position }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="far fa-folder"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{ 'Job Type' }}</h4>
                                            <span class="details">{{ str_replace('_', ' ', $job->employment_status) }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{ 'Salary' }}</h4>
                                            <span class="details">{{ $job->salary }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{ 'Location' }}</h4>
                                            <span class="details">{{ $job->job_location }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-job-info">
                                        <div class="icon">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{{ 'Deadline' }}</h4>
                                            <span class="details">{{ date('d M Y', strtotime($job->deadline)) }}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget_nav_menu">
                            <h2 class="widget-title">{{ get_static_option('site_jobs_category_title') }}</h2>
                            <ul>
                                @foreach ($all_job_category as $data)
                                    <li><a
                                            href="{{ route('frontend.jobs.category', ['id' => $data->id, 'any' => Str::slug($data->title, '-')]) }}">{{ ucfirst($data->title) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
