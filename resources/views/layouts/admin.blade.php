<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@stack('page_title')</title>
        <link rel="icon" type="ico" href="{{ mix('img/favicon.ico') }}">
        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="{{ mix('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ mix('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ mix('dist/css/adminlte.css') }}">        
        <link rel="stylesheet" href="{{ mix('css/bootstrap-multiselect.css') }}"> 
        <link rel="stylesheet" href="{{ mix('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ mix('plugins/daterangepicker/daterangepicker.css') }}"> 
        <link rel="stylesheet" href="{{ mix('dist/css/bootstrap-select.css') }}"> 
        {{-- Main Style File --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}"> 
        @stack('styles')
        @livewireStyles
        <!-- Styles -->
        
    </head>
    <body class="hold-transition sidebar-mini layout-fixed text-sm">
        <div class="wrapper">
            @include('admin.elements.header')
            @include('admin.elements.sidebar')
            <div class="content-wrapper">
                {{-- @yield('content') --}}
                @if(isset($slot)) 
                    {{ $slot }}
                @else
                    @yield('content')
                @endif                
            </div>
            @include('admin.elements.controlbar')
            @include('admin.elements.footer')          
        </div>
        <button
        type="button"
        class="btn btn-danger btn-floating btn-lg"
        id="btn-back-to-top"
        >
        <div class="on-display">
            <i class="fas fa fa-chevron-left"></i>
        </div>
        <div class="on-hover text-left">
            <i class="fas fa fa-chevron-up"></i>
        </div>
            
        </button>
        <script src="{{ mix('plugins/jquery/jquery.min.js') }} "></script> 
        <script src="{{ mix('plugins/moment/moment.min.js') }}"></script>
        
        <script src="{{ mix('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
        <script src="{{ mix('plugins/select2/js/select2.full.min.js') }} "></script> 
        <script src="{{ mix('dist/js/adminlte.js') }} "></script> 
        <script src="{{ mix('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <script src="{{ mix('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ mix('js/bootstrap-multiselect.js') }}"></script>
        <script src="{{ mix('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        {{-- <script src="{{ mix('js/app.js') }}" ></script>   --}}
        <script src="{{ mix('dist/js/bootstrap-select.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        @livewireScripts  
        <x-livewire-alert::scripts />
        @stack('scripts')
       
    </body>
</html>