<footer class="bg-emerald-500">
    <div class="lg:flex justify-between bg-emerald-500 mx-auto px-12 py-4">
        <div class="MenloRegular text-white pt-6 lg:text-left text-center">
            <a href="{{ route('about') }}"  class="text-sm font-bold">About</a><br><br>
            <a href="{{ route('events') }}" class="text-sm font-bold">Events</a><br><br>
            <a href="{{ route('register') }}"class="text-sm font-bold">Attend</a><br><br>
            <a href="{{ route('contact') }}" class="text-sm font-bold">Contact</a>

            <div class="mx-auto pt-8 ">
                <p class="text-xs font-bold lg:text-left text-center">&copy; {{ date('Y') }} PH TECH EXPO</p>
            </div>
        </div>

        <div class="MenloRegular text-white ">
           <img class="w-96" src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713525026/PHTECHEXPO2024-LOGO-WHITE_w7uy3k_xdkxbj.gif" alt="logo"> 
        </div>
    </div>
</footer>