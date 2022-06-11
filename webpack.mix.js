const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('resources/img', 'public/img') 

    
    .css('resources/css/bootstrap-multiselect.css', 'public/css') 
    .copy('vendor/almasaeed2010/adminlte/dist/css/adminlte.css', 'public/dist/css') 
    .copy('vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css.map', 'public/dist/css') 
    .copy('vendor/almasaeed2010/adminlte/dist/css/adminlte.css.map', 'public/dist/css') 
    .copy('vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.css', 'public/plugins/daterangepicker') 

    
    .copy('vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js', 'public/plugins/jquery') 
    .copy('vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js', 'public/plugins/bootstrap/js')
    .copy('vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js.map', 'public/plugins/bootstrap/js')  
    .copy('vendor/almasaeed2010/adminlte/dist/js/adminlte.js', 'public/dist/js/') 
    .copy('vendor/almasaeed2010/adminlte/dist/js/adminlte.js.map', 'public/dist/js/') 
    .copy('vendor/almasaeed2010/adminlte/plugins/sweetalert2/sweetalert2.all.min.js', 'public/plugins/sweetalert2') 
    .copy('vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.js', 'public/plugins/daterangepicker')
    .copy('vendor/almasaeed2010/adminlte/plugins/select2/js/select2.full.min.js', 'public/plugins/select2/js')
    .copy('vendor/almasaeed2010/adminlte/plugins/moment/moment.min.js', 'public/plugins/moment')
    .copy('vendor/almasaeed2010/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js', 'public/plugins/tempusdominus-bootstrap-4/js')
    
    .copy('vendor/almasaeed2010/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css', 'public/plugins/tempusdominus-bootstrap-4/css/')
    
    
    .copy('vendor/almasaeed2010/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css', 'public/plugins/sweetalert2-theme-bootstrap-4') 
    .copy('vendor/almasaeed2010/adminlte/plugins/select2/css/select2.min.css', 'public/plugins/select2/css') 
    
    .copy('vendor/almasaeed2010/adminlte/dist/img', 'public/dist/img') 
    .copy('resources/js/bootstrap-multiselect.js', 'public/js')

    .copy('resources/css/bootstrap-select.css', 'public/dist/css')
    .copy('resources/css/bootstrap-select.min.css', 'public/dist/css')
    .copy('resources/js/bootstrap-select.js', 'public/dist/js')

    .copy('resources/js/ck-editor.js', 'public/js')
    .sourceMaps();
