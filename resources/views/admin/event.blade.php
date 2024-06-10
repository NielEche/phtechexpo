<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight NHaasGroteskDSPro-65Md">
            Admin Events
        </h2>
    </x-slot>


    @if(session('success'))
        <div class="absolute top-0 left-0 mt-4 mr-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
            role="alert" id="success-message">
            <strong class="font-bold">Successful update!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>

        <script>
            setTimeout(function () {
                document.getElementById('success-message').style.display = 'none';
            }, 5000); // 5000 milliseconds (5 seconds)

        </script>
    @endif


    <div class="container-fluid mx-auto pt-16  bg-SelectColor">
        <hr class="  border-black dark:border-black">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0  relative z-10">
            <h3 class="text-3xl leading-none py-8 font-semibold orpheusproMedium">
            Events Details</h3>
        </div>
        <hr class="  border-black dark:border-black">
  
        <div class=" ">
            @foreach($eventsMains as $mains)
                <div class="flex-initial  pt-4 px-2">
                    <div class="relative space-y-1 pt-4 border-b border-black dark:border-black">
                        <div class="text-left">
                            <div class="flex">
                                <div class="lg:w-1/2">
                                    <img src="public{{ $mains->path }}" alt="Image"
                                    class="object-contain storiesBox" />
                                </div>
                         
                                <div class="p-4 lg:w-1/2">
                                    <p class="text-lg pt-3 HaasGroteskDSPro-65Md" style="font-weight:800;">
                                        {{ $mains->header }} </p>
                                    <p class="HalyardDisplay pb-2">
                                        {{  $mains->caption  }}
                                    </p>
                                </div>
                            
                            </div>
                            <div class="flex justify-between border-t  border-black dark:border-black py-4">
                                <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'main{{ $mains->id }}')" class="text-lg underline  text-black">EDIT</a>   

                            </div>
                        </div>
                    </div>
                </div>
                <x-modal name="main{{ $mains->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('eventsmain.update', $mains->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Event Details') }} 
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Edit the details for this section below') }}
                        </p>

                        <div class="mt-6">
                            <p class="orpheusproMedium" for="path" :value="__('path')">Image</p>
                            <input type="file" name="path" id="path" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('path')" />
                        </div>

                        <div class="mt-6 ">
                            <p class="orpheusproMedium" for="header" :value="__('header')">Header</p>
                            <x-text-input id="header" name="header" type="text" class="mt-1 block w-full"
                                :value="old('header', $mains->header)" required autofocus autocomplete="header" />
                            <x-input-error class="mt-2" :messages="$errors->get('header')" />
                        </div>

                      

                        <div class="mt-6 ">
                            <p class="orpheusproMedium" for="caption" :value="__('caption')">Caption</p>
                            <textarea id="caption" name="caption"
                                class=" border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                                required autofocus
                                autocomplete="caption">{{ old('caption', $mains->caption) }}</textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('caption')" />
                        </div>


                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-primary-button class="ml-3">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>

                </x-modal>

          
            @endforeach

        </div>
    </div>


    <div class="container-fluid mx-auto pt-16  bg-SelectColor">
        <hr class="  border-black dark:border-black">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0 relative z-10">
            <h3 class="text-3xl leading-none py-8 font-semibold orpheusproMedium">
            Events</h3>
        </div>
        <hr class="  border-black dark:border-black">
        <div class="flex items-center px-6 py-6">
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addEvent')" id="add-slider-button"
                class="ml-auto text-xl py-4 underline DINAlternateBold  p-6  text-black">
                Create Event
            </button>
        </div>
        <div class=" flex flex-wrap">
            @foreach($events as $event)
              

                <div class="flex-initial w-80 pt-4 px-2">
                    <div class="relative space-y-1 pt-4 border-b  border-black dark:border-black">
                        <div class=" text-center">
                            <img src="public{{ $event->path }}" alt="Image"
                                class="object-contain storiesBox" />
                            <p class="text-base pt-3 HaasGroteskDSPro-65Md" style="font-weight:800;">
                                {{ $event->date }} </p>
                            <p class="HalyardDisplay pb-2">
                                {{  $event->theme  }}
                            </p>
                            <div class="flex justify-between border-t  border-black dark:border-black py-4">
                                <a x-data="" x-on:click.prevent="$dispatch('open-modal', '{{ $event->id }}')" class="text-sm underline  text-black">EDIT</a>   
                              
                                <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete{{ $event->id }}')"
                                    class="text-sm DINAlternateBold">Delete</a>
                            </div>
                            <div class="flex justify-between border-t  border-black dark:border-black py-4">
                               <a href="{{ route('event.speakers', $event->id) }}"
                                    class="text-sm DINAlternateBold">Add Speakers</a>
                                <a href="{{ route('event.schedule', $event->id) }}"
                                    class="text-sm DINAlternateBold">Add Schedule</a>
                            </div>
                        </div>
                    </div>
                </div>
                <x-modal name="{{ $event->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('events.update', $event->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Event Section') }} 
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Edit the details for this section below') }}
                        </p>

                        <div class="mt-6 form-check">
                            <input type="checkbox" class="form-check-input" id="publishCheckbox" name="publish" {{ $event->publish ? 'checked' : '' }}>
                            <label class="form-check-label" for="publishCheckbox">Publish</label>
                        </div>

                        <div class="mt-6">
                            <p class="orpheusproMedium" for="path" :value="__('path')">Image</p>
                            <input type="file" name="path" id="path" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('path')" />
                        </div>

                        <div class="mt-6 ">
                            <p class="orpheusproMedium" for="date" :value="__('date')">Date</p>
                            <x-text-input id="date" name="date" type="text" class="mt-1 block w-full"
                                :value="old('date', $event->date)" required autofocus autocomplete="date" />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>

                        <div class="mt-6 ">
                            <p class="orpheusproMedium" for="time" :value="__('Time')">Time</p>
                            <x-text-input id="time" name="time" type="text" class="mt-1 block w-full"
                                :value="old('time', $event->time)" required autofocus autocomplete="time" />
                            <x-input-error class="mt-2" :messages="$errors->get('time')" />
                        </div>

                        <div class="mt-6 ">
                            <p class="orpheusproMedium" for="theme" :value="__('theme')">Theme</p>
                            <x-text-input id="theme" name="theme" type="text" class="mt-1 block w-full"
                                :value="old('theme', $event->theme)" required autofocus autocomplete="theme" />
                            <x-input-error class="mt-2" :messages="$errors->get('theme')" />
                        </div>

                        <div class="mt-6 ">
                            <p class="orpheusproMedium" for="venue" :value="__('venue')">Venue</p>
                            <x-text-input id="venue" name="venue" type="text" class="mt-1 block w-full"
                                :value="old('venue', $event->venue)" required autofocus autocomplete="venue" />
                            <x-input-error class="mt-2" :messages="$errors->get('venue')" />
                        </div>

                        <div class="mt-6 ">
                            <p class="orpheusproMedium" for="about" :value="__('about')">About</p>
                            <textarea id="about" name="about"
                                class=" border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                                required autofocus
                                autocomplete="about">{{ old('about', $event->about) }}</textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('about')" />
                        </div>


                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-primary-button class="ml-3">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>

                </x-modal>

                <x-modal name="delete{{ $event->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('eventDelete.destroy', $event->id) }}"
                        class="p-6 bg-emerald-500">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Delete event') }} Image
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Are you sure you want to delete image') }}
                        </p>



                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>


                            <x-danger-button class="ml-3">
                                {{ __('Delete Image') }}
                            </x-danger-button>
                        </div>
                    </form>

                </x-modal>
            @endforeach
        </div>
    </div>
    


       <!-- MODALS MODALS MODALS MODALS -->
       <x-modal name="addEvent" focusable>
        <!-- Modal Content -->
        <form method="post" action="{{ route('events.store') }}" class="p-6 bg-emerald-500"
            enctype="multipart/form-data">
            @csrf


            <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                {{ __('Add a new Slider ') }}
            </h2>


            <div class="mt-6">
                <p class="orpheusproMedium" for="path" :value="__('path')">File*</p>
                <input type="file" name="path" id="path" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('path')" />
            </div>

            <div class="mt-6 ">
                <p class="orpheusproMedium" for="date" :value="__('date')">Date</p>
                <x-text-input id="date" name="date" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="date" />
                <x-input-error class="mt-2" :messages="$errors->get('date')" />
            </div>

            <div class="mt-6 ">
                <p class="orpheusproMedium" for="time" :value="__('time')">Time</p>
                <x-text-input id="time" name="time" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="time" />
                <x-input-error class="mt-2" :messages="$errors->get('time')" />
            </div>

            <div class="mt-6 ">
                <p class="orpheusproMedium" for="theme" :value="__('theme')">Theme</p>
                <x-text-input id="theme" name="theme" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="theme" />
                <x-input-error class="mt-2" :messages="$errors->get('theme')" />
            </div>
            <div class="mt-6 ">
                <p class="orpheusproMedium" for="venue" :value="__('venue')">Venue</p>
                <x-text-input id="venue" name="venue" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="venue" />
                <x-input-error class="mt-2" :messages="$errors->get('venue')" />
            </div>
            <div class="mt-6 ">
                <p class="orpheusproMedium" for="about" :value="__('about')">About</p>
                <textarea id="about" name="about"
                    class="HalyardDisplay border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                    required autofocus autocomplete="about" value="null"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('about')" />
            </div>




            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>

    </x-modal>

</x-admin-layout>