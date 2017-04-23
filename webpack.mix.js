const {mix} = require('laravel-mix');

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

mix.js(['resources/assets/js/app.js'], 'public/js')
    .extract(['jquery'])
    .js([
        'resources/assets/bower_components/moment/moment.js',
        'resources/assets/bower_components/angular/angular.min.js',
        'resources/assets/bower_components/angular-animate/angular-animate.min.js',
        'resources/assets/bower_components/flatpickr/dist/flatpickr.js',
        'resources/assets/bower_components/select2//dist/js/select2.js',
        'resources/assets/bower_components/datatables/media/js/jquery.dataTables.js',
        'resources/assets/bower_components/datatables/media/js/dataTables.bootstrap.min.js',
        'resources/assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        //'resources/assets/bower_components/toastr/toastr.min.js',

    ], 'public/js/vendor.js')

    .styles([
        'resources/assets/bower_components/font-awesome/css/font-awesome.min.css',
        'resources/assets/bower_components/flatpickr/dist/flatpickr.css',
        'resources/assets/bower_components/select2/dist/css/select2.min.css',
        'resources/assets/bower_components/datatables/media/css/dataTables.bootstrap.css',
        'resources/assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
        //'resources/assets/bower_components/toastr/toastr.min.css',
        'resources/assets/css/dashboard.css.css',

    ], 'public/css/vendor.css')

    //.copy('resources/assets/bower_components/font-awesome/fonts', 'public/fonts')

    // .less('resources/assets/bower_components/font-awesome/less/font-awesome.less',
    //     'public/css/vendor.css')
    .sass('resources/assets/sass/app.scss', 'public/css');




