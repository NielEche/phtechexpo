<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl bg-emerald-500 dark:text-green-600 leading-tight MenloRegular ">
                PH TECH EXPO
            </h2>
        </div>
    </x-slot>

        <div class="container bg-emerald-500 mx-auto px-6 lg:px-20 pt-16">
            <div class="py-12" style="font-family:Menlo;">
            <h2 class="MenloRegular text-4xl py-6">About This <span class="text-white">Event</span><span class="blink"
                        style="color:white;">|</span></h2>
            <p class="MenloRegular text-base text-white text-left">
                {{ $Events->about }}
                </p>
              
            </div>
            <hr>
        </div>


    <div class="container bg-emerald-500 mx-auto px-6 lg:px-20 pb-10">
        <div class="py-10">


            @php
                $showContainer2 = false;
            @endphp

            @foreach($Schedules as $schedule)
                @if($schedule->publish == 1  && !empty($schedule->topic))
                    @php
                        $showContainer2 = true;
                    @endphp
                    <!-- Exit the loop once the condition is met -->
                    @break
                @endif
            @endforeach

            @if($showContainer2)
                <div class="text-black pt-16 pb-6" style="min-width: 50vw;"  id="schedule">
                    <h2 class="MenloRegular text-4xl">Our Event <span class="text-white">Schedule</span><span class="blink"
                        style="color:white;">|</span></h2>
                </div>
            @endif
            <hr>

            @php
                $previousDate = null;
            @endphp

            @if($Schedules)
    <div x-data="{ openTab: 1 }">
        @foreach($Schedules->groupBy('date') as $date => $schedulesForDate)
            <div class="py-4 MenloRegular">
                @if($date !== $previousDate)
                    @php
                        // Parse the date string into a DateTime object
                        $dateTime = new DateTime($date);

                        // Format the date as desired
                        $formattedDate = $dateTime->format('jS F Y');
                    @endphp
                    <button @click="openTab = {{ $loop->iteration }}" class="text-white text-3xl py-6">{{ $formattedDate }}</button>
                    @php
                        $previousDate = $date;
                    @endphp
                @endif

                <div x-show="openTab === {{ $loop->iteration }}" class="lg:grid grid-cols-3 gap-4 py-8 text-white border-2 border-white p-10">
                    @foreach($schedulesForDate->sortBy('time') as $schedule)
                        @if($schedule->publish == 1)
                            <a title="attend session">
                                <div class="py-6">
                                    <div style="height:120px;">
                                    <h3 class="text-2xl">
                                        @php
                                            // Parse the time string into a timestamp
                                            $timestamp = strtotime($schedule->time);

                                            // Format the time as desired, including AM or PM
                                            $formattedTime = date('g:i A', $timestamp);
                                            
                                            // Output the formatted time
                                            echo $formattedTime;
                                        @endphp
                                    </h3>
                                    <p class="py-2 text-base font-black">{{ $schedule->topic }}</p>
                                    <h3 class="text-sm font-black pb-4">{{ $schedule->venue }}</h3>
                                    </div>
                                      <!-- Retrieve speaker details -->
                                      @php
                                        $speaker = \App\Models\Speakers::find($schedule->speaker_id);
                                    @endphp
                                    <div style="height:154px;">
                                    @if($speaker)
                                        <p class="text-xs">Speaker</p>
                                        <div class="flex flex-start py-4">
                                            <img style="height:70px; object-fit:contain;" class=" float-left" src="{{ $speaker->path }}" alt="">
                                            <p class="font-bold text-sm px-2">{{ $speaker->name }}</p>
                                        </div>
                                       
                                        <!-- Add other speaker details as needed -->
                                    @endif
                                    </div>
                                    <hr>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    @endif

        </div>
    </div>



                
  

    @php
        $showContainer = false;
    @endphp

    @foreach($Speakers as $speaker)
        @if($speaker->publish == 1 && $speaker->keynote == 1 && !empty($speaker->bio))
            @php
                $showContainer = true;
            @endphp
            <!-- Exit the loop once the condition is met -->
            @break
        @endif
    @endforeach

    <!--
    @if($showContainer)
        <div class="container bg-emerald-500 mx-auto px-6 lg:px-20 py-0">
            <div class="py-2">
                <div class="text-black pb-6" style="min-width: 50vw;">
                    <h2 style="font-family:Menlo;" class="MenloRegular text-4xl">Keynote <span class="text-white">Address</span><span class="blink" style="color:white;">|</span></h2>
                </div>
                <hr>
            </div>
        </div>
    @endif



    @if($Speakers)
    @foreach($Speakers as $speaker)
        @if($speaker->publish == 1)
        @if($speaker->keynote == 1)
        <div class="container bg-emerald-500 mx-auto px-6 lg:px-20 py-10">
            <div class="container my-4 lg:flex justify-around mx-auto">
                <img class="w-80 h-full" src="{{ $speaker->path }}" alt="">

                <div class="text-black py-6 lg:px-8">
                    <p class="MenloRegular text-sm text-white text-left">{{ $speaker->bio }}</p class="MenloRegular">
                    <div class="pt-4">
                        <h2 class="MenloRegular pb-0 font-bold text-white text-xl">{{ $speaker->name }}</h2>
                        <h2 class="MenloRegular  font-bold text-white text-xl">{{ $speaker->profession }}</h2>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        @endif
        @endif
    @endforeach
    -->

    @php
        $showSpeakers = false;
    @endphp

    @foreach($Speakers as $speaker)
        @if($speaker->publish == 1 && $speaker->keynote != 1 && !empty($speaker->bio))
            @php
                $showSpeakers = true;
            @endphp
            <!-- Exit the loop once the condition is met -->
            @break
        @endif
    @endforeach



    @if($showSpeakers)
        <div class="container bg-emerald-500 mx-auto px-6 lg:px-20 py-0" id="speakers">
            <div class="py-2">
                <div class="text-black pb-6" style="min-width: 50vw;">
                    <h2 style="font-family:Menlo;" class="MenloRegular text-4xl">Our <span class="text-white">Speakers</span><span class="blink"
                            style="color:white;">|</span></h2>
                </div>
               
            </div>
        </div>
    @endif

        <div class="container bg-white mx-auto px-6 lg:px-20 py-10 card-container lg:grid grid-cols-4 gap-1" >
        @foreach($Speakers as $speaker)
        @if($speaker->publish == 1)
            <div class="rounded-lg mb-6">
                <div x-data="" x-on:click.prevent="$dispatch('open-modal', 'speakerDetails{{ $speaker->id }}')" class=" rounded-lg flex justify-center items-center ">
                    <div class="text-black text-left py-4">
                        <img style="height:350px; object-fit:cover;" class="w-full" src="{{ $speaker->path }}" alt="">
                        <div class="
                            @if($speaker->keynote == 1)
                            bg-purple-400
                            @else
                            bg-emerald-500
                            @endif
                            p-4 h-36">
                            <h2 class="text-black MenloRegular font-bold text-base">{{ $speaker->name }}</h2>
                            <p  class="text-black MenloRegular text-left text-xs">{{ $speaker->profession }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
        </div>
     
        @else
        <!-- Handle the case where no speakers are found -->
        <div class="lg:w-1/2 lg:px-4 w-full h-full flex items-center justify-center  bg-SelectColor">
                <div class="text-center text-black lg:px-32 p-10 relative z-10">
                    <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                        Theres No speaker for this event yet </h3>
                </div>
            </div>
        @endif



        @foreach($Speakers as $speaker)
        <x-sidemodal name="speakerDetails{{ $speaker->id }}" focusable>
                <!-- Modal Content -->
                <div class="bg-black relative">
                    <img style="object-fit:cover;" class="w-full" src="/public{{ $speaker->path }}" alt="">
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h2 class="text-white MenloRegular font-black text-2xl">{{ $speaker->name }}</h2>
                        <p  class="py-2 text-white MenloRegular text-sm">{{ $speaker->profession }}</p>
                        <!-- Add other text or content here as needed -->
                    </div>
                </div>
                <div class="p-6">
                    <div class="py-2 text-white MenloRegular text-sm aboutdata" style="color:white !important;">{!! $speaker->bio !!}</div>
                </div>

                <style>
                     .aboutdata p , .aboutdata li {
                            font-size:0.875rem;
                            line-height: 1.25rem;
                            text-align:left;
                            color:white !important;
                        }
                </style>

        </x-sidemodal>
        @endforeach


    <style>
        .card-container {
            perspective: 1000px;
        }

        main{
            background-color:rgb(16 185 129 / var(--tw-bg-opacity));
        }

        .card {
            width: 350px;
            height: 500px;
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
            background-color: #fff;
        }

        .card-back {
            background-color: #000;
            transform: rotateY(180deg);
        }

        header{
            position: fixed;
            width:100%;
        }

        footer{
            font-family:Menlo !important;
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
