<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <div class="py-12" style="background-color:#1d70b7;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-20">
            <div  class="bg-white dark:bg-gray-800 rounded-full shadow-sm sm:rounded-full">
            @include('layouts.navigation')
            </div>
        </div>
    </div>


        <div class="bg-white mx-auto px-6 lg:px-20 py-6">
            @if(session('success'))
            <div class=" top-0 left-0 mt-4 mr-4 bg-emerald-500 border border-emerald-500 text-white text-xl px-4 py-3 rounded"
                role="alert" id="success-message">
                <strong class="font-bold">{{ session('success') }}</strong><br>
                <span class="block sm:inline">Check your email for further information about the event schedule, venue details, and additional resources.</span>
            </div>

            <script>
                setTimeout(function () {
                    document.getElementById('success-message').style.display = 'none';
                }, 10000); // 10000 milliseconds (10 seconds)

            </script>
            @endif

            <div class="container  mx-auto my-4 lg:flex justify-between ">
                    <div class="text-black py-4" style="min-width: 50vw;">
                        <h2 class="MenloRegular text-4xl">Welcome To Your <span class="text-emerald-500">Dashboard</span><span class="blink" style="color:rgb(16 185 129 / var(--tw-bg-opacity));">|</span></h2>
                    </div>

                 
                    <div class="text-black py-4">
                        <p class="MenloRegular text-sm text-left">Manage your account and events here, update your availabilty and keep track of all your sessions.</p class="MenloRegular">
                        <h2 class="MenloRegular text-xl py-4">Attendance passcode <span class="text-emerald-500">{{ auth()->user()->attending }} </span></h2>
                    </div>      
            </div>
        </div>

     
        <div class="bg-white mx-auto px-6 lg:px-20 py-6">
          <div class="container mx-auto my-4 ">
                <div class=" float-left py-6 my-4 bg-white">
                    <a href="{{route('user.id')}}" class="bg-emerald-500 px-4 py-2 rounded">Generate ID CARD !</a>
                </div>
                <div class="container  mx-auto my-10 flex justify-between ">
                </div>
          </div>
        </div>

        <hr>
        
        <!--<div class=" bg-white mx-auto px-6 lg:px-20 pt-6 pb-2">
            <div class="container mx-auto my-4 lg:flex justify-between ">
                    <div class="text-black py-4" style="min-width: 50vw;">
                        <h2 class="MenloRegular font-bold text-2xl">Registered Sessions</h2>
                    </div>
            </div>
        </div>-->


       <!-- <div class="container-fluid bg-white mx-auto px-6 lg:px-20  pb-16 card-container lg:grid grid-cols-3 gap-4">
            <div class="card rounded-lg">
                <div class="card-front rounded-lg flex justify-center items-center ">
                        <div class="text-black text-left MenloRegular px-12 lg:px-12 py-4">
                            <img class="w-64 py-4" src="https://res.cloudinary.com/iamvocal/image/upload/v1708296226/phtech_ey4jwx.jpg" alt="">
                            <h2 class="text-bold MenloRegular text-lg">23rd Nov. 2023</h2>
                            <h2 class="text-black MenloRegular text-xl">STARTUP PITCH SESSION</h2>
                        </div>
                </div>
                <div class="card-back flex justify-center items-center rounded-lg ">
                    <div class="text-white p-6 MenloRegular text-center">
                      
                            <p class="text-base">Main Hall</p>
                            <p class="text-base">2:00 pm</p>
                    </div>
                </div>
            </div>
        </div>-->

    <style>
        .card-container {
            perspective: 1000px;
        }

        main{
            background-color:rgb(16 185 129 / var(--tw-bg-opacity));
        }

        .card {
            height: 400px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.5s;
        }

        .card:hover {
            transform: rotateY(180deg);
        }

        .card-front,
        .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .card-front {
            background-color: rgb(16 185 129 / var(--tw-bg-opacity));
        }

        .card-back {
            background-color: #000;
            transform: rotateY(180deg);
        }

    </style>

    <script>
        $(document).ready(function() {
            $('.card').on('click', function() {
                $(this).toggleClass('flipped');
            });
        });

    </script>

</x-app-layout>
