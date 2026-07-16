@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Form Layouts')

@section('content')
<div class="card">

    {{-- HEADER --}}
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">{{ $form->heading ?? $form->name }}</h5>
            @if(!empty($form->paragraph))
                <p class="text-muted mb-0">{{ $form->paragraph }}</p>
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
                            @if($field->required)
                                <span class="text-danger">*</span>
                            @endif
                        </label>

                        {{-- INPUT TYPES --}}
                        @if(in_array($field->type, ['text', 'email', 'number', 'hidden', 'date', 'time', 'password', 'file']))
                            <input
                                type="{{ $field->type }}"
                                class="form-control {{ $field->class ?? '' }}"
                                id="{{ $field->field_id ?? '' }}"
                                placeholder="{{ $field->placeholder ?? $field->label }}"
                                {{ $field->disabled ? 'disabled' : '' }}
                            >

                        {{-- TEXTAREA --}}
                        @elseif($field->type === 'textarea')
                            <textarea
                                class="form-control {{ $field->class ?? '' }} {{ $field->use_ck_editor ? 'ckeditor' : '' }}"
                                id="{{ $field->field_id ?? '' }}"
                                rows="3"
                                placeholder="{{ $field->placeholder ?? $field->label }}"
                                {{ $field->disabled ? 'disabled' : '' }}
                            ></textarea>

                        {{-- SELECT --}}
                        @elseif(in_array($field->type, ['select', 'radio', 'checkbox']))
                            <select
                                class="form-select {{ $field->class ?? '' }}"
                                id="{{ $field->field_id ?? '' }}"
                                {{ $field->disabled ? 'disabled' : '' }}
                            >
                                <option value="">{{ 'Select '.$field->label }}</option>
                                @foreach ($field->options ?? [] as $option)
                                    <option>{{ $option }}</option>
                                @endforeach
                            </select>
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


