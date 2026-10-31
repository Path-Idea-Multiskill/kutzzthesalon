
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Kutzz Salon Admin')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <x-global-theme />
</head>

<body class="bg-slate-50 font-sans text-slate-800">

<div class="min-h-screen lg:flex">

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay"
         class="fixed inset-0 z-40 hidden bg-black/50
                backdrop-blur-sm lg:hidden"
         aria-hidden="true">
    </div>

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main Content -->
    <div class="min-w-0 flex-1">

        @include('admin.layouts.header')

        <main class="p-3 sm:p-6 lg:p-8">
            @yield('content')
        </main>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const menuBtn = document.getElementById('menuToggle');
    const closeBtn = document.getElementById('closeSidebar');

    if (!sidebar || !overlay || !menuBtn || !closeBtn) {
        return;
    }

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');

        menuBtn.setAttribute('aria-expanded', 'true');
        sidebar.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');
        closeBtn.focus();
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');

        menuBtn.setAttribute('aria-expanded', 'false');
        sidebar.setAttribute('aria-hidden', 'true');

        document.body.classList.remove('overflow-hidden');
        menuBtn.focus();
    }

    menuBtn.addEventListener('click', openSidebar);
    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' &&
            !sidebar.classList.contains('-translate-x-full')) {
            closeSidebar();
        }
    });

    const desktopQuery = window.matchMedia('(min-width: 1024px)');

    function syncSidebar() {
        if (desktopQuery.matches) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            sidebar.removeAttribute('aria-hidden');
            menuBtn.setAttribute('aria-expanded', 'false');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            sidebar.setAttribute('aria-hidden', 'true');
            menuBtn.setAttribute('aria-expanded', 'false');
        }
    }

    desktopQuery.addEventListener('change', syncSidebar);
    syncSidebar();

});
</script>

</body>
</html>
