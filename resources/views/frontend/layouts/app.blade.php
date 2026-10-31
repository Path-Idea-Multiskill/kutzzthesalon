
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Kutzz The Salon')</title>

    <meta name="description"
          content="@yield('meta_description', 'Kutzz The Salon - Premium salon services')">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-global-theme />
</head>

<body class="min-w-0 bg-white font-sans text-slate-900">

    <div class="flex min-h-screen w-full min-w-0 flex-col">

        @include('frontend.components.header')

        <main id="main-content" class="w-full min-w-0 flex-1">
            @yield('content')
        </main>

        @include('frontend.components.footer')

    </div>

</body>
</html>
