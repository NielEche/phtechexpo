<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Port Harcourt Tech Expo | PH Tech Expo</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('css/general.css') }}" rel="stylesheet">

        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
       

         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
                
        

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-white dark:bg-white">
            <style>
                @media screen and (min-width: 644px) {
                .onlgOnly {
                    width:90%;
                    float:right;
                }
                }
            </style>
            <!-- Page Heading -->
            @if (isset($header))
                @include('admin.partials.header')
            @endif

            <!-- Page Content -->
            <div class="onlgOnly">
                {{ $slot }}
            </div>

            @if (isset($header))
                @include('admin.partials.footer')
            @endif
        </div>
        <script src="{{asset('js/style.js') }}"></script>
    </body>
</html>
