<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">{{ __('Enable Doctor Services') }}</h4>

            <div class="tab-content margin-top-40" id="myTabContent">
                <div class="tab-pane fade show active" role="tabpanel">
                    <form action="{{ route('admin.doctor.details.edit.service') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @foreach ($singleDetails as $data)
                            <input type="hidden" value="{{ $data->doctor_id }}" name="doctor_id">
                        @endforeach
                        <table class="table table-default">
                            <thead>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Service Title') }}</th>
                                <th>{{ __('Action') }}</th>
                            </thead>
                            <tbody>
                                @php
                                    foreach ($docServices as $data) {
                                        $sevdep = $data->department_id;
                                    }
                                    foreach ($singleDetails as $data) {
                                        $dep = $data->department_id;
                                    }
                                @endphp
                                @if (!empty($sevdep))
                                    @if ($sevdep != $dep)
                                        @if (!empty($docsavedservicess))
                                            @foreach ($docsavedservicess as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <input type="hidden" name="id[]" value="{{ $data->id }}" />
                                                    <td>{{ $data->title }}</td>
                                                    <input type="hidden" name="title[]" value="{{ $data->title }}" />
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" name="service_status[]" @if ($data->service_status == 1) checked @endif>
                                                            <span class="slider onff"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                @endif
                                @if (!empty($docsavedservicess))
                                    @foreach ($docsavedservicess as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <input type="hidden" name="id[]" value="{{ $data->id }}" />
                                            <td>{{ $data->title }}</td>
                                            <input type="hidden" name="title[]" value="{{ $data->title }}" />
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" name="service_status[]" @if ($data->service_status == 1) checked @endif>
                                                    <span class="slider onff"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if (!empty($sevdep))
                                    @if ($sevdep == $dep)
                                        @if (!empty($docServices))
                                            @foreach ($docServices as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <input type="hidden" name="id[]" value="{{ $data->id }}" />
                                                    <td>{{ $data->title }}</td>
                                                    <input type="hidden" name="title[]" value="{{ $data->title }}" />
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" name="service_status[]" checked>
                                                            <span class="slider onff"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                @endif
                            </tbody>
                        </table>
                        <button type="submit"
                            class="btn btn-primary mt-4 pr-4 pl-4">{{ __('Save Servies List') }}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
