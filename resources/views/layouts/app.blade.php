<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('dist/css/adminlte.css') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles
        
    </head>
    <body class="hold-transition layout-top-nav text-sm">
        <div class="wrapper">
            <div class="content-wrapper">
          
                @livewire('navigation-menu')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class=" shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        @stack('modals')
        <script src="{{ mix('plugins/jquery/jquery.min.js') }} "></script> 
        <script src="{{ mix('js/app.js') }} "></script> 
        <script src="{{ mix('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
        <script src="{{ mix('plugins/select2/js/select2.full.min.js') }} "></script> 
        
        @livewireScripts
    </body>
</html>
