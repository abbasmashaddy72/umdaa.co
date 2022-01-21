<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">{{ __('Doctor Practice Location') }}</h4>
            <p>Please Add Slots to appear on the Website.</p>
            <div class="tab-content margin-top-40" id="myTabContent">
                <div class="tab-pane fade show active" role="tabpanel">
                    <table class="table table-default">
                        <thead>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Clinic Name') }}</th>
                            <th>{{ __('Location') }}</th>
                            <th>{{ __('Contact No.') }}</th>
                            <th>{{ __('Action') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($docWrk as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->clinic_name }}</td>
                                    <td>{{ $data->location }}</td>
                                    <td>{{ $data->clinic_phone }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#exp_info_item_edit_modal"
                                            class="btn btn-lg btn-primary btn-sm mb-3 mr-1 clinic_info_edit_btn"
                                            data-id="{{ $data->id }}" data-clinic_name="{{ $data->clinic_name }}"
                                            data-location="{{ $data->location }}"
                                            data-clinic_phone="{{ $data->clinic_phone }}">
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
<div class="modal fade" id="exp_info_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Edit Clinic DEtails') }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{ route('admin.clinic.details.update') }}" id="clinic_info_edit_modal_form" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="contact_info_id" value="">

                    <div class="form-group">
                        <label for="edit_title">{{ __('Clinci Name') }}</label>
                        <input type="text" class="form-control" id="edit_clinic_name" name="clinic_name"
                            placeholder="{{ __('Clinic Name') }}">
                    </div>
                    <div class="form-group">
                        <label for="edit_title">{{ __('Location') }}</label>
                        <input type="text" class="form-control" id="edit_location" name="location"
                            placeholder="{{ __('Clinic Location') }}">
                    </div>
                    <div class="form-group">
                        <label for="edit_title">{{ __('Contact Number') }}</label>
                        <input type="text" class="form-control" id="edit_clinic_phone" name="clinic_phone"
                            placeholder="{{ __('Clinic Contcat No.') }}">
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
