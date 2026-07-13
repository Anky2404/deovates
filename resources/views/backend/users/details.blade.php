@extends('backend.layouts.app')

@section('title', 'Devovate World | User Details')

@section('content')
<div class="row">

    {{-- Profile Card --}}
    <div class="col-xl-4 col-lg-5 col-md-5">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body text-center position-relative">


            {{-- Avatar --}}
            <div class="mb-3">
                <img
                    src="{{ $user->avatar
                        ? asset('storage/'.$user->avatar)
                        : asset('assets/backend/img/avatars/1.png') }}"
                    alt="{{ $user->name }}"
                    class="rounded-circle border border-3 border-light shadow"
                    width="120"
                    height="120">
            </div>

            {{-- Name --}}
            <h4 class="mb-1 fw-semibold">{{ $user->name }}</h4>
              {{-- Status --}} <div class="mt-2"> <span class="badge bg-label-{{ $user->is_active ? 'success' : 'danger' }}"> {{ $user->is_active ? 'Active' : 'Inactive' }} </span> </div>


            {{-- Role --}}
            <span class="badge bg-label-primary px-3 py-1 mb-2">
                {{ $user->role->name ?? 'N/A' }}
            </span>


            {{-- Quick Info --}}
            <div class="d-flex justify-content-center gap-4 mb-3 text-muted small">
                <div>
                    <i class="bx bx-envelope"></i>
                    <div>{{ $user->email }}</div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('admin.users.createoredit', $user->uuid) }}"
                   class="btn btn-primary btn-sm px-3">
                    <i class="bx bx-edit"></i> Edit
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-outline-secondary btn-sm px-3">
                    <i class="bx bx-arrow-back"></i> Back
                </a>
            </div>

        </div>
    </div>
</div>


    {{-- Details Card --}}
    <div class="col-xl-8 col-lg-7 col-md-7">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">User Information</h5>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>Email</strong>
                        <p class="mb-0 text-muted">{{ $user->email }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Username</strong>
                        <p class="mb-0 text-muted">{{ $user->username }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Phone</strong>
                        <p class="mb-0 text-muted">
                            {{ $user->phone ?? '—' }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Department</strong>
                        <p class="mb-0 text-muted">
                            {{ $user->department->name ?? '—' }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Designation</strong>
                        <p class="mb-0 text-muted">
                            {{ $user->designation ?? '—' }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Joined On</strong>
                        <p class="mb-0 text-muted">
                            {{ $user->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="col-12 mb-3">
                        <strong>Bio</strong>
                        <p class="mb-0 text-muted">
                            {{ $user->bio ?? 'No bio available.' }}
                        </p>
                    </div>

                </div>



            </div>
        </div>
    </div>

</div>
@endsection
