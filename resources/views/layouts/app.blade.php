<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Port Harcourt Tech Expo | PH Tech Expo</title>
        <meta name="description" content="Port Harcourt Tech Expo. The world of tomorrow is shaped by the designs and technologies emerging today. Learn more at phtechexpo.com">
        <meta name="keywords" content="Port Harcourt Tech Expo, PH Tech Expo, ph, port harcourt, Port Harcourt, technology expo, industry event, tech conference, innovation, networking">
    

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

         <!-- Favicon -->
         <link rel="icon" href="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713590106/logophtech_faclfs_1_sn2ceq.png" type="image/x-icon">

        <!--style -->
        <link href="{{ asset('css/general.css') }}" rel="stylesheet">
        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white">
        <div class="min-h-screen bg-white dark:bg-white" style="display: flex; flex-direction: column; min-height: 100vh;">


            <!-- Page Heading -->
            @if (isset($header))
                @include('partials.header')
            @endif

            <!-- Page Content -->
            <main style=" flex: 1;">
                {{ $slot }}
            </main>

            @include('partials.footer')
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            const carouselInner = document.querySelector('.carousel-inner');
            const counter = document.querySelector('.counter');
            let currentIndex = 0;

            function updateCounter() {
            counter.innerHTML = '';
            for (let i = 0; i < carouselInner.children.length; i++) {
                const counterNumber = document.createElement('div');
                counterNumber.textContent = i + 1;
                counterNumber.classList.add('counter-number');
                if (i === currentIndex) {
                counterNumber.classList.add('active');
                }
                counter.appendChild(counterNumber);
            }
            }

            prevBtn.addEventListener('click', function () {
            currentIndex = (currentIndex - 1 + carouselInner.children.length) % carouselInner.children.length;
            carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
            updateCounter();
            });

            nextBtn.addEventListener('click', function () {
            currentIndex = (currentIndex + 1) % carouselInner.children.length;
            carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
            updateCounter();
            });

            updateCounter();
            });

        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const prevBtn = document.querySelector('.prev-btn2');
                const nextBtn = document.querySelector('.next-btn2');
                const carouselInner = document.querySelector('.carousel-inner2');
                const counter = document.querySelector('.counter2');
                let currentIndex = 0;

                function updateCounter() {
                    counter.innerHTML = '';
                    for (let i = 0; i < carouselInner.children.length; i++) {
                        const counterNumber = document.createElement('div');
                        counterNumber.textContent = i + 1;
                        counterNumber.classList.add('counter-number2');
                        if (i === currentIndex) {
                            counterNumber.classList.add('active');
                        }
                        counter.appendChild(counterNumber);
                    }
                }

                function goToNextSlide() {
                    currentIndex = (currentIndex + 1) % carouselInner.children.length;
                    carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
                    updateCounter();
                }

                // Add automatic sliding
                const slideInterval = setInterval(goToNextSlide, 3000); // Adjust the interval time as needed (in milliseconds)

                prevBtn.addEventListener('click', function () {
                    clearInterval(slideInterval); // Stop automatic sliding when user interacts with buttons
                    currentIndex = (currentIndex - 1 + carouselInner.children.length) % carouselInner.children.length;
                    carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
                    updateCounter();
                });

                nextBtn.addEventListener('click', function () {
                    clearInterval(slideInterval); // Stop automatic sliding when user interacts with buttons
                    goToNextSlide();
                });

                updateCounter();
            });
        </script>

        <script>
        window.addEventListener('mouseover', initLandbot, { once: true });
        window.addEventListener('touchstart', initLandbot, { once: true });
        var myLandbot;
        function initLandbot() {
        if (!myLandbot) {
            var s = document.createElement('script');s.type = 'text/javascript';s.async = true;
            s.addEventListener('load', function() {
            var myLandbot = new Landbot.Livechat({
                configUrl: 'https://storage.googleapis.com/landbot.online/v3/H-2161625-2TJ16OAJYL9IMVWK/index.json',
            });
            });
            s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.js';
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        }
        }
        </script>
        <style>
            .gYReNf {
                height:80% !important;
            }
        </style>

    </body>
</html>
