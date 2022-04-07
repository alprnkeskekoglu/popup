@extends('Core::layouts.app')

@section('content')
    @include('Core::includes.page_header', ['headerTitle' => __('Popup::general.title.edit')])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dawnstar.popups.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i>
                            @lang('Core::general.back')
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dawnstar.popups.update', $popup) }}" method="POST" id="popupForm">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="form-label">@lang('Popup::general.labels.status')</label>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline form-radio-success">
                                        <input type="radio" id="status_1" name="status" class="form-check-input @error('status') is-invalid @enderror" value="1" {{ old('status', $popup->status) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_1">@lang('Core::general.status_options.1')</label>
                                    </div>
                                    <div class="form-check form-check-inline form-radio-secondary">
                                        <input type="radio" id="status_2" name="status" class="form-check-input @error('status') is-invalid @enderror" value="2" {{ old('status', $popup->status) == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_2">@lang('Core::general.status_options.2')</label>
                                    </div>
                                    <div class="form-check form-check-inline form-radio-danger">
                                        <input type="radio" id="status_0" name="status" class="form-check-input @error('status') is-invalid @enderror" value="0" {{ old('status', $popup->status) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_0">@lang('Core::general.status_options.0')</label>
                                    </div>
                                    @error('status')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="order" class="form-label">@lang('Popup::general.labels.order')</label>
                                    <input class="form-control w-50 @error('order') is-invalid @enderror" id="order"
                                           type="number" name="order" value="{{ old('order', $popup->order) }}">
                                    @error('order')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <label class="form-label">@lang('Popup::general.labels.devices')</label>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" id="device_desktop" name="devices[]" class="form-check-input @error('devices') is-invalid @enderror"
                                               value="desktop" {{ in_array('desktop', old('devices', $popup->devices)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="device_desktop">
                                            <img src="{{ asset('vendor/dawnstar/popup/medias/desktop.png') }}" class="img-fluid avatar-sm">
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" id="device_tablet" name="devices[]" class="form-check-input @error('devices') is-invalid @enderror"
                                               value="tablet" {{ in_array('tablet', old('devices', $popup->devices)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="device_tablet">
                                            <img src="{{ asset('vendor/dawnstar/popup/medias/tablet.png') }}" class="img-fluid avatar-sm">
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" id="device_mobile" name="devices[]" class="form-check-input @error('devices') is-invalid @enderror"
                                               value="mobile" {{ in_array('mobile', old('devices', $popup->devices)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="device_mobile">
                                            <img src="{{ asset('vendor/dawnstar/popup/medias/mobile.png') }}" class="img-fluid avatar-sm">
                                        </label>
                                    </div>
                                    @error('devices')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">@lang('Popup::general.labels.type')</label>
                                <div class="mb-3">
                                    @for($i=1; $i <= 8; $i++)
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="type_{{ $i }}" name="type" class="form-check-input @error('type') is-invalid @enderror"
                                                   value="{{ $i }}" {{ old('type', $popup->type) == $i ? 'checked' : '' }}>
                                            <label class="form-check-label" for="type_{{ $i }}">
                                                <img src="{{ asset('vendor/dawnstar/popup/medias/0'.$i.'.png') }}" class="img-fluid avatar-xl">
                                            </label>
                                        </div>
                                    @endfor
                                    @error('type')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                                           min="{{ date('Y-m-d') }}"
                                           type="date" name="start_date" value="{{ old('start_date', $popup->start_date) }}">
                                    <label for="start_date">@lang('Popup::general.labels.start_date')</label>
                                    @error('start_date')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                                           min="{{ date('Y-m-d') }}"
                                           type="date" name="end_date" value="{{ old('end_date', $popup->end_date) }}">
                                    <label for="end_date">@lang('Popup::general.labels.end_date')</label>
                                    @error('end_date')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('display') is-invalid @enderror" id="display" name="display">
                                        @for($i = 1; $i <= 3; $i++)
                                            <option {{ old('display', $popup->display) == $i ? 'selected' : '' }} value="{{ $i }}">@lang('Popup::general.display.' . $i)</option>
                                        @endfor
                                    </select>
                                    <label for="end_date">@lang('Popup::general.labels.display')</label>
                                    @error('display')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3 {{ old('display', $popup->display) == 3 ? '' : 'd-none' }}">
                                    <select class="select2 form-select select2-multiple" data-toggle="select2" id="urls" name="urls[]" multiple data-placeholder="@lang('Core::general.select')...">
                                        @foreach($urls as $id => $url)
                                            <option {{ in_array($id, old('urls', $selectedUrls)) ? 'selected' : '' }} value="{{ $id }}">{{ $url }}</option>
                                        @endforeach
                                    </select>
                                    <label for="models">@lang('Popup::general.labels.urls')</label>
                                    @error('urls')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('trigger') is-invalid @enderror" id="trigger" name="trigger">
                                        @for($i = 1; $i <= 3; $i++)
                                            <option {{ old('trigger', $popup->trigger) == $i ? 'selected' : '' }} value="{{ $i }}">@lang('Popup::general.trigger.' . $i)</option>
                                        @endfor
                                    </select>
                                    <label for="trigger">@lang('Popup::general.labels.trigger')</label>
                                    @error('trigger')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3 {{ in_array(old('trigger', $popup->trigger), [2, 3]) ? '' : 'd-none' }}">
                                    <input type="number" min="1" id="trigger_count" name="trigger_count" class="form-control @error('trigger_count') is-invalid @enderror"
                                           value="{{ old('trigger_count', $popup->trigger_count) }}">
                                    <label for="trigger_count">@lang('Popup::general.labels.trigger_count')</label>
                                    @error('trigger_count')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('limit') is-invalid @enderror" id="limit" name="limit">
                                        @for($i = 1; $i <= 3; $i++)
                                            <option {{ old('limit', $popup->limit) == $i ? 'selected' : '' }} value="{{ $i }}">@lang('Popup::general.limit.' . $i)</option>
                                        @endfor
                                    </select>
                                    <label for="limit">@lang('Popup::general.labels.limit')</label>
                                    @error('limit')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3  {{ in_array(old('limit', $popup->limit), [2, 3]) ? '' : 'd-none' }}">
                                    <input type="number" min="1" id="limit_count" name="limit_count" class="form-control @error('limit_count') is-invalid @enderror"
                                           value="{{ old('limit_count', $popup->limit_count) }}">
                                    <label for="limit_count">@lang('Popup::general.labels.limit_count')</label>
                                    @error('limit_count')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" min="0" id="display_second" name="display_second" class="form-control @error('display_second') is-invalid @enderror"
                                           value="{{ old('display_second', $popup->display_second) }}">
                                    <label for="display_second">@lang('Popup::general.labels.display_second')</label>
                                    @error('display_second')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">@lang('Popup::general.labels.show_name')</label>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline form-radio-success">
                                        <input type="radio" id="show_name_1" name="show_name" class="form-check-input @error('show_name') is-invalid @enderror"
                                               value="1" {{ old('show_name', $popup->show_name) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_name_1">@lang('Core::general.status_options.1')</label>
                                    </div>
                                    <div class="form-check form-check-inline form-radio-danger">
                                        <input type="radio" id="show_name_0" name="show_name" class="form-check-input @error('show_name') is-invalid @enderror"
                                               value="0" {{ old('show_name', $popup->show_name) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_name_0">@lang('Core::general.status_options.0')</label>
                                    </div>
                                    @error('show_name')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="d-flex">
                                    @foreach(session('dawnstar.languages') as $language)
                                        <div class="ms-1">
                                            <button type="button" class="btn btn-outline-secondary p-1 languageBtn{{ $loop->first ? ' active' : '' }}" data-language="{{ $language->id }}" {{ old('languages.' . $language->id, 1) == 1 ? '' : 'disabled' }}>
                                                <img src="{{ languageFlag($language->code) }}" width="25"> {{ strtoupper($language->code) }}
                                            </button>
                                            <span class="btn-language-status {{ old('languages.' . $language->id, 1) == 1 ? 'bg-danger' : 'bg-success' }}" data-status="1"><i class="mdi {{ old('languages.' . $language->id, 1) == 1 ? 'mdi-close' : 'mdi-check' }}"></i></span>
                                            <input type="hidden" name="languages[{{ $language->id }}]" value="{{ old('languages.' . $language->id, 1) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @foreach(session('dawnstar.languages') as $language)
                                @php
                                    $translation = $popup->translations()->where('language_id', $language->id)->first();
                                @endphp
                                <div class="col-lg-12">
                                    <div class="form-floating mb-2 hasLanguage {{ $loop->first ? '' : 'd-none' }}" data-language="{{ $language->id }}">
                                        <input type="text"
                                               class="form-control nameInput @if($errors->has("translations.{$language->id}.name")) is-invalid @endif"
                                               name="translations[{{ $language->id }}][name]"
                                               value="{{ old("translations.{$language->id}.name", optional($translation)->name) }}"
                                               id="translations_{{ $language->id }}_name" data-language="{{ $language->id }}"/>
                                        <label for="translations_{{ $language->id }}_name">@lang('Popup::general.labels.name')</label>
                                        @if($errors->has("translations.{$language->id}.name"))
                                            <div class="invalid-feedback">
                                                {{ $errors->first("translations.{$language->id}.name") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-2 hasLanguage {{ $loop->first ? '' : 'd-none' }}" data-language="{{ $language->id }}">
                                        <label for="translations_{{ $language->id }}_detail">@lang('Popup::general.labels.detail')</label>
                                        <textarea class="form-control @if($errors->has("translations.{$language->id}.detail")) is-invalid @endif"
                                                  name="translations[{{ $language->id }}][detail]"
                                                  id="translations_{{ $language->id }}_detail"
                                                  data-type="ckeditor">{{ old("translations.{$language->id}.detail", optional($translation)->detail) }}</textarea>
                                        @if($errors->has("translations.{$language->id}.detail"))
                                            <div class="invalid-feedback">
                                                {{ $errors->first("translations.{$language->id}.detail") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary" form="popupForm">@lang('Core::general.save')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/dawnstar/core/js/language-button.js') }}"></script>
    <script src="{{ asset('vendor/dawnstar/core/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/dawnstar/core/plugins/ckeditor/lang/' . session('dawnstar.language.code') . '.js') }}"></script>
    <script>
        $('#start_date').on('change', function () {
            $('#end_date').attr('min', $(this).val())
        })
        $('#end_date').on('change', function () {
            $('#start_date').attr('max', $(this).val())
        })
        $('#display').on('change', function () {
            if($(this).val() == 3)  {
                $('#urls').parent().removeClass('d-none');
            } else {
                $('#urls').parent().addClass('d-none');
            }
        })
        $('#trigger').on('change', function () {
            if($(this).val() == 1)  {
                $('#trigger_count').parent().addClass('d-none');
            } else {
                $('#trigger_count').parent().removeClass('d-none');
            }
        })
        $('#limit').on('change', function () {
            if($(this).val() == 1)  {
                $('#limit_count').parent().addClass('d-none');
            } else {
                $('#limit_count').parent().removeClass('d-none');
            }
        })

        $('.select2-selection--multiple').addClass('form-select');
        @if($errors->any())
        showMessage('error', 'Oops...', '')
        $('#urls').trigger('change');
        @endif

        @error('urls')
        $('.select2-selection--multiple').addClass('is-invalid').attr('style', 'border-color: #ff5b5b !important');
        @enderror

        var editors = document.querySelectorAll('textarea[data-type="ckeditor"]');
        for (var i = 0; i < editors.length; ++i) {
            CKEDITOR.replace(editors[i], {
                language: '{{ session('dawnstar.language.code') }}',
                filebrowserImageBrowseUrl: '/dawnstar/media-manager?selectable=image&maxCount=1',
                filebrowserBrowseUrl: '/dawnstar/media-manager?selectable=image&maxCount=1',
                toolbar: [
                    {
                        name: 'clipboard',
                        groups: ['clipboard', 'undo'],
                        items: ['PasteFromWord', '-', 'Undo', 'Redo']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker'],
                        items: ['Find', 'Replace']
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'textindent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                    },
                    {name: 'insert', items: ['Image', 'Table', 'bol', 'SpecialChar', 'Iframe']},
                    {name: 'links', items: ['Link', 'Unlink']},
                    '/',
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                    },
                    {name: 'styles', items: ['Styles', 'Format', 'FontSize']},
                    {name: 'colors', items: ['TextColor', 'BGColor']},
                    {name: 'tools', items: ['Maximize', 'ShowBlocks']},
                    {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source', 'kopyala']}

                ]
            });
        }
    </script>
@endpush
