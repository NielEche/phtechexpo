<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl bg-emerald-500 dark:text-green-600 leading-tight MenloRegular ">
                PH TECH EXPO
            </h2>
        </div>
    </x-slot>

    
    @php( $homeGallerys = \App\Models\HomeGallerys::orderBy('id', 'asc')->get())
    @php( $homeAbouts = \App\Models\HomeAbouts::orderBy('id', 'asc')->get())
    @php( $homeServices = \App\Models\HomeServices::orderBy('id', 'asc')->get())
    @php( $partners = \App\Models\partners::orderBy('id', 'asc')->get())
    @php( $programs = \App\Models\programs::orderBy('id', 'asc')->get())
    @php( $eprograms = \App\Models\ExplorePrograms::orderBy('id', 'asc')->get())
    @php( $homeVideos = \App\Models\HomeVideos::where('publish', 1)->orderBy('id', 'asc')->get())
    @php( $events = \App\Models\Events::orderBy('created_at', 'desc')->value('id') )
    @php( $speakers = \App\Models\Speakers::orderBy('order_number', 'asc')->where('event_id', $events)->limit(8)->get() )


       
    @if(session('success'))
    <div class="absolute top-0 left-0 mt-4 mr-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
        role="alert" id="success-message">
        <strong class="font-bold">Successful update!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var successMessage = @json(session('success'));

                // Show an alert box if there's a success message
                if (successMessage) {
                    alert(successMessage);
                }

                // Automatically hide the success message after 5 seconds
                setTimeout(function () {
                    document.getElementById('success-message').style.display = 'none';
                }, 5000); // 5000 milliseconds (5 seconds)
            });
        </script>
    @endif
    
            <!-- <div class="sticky-parent">
                <div class="sticky">
                    <div class="horizontal">
                        @foreach($homeGallerys as $gallery)
                        <div class="dim bg-emerald-500"  style="background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4)),  url('{{ $gallery->path }}'); background-size: cover;">
                        
                            <h2 class="font-semibold absolute bottom-0 lg:text-4xl text-4xl text-white lg:py-10 lg:px-16 py-6 px-4 dark:text-white leading-tight MenloRegular lg:w-1/3 w-96">
                                {{ $gallery->caption }}<span class="blink">|</span>
                            </h2>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="py-6">
            </div>-->

                <div class="container-fluid bg-white mx-auto">
                    <div class="carousel h-screen">
                        <div class="carousel-inner2">
                            @foreach($homeGallerys as $gallery)
                            <div class="carousel-item2 h-screen" data-title="Slide">
                                <img class="rounded-lg " src="public{{ $gallery->path }}" alt="">
                                
                                <div class="absolute text-white container-fluid lg:px-16 px-10 mx-auto lg:w-4/5 bg-transparent headCap rounded-lg">
                                    @if($gallery->header)
                                    <h2 class="text-white MenloRegular font-semibold text-2xl lg:text-4xl py-2">{{ $gallery->header }}<span class="blink">|</span></h2>
                                    @endif
                                    @if($gallery->caption)
                                        <p class="MenloRegular text-left phtech-para">
                                            {{ $gallery->caption }}
                                        </p>
                                    @endif
                                    @if($gallery->embed)
                                        <div class="pt-6">
                                            <a href=" {{ $gallery->embed}}" class="bg-emerald-500 px-4 py-2 rounded">
                                            @if($gallery->button)
                                            {{ $gallery->button }}
                                            @endif
                                            </a>
                                        </div>
                                    @endif
                                   
                                </div>
                            </div>
                            @endforeach
                            <div class="carousel-item2 h-screen" data-title="Slide">
                                <img class="rounded-lg " src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713594937/pj2qyribzmwrpzyavbek.jpg" alt=""> 
                                <div class="absolute text-white container-fluid lg:px-16 px-10 mx-auto lg:w-4/5 bg-transparent headCap rounded-lg">
                                    <h2 class="text-white MenloRegular font-semibold text-2xl lg:text-4xl py-2">Explore our brochure<span class="blink">|</span></h2>        
                                    <div class="pt-6">
                                        <a href="/brochure/TechExpo2024.pdf" download="PHTechExpoBrochure.pdf"class="bg-emerald-500 px-4 py-2 rounded">
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <button class="prev-btn2 text-3xl" style="background-color:transparent; color:white;"><span>&#8592;</span></button>
                        <button class="next-btn2  text-3xl" style="background-color:transparent; color:white;"><span>&#8594;</span></button>
                    </div>
                </div>




        <div class="container-fluid bg-white mx-auto px-6 lg:px-20 py-6">
            <div class="my-4 lg:flex justify-between ">
                    <div class="text-black py-4" style="min-width: 50vw;">
                        <h2 class="MenloRegular font-black text-4xl">Let's Talk About <span class="text-emerald-500">The Future</span><span class="blink" style="color:rgb(16 185 129 / var(--tw-bg-opacity));">|</span></h2>
                    </div>

                    @foreach($homeAbouts as $about)
                    <div class="text-black py-4">
                        <p class="MenloRegular text-left phtech-para">
                            {{ $about->details }}
                        </p class="MenloRegular">
                        <div class="pt-6">
                            <a href="{{route('about')}}" class="bg-emerald-500 px-4 py-2 rounded">Know More</a>
                        </div>
                    </div>    
                    @endforeach  
            </div>
        </div>

        <div class="container-fluid bg-white mx-auto px-6 py-6 lg:px-20 py-8">
            <div id="partners" class="lg:flex justify-between pt-12">
                <div class="text-black py-4" style="min-width: 50vw;">
                    <h2 class="MenloRegular text-4xl font-black">Speakers<span class="blink" style="color:rgb(16 185 129 / var(--tw-bg-opacity));">|</span></h2>
                </div>
            </div>
            <div class="container text-left bg-white mx-auto px-6 lg:px-20 py-4 card-container lg:grid grid-cols-4 gap-1">
            @foreach($speakers as $speaker)
            @if($speaker->publish == 1)
            <div class="rounded-lg mb-6">
                <div x-data="" x-on:click.prevent="$dispatch('open-modal', 'speakerDetails{{ $speaker->id }}')" class=" rounded-lg flex justify-center items-center ">
                    <div class="text-black text-left py-4">
                        <img style="height:350px; object-fit:cover;" class="w-full" src="public{{ $speaker->path }}" alt="">
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
            <div class="float-right">
                <a href="{{ route('schedule.view', ['schedule' => $events]) }}" class="bg-emerald-500 px-4 py-2 rounded">See All</a>
            </div>
        </div>


        @foreach($speakers as $speaker)
        <x-sidemodal name="speakerDetails{{ $speaker->id }}" focusable>
                <!-- Modal Content -->
                <div class="bg-black relative">
                    <img style="object-fit:cover;" class="w-full" src="public{{ $speaker->path }}" alt="">
                    <div style="text-align:left;" class="absolute bottom-0 left-0 right-0 p-6">
                        <h2 class="text-white MenloRegular font-black text-2xl">{{ $speaker->name }}</h2>
                        <p  class="py-2 text-left text-white MenloRegular text-sm">{{ $speaker->profession }}</p>
                        <!-- Add other text or content here as needed -->
                    </div>
                </div>
                <div style="text-align:left;" class="p-6">
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

        <div class="container-fluid  bg-white mx-auto px-6 py-6 lg:px-20 lg:py-8">
            <div class="lg:grid grid-cols-3 gap-4 w-full ">
                @foreach($programs as $program)
                    <div class="programsw relative rounded-lg overflow-hidden" style="height:500px;">
                        <img src="public{{ $program->path }}" alt="Image 1" class="processSize h-auto rounded-lg">
                        <p class="lg:inline-block hidden absolute bottom-10 left-0 w-full text-left font-black text-xl MenloRegular text-white px-6">{{ $program->header }} </p>
                        <div class="absolute inset-x-0 bottom-0 bg-prog bg-black opacity-0 rounded-lg transition-all duration-300 transform translate-y-full flex items-end ">
                            <div class="w-full  text-left font-black text-xl MenloRegular text-white px-6 py-8">
                                <p class="pb-2 w-full text-left font-black text-xl ">{{ $program->header }} </p>
                                <p  class=" w-full text-left font-black text-sm">{{ $program->caption }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:hidden mb-4 bg-prog bg-black  rounded-lg flex items-end ">
                        <div class="w-full  text-left font-black text-xl MenloRegular text-white px-6 py-8">
                            <p class="pb-2 w-full text-left font-black text-xl ">{{ $program->header }} </p>
                            <p  class=" w-full text-left font-black text-sm">{{ $program->caption }}</p>
                        </div>
                    </div>


                @endforeach  
                @foreach($eprograms as $eprogram)
                <div class="relative mb-4" style="height:500px;">
                    <img src="public{{ $eprogram->path }}" alt="Image 3" class="processSize h-auto rounded-lg">
                    <div class="absolute inset-0 bg-black opacity-10 rounded-lg"></div>
                    <p class="left-0 w-full text-left font-black text-base MenloRegular text-black px-8">
                        <span class="absolute top-10 text-5xl MenloRegular">{{ $eprogram->header }}</span><br>
                        <a href="{{ $eprogram->link }}" class="absolute bottom-7 underline">{{ $eprogram->button }}</a>
                    </p>
                </div>
                @endforeach  
            </div>
        </div>

        <div class="container-fluid  bg-white mx-auto px-6 py-6 lg:px-20 py-6">
            <div class="carousel">
            <div class="counter  w-full z-50 MenloRegular font-bolder px-8"></div>
                <div class="carousel-inner">
                    @foreach($homeServices as $service)
                    <div class="carousel-item" data-title="Slide 1">
                        <img class="rounded-lg " src="public{{ $service->path }}" alt="">
                        <div class="text-white caption rounded-lg px-12 lg:px-20">
                            <h2 class="text-white MenloRegular text-bold text-2xl">{{ $service->title }}</h2>
                            <p  class="text-white MenloRegular text-bold text-sm text-left">{{ $service->details }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="prev-btn">Prev</button>
                <button class="next-btn">Next</button>
            </div>
        </div>


        <div class="container-fluid bg-white mx-auto px-6 py-6 lg:px-20 py-8">
            <div id="partners" class="lg:flex justify-between pt-12">
                <div class="text-black py-4" style="min-width: 50vw;">
                    <h2 class="MenloRegular text-4xl font-black">Partners</h2>
                </div>
            </div>

           <!-- Sponsors -->
            @if($partners->where('type', 'Sponsors')->isNotEmpty())
            <h2 class="MenloRegular pt-6 text-xl font-black">Sponsors</h2>
            <div class=" bg-white mx-auto px-4 lg:px-4 py-2 card-container flex flex-wrap lg:justify-center gap-6 place-content-center">
                @foreach($partners->where('type', 'Sponsors') as $partner)
                <img class="w-48 " style="object-fit:contain;" src="public{{ $partner->path }}" alt="">
                @endforeach
            </div>
            @endif

            <!-- Partners -->
            @if($partners->where('type', 'Partners')->isNotEmpty())
            <h2 class="MenloRegular pt-6 text-xl font-black">Partners</h2>
            <div class=" bg-white mx-auto px-4 lg:px-4 py-2 card-container flex flex-wrap lg:justify-center gap-6 place-content-center">
                @foreach($partners->where('type', 'Partners') as $partner)
                <img class="w-48" style="object-fit:contain;" src="public{{ $partner->path }}" alt="">
                @endforeach
            </div>
            @endif

            <!-- Supporters -->
            @if($partners->where('type', 'Supporters')->isNotEmpty())
            <h2 class="MenloRegular pt-6 text-xl font-black">Supporters</h2>
            <div class=" bg-white mx-auto px-4 lg:px-4 py-2 card-container flex flex-wrap lg:justify-center gap-6 place-content-center">
                @foreach($partners->where('type', 'Supporters') as $partner)
                <img class="w-48" style="object-fit:contain;" src="public{{ $partner->path }}" alt="">
                @endforeach
            </div>
            @endif

        </div>


 
        <div class="container-fluid mx-auto px-6 py-6 lg:px-20 py-8 rounded-lg">
            <div class="bg-black p-10 rounded-lg">
                <div class="lg:grid grid-cols-3 gap-4">
                    @foreach($homeVideos as $video)
                    <div class="relative my-2 rounded-lg">
                        <iframe style="height:600px;" class="rounded-lg w-full h-full"  src="{{ $video->embed }}" frameborder="0" allow="accelerometer;" allowfullscreen></iframe>
                        <div class="pt-4 w-full text-left font-black text-xl MenloRegular text-white px-6">
                            <p class="pb-2 text-sm">{{ $video->caption }}</p>
                        </div>
                    </div>
                    @endforeach
                  
                </div>
            </div>
        </div>
      
        <div class="container-fluid bg-white mx-auto px-6 lg:px-20 py-8">
            <div class="py-12 lg:flex justify-between">
                <div class="text-black py-4" style="min-width: 50vw;">
                    <h2 class="MenloRegular text-4xl font-black">Come Get <span class="text-emerald-500">Involved</span><span class="blink" style="color:rgb(16 185 129 / var(--tw-bg-opacity));">|</span></h2>
                </div>

                <div class="text-black py-4">
                    <div>
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'contactform')" id="add-feature-button"
                            class=" bg-emerald-500  MenloRegular text-black px-4 py-2 rounded">
                            Get in touch
                        </button>
                    </div>
                </div>      
            
            </div>

            <x-modal name="contactform" focusable>
                <!-- Modal Content -->
                <div class="p-12 bg-emerald-500">
                
                    <form action="{{ route('subscribe') }}" method="post" enctype="multipart/form-data" class="w-full">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-4 MenloRegular">
                            <div>
                                <label for="name">Name:</label><br>
                                <input class="w-full rounded-lg" type="text" id="name" name="name"><br>
                            </div>
                            <div>
                                <label for="email">Email:</label><br>
                                <input class="w-full rounded-lg" type="email" id="email" name="email"><br>
                            </div>
                            <div class="col-span-2">
                                <label for="phone">Phone Number:</label><br>
                                <input class="w-full rounded-lg" type="text" id="phone" name="phone"><br>
                            </div>
                            <div class="col-span-2">
                                <label for="message">Question/Comment:</label><br>
                                <textarea class="w-full rounded-lg" id="comment" name="comment"></textarea><br>
                            </div>
                        </div>
                        <button class="MenloRegular bg-black text-white px-4 py-2 mt-3 rounded-lg" type="submit">Submit</button>
                    </form>
                </div>
            </x-modal>
        </div>
      
        <style>
            .processSize{
                width:100%;
                height:500px;
                object-fit:cover;
            }

            .caption {
                position: relative;
                bottom: 30%;
                left: 0; 
                text-align:left;
                background-color: rgba(0, 0, 0, 0.4);
                color: white;
                width:50%;
                padding: 10px 30px;
            }

            .headCap     {
                position: relative;
                bottom: 35%;
                left: 0; 
                text-align:left;
                color: white;
            }

            .carousel {
                position: relative;
                overflow: hidden;
                margin: 0 auto;
                width: 100%;
            }

            .carousel-inner, .carousel-inner2 {
                display: flex;
                transition: transform 0.5s ease;
            }

            .carousel-item {
                flex: 0 0 100%;
                width: 100%;
                height:800px;
            }

            .carousel-item2 {
                height:100vh !important;
                flex: 0 0 100%;
                width: 100%;
                height:800px;
            }

             .carousel-item2 img {
                height:100vh !important;
                width:100%;
                object-fit: cover;
            }

            .carousel-item img {
                height:800px;
                width:100%;
                object-fit: cover;
            }
            .prev-btn, .next-btn , .prev-btn2, .next-btn2 {
                position: absolute;
                top: 60%;
                transform: translateY(-50%);
                padding: 10px;
                cursor: pointer;
                z-index: 1;
                background-color:rgb(16 185 129 / var(--tw-bg-opacity)) ;
            }

            .prev-btn, .prev-btn2{
                left: 0;
            }

            .programsw:hover .bg-prog {
                opacity: 1; /* Adjust the opacity value as needed */
                transform: translate(0, -1%); /* Slide up the container */
            }

            @media (max-width: 620px) {
            
                .caption {
                    width:100%;
                    bottom: 35%;
                }

                .headCap    {
                    width:100%;
                    bottom: 60%;
                }

                .programsw .bg-prog {
                   visibility:hidden;
                }


            }

            .next-btn, .next-btn2 {
                right: 0;
            }

            .counter {
                display:flex;
                justify-content:space-between;
                text-align: center;
                margin-top: 10px;
                margin-bottom:20px;
            }

            .counter-number {
                display: inline-block;
                width: 40px;
                height: 40px;
                margin: 0 5px;
                cursor: pointer;
                border-radius: 50%;
                line-height: 20px;
                text-align: center;
                padding: 10px;
                color:black;
            }

            .counter-number.active {
                background-color:rgb(16 185 129 / var(--tw-bg-opacity)) ;
                color: #000
            }

            .sticky-parent{
            height: 700vh;
            }

            .sticky{
            position: sticky;
            top: 0px;
            max-height: 100vh;
            overflow-x: hidden;
            overflow-y: hidden;
            }
            .dim{
            display: block;
            min-width: 70vw;
            height: 100vh;
            }
            .horizontal{
            display: flex;
            }
            .br{
            outline: solid;
            }

            @media (max-width: 620px) {
            .dim{
                display: block;
                min-width: 100vw;
                height: 100vh;
            }
            }

            p{
            font-size: 10em;
            text-align: center;
            }
            
            
        </style>


        <script>
            "use strict"

            // Adding scroll event listener
            document.addEventListener('scroll', horizontalScroll);

            //Selecting Elements
            let sticky = document.querySelector('.sticky');
            let stickyParent = document.querySelector('.sticky-parent');

            let scrollWidth = sticky.scrollWidth;
            let verticalScrollHeight = stickyParent.getBoundingClientRect().height-sticky.getBoundingClientRect().height;

            //Scroll function 
            function horizontalScroll(){

                //Checking whether the sticky element has entered into view or not
                let stickyPosition = sticky.getBoundingClientRect().top;
                if(stickyPosition > 1){
                    return;
                }else{
                    let scrolled = stickyParent.getBoundingClientRect().top; //how much is scrolled?
                    sticky.scrollLeft =(scrollWidth/verticalScrollHeight)*(-scrolled)*0.85;
                
                }
            }
        </script>

    
</x-app-layout>
