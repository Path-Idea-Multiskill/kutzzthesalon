
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $page->meta_title ?: $page->title }}</title>

    <meta name="description"
          content="{{ $page->meta_description }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800">

    <main class="mx-auto max-w-4xl px-5 py-12 sm:py-20">

        <a href="{{ url('/') }}"
           class="text-sm font-semibold text-brand">
            ← Back to Home
        </a>

        <h1 class="mt-8 font-heading text-3xl font-bold text-slate-900 sm:text-5xl">
            {{ $page->title }}
        </h1>

        <div class="mt-8 whitespace-pre-line break-words text-base leading-8 text-slate-600">{{ $page->content }}</div>

    </main>

</body>
</html>
