<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dynamic Sections Field Guide</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        h2.page-name { font-size: 16px; margin-top: 30px; margin-bottom: 6px; color: #ff5f13; border-bottom: 2px solid #ff5f13; padding-bottom: 4px; }
        h3.section-name { font-size: 14px; margin-top: 16px; margin-bottom: 4px; background: #f5f5f5; padding: 6px 8px; }
        .meta { color: #666; margin-bottom: 2px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; font-size: 11px; }
        th { background: #333; color: #fff; }
        .group-row td { background: #fffaf5; }
        .badge { display: inline-block; padding: 1px 6px; border-radius: 3px; font-size: 10px; color: #fff; background: #ff5f13; }
        .intro { margin-bottom: 20px; color: #444; }
    </style>
</head>
<body>
    <h1>Dynamic Sections Field Guide</h1>
    <p class="intro">
        This guide lists every Page and its dynamic Sections currently wired into the front-end templates.
        For each Section, create the exact fields below (name + type) in Admin &rarr; Pages &rarr; Forms
        (via the Section's "Manage Fields for This Section" link), matching the Field Name column exactly
        so the values map correctly to the live page.
    </p>

    @foreach ($pages as $page)
        <h2 class="page-name">Page: {{ $page['name'] }}</h2>

        @foreach ($page['sections'] as $section)
            <h3 class="section-name">
                Section: {{ $section['name'] }}
                <span class="badge">slug: {{ $section['slug'] }}</span>
            </h3>

            <table>
                <thead>
                    <tr>
                        <th style="width:28%">Field Name</th>
                        <th style="width:18%">Type</th>
                        <th style="width:22%">Repeat Group</th>
                        <th style="width:32%">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section['fields'] as $field)
                        <tr @if(!empty($field['group'])) class="group-row" @endif>
                            <td>{{ $field['name'] }}</td>
                            <td>{{ $field['type'] }}</td>
                            <td>{{ $field['group'] ?? '-' }}</td>
                            <td>{{ $field['notes'] ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach
</body>
</html>
