<header class="md:invisible lg-hide" style="z-index:100;" id="stickyHeader">

    <style>
        @media screen and (min-width: 644px) {
        .lg-hide {
            display:none !important;
        }
        }
    </style>

    <nav x-data="{ open: false }" class="bg-black dark:border-gray-700"  style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
        <!-- Primary Navigation Menu -->
       <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-12">
             

                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a class="md:font-bold text-3xl" href="{{ route('admin.dashboard') }}">
                           <img src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713590106/logophtech_faclfs_1_sn2ceq.png" class="w-10" alt="PHTECHEXPO LOGO">
                        </a>
                    </div>

                  

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white dark:text-white-500 hover:text-white-500 dark:hover:text-white-400 hover:bg-white-100 dark:hover:bg-white-900 focus:outline-none focus:bg-white-100 dark:focus:bg-white-900 focus:text-white-500 dark:focus:text-white-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            

            <!-- Responsive Settings Options -->

            <div class="py-2 space-y-1 border-t border-white-200 dark:border-white-600">
              <x-responsive-nav-link style="color:white;" href="{{ route('admin.dashboard') }}">
                  Home
              </x-responsive-nav-link>
            </div>

            <div class="py-2 space-y-1 border-t border-white-200 dark:border-white-600">
              <x-responsive-nav-link style="color:white;" href="{{ route('admin.users') }}">
                  Users
              </x-responsive-nav-link>
            </div>
       
            <div class="py-2 space-y-1 border-t border-white-200 dark:border-white-600">
                <x-responsive-nav-link style="color:white;" href="{{ route('admin.about') }}">
                    About
                </x-responsive-nav-link>
            </div>
            <div class="py-2 space-y-1 border-t border-white-200 dark:border-white-600">
                <x-responsive-nav-link style="color:white;" href="{{ route('admin.events') }}">
                    Events
                </x-responsive-nav-link>
            </div>
            <div class="py-2 space-y-1 border-t border-white-200 dark:border-white-600">
                <x-responsive-nav-link style="color:white;" href="{{ route('admin.partner') }}">
                    Partner
                </x-responsive-nav-link>
            </div>
          
        </div>
    </nav>

</header>

<aside style="z-index:100; width:10%;" id="default-sidebar" class=" fixed top-0 left-0 z-40 w-40 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-black ">
      <ul class="space-y-2 font-medium">
       
         <li class="py-4">
            <a class="text-center flex justify-center" href="">
                <img src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713590106/logophtech_faclfs_1_sn2ceq.png" class="w-12" alt="PHTECHEXPO LOGO">
            </a>
         </li>
         <li class="py-6 text-center">
             <x-nav-link style="color:white;" href="{{ route('admin.dashboard') }}" :active="request()->routeIs('features')">
                    Home
                </x-nav-link>
        </li>
        <li class="py-6 text-center">
             <x-nav-link style="color:white;" href="{{ route('admin.users') }}" :active="request()->routeIs('features')">
                    Users
                </x-nav-link>
        </li>
         <li class="py-6 text-center">
            <x-nav-link style="color:white;" href="{{ route('admin.about') }}" :active="request()->routeIs('features')">
                About
            </x-nav-link>
         </li>
         <li class="py-6 text-center">
            <x-nav-link style="color:white;" href="{{ route('admin.events') }}" :active="request()->routeIs('features')">
                Events
            </x-nav-link>
         </li>
         <li class="py-6 text-center">
            <x-nav-link style="color:white;" href="{{ route('admin.partner') }}" :active="request()->routeIs('issues')">
            Partners
            </x-nav-link>
         </li>
      </ul>
   </div>
</aside>

