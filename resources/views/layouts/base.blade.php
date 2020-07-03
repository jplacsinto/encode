<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="theme-color" content="#563d7c">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        body {
          font-size: .875rem;
        }

        .feather {
          width: 16px;
          height: 16px;
          vertical-align: text-bottom;
        }

        /*
         * Sidebar
         */

        .sidebar {
          position: fixed;
          top: 0;
          bottom: 0;
          left: 0;
          z-index: 100; /* Behind the navbar */
          padding: 48px 0 0; /* Height of navbar */
          box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
          .sidebar {
            top: 5rem;
          }
        }

        .sidebar-sticky {
          position: relative;
          top: 0;
          height: calc(100vh - 48px);
          padding-top: .5rem;
          overflow-x: hidden;
          overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }

        @supports ((position: -webkit-sticky) or (position: sticky)) {
          .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
          }
        }

        .sidebar .nav-link {
          font-weight: 500;
          color: #333;
        }

        .sidebar .nav-link .feather {
          margin-right: 4px;
          color: #999;
        }

        .sidebar .nav-link.active {
          color: #007bff;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
          color: inherit;
        }

        .sidebar-heading {
          font-size: .75rem;
          text-transform: uppercase;
        }

        /*
         * Navbar
         */

        .navbar-brand {
          padding-top: .75rem;
          padding-bottom: .75rem;
          font-size: 1rem;
          background-color: rgba(0, 0, 0, .25);
          box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .navbar-toggler {
          top: .25rem;
          right: 1rem;
        }

        .navbar .form-control {
          padding: .75rem 1rem;
          border-width: 0;
          border-radius: 0;
        }

        .form-control-dark {
          color: #fff;
          background-color: rgba(255, 255, 255, .1);
          border-color: rgba(255, 255, 255, .1);
        }

        .form-control-dark:focus {
          border-color: transparent;
          box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }

        .show-rows {
          width:65px;
        }
    </style>
</head>
<body>
    <div id="app">
    
      @include('components.navigation')

    <div class="container-fluid">
      <div class="row">
        
        @include('components.sidebar-menu')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 pt-3">
            @yield('content')
        </main>
      </div>
    </div>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script>feather.replace();</script>
</body>
</html>