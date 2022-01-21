@extends('backend.admin-master')
@section('site-title')
    {{ 'New Job Post' }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Add New Job Post' }}</h4>
                        <form action="{{ route('admin.jobs.new') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title">{{ 'Title' }}</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title') }}" placeholder="{{ 'Title' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="position">{{ 'Job Position' }}</label>
                                        <input type="text" class="form-control" id="position" name="position"
                                            value="{{ old('position') }}" placeholder="{{ 'Position' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">{{ 'Company Name' }}</label>
                                        <input type="text" class="form-control" id="company_name"
                                            value="{{ old('company_name') }}" name="company_name"
                                            placeholder="{{ 'Company Name' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{ 'Category' }}</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">{{ 'Select Category' }}</option>
                                            @foreach ($all_category as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vacancy">{{ 'Vacancy' }}</label>
                                        <input type="text" class="form-control" id="vacancy" value="{{ old('vacancy') }}"
                                            name="vacancy" placeholder="{{ 'Vacancy' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="job_context">{{ 'Job Context' }}</label>
                                        <textarea name="job_context" id="job_context" class="form-control" cols="30"
                                            placeholder="{{ 'Job Context' }}"
                                            rows="10">{{ old('job_context') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="job_responsibility">{{ 'Job Responsibility' }}</label>
                                        <textarea name="job_responsibility" id="job_responsibility" class="form-control"
                                            cols="30" placeholder="{{ 'Job Responsibility' }}"
                                            rows="10">{{ old('job_responsibility') }}</textarea>
                                        <small
                                            class="info-text">{{ 'separate responsibility by pipe (|), to break in new line' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="education_requirement">{{ 'Educational Requirements' }}</label>
                                        <textarea name="education_requirement" id="education_requirement"
                                            class="form-control" cols="30" placeholder="{{ 'Educational Requirements' }}"
                                            rows="10">{{ old('education_requirement') }}</textarea>
                                        <small
                                            class="info-text">{{ 'separate responsibility by pipe (|), to break in new line' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="experience_requirement">{{ 'Experience Requirements' }}</label>
                                        <textarea name="experience_requirement" id="experience_requirement"
                                            class="form-control" cols="30" placeholder="{{ 'Experience Requirements' }}"
                                            rows="10">{{ old('experience_requirement') }}</textarea>
                                        <small
                                            class="info-text">{{ 'separate responsibility by pipe (|), to break in new line' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="additional_requirement">{{ 'Additional Requirements' }}</label>
                                        <textarea name="additional_requirement" id="additional_requirement"
                                            class="form-control" cols="30" placeholder="{{ 'Additional Requirements' }}"
                                            rows="10">{{ old('additional_requirement') }}</textarea>
                                        <small
                                            class="info-text">{{ 'separate responsibility by pipe (|), to break in new line' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_status">{{ 'Employment Status' }}</label>
                                        <select name="employment_status" id="employment_status" class="form-control">
                                            <option value="full_time">{{ 'Full-Time' }}</option>
                                            <option value="part_time">{{ 'Part-Time' }}</option>
                                            <option value="project_based">{{ 'Project Based' }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="job_location">{{ 'Job Location' }}</label>
                                        <input type="text" class="form-control" id="job_location" name="job_location"
                                            value="{{ old('job_location') }}" placeholder="{{ 'Job Location' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="other_benefits">{{ 'Compensation & Other Benefits' }}</label>
                                        <textarea name="other_benefits" id="other_benefits" class="form-control" cols="30"
                                            placeholder="{{ 'Compensation & Other Benefits' }}"
                                            rows="10">{{ old('other_benefits') }}</textarea>
                                        <small
                                            class="info-text">{{ 'separate responsibility by pipe (|), to break in new line' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ 'Email' }}</label>
                                        <input type="text" class="form-control" id="email" value="{{ old('email') }}"
                                            name="email" placeholder="{{ 'Email' }}">
                                        <small
                                            class="info-text">{{ 'enter an email address where everyone will apply to the post' }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary">{{ 'Salary' }}</label>
                                        <input type="text" class="form-control" id="salary" name="salary"
                                            value="{{ old('salary') }}" placeholder="{{ 'Salary' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline">{{ 'Deadline' }}</label>
                                        <input type="date" class="form-control" id="deadline" name="deadline"
                                            placeholder="{{ 'Deadline' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{ 'Status' }}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="publish">{{ 'Publish' }}</option>
                                            <option value="draft">{{ 'Draft' }}</option>
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary mt-4 pr-4 pl-4">{{ 'Add New Job' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
