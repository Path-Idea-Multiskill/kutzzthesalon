
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Admin Login | Kutzz Salon</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <x-global-theme />
</head>

<body class="flex min-h-screen items-center
             justify-center bg-brand-light
             px-4 py-8 font-sans">

    <div class="w-full max-w-md rounded-2xl
                border border-red-100 bg-white
                p-5 shadow-xl sm:p-8">

        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-brand">
                Kutzz
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Salon Admin Login
            </p>
        </div>

        <form method="POST"
              action="{{ route('admin.login.submit') }}"
              class="space-y-5">

            @csrf

            <div>
                <label for="email"
                       class="mb-2 block text-sm font-medium">
                    Email Address
                </label>

                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       autocomplete="username"
                       required
                       class="w-full min-w-0 rounded-xl
                              border border-slate-300
                              px-4 py-3 outline-none
                              focus:border-brand">

                @error('email')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password"
                       class="mb-2 block text-sm font-medium">
                    Password
                </label>

                <input type="password"
                       id="password"
                       name="password"
                       autocomplete="current-password"
                       required
                       class="w-full min-w-0 rounded-xl
                              border border-slate-300
                              px-4 py-3 outline-none
                              focus:border-brand">
            </div>

            <button type="submit"
                    class="w-full rounded-xl bg-brand
                           px-5 py-3 font-semibold
                           text-white transition
                           hover:bg-brand-dark">
                Login to Dashboard
            </button>

        </form>

    </div>

</body>
</html>
