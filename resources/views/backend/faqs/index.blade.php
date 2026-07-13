@extends('backend.layouts.app')

@section('title', 'Deovate World | FAQs')

@section('content')
<div class="card">

    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">FAQ Lists</h5>

        <a href="{{ route('admin.faqs.createoredit') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Create FAQ
        </a>
    </div>

    <!-- Table -->
    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SN</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="table-border-bottom-0">
                @forelse ($rows as $index => $faq)
                    <tr>
                        <!-- SN -->
                        <td>{{ $rows->firstItem() + $index }}</td>

                        <!-- Category -->
                        <td>
                            <span class="badge bg-label-info">
                                {{ $faq->category->title ?? '—' }}
                            </span>
                        </td>

                        <!-- Question -->
                        <td class="description-column">
                            <strong>{{ \Illuminate\Support\Str::limit(strip_tags($faq->question), 60) }}</strong>
                        </td>

                        <!-- Order -->
                        <td>
                            <span class="badge bg-label-secondary">
                                {{ $faq->display_order }}
                            </span>
                        </td>

                          {{-- Status --}}
                                <td>
                                    <span
                                        class="badge toggle-status cursor-pointer bg-label-{{ $faq->is_active ? 'success' : 'danger' }}"
                                        data-url="{{ route('admin.faqs.togglestatus', $faq->id) }}">
                                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>



                        <!-- Actions -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                              {{--    <a href="{{ route('admin.faqs.createoredit', $faq->id) }}"
                                   class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="bx bx-edit-alt"></i> Edit
                                </a>--}}

                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}"
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
                        <td colspan="6" class="text-center text-muted py-4">
                            No FAQs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="card-footer">
        {{ $rows->links() }}
    </div>

</div>
@endsection
