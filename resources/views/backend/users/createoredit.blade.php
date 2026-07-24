@extends('backend.layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Create User')

@section('content')
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">{{ isset($user) ? 'Edit User' : 'Create User' }}</h5>
        </div>

        <form id="userForm" method="POST" enctype="multipart/form-data"
            action="{{ route('admin.users.saveorupdate', ['uuid' => $user->uuid ?? null]) }}">

            @csrf


            <div class="card-body">
                <div class="row g-3">

                    {{-- ROLE --}}
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-select" >
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" data-slug="{{ $role->slug }}"
                                    {{ isset($user) && $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- DEPARTMENT --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Department
                            <span id="departmentRequiredMark" class="text-danger">*</span>
                            <small id="departmentOptionalNote" class="text-muted d-none">(not required for Admin / Super Admin)</small>
                        </label>
                        <select name="department_id" id="department_id" class="form-select" >
                            <option value="">-- Select Department --</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ isset($user) && $user->department_id == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- NAME --}}
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name ?? old('name') }}"
                            >
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email ?? old('email') }}"
                            >
                    </div>

                    {{-- PHONE --}}
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>

                        <div class="input-group">

                            <!-- Country Code Dropdown -->
                            <select name="country_code" class="form-select" style="max-width: 140px;">

                                @php
                                    $selectedCountry =
                                        old('country_code') ??
                                        ($user->country_code ?? null ?? config('constants.DEFAULT_COUNTRY_CODE'));
                                @endphp

                                @foreach ($countries as $country)
                                    <option value="{{ $country->phonecode }}"
                                        {{ (string) $selectedCountry === (string) $country->phonecode ? 'selected' : '' }}>
                                        {{ $country->emoji }} +{{ $country->phonecode }}
                                    </option>
                                @endforeach

                            </select>



                            <!-- Phone Number Input -->
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $user->phone ?? '') }}" placeholder="Enter phone number">
                        </div>
                    </div>


                    {{-- DESIGNATION --}}
                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <input type="text" name="designation" class="form-control"
                            value="{{ $user->designation ?? old('designation') }}">
                    </div>

                    {{-- AVATAR --}}
                   <div class="col-md-6">
    @include('backend.partials.image-upload-box', [
        'name' => 'avatar',
        'label' => 'Profile Image',
        'previewId' => 'avatarPreview',
        'previewUrl' => isset($user) && $user->avatar ? asset('storage/' . $user->avatar) : null,
        'width' => 400,
        'height' => 400,
        'altName' => 'avatar_alt',
        'altValue' => old('avatar_alt', $user->avatar_alt ?? ''),
    ])
</div>

                    {{-- PASSWORD --}}
                    <div class="col-md-6">
                        <label class="form-label">
                            Password
                            @if (isset($user))
                                <small>(Leave blank to keep existing password)</small>
                            @endif
                        </label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    {{-- BIO --}}
                    <div class="col-md-12">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" id="bio_input" class="form-control ckeditor-field" data-ck-height="250" rows="4">{{ $user->bio ?? old('bio') }}</textarea>
                    </div>

                    {{-- ACTIVE --}}
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $user->is_active ?? 1) ? 'checked' : '' }}>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary">
                    {{ isset($user) ? 'Update' : 'Create' }}
                </button>
            </div>


        </form>
    </div>
@endsection
@push('scripts')
    <script>
function isAdminRoleSelected() {
    var slug = $('#role_id option:selected').data('slug');
    return slug === 'super-admin' || slug === 'admin';
}

function toggleDepartmentRequirement() {
    var adminRole = isAdminRoleSelected();
    $('#departmentRequiredMark').toggleClass('d-none', adminRole);
    $('#departmentOptionalNote').toggleClass('d-none', !adminRole);
}

$.validator.addMethod("phoneFormat", function (value, element) {
    return this.optional(element) || /^[0-9+\-\s()]{6,20}$/.test(value);
}, "Please enter a valid phone number.");

$(document).ready(function () {

    toggleDepartmentRequirement();

    $('#role_id').on('change', function () {
        toggleDepartmentRequirement();
        $('#userForm').valid();
    });

    $("#userForm").validate({

        onkeyup: true,      // validate while typing
        onfocusout: true,   // validate on tab/blur
        onclick: false,

        rules: {
            role_id: {
                required: true
            },
            department_id: {
                required: function () {
                    return !isAdminRoleSelected();
                }
            },
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            country_code: {
                required: true
            },
            phone: {
                required: true,
                phoneFormat: true,
                minlength: 6,
                maxlength: 20
            },
            designation: {
                required: true
            },

            @if (!isset($user))
            // only required in CREATE
            password: {
                required: true,
                minlength: 6
            },
            @endif

            bio: {
                required: false
            }
        },

        messages: {
            role_id: {
                required: "Please select a role."
            },
            department_id: {
                required: "Please select a department."
            },
            name: {
                required: "Full name is required.",
                minlength: "Name must be at least 2 characters."
            },
            email: {
                required: "Email is required.",
                email: "Please enter a valid email."
            },
            country_code: {
                required: "Select country code."
            },
            phone: {
                required: "Phone number is required.",
                phoneFormat: "Please enter a valid phone number.",
                minlength: "Phone is too short.",
                maxlength: "Phone is too long."
            },
            designation: {
                required: "Designation is required."
            },

            @if (!isset($user))
            password: {
                required: "Password is required.",
                minlength: "Password must be at least 6 characters."
            },
            @endif
        },

        errorElement: "span",
        errorClass: "text-danger mt-1",

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        errorPlacement: function (error, element) {
            if (element.closest('.input-group').length) {
                error.insertAfter(element.closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        }
    });

});
</script>

@endpush
