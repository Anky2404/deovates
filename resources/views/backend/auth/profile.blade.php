@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | My Profile')

@section('content')
<div class="row">

    {{-- Avatar / Summary Card --}}
    <div class="col-xl-4 col-lg-5 col-md-5">
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body text-center">
                <div class="mb-3">
                    <img
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://placehold.co/130x130' }}"
                        alt="{{ $user->name }}"
                        class="rounded-circle border border-3 border-light shadow"
                        width="120"
                        height="120">
                </div>

                <h4 class="mb-1 fw-semibold">{{ $user->name }}</h4>
                <span class="badge bg-label-primary px-3 py-1 mb-2">
                    {{ $user->role?->name ?? 'N/A' }}
                </span>

                <div class="d-flex justify-content-center gap-4 mt-3 text-muted small">
                    <div>
                        <i class="bx bx-envelope"></i>
                        <div>{{ $user->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7 col-md-7">

        {{-- Update Profile --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Update Profile</h5>
            </div>

            <form id="profileForm" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.profile.update') }}">
                @csrf

                <div class="card-body">
                    <div class="row g-3">

                        {{-- NAME --}}
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- USERNAME --}}
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control"
                                value="{{ old('username', $user->username) }}">
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PHONE --}}
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DESIGNATION --}}
                        <div class="col-md-6">
                            <label class="form-label">Designation</label>
                            <input type="text" name="designation" class="form-control"
                                value="{{ old('designation', $user->designation) }}">
                        </div>

                        {{-- AVATAR --}}
                        <div class="col-md-6">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="avatar" class="form-control croppie-upload"
                                data-preview="#avatarPreview" data-width="400" data-height="400" accept="image/*">
                            <img id="avatarPreview"
                                src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://placehold.co/130x130' }}"
                                class="mt-2 rounded border img-thumbnail" height="130" width="130">
                            @error('avatar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <input type="text" name="avatar_alt" class="form-control mt-2"
                                placeholder="Alt text (used for the image name too)"
                                value="{{ old('avatar_alt', $user->avatar_alt) }}">
                        </div>

                        {{-- BIO --}}
                        <div class="col-12">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" rows="4">{{ old('bio', $user->bio) }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-end">
                    <button class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Change Password</h5>
            </div>

            <form id="changePasswordForm" method="POST" action="{{ route('admin.profile.change-password') }}">
                @csrf

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-12 form-password-toggle">
                            <label class="form-label">Current Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="current_password" class="form-control">
                                <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                            </div>
                            @error('current_password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-password-toggle">
                            <label class="form-label">New Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" class="form-control">
                                <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-password-toggle">
                            <label class="form-label">Confirm New Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password_confirmation" class="form-control">
                                <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-end">
                    <button class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    <script>
    $(document).ready(function () {

        $("#profileForm").validate({
            onkeyup: true,
            onfocusout: true,
            rules: {
                name: { required: true, minlength: 2 },
                email: { required: true, email: true },
                phone: { digits: true, minlength: 6, maxlength: 15 }
            },
            messages: {
                name: { required: "Full name is required." },
                email: { required: "Email is required.", email: "Please enter a valid email." }
            },
            errorElement: "span",
            errorClass: "text-danger mt-1",
            highlight: function (element) { $(element).addClass("is-invalid"); },
            unhighlight: function (element) { $(element).removeClass("is-invalid"); },
            errorPlacement: function (error, element) {
                if (element.closest('.input-group').length) {
                    error.insertAfter(element.closest('.input-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $("#changePasswordForm").validate({
            onkeyup: true,
            onfocusout: true,
            rules: {
                current_password: { required: true },
                password: { required: true, minlength: 8 },
                password_confirmation: { required: true, equalTo: "input[name='password']" }
            },
            messages: {
                current_password: { required: "Current password is required." },
                password: { required: "New password is required.", minlength: "Password must be at least 8 characters." },
                password_confirmation: { required: "Please confirm your new password.", equalTo: "Passwords do not match." }
            },
            errorElement: "span",
            errorClass: "text-danger mt-1",
            highlight: function (element) { $(element).addClass("is-invalid"); },
            unhighlight: function (element) { $(element).removeClass("is-invalid"); },
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
