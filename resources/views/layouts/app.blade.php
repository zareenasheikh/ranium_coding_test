<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        @yield('meta')


        <link rel="icon" type="image/png" href="{{ asset('public/img/favicon.jpg') }}" sizes="16x16" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="{{ asset('public/sweetalert-master/dist/sweetalert.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/datepicker.min.css') }}">

        <link rel="stylesheet" href="{{ asset('public/fonts/icomoon/style.css') }}">

        <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">


        @stack('style')
        {{-- .................. --}}

        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}">


        <link href="{{ asset('public/css/toastr.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">


        @yield('customStyle')


    </head>
    <body>
     @yield('content')
     


     <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
     <script src="{{asset('public/js/toastr.min.js')}}"></script>
     <script src="{{ asset('public/sweetalert-master/dist/sweetalert.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/js/datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/datepicker.en.js') }}"></script>
     <script src="{{ asset('public/js/popper.min.js')}}"></script>
     <script src="{{ asset('public/js/bootstrap.min.js')}}"></script>

     <script async src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
     @stack('js')

     <script>
         var baseUrl = @json(url('/'.Request::segment(2)));
         var appname = @json(config('app.name'));

         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type', 'info') }}";
         switch(type){
            case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
            
            case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

            case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

            case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
        }
        @endif

        
    </script>


</body>
</html>
