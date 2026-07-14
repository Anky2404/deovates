@extends('backend.layouts.app')

@section('title', config('constants.BUSINESS.name') . ' | Users')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Users</h5>
                <a href="{{ route('admin.users.createoredit') }}" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus"></i> Add User
                </a>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">
                        @forelse($rows as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                {{-- Image --}}
                                <td>
                                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/backend/img/avatars/1.png') }}"
                                        alt="{{ $user->name }}" class="rounded-circle" width="40" height="40">
                                </td>

                                {{-- Name --}}
                                <td>{{ $user->name }}</td>

                                {{-- Email --}}
                                <td>{{ $user->email }}</td>

                                {{-- Role --}}
                                <td>
                                    <span class="badge bg-label-primary">
                                        {{ $user->role->name ?? 'N/A' }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td>
                                    <span
                                        class="badge toggle-status cursor-pointer bg-label-{{ $user->is_active ? 'success' : 'danger' }}"
                                        data-url="{{ route('admin.users.togglestatus', $user->uuid) }}">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="d-flex gap-1">
                                    <a href="{{ route('admin.users.details', $user->uuid) }}"
                                        class="btn btn-sm btn-outline-info" title="View">
                                        <i class="bx bx-show"></i>
                                    </a>

                                    <a href="{{ route('admin.users.createoredit', $user->uuid) }}"
                                        class="btn btn-sm btn-outline-success" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    

                                    <form action="{{ route('admin.users.destroy', $user->uuid) }}" method="POST"
                                       class="js-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1"
                                           title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    No users found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="card-footer">
                {{ $rows->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
