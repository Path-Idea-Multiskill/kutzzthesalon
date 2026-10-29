
@extends('admin.layouts.app')

@section('title', 'Website Settings | Kutz Salon')

@section('content')

<div class="mx-auto w-full max-w-6xl min-w-0 space-y-6">

    <div>
        <h2 class="font-heading text-xl font-bold text-slate-900 sm:text-2xl">
            Website Settings
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Manage salon information and global theme.
        </p>
    </div>

    @if(session('success'))
        <div role="status"
             class="rounded-xl border border-green-200
                    bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div role="alert"
             class="rounded-xl border border-red-200
                    bg-red-50 p-4 text-sm text-red-700">
            Please check the form fields.
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.settings.update') }}"
          class="space-y-6">

        @csrf
        @method('PUT')

        <!-- GENERAL INFORMATION -->
        <section class="rounded-2xl border border-slate-200
                        bg-white p-4 shadow-sm sm:p-6">

            <h3 class="mb-5 font-heading text-lg font-semibold">
                General Information
            </h3>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                <div>
                    <label for="site_name"
                           class="mb-2 block text-sm font-medium">
                        Salon Name
                    </label>
                    <input id="site_name"
                           name="site_name"
                           required
                           maxlength="255"
                           value="{{ old('site_name', $settings->site_name) }}"
                           class="w-full min-w-0 rounded-xl
                                  border border-slate-300 px-4 py-3
                                  focus:border-brand focus:outline-none">
                    @error('site_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="site_tagline"
                           class="mb-2 block text-sm font-medium">
                        Tagline
                    </label>
                    <input id="site_tagline"
                           name="site_tagline"
                           maxlength="255"
                           value="{{ old('site_tagline', $settings->site_tagline) }}"
                           class="w-full min-w-0 rounded-xl
                                  border border-slate-300 px-4 py-3
                                  focus:border-brand focus:outline-none">
                </div>

                <div>
                    <label for="email"
                           class="mb-2 block text-sm font-medium">
                        Email
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $settings->email) }}"
                           class="w-full min-w-0 rounded-xl
                                  border border-slate-300 px-4 py-3
                                  focus:border-brand focus:outline-none">
                </div>

                <div>
                    <label for="phone"
                           class="mb-2 block text-sm font-medium">
                        Phone
                    </label>
                    <input type="tel"
                           id="phone"
                           name="phone"
                           value="{{ old('phone', $settings->phone) }}"
                           class="w-full min-w-0 rounded-xl
                                  border border-slate-300 px-4 py-3
                                  focus:border-brand focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label for="address"
                           class="mb-2 block text-sm font-medium">
                        Address
                    </label>
                    <textarea id="address"
                              name="address"
                              rows="3"
                              class="w-full min-w-0 rounded-xl
                                     border border-slate-300 px-4 py-3
                                     focus:border-brand focus:outline-none">{{ old('address', $settings->address) }}</textarea>
                </div>

            </div>
        </section>

        <!-- THEME COLORS -->
        <section class="rounded-2xl border border-slate-200
                        bg-white p-4 shadow-sm sm:p-6">

            <h3 class="mb-5 font-heading text-lg font-semibold">
                Theme Colors
            </h3>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

                @foreach([
                    'primary_color' => 'Primary Color',
                    'secondary_color' => 'Secondary Color',
                    'light_color' => 'Light Color'
                ] as $field => $label)

                    <div>
                        <label for="{{ $field }}"
                               class="mb-2 block text-sm font-medium">
                            {{ $label }}
                        </label>

                        <input type="color"
                               id="{{ $field }}"
                               name="{{ $field }}"
                               value="{{ old($field, $settings->$field) }}"
                               class="h-12 w-full cursor-pointer
                                      rounded-xl border border-slate-300
                                      bg-white p-1">
                        @error($field)
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                @endforeach

            </div>
        </section>

        <!-- TYPOGRAPHY -->
        <section class="rounded-2xl border border-slate-200
                        bg-white p-4 shadow-sm sm:p-6">

            <h3 class="mb-5 font-heading text-lg font-semibold">
                Typography
            </h3>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                <div>
                    <label for="heading_font"
                           class="mb-2 block text-sm font-medium">
                        Heading Font
                    </label>

                    <select id="heading_font"
                            name="heading_font"
                            class="w-full min-w-0 rounded-xl
                                   border border-slate-300 px-4 py-3">

                        @foreach(['Poppins', 'Inter'] as $font)
                            <option value="{{ $font }}"
                                @selected(old('heading_font', $settings->heading_font) === $font)>
                                {{ $font }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label for="body_font"
                           class="mb-2 block text-sm font-medium">
                        Body Font
                    </label>

                    <select id="body_font"
                            name="body_font"
                            class="w-full min-w-0 rounded-xl
                                   border border-slate-300 px-4 py-3">

                        @foreach(['Inter', 'Poppins'] as $font)
                            <option value="{{ $font }}"
                                @selected(old('body_font', $settings->body_font) === $font)>
                                {{ $font }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>
        </section>

        <div class="flex justify-stretch sm:justify-end">
            <button type="submit"
                    class="min-h-12 w-full rounded-xl bg-brand
                           px-8 py-3 font-semibold text-white
                           transition hover:bg-brand-dark
                           sm:w-auto">
                Save Settings
            </button>
        </div>

    </form>

</div>

@endsection
