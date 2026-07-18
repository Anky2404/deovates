{{--
    Renders a Form's fields (standalone + repeatable groups) for actual data
    entry/editing. Shared by the Form Builder's live preview (blank values)
    and the Page/Section content editor (prefilled values).

    Params:
    - $fields      Collection of FormField, already ordered.
    - $values      array, optional. Top-level: [$fieldName => $value]. Group
                    members: ['group_data' => [$groupKey => [ [$fieldName => $value], ... ]]].
    - $namePrefix  string, optional. Wraps every field name, e.g. "sections_data[5]"
                    so values submit as "sections_data[5][company_name]".
    - $idPrefix    string, optional. Keeps element ids unique when this partial
                    is rendered more than once on the same page.
--}}
@php
    $values = $values ?? [];
    $namePrefix = $namePrefix ?? '';
    $idPrefix = $idPrefix ?? 'f';
    $renderedGroups = [];
    $fieldName = fn ($f) => $f->name ?: ($f->field_id ?: 'field_'.$f->id);

    // $n may be a plain key ("company_name") or an already-bracketed chain
    // ("group_data[team_member][0][member_name]") — either way, splice it in
    // as additional bracket segments after the prefix rather than wrapping
    // the whole chain in one more pair of brackets (which PHP can't parse
    // back into nested array keys).
    $wrapName = function ($n) use ($namePrefix) {
        if ($namePrefix === '') {
            return $n;
        }

        preg_match('/^([^\[]+)(.*)$/', $n, $m);

        return $namePrefix.'['.$m[1].']'.($m[2] ?? '');
    };
@endphp

<div class="row g-3">
@forelse($fields as $field)
    @continue(!empty($field->group_key) && in_array($field->group_key, $renderedGroups))

    @if(!empty($field->group_key))
        @php
            $renderedGroups[] = $field->group_key;
            $groupKey = $field->group_key;
            $groupFields = $fields->where('group_key', $groupKey)->values();
            $groupInstances = $values['group_data'][$groupKey] ?? [];
            if (empty($groupInstances)) { $groupInstances = [[]]; }
        @endphp

        <div class="col-12">
            <div class="border rounded p-3 repeater-group">
                <label class="form-label fw-semibold mb-2">{{ \Illuminate\Support\Str::headline($groupKey) }}</label>

                <div class="repeater-instances" data-group-instances="{{ $idPrefix }}-{{ $groupKey }}">
                    @foreach($groupInstances as $instIdx => $instanceData)
                        <div class="repeater-instance row g-3 position-relative border-bottom pb-3 mb-3">
                            <button type="button"
                                class="btn btn-sm btn-outline-danger remove-repeater-instance position-absolute top-0 end-0">
                                &times;
                            </button>

                            @foreach($groupFields as $gField)
                                <div class="col-md-{{ $gField->field_width }}">
                                    <label class="form-label">
                                        {{ $gField->label }}
                                        @if($gField->required)<span class="text-danger">*</span>@endif
                                    </label>
                                    @include('backend.pages.layouts.partials._field_input', [
                                        'field' => $gField,
                                        'idPrefix' => $idPrefix.'_f'.$gField->id.'_'.$instIdx,
                                        'name' => $wrapName('group_data['.$groupKey.']['.$instIdx.']['.$fieldName($gField).']'),
                                        'value' => $instanceData[$fieldName($gField)] ?? null,
                                    ])
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-sm btn-outline-primary add-repeater-instance"
                    data-group="{{ $idPrefix }}-{{ $groupKey }}">
                    <i class="bx bx-plus"></i> Add Another {{ \Illuminate\Support\Str::headline($groupKey) }}
                </button>

                {{-- Clone template for JS "Add Another" (never rendered directly by the browser) --}}
                <template id="tpl-group-{{ $idPrefix }}-{{ $groupKey }}">
                    <div class="repeater-instance row g-3 position-relative border-bottom pb-3 mb-3">
                        <button type="button"
                            class="btn btn-sm btn-outline-danger remove-repeater-instance position-absolute top-0 end-0">
                            &times;
                        </button>

                        @foreach($groupFields as $gField)
                            <div class="col-md-{{ $gField->field_width }}">
                                <label class="form-label">
                                    {{ $gField->label }}
                                    @if($gField->required)<span class="text-danger">*</span>@endif
                                </label>
                                @include('backend.pages.layouts.partials._field_input', [
                                    'field' => $gField,
                                    'idPrefix' => $idPrefix.'_f'.$gField->id.'___I__',
                                    'name' => $wrapName('group_data['.$groupKey.'][__I__]['.$fieldName($gField).']'),
                                    'value' => null,
                                ])
                            </div>
                        @endforeach
                    </div>
                </template>
            </div>
        </div>
    @else
        <div class="col-md-{{ $field->field_width }}">
            <label class="form-label">
                {{ $field->label }}
                @if($field->required)<span class="text-danger">*</span>@endif
            </label>
            @include('backend.pages.layouts.partials._field_input', [
                'field' => $field,
                'idPrefix' => $idPrefix.'_f'.$field->id,
                'name' => $wrapName($fieldName($field)),
                'value' => $values[$fieldName($field)] ?? null,
            ])
        </div>
    @endif
@empty
    <div class="col-12 text-center text-muted">
        No fields added to this form.
    </div>
@endforelse
</div>
