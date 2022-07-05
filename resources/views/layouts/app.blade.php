<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
  <body>
        <div id="app">
            <div class="min-h-screen flex flex-col bg-gray-200">
                @include('layouts.partials.header')

                @include('layouts.partials.content')

                @include('layouts.partials.footer')
            </div>
        </div>
  </body>
</html>
