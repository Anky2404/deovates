@extends('backend.layouts.app')
@section('title', config('constants.BUSINESS.name') . ' | Admin Login')
@section('content')
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card px-sm-6 px-0">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-heading fw-bold">{{ config('constants.BUSINESS.name') }}</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <form id="formAuthentication" class="mb-6" action="{{ route('admin.login.submit',['guard' => 'admin']) }}" method="POST">
                      @csrf
                        <div class="mb-6">
                            <label for="email" class="form-label">Email or Username</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email or username" autofocus />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-6 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="*** *** **"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>


                        <div class="mb-8">
                            <div class="d-flex justify-content-between">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                                <a href="{{ route('admin.forgot.index') }}"><span>Forgot Password?</span></a>
                            </div>
                        </div>

                        <div class="mb-6">
                            <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                        </div>
                    </form>



                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
@endsection
