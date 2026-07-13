@extends('backend.layouts.app')

@section('title', 'Deovate World | Testimonials')

@section('content')
<div class="card">

    <!-- HEADER -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Testimonial Lists</h5>

        <a href="{{ route('admin.testimonials.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Create Testimonial
        </a>
    </div>

    <!-- TABLE -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $index => $testimonial)
                    <tr>

                        <!-- SN -->
                        <td>{{ $index + 1 }}</td>

                        <!-- PHOTO -->
                        <td>
                            @if($testimonial->photo)
                                <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                     alt="photo"
                                     width="40" height="40"
                                     class="rounded-circle object-fit-cover">
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <!-- NAME -->
                        <td>
                            <strong>{{ $testimonial->name }}</strong><br>
                            <small class="text-muted">
                                {{ $testimonial->designation ?? '' }}
                            </small>
                        </td>

                        <!-- COMPANY -->
                        <td>
                            {{ $testimonial->company ?? '—' }}
                        </td>

                        <!-- RATING -->
                        <td>
                            @if($testimonial->rating)
                                ⭐ {{ $testimonial->rating }}/5
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td>
                            <span
                                class="badge toggle-status cursor-pointer bg-label-{{ $testimonial->is_active ? 'success' : 'danger' }}"
                                data-url="{{ route('admin.testimonials.togglestatus', $testimonial->uuid) }}">
                                {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <!-- FEATURED -->
                        <td>
                            <span
                                class="badge {{ $testimonial->is_featured ? 'bg-label-primary' : 'bg-label-secondary' }}">
                                {{ $testimonial->is_featured ? 'Featured' : 'Normal' }}
                            </span>
                        </td>

                        <!-- ACTION -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.testimonials.createoredit', $testimonial->uuid) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>

                                <form action="{{ route('admin.testimonials.destroy', $testimonial->uuid) }}"
                                      method="POST" class="js-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                        <i class="bx bx-trash"></i> Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No Testimonials found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection
