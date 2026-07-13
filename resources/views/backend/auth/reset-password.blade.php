@extends('backend.layouts.app')

@section('title', 'Deovate World | Reset Password')

@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <div class="card px-sm-6 px-0">
            <div class="card-body">

                <!-- Logo -->
                <div class="app-brand justify-content-center mb-6">
                    <a href="{{ route('admin.login.index') }}" class="app-brand-link gap-2">
                        <span class="app-brand-text demo text-heading fw-bold">
                            Deovate World
                        </span>
                    </a>
                </div>
                <!-- /Logo -->

                <h4 class="mb-2 text-center">Reset Password 🔐</h4>
                <p class="mb-6 text-center">
                    Enter your new password below
                </p>

                <form
                    id="formResetPassword"
                    class="mb-6"
                    method="POST"
                    action="{{ route('password.update') }}"
                >
                    @csrf

                    <!-- Token -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email -->
                    <div class="mb-6">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            value="{{ $email }}"
                            readonly
                        />
                    </div>

                    <!-- New Password -->
                    <div class="mb-6 form-password-toggle">
                        <label class="form-label">New Password</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                placeholder="Enter new password"
                                required
                            />
                            <span class="input-group-text cursor-pointer">
                                <i class="icon-base bx bx-hide"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6 form-password-toggle">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                placeholder="Confirm new password"
                                required
                            />
                            <span class="input-group-text cursor-pointer">
                                <i class="icon-base bx bx-hide"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button class="btn btn-primary d-grid w-100">
                        Reset Password
                    </button>
                </form>

                <div class="text-center">
                    <a href="{{ route('admin.login.index') }}">
                        <i class="bx bx-chevron-left"></i>
                        Back to Login
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
