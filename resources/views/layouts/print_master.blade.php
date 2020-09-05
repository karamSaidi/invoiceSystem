<!DOCTYPE html>
<html>
  <head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- bootstrap rtl --}}
    @if(app()->getLocale() == 'ar')
    <link href="{{ asset('css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    @endif

    @stack('style')

  </head>
  <body>

    <div id="app">

        <div class="container py-2">
            <x-alert></x-alert>

            @yield('content')
        </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('script')
  </body>
</html>
