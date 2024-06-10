<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl bg-emerald-500 dark:text-green-600 leading-tight MenloRegular ">
                PH TECH EXPO
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid bg-white mx-auto px-6 lg:px-20 py-6 pt-16 ">
        <div class=" top-0 left-0 mt-4 mr-4 bg-emerald-500 border border-emerald-500 text-white text-xl px-4 py-3 rounded"
            role="alert" id="success-message">
            <strong class="font-bold">{{ session('success') }}</strong><br>
            <span class="block sm:inline">See you at the event</span>
            @auth
                <span class="block sm:inline font-bold">Your code: {{ session('code') }}</span>
            @else
                <span class="block sm:inline">Please <a href="{{ route('login') }}" class="underline">login</a> to see your code.</span>
            @endauth
        </div>


        <div class="text-black py-8" style="min-width: 50vw;">
            <h2 class="MenloRegular text-4xl">Visit your dashboard<span class="text-emerald-500"> <a href="{{ route('dashboard') }}">HERE</a></span><span class="blink" style="color:rgb(16 185 129 / var(--tw-bg-opacity));">|</span></h2>
        </div>   
    </div>



</x-app-layout>