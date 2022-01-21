<div class="col-lg-6 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">{{ __('Added Doctor Experience List') }}</h4>

            <div class="tab-content margin-top-40" id="myTabContent">
                <div class="tab-pane fade show active" role="tabpanel">
                    <table class="table table-default">
                        <thead>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Timeline') }}</th>
                            <th>{{ __('Designation') }}</th>
                            <th>{{ __('Location / About') }}</th>
                            <th>{{ __('Action') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($docExp as $data)
                                <tr>
                                    <td>{{ $data->exp_id }}</td>
                                    <td>{{ $data->exp_timeline }}</td>
                                    <td>{{ $data->exp_designation }}</td>
                                    <td>{{ $data->exp_location_about }}</td>
                                    <td>
                                        <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1" role="button"
                                            data-toggle="popover" data-trigger="focus" data-html="true" title=""
                                            data-content="
                                            <h6>Are you sure to delete this Doctor Experience item ?</h6>
                                            <form method='post' action='{{ route('admin.doctor.details.delete.exp', $data->exp_id) }}'>
                                            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                            <br>
                                            <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                            </form>
                                            ">
                                            <i class="ti-trash"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#exp_info_item_edit_modal"
                                            class="btn btn-lg btn-primary btn-sm mb-3 mr-1 exp_info_edit_btn"
                                            data-id="{{ $data->exp_id }}" data-timeline="{{ $data->exp_timeline }}"
                                            data-designation="{{ $data->exp_designation }}"
                                            data-location_about="{{ $data->exp_location_about }}">
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
            <h4 class="header-title">{{ __('Add Doctor Experience') }}</h4>
            <form action="{{ route('admin.doctor.details.edit.exp') }}" method="post" enctype="multipart/form-data">
                @foreach ($singleDetails as $data)
                    <input type="hidden" value="{{ $data->doctor_id }}" name="doctor_id">
                @endforeach
                @csrf
                <div class="form-group">
                    <label for="title">{{ __('Timeline') }}</label>
                    <input type="text" class="form-control" id="timeline" name="timeline"
                        placeholder="{{ __('Timeline') }}">
                </div>
                <div class="form-group">
                    <label for="title">{{ __('Designation') }}</label>
                    <input type="text" class="form-control" id="designation" name="designation"
                        placeholder="{{ __('Designation') }}">
                </div>
                <div class="form-group">
                    <label for="title">{{ __('Location / About') }}</label>
                    <input type="text" class="form-control" id="location_about" name="location_about"
                        placeholder="{{ __('Location / About') }}">
                </div>
                <button type="submit"
                    class="btn btn-primary mt-4 pr-4 pl-4">{{ __('Add Doctor Experience') }}</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exp_info_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Doctor Experience') }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{ route('admin.doctor.details.update.exp') }}" id="exp_info_edit_modal_form"
                method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="contact_info_id" value="">

                    <div class="form-group">
                        <label for="edit_title">{{ __('Timeline') }}</label>
                        <input type="text" class="form-control" id="edit_timeline" name="timeline"
                            placeholder="{{ __('Timeline') }}">
                    </div>
                    <div class="form-group">
                        <label for="edit_title">{{ __('Designation') }}</label>
                        <input type="text" class="form-control" id="edit_designation" name="designation"
                            placeholder="{{ __('Designation') }}">
                    </div>
                    <div class="form-group">
                        <label for="edit_title">{{ __('Location / About') }}</label>
                        <input type="text" class="form-control" id="edit_location_about" name="location_about"
                            placeholder="{{ __('Location / About') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
