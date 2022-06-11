<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2/css/select2.min.css">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('dist/css/adminlte.css') }}">
        @livewireStyles
        <!-- Scripts -->
        
    </head>
    <body class="hold-transition sidebar-mini text-sm">
        <div class="wrapper">
            @include('admin.elements.header')
            @include('admin.elements.sidebar')
            <div class="content-wrapper">
                @if($slot) 
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </div>
            @include('admin.elements.controlbar')
            @include('admin.elements.footer')          
        </div>
        <script src="{{ mix('plugins/jquery/jquery.min.js') }} "></script> 
        <script src="{{ mix('js/app.js') }} "></script> 
        <script src="{{ mix('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
        <script src="{{ mix('plugins/select2/js/select2.full.min.js') }} "></script> 
        @include('admin.common_script') 
        @livewireScripts
    </body>
</html>
