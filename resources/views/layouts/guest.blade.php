<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Port Harcourt Tech Expo | PH Tech Expo</title>
        <meta name="description" content="Port Harcourt Tech Expo. The world of tomorrow is shaped by the designs and technologies emerging today. Learn more at phtechexpo.com">
        <meta name="keywords" content="login, register, Port Harcourt Tech Expo, PH Tech Expo, ph, port harcourt, Port Harcourt, technology expo, industry event, tech conference, innovation, networking">
    

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

          <!-- Favicon -->
          <link rel="icon" href="https://res.cloudinary.com/iamvocal/image/upload/v1707387543/logophtech_faclfs.png" type="image/x-icon">


          <!--style -->
          <link rel="stylesheet" href="css/general.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-black antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
         

            <div class="w-full sm:max-w-xl my-10 px-6 py-4 bg-emerald-500 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>

</html>
