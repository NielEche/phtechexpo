<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl bg-emerald-500 dark:text-green-600 leading-tight MenloRegular ">
                PH TECH EXPO
            </h2>
        </div>
    </x-slot>

    <style>
        main{
            background-color:rgb(16 185 129 / var(--tw-bg-opacity)) !important;
        }
    </style>

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


    <div class="py-12 mt-10 bg-emerald-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                 
                        <form method="POST" action="{{ route('generate.code') }}">
                            @csrf

                            <div class="container mx-auto px-6 pt-32 pb-8">
                                <h2 class="MenloRegular text-4xl font-black py-2">Please confirm your attendance<span class="blink" style="color:black;">|</span></h2>
                            </div>
                            <hr>

                            <div class="mt-4">
                                <h2 class="MenloRegular text-xl font-black py-4">Your registered Email</h2>

                                @auth   
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="auth()->user()->email" required />  
                                @else
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                @endauth
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Generate Code') }}
                                </x-primary-button>
                            </div>
                        </form>
                   
                </div>
            </div>
        </div>
    </div>
   


      

</x-app-layout>
