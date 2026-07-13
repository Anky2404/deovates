@extends('backend.layouts.app')
@section('title','Deovate World | Forgot Password')
@section('content')
 <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Forgot Password -->
          <div class="card px-sm-6 px-0">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-6">
                <a href="{{ route('admin.dashboard.index')}}" class="app-brand-link gap-2">
                  <span class="app-brand-text demo text-heading fw-bold">Deovate World</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1">Forgot Password? </h4>
              {{-- <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p> --}}
              <form id="formForgotPassword" class="mb-6" action="{{ route('admin.forgot.submit')}}" method="POST">
                @csrf
                <div class="mb-6">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autofocus />
                </div>
                <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
              </form>
              <div class="text-center">
                <a href="{{route('admin.login.index')}}" class="d-flex justify-content-center">
                  <i class="icon-base bx bx-chevron-left me-1"></i>
                  Back to login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
@endsection
