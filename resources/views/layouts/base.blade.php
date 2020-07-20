<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/emoji.css') }}" rel="stylesheet">

    <style>
        .bg-sidebar { background: #3C366B; }
        .cta-btn { color: #3C366B; }
        .upgrade-btn:hover { background: #3C366B; }
        .active-nav-link { background: #3C366B; }
        .nav-item:hover { background: #3C366B; }
        .account-link:hover { background: #3C366B; }
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow-x: hidden; overflow-y: visible !important; }
        input:checked + svg { display: block; }
        .toggle-checkbox:checked { @apply: right-0 border-green-400;right: 0; border-color: #68D391; }
        .toggle-checkbox:checked + .toggle-label { @apply: bg-green-400; background-color: #68D391; }
    </style>

    @yield('styles')
</head>

<body class="bg-gray-200 flex">

  @include('components.navigations.sidebar-menu')

  <div class="relative w-full flex flex-col h-screen overflow-y-hidden">

      @include('components.navigations.header')

      @include('components.navigations.mobile-header')

      <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
          <main class="w-full flex-grow p-4">
              @yield('content')
          </main>
      </div>
      
  </div>

  @yield('body_close')

    <script src="{{ asset('js/alpine.min.js') }}" defer></script>

    <script src="{{ asset('js/fontawesome.min.js') }}"></script>

    @yield('scripts')

</body>
</html>