<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">{{ __('Update Doctor Details') }}</h4>
            <form action="{{ route('admin.doctor.details.edit.profile') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @foreach ($singleDetails as $data)
                    <input type="hidden" value="{{ $data->doctor_id }}" name="doctor_id">
                    <div class="container">
                        <div class="row">
                            <div class="col form-group">
                                <label for="title">{{ __('First Name') }}</label>
                                <input type="text" class="form-control" name="first_name"
                                    placeholder="{{ __('First Name') }}" value="{{ $data->first_name }}">
                            </div>
                            <div class="col form-group">
                                <label for="title">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control" name="last_name"
                                    placeholder="{{ __('Last Name') }}" value="{{ $data->last_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col form-group">
                                <label for="title">{{ __('Tags') }}</label>
                                <input type="text" class="form-control" name="tags" data-role="tagsinput"
                                    value="{{ $data->tags }}">
                            </div>
                            <div class="col form-group">
                                <label for="category">{{ __('Depertment') }}</label>
                                <select name="department_id" class="form-control">
                                    <option value="" selected disabled>{{ __('Select Depertment') }}</option>
                                    @php
                                        $dep = $data->department_id;
                                    @endphp
                                    @foreach ($all_category as $data)
                                        <option @if ($data->department_id == $dep) selected @endif
                                            value="{{ $data->department_id }}">{{ $data->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach ($singleDetails as $data)
                    <div class="container">
                        <div class="row">
                            <div class="col form-group">
                                <label for="description">{{ __('About') }}</label>
                                <textarea name="about" class="form-control max-height-120" cols="30" rows="10"
                                    placeholder="{{ __('Enter Doctor About Data') }}">{{ $data->about }}</textarea>
                            </div>
                            <div class="col form-group">
                                <label for="description">{{ __('Testimonial') }}</label>
                                <textarea name="testimonial" class="form-control max-height-120" cols="30" rows="10"
                                    placeholder="{{ __('Enter Doctor Testimonial') }}">{{ $data->testimonial }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col form-group">
                                <label for="profile_image">{{ __('Image') }}</label>
                                <div class="media-upload-btn-wrapper">
                                    <input type="file" name="profile_image" value="profile_image" style="color: white">
                                </div>
                                @php
                                    $blog_img = $data->profile_image;
                                    $blog_image_btn_label = 'Upload Image';
                                @endphp
                                @if (!empty($blog_img))
                                    <br>
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb"
                                                    src="{{ 'https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <small>{{ __('Recommended image size 1920x1280') }}</small>
                            </div>
                            <div class="col form-group">
                                <label for="title">{{ __('Languages Known') }}</label>
                                <input type="text" class="form-control" name="languages" data-role="tagsinput"
                                    placeholder="{{ __('Enter Doctor Languages Known') }}"
                                    value="{{ $data->languages }}">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col form-group">
                                <label for="title">{{ __('Facebook URL') }}</label>
                                <input type="text" class="form-control" name="fb_url"
                                    placeholder="{{ __('Facebook URL') }}" value="{{ $data->fb_url }}">
                            </div>
                            <div class="col form-group">
                                <label for="title">{{ __('Linkedin URL') }}</label>
                                <input type="text" class="form-control" name="li_url"
                                    placeholder="{{ __('Linkedin URL') }}" value="{{ $data->li_url }}">
                            </div>
                            <div class="col form-group">
                                <label for="title">{{ __('Twitter URL') }}</label>
                                <input type="text" class="form-control" name="tw_url"
                                    placeholder="{{ __('Twitter URL') }}" value="{{ $data->tw_url }}">
                            </div>
                            <div class="col form-group">
                                <label for="title">{{ __('Instagram URL') }}</label>
                                <input type="text" class="form-control" name="in_url"
                                    placeholder="{{ __('Instagram URL') }}" value="{{ $data->in_url }}">
                            </div>
                            <div class="col form-group">
                                <label for="title">{{ __('Google MyBusiness URL') }}</label>
                                <input type="text" class="form-control" name="gb_url"
                                    placeholder="{{ __('Google MyBusiness URL') }}" value="{{ $data->gb_url }}">
                            </div>
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{ __('Save Doctor Details') }}</button>
            </form>
        </div>
    </div>
</div>
