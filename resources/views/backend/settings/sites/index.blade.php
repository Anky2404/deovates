@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Site Settings')

@section('content')

    <form method="POST" action="{{ route('admin.settings.sites.saveorupdate') }}">
        @csrf

        @forelse ($groups as $group => $settings)
            <div class="card mb-4">

                <!-- Card Header -->
                <div class="card-header">
                    <h5 class="mb-0 text-capitalize">{{ str_replace('_', ' ', $group) }} Settings</h5>
                </div>

                <div class="card-body row g-3">
                    @foreach ($settings as $setting)
                        <div class="col-md-6">
                            <label class="form-label">
                                {{ $setting->label ?? \Illuminate\Support\Str::headline($setting->key) }}
                            </label>

                            @if ($setting->type === 'boolean')
                                <div class="form-check form-switch mt-2">
                                    <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="settings[{{ $setting->key }}]"
                                           value="1"
                                           {{ old('settings.' . $setting->key, $setting->value) ? 'checked' : '' }}>
                                </div>
                            @elseif ($setting->type === 'integer')
                                <input type="number"
                                       name="settings[{{ $setting->key }}]"
                                       class="form-control"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}">
                            @elseif (in_array($setting->type, ['textarea', 'text_long']))
                                <textarea name="settings[{{ $setting->key }}]"
                                          class="form-control"
                                          rows="3">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                            @elseif ($setting->type === 'select' && !empty($setting->options))
                                <select name="settings[{{ $setting->key }}]" class="form-select">
                                    @foreach ($setting->options as $optionValue => $optionLabel)
                                        <option value="{{ $optionValue }}"
                                            {{ old('settings.' . $setting->key, $setting->value) == $optionValue ? 'selected' : '' }}>
                                            {{ $optionLabel }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text"
                                       name="settings[{{ $setting->key }}]"
                                       class="form-control"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}">
                            @endif

                            @if ($setting->description)
                                <div class="form-text">{{ $setting->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body text-center text-muted py-4">
                    No site settings found.
                </div>
            </div>
        @endforelse

        @if ($groups->isNotEmpty())
            <div class="card">
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i>
                        Save Settings
                    </button>
                </div>
            </div>
        @endif
    </form>

@endsection
