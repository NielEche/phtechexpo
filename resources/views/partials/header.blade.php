<header class="fixed-top z-[99]" id="{{ Route::currentRouteName() === 'home' ? 'stickyHeader' : '' }}">

@php( $events2 = \App\Models\Events::orderBy('created_at', 'desc')->value('id') )

    <nav x-data="{ open: false }" class="dark:border-gray-700" >
        <!-- Primary Navigation Menu -->
        <div class=" mx-auto px-6 lg:px-10">
            <div class="my-4 flex justify-between h-12">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a class="md:font-bold text-xl my-4"  href="/">
                            @if (Route::currentRouteName() === 'home')
                            <img class="my-10 hidden" src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713590106/logophtech_faclfs_1_sn2ceq.png" alt="PH TECH SUMMIT LOGO W" style="width:50px !important;">
                            @else
                                <img src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713590106/logophtech_faclfs_1_sn2ceq.png" alt="PH TECH SUMMIT LOGO" style="width:50px !important;">
                            @endif
                        </a>
                    </div>

                    <style>
                        .ring-opacity-5 {
                            padding:0px;
                        }
                    </style>
                    <!-- Navigation Links -->
                    <div class="flex hidden space-x-8 px-6 sm:flex bg-white rounded-full ">

                        <div class="hidden space-x-4 px-0 sm:flex">
                            <x-nav-link  href="{{ route('about') }}" class="{{ Route::currentRouteName() === 'home' ? 'hover-border ' : '' }}"  :active="request()->routeIs('about')">
                                About
                            </x-nav-link>
                        </div>
                      
                        <div class="hidden space-x-4 px-0 sm:flex relative">
      
                                <x-dropdown  class="p-0" align="center">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center py-2 mt-1">
                                            <x-nav-link class="{{ Route::currentRouteName() === 'home' ? 'hover-border ' : '' }}" :active="request()->routeIs('events')">
                                                Events
                                            </x-nav-link>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content" >
                                        <div class="bg-white text-green-800">
                                        <x-dropdown-link  style="color:rgb(16 185 129 / var(--tw-text-opacity));" href="{{ route('events') }}">
                                          Events
                                        </x-dropdown-link>
                                        <x-dropdown-link style="color:rgb(16 185 129 / var(--tw-text-opacity));" href="{{ route('schedule.view', ['schedule' => $events2]) }}#speakers">
                                          Speakers
                                        </x-dropdown-link>

                                       
                                        <x-dropdown-link style="color:rgb(16 185 129 / var(--tw-text-opacity));" href="{{ route('schedule.view', ['schedule' => $events2]) }}#schedule">
                                           Sessions
                                        </x-dropdown-link>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                    
                        </div>

                        <div class="hidden space-x-6 px-0 sm:flex">
                            <x-nav-link href="/#partners" class="{{ Route::currentRouteName() === 'home' ? 'hover-border ' : '' }}"  :active="request()->routeIs('shop')">
                                Partners
                            </x-nav-link>
                        </div>
                   

                        <div class="hidden space-x-6 px-0 sm:flex" >
                            @auth
                                <x-nav-link href="{{ route('dashboard') }}" class="{{ Route::currentRouteName() === 'home' ? 'hover-border ' : '' }}"   :active="request()->routeIs('dashboard')">
                                    Profile
                                </x-nav-link>
                            @else
                                <x-nav-link href="{{ route('register') }}"  class="{{ Route::currentRouteName() === 'home' ? 'hover-border ' : '' }}"  :active="request()->routeIs('dashboard')">
                                    Attend
                                </x-nav-link>
                            @endauth
                        </div>

                        <div class="hidden space-x-6 px-0 sm:flex">
                            <x-nav-link href="{{ route('contact') }}" class="{{ Route::currentRouteName() === 'home' ? 'hover-border ' : '' }}"   :active="request()->routeIs('contact')">
                                Contact
                            </x-nav-link>
                        </div>
                
                    </div>      

                <!-- Hamburger -->
                
                <div class="flex items-center bg-white rounded-full px-4 sm:hidden">
                   <span class="text-black text-xs MenloRegular">
                        MENU
                   </span> 
                        @if (Route::currentRouteName() === 'home')
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-black  hover:text-white dark:hover:text-black hover:bg-white-100 dark:hover:bg-white-900 focus:outline-none focus:bg-white-100 dark:focus:bg-white-900 focus:text-white-500 dark:focus:text-white-400 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @else
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-black dark:text-black hover:text-black dark:hover:text-white-400 hover:bg-white-100 dark:hover:bg-white-900 focus:outline-none focus:bg-white-100 dark:focus:bg-white-900 focus:text-white-500 dark:focus:text-white-400 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open} " class="hidden sm:hidden bg-white h-screen text-center pt-10">
            <!-- Responsive Settings Options -->
            <div class="py-6 space-y-4">
                <a href="{{ route('about') }}" class="text-2xl font-bold MenloRegular">
                    About
                </a>
            </div>
            <div class="py-6 space-y-4">
                <a href="{{ route('events') }}" class="text-2xl font-bold MenloRegular">
                    Events
                </a>
                    <ul>
                        <li class="py-2">
                            <a class="text-sm font-bold MenloRegular" href="{{ route('schedule.view', ['schedule' => $events2]) }}#speakers">
                                Speakers
                            </a>
                        </li>
                        <li class="py-2">
                            <a class="text-sm font-bold MenloRegular" href="{{ route('schedule.view', ['schedule' => $events2]) }}#schedule">
                                Sessions
                            </a>
                        </li>         
                    </ul>
                
            </div>
            
            <div class="py-6 space-y-4">
                <a href="/#partners"  class="text-2xl font-bold MenloRegular">
                    Partners
                </a>
            </div>
             <div class="py-6 space-y-4">
                <a href="{{ route('contact') }}"  class="text-2xl font-bold MenloRegular">
                    Contact
                </a>
            </div>
            <div class="py-6 space-y-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold MenloRegular">
                        hello {{ auth()->user()->name }} !
                    </a>
                @else
                    <a href="{{ route('register') }}" class="text-2xl font-bold MenloRegular">
                        Attend
                    </a>
                @endauth
            </div>
           
        </div>
    </nav>

</header>
        