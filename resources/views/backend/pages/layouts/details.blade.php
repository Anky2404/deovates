@extends('backend.layouts.app')

@section('title', 'Deovate World | Form Layouts')

@section('content')
<div class="card">

    {{-- HEADER --}}
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">{{ $form->form_heading ?? $form->name }}</h5>
            @if(!empty($form->form_paragraph))
                <p class="text-muted mb-0">{{ $form->form_paragraph }}</p>
            @endif
        </div>

        {{-- BACK BUTTON --}}
        <a href="{{ route('admin.pages.forms.index') }}"
           class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    {{-- FORM PREVIEW --}}
    <div class="card-body">
        <form>

            <div class="row g-3">

                @forelse($form->fields as $field)
                    <div class="col-md-{{ $field->field_width }}">

                        <label class="form-label">
                            {{ $field->label }}
                            @if($field->is_required)
                                <span class="text-danger">*</span>
                            @endif
                        </label>

                        {{-- INPUT TYPES --}}
                        @if(in_array($field->type, ['text', 'email', 'number', 'hidden']))
                            <input
                                type="{{ $field->type }}"
                                class="form-control {{ $field->css_class ?? '' }}"
                                id="{{ $field->html_id ?? '' }}"
                                placeholder="{{ $field->placeholder ?? $field->label }}"
                                title="{{ $field->help_text ?? '' }}"
                                {{ $field->is_disabled ? 'disabled' : '' }}
                            >

                        {{-- TEXTAREA --}}
                        @elseif($field->type === 'textarea')
                            @if($field->use_editor)
                                <textarea
                                    class="form-control {{ $field->css_class ?? '' }} ckeditor"
                                    id="{{ $field->html_id ?? '' }}"
                                    placeholder="{{ $field->placeholder ?? $field->label }}"
                                    title="{{ $field->help_text ?? '' }}"
                                    {{ $field->is_disabled ? 'disabled' : '' }}
                                ></textarea>
                            @else
                                <textarea
                                    class="form-control {{ $field->css_class ?? '' }}"
                                    id="{{ $field->html_id ?? '' }}"
                                    rows="3"
                                    placeholder="{{ $field->placeholder ?? $field->label }}"
                                    title="{{ $field->help_text ?? '' }}"
                                    {{ $field->is_disabled ? 'disabled' : '' }}
                                ></textarea>
                            @endif

                        {{-- SELECT --}}
                        @elseif($field->type === 'select')
                            <select
                                class="form-select {{ $field->css_class ?? '' }}"
                                id="{{ $field->html_id ?? '' }}"
                                {{ $field->is_disabled ? 'disabled' : '' }}
                            >
                                <option value="">{{ 'Select '.$field->label }}</option>
                                @if(!empty($field->options))
                                    @foreach(explode(',', $field->options) as $option)
                                        <option>{{ $option }}</option>
                                    @endforeach
                                @endif
                            </select>
                        @endif

                        @if(!empty($field->help_text))
                            <small class="form-text text-muted">{{ $field->help_text }}</small>
                        @endif

                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        No fields added to this form.
                    </div>
                @endforelse

            </div>

        </form>
    </div>

</div>
@endsection


