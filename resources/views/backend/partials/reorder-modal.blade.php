{{-- Reusable drag-to-reorder modal for paginated admin listings.
     Usage: @include('backend.partials.reorder-modal', [
         'modalId'     => 'authorsReorderModal',
         'rows'        => $reorderRows,               // full, unpaginated, display_order-sorted collection
         'reorderUrl'  => route('admin.authors.reorder'),
         'title'       => 'Reorder Authors',
         'labelField'  => 'name',                      // property to show as the row label
         'imageField'  => null,                         // optional storage-relative image property
     ])
--}}
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title ?? 'Reorder' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <tbody id="{{ $modalId }}Sortable" class="sortable-table" data-url="{{ $reorderUrl }}"
                        data-reload-on-success="true">
                        @forelse ($rows as $index => $row)
                            <tr data-uuid="{{ $row->uuid }}">
                                <td class="drag-handle" style="cursor: grab; width:1%;">
                                    <i class="bx bx-menu text-muted"></i>
                                </td>
                                <td class="row-number" style="width:1%;">{{ $index + 1 }}</td>
                                @isset($imageField)
                                    <td style="width:1%;">
                                        @if (!empty($row->{$imageField}) && \Illuminate\Support\Facades\Storage::disk('public')->exists($row->{$imageField}))
                                            <img src="{{ asset('storage/' . $row->{$imageField}) }}" alt=""
                                                class="rounded" style="width:36px;height:36px;object-fit:cover;">
                                        @else
                                            <span class="text-muted">&mdash;</span>
                                        @endif
                                    </td>
                                @endisset
                                <td>{{ $row->{$labelField} }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-muted py-4">Nothing to reorder yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="text-muted small me-auto">
                    <i class="bx bx-info-circle"></i> Drag rows by the handle to reorder. Saved automatically.
                </div>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
