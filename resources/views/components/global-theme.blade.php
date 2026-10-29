
@php
    $theme = \App\Models\WebsiteSetting::query()
        ->first();

    $primary = $theme?->primary_color ?? '#D60927';
    $secondary = $theme?->secondary_color ?? '#A60820';
    $light = $theme?->light_color ?? '#FFF2F4';

    $headingFont = $theme?->heading_font ?? 'Poppins';
    $bodyFont = $theme?->body_font ?? 'Inter';

    // Whitelist font names for safe CSS output.
    $headingFont = in_array($headingFont, ['Poppins', 'Inter'], true)
        ? $headingFont
        : 'Poppins';

    $bodyFont = in_array($bodyFont, ['Poppins', 'Inter'], true)
        ? $bodyFont
        : 'Inter';

    // Validate colors before inserting into CSS.
    foreach (['primary', 'secondary', 'light'] as $key) {
        if (!preg_match('/^#[0-9a-fA-F]{6}$/', $$key)) {
            $$key = match ($key) {
                'primary' => '#D60927',
                'secondary' => '#A60820',
                'light' => '#FFF2F4',
            };
        }
    }
@endphp

<style>
    :root {
        --color-brand: {{ $primary }};
        --color-brand-dark: {{ $secondary }};
        --color-brand-light: {{ $light }};

        --font-sans: "{{ $bodyFont }}", sans-serif;
        --font-heading: "{{ $headingFont }}", sans-serif;
    }
</style>
