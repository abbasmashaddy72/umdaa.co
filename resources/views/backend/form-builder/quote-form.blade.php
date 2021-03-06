@extends('backend.admin-master')
@section('site-title')
    {{ 'Quote Form Builder' }}
@endsection
@section('style')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Quote Form Builder' }}</h4>
                        <form action="{{ route('admin.form.builder.quote') }}" method="Post">
                            @csrf
                            @php
                                $form_fields = json_decode(get_static_option('quote_page_form_fields'));
                                $select_index = 0;
                            @endphp
                            <ul id="sortable" class="available-form-field main-fields">
                                @foreach ($form_fields->field_type as $key => $value)
                                    <li class="ui-state-default">
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                        <span class="remove-fields">x</span>
                                        <a data-toggle="collapse" href="#fileds_collapse_{{ $key }}" role="button"
                                            aria-expanded="false" aria-controls="collapseExample">
                                            {{ ucfirst($value) }}: <span
                                                class="placeholder-name">{{ $form_fields->field_placeholder[$key] }}</span>
                                        </a>
                                        <div class="collapse" id="fileds_collapse_{{ $key }}">
                                            <div class="card card-body margin-top-30">
                                                <input type="hidden" class="form-control" name="field_type[]"
                                                    value="{{ $value }}">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control " name="field_name[]"
                                                        placeholder="enter field name"
                                                        value="{{ $form_fields->field_name[$key] }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Placeholder/Label</label>
                                                    <input type="text" class="form-control field-placeholder"
                                                        name="field_placeholder[]" placeholder="enter field name"
                                                        value="{{ $form_fields->field_placeholder[$key] }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><strong>Required</strong></label>
                                                    <label class="switch">
                                                        <input type="checkbox" class="field-required"
                                                            name="field_required[{{ $key }}]" @if (is_object($form_fields->field_required) && !empty($form_fields->field_required->$key)) checked @elseif(is_array($form_fields->field_required) && !empty($form_fields->field_required[$key])) checked @endif>
                                                        <span class="slider onff"></span>
                                                    </label>
                                                </div>
                                                @if ($value == 'select')
                                                    <div class="form-group">
                                                        <label>Options</label>
                                                        <textarea name="select_options[]"
                                                            class="form-control max-height-120" cols="30" rows="10"
                                                            placeholder=""
                                                            required>{{ $form_fields->select_options[$select_index] }}</textarea>
                                                        <small>separate option by ; </small>
                                                    </div>
                                                    @php $select_index++; @endphp
                                                @endif
                                                @if ($value == 'file')
                                                    <div class="form-group">
                                                        <label>File Type</label>
                                                        <select name="mimes_type[{{ $key }}]"
                                                            class="form-control mime-type">
                                                            <option value="mimes:jpg,jpeg,png" @if (isset($form_fields->mimes_type->$key) && $form_fields->mimes_type->$key == 'mimes:jpg,jpeg,png') selected @endif>jpg,jpeg,png</option>
                                                            <option value="mimes:txt,pdf" @if (isset($form_fields->mimes_type->$key) && $form_fields->mimes_type->$key == 'mimes:txt,pdf') selected @endif>txt,pdf</option>
                                                            <option value="mimes:doc,docx" @if (isset($form_fields->mimes_type->$key) && $form_fields->mimes_type->$key == 'mimes:doc,docx') selected @endif>doc,docx</option>
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 margin-bottom-40"
                                id="db_backup_btn">{{ 'Save Change' }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ 'Available Form Fields' }}</h4>
                        <ul id="sortable_02" class="available-form-field">
                            <li class="ui-state-default" type="text"><span
                                    class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ 'Text' }}</li>
                            <li class="ui-state-default" type="email"><span
                                    class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ 'Email' }}</li>
                            <li class="ui-state-default" type="tel"><span
                                    class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ 'Tel' }}</li>
                            <li class="ui-state-default" type="url"><span
                                    class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ 'URL' }}</li>
                            <li class="ui-state-default" type="select"><span
                                    class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ 'Select' }}</li>
                            <li class="ui-state-default" type="checkbox"><span
                                    class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ 'Check Box' }}</li>
                            <li class="ui-state-default" type="file"><span
                                    class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ 'File' }}</li>
                            <li class="ui-state-default" type="textarea"><span
                                    class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ 'Textarea' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#sortable").sortable({
                    axis: "y",
                    placeholder: "sortable-placeholder",
                    out: function(event, ui) {
                        setTimeout(function() {
                            var allShortableList = $("#sortable li");

                            allShortableList.each(function(index, value) {
                                var el = $(this);
                                el.find('.field-required').attr('name',
                                    'field_required[' + index + ']');
                                el.find('.mime-type').attr('name', 'mimes_type[' +
                                    index + ']');
                            });
                        }, 500);
                    }
                }).disableSelection();
                $("#sortable_02").sortable({
                    connectWith: '#sortable',
                    helper: "clone",
                    remove: function(e, li) {
                        var value = li.item.context.attributes.type.value;
                        var random = Math.floor(Math.random(9999) * 999999);
                        var formFiledLength = $('#sortable li').length - 1;

                        var markup =
                            '<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>\n <span class="remove-fields">x</span>\n<a data-toggle="collapse" href="#collapseExample-' +
                            random +
                            '" role="button" aria-expanded="false" aria-controls="collapseExample">\n' +
                            '                                       ' + value +
                            ': <span class="placeholder-name"></span>\n' +
                            '                                    </a>\n' +
                            '                                    <div class="collapse" id="collapseExample-' +
                            random + '">\n' +
                            '                                        <div class="card card-body margin-top-30">\n' +
                            ' <input type="hidden" class="form-control" name="field_type[]" value="' +
                            value + '">' +
                            '                                           <div class="form-group">\n' +
                            '                                               <label>Name</label>\n' +
                            '                                               <input type="text" class="form-control " name="field_name[]" placeholder="enter field name" required>\n' +
                            '                                           </div>\n' +
                            '                                            <div class="form-group">\n' +
                            '                                                <label>Placeholder/Label</label>\n' +
                            '                                                <input type="text" class="form-control field-placeholder"  name="field_placeholder[]" placeholder="enter field name" required>\n' +
                            '                                            </div>\n' +
                            '<div class="form-group">\n' +
                            '                                                    <label ><strong>Required</strong></label>\n' +
                            '                                                    <label class="switch">\n' +
                            '                                                        <input type="checkbox" class="field-required" name="field_required[' +
                            formFiledLength + ']" >\n' +
                            '                                                        <span class="slider onff"></span>\n' +
                            '                                                    </label>\n' +
                            '                                                </div>'
                        '                                        </div>\n' +
                        '                                    </div>';

                        if (value == 'select') {
                            markup =
                                '<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>\n <span class="remove-fields">x</span>\n<a data-toggle="collapse" href="#collapseExample-' +
                                random +
                                '" role="button" aria-expanded="false" aria-controls="collapseExample">\n' +
                                '                                       ' + value +
                                ': <span class="placeholder-name"></span>\n' +
                                '                                    </a>\n' +
                                '                                    <div class="collapse" id="collapseExample-' +
                                random + '">\n' +
                                '                                        <div class="card card-body margin-top-30">\n' +
                                ' <input type="hidden" class="form-control" name="field_type[]" value="' +
                                value + '">' +
                                '                                           <div class="form-group">\n' +
                                '                                               <label>Name</label>\n' +
                                '                                               <input type="text" class="form-control " name="field_name[]" placeholder="enter field name" required>\n' +
                                '                                           </div>\n' +
                                '                                            <div class="form-group">\n' +
                                '                                                <label>Placeholder/Label</label>\n' +
                                '                                                <input type="text" class="form-control field-placeholder" name="field_placeholder[]" placeholder="enter field name" required>\n' +
                                '                                            </div>\n' +
                                '<div class="form-group">\n' +
                                '                                                    <label ><strong>Required</strong></label>\n' +
                                '                                                    <label class="switch">\n' +
                                '                                                        <input type="checkbox" class="field-required" name="field_required[' +
                                formFiledLength + ']"   >\n' +
                                '                                                        <span class="slider onff"></span>\n' +
                                '                                                    </label>\n' +
                                '                                                </div>' +
                                '<div class="form-group">\n' +
                                '                                                <label>Options</label>\n' +
                                '                                                    <textarea name="select_options[]"  class="form-control max-height-120" cols="30" rows="10" placeholder="" required></textarea>\n' +
                                '                                                    <small>separate option by ; </small>\n' +
                                '                                            </div>\n' +
                                '                                        </div>\n' +
                                '                                    </div>';
                        }
                        if (value == 'file') {
                            var mimeType = '';
                            markup =
                                '<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>\n <span class="remove-fields">x</span>\n<a data-toggle="collapse" href="#collapseExample-' +
                                random +
                                '" role="button" aria-expanded="false" aria-controls="collapseExample">\n' +
                                '                                       ' + value +
                                ': <span class="placeholder-name"></span>\n' +
                                '                                    </a>\n' +
                                '                                    <div class="collapse" id="collapseExample-' +
                                random + '">\n' +
                                '                                        <div class="card card-body margin-top-30">\n' +
                                ' <input type="hidden" class="form-control" name="field_type[]" value="' +
                                value + '">' +
                                '                                           <div class="form-group">\n' +
                                '                                               <label>Name</label>\n' +
                                '                                               <input type="text" class="form-control " name="field_name[]" placeholder="enter field name" required>\n' +
                                '                                           </div>\n' +
                                '                                            <div class="form-group">\n' +
                                '                                                <label>Placeholder/Label</label>\n' +
                                '                                                <input type="text" class="form-control field-placeholder" name="field_placeholder[]" placeholder="enter field name" required>\n' +
                                '                                            </div>\n' +
                                '<div class="form-group">\n' +
                                '                                                    <label ><strong>Required</strong></label>\n' +
                                '                                                    <label class="switch">\n' +
                                '                                                        <input type="checkbox" class="field-required" name="field_required[' +
                                formFiledLength + ']" >\n' +
                                '                                                        <span class="slider onff"></span>\n' +
                                '                                                    </label>\n' +
                                '                                                </div>' +
                                '<div class="form-group">\n' +
                                '                                                        <label>File Type</label>\n' +
                                '                                                        <select name="mimes_type[' +
                                formFiledLength + ']" class="form-control mime-type">\n' +
                                '                                                            <option value="mimes:jpg,jpeg,png" >jpg,jpeg,png</option>\n' +
                                '                                                            <option value="mimes:txt,pdf">txt,pdf</option>\n' +
                                '<option value="mimes:doc,docx">doc,docx</option>\n' +
                                '                                                        </select>\n' +
                                '                                                    </div>'
                            '                                        </div>\n' +
                            '                                    </div>';
                        }

                        li.item.clone()
                            .prop('id', value + '_' + random)
                            .text('')
                            .append(markup)
                            .insertAfter(li.item);
                        $(this).sortable('cancel');
                        return li.item.clone();
                    }
                }).disableSelection();

                $('.field-placeholder').on('change paste keyup', function(e) {
                    $(this).parent().parent().parent().prev().find('.placeholder-name').text($(this)
                        .val());
                });
                $('body').on('click', '.remove-fields', function(e) {
                    $(this).parent().remove();
                    $("#sortable").sortable("refreshPositions");
                });
            });
        }(jQuery));

    </script>
@endsection
