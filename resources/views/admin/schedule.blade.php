<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight NHaasGroteskDSPro-65Md">
            Admin Issue
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


    <div class="py-12 bg-SelectColor ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 ">
        <a class=" m-4 NHaasGroteskDSPro-65Md border-b border-black" href="{{ route('admin.events') }}">BACK TO EVENT</a>

            <div class="py-4 px-2  bg-SelectColor">
                    <section>
                        <div class="h-full w-full ">
                            @if($schedules->isEmpty())

                                <div class="lg:w-1/2 lg:px-4 w-full h-full flex items-center justify-center  bg-SelectColor">
                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addSchedule')" id="add-issue-button"
                                        class="fixed mt-16 top-4 right-4 bg-black  underline text-white px-4 py-2 rounded">
                                        Add Schedule
                                    </button>
                                    <div class="text-center text-black lg:px-32 p-10 relative z-10">
                                        <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                                           Theres No schedule for this event yet </h3>
                                    </div>
                                </div>
                            @else
                            <div class=" container-fluid ">
                                     <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addSchedule')" id="add-issue-button"
                                        class="fixed mt-16 top-4 right-4 bg-black  underline text-white px-4 py-2 rounded">
                                        Add Schedule
                                    </button>
                                <h3 class="text-xl leading-none pb-6 font-semibold orpheusproMedium">
                                           Schedule</h3>
                                    
                                <hr class="  border-black dark:border-black">
                                <div class="flex flex-wrap">
                                    @php
                                        $previousDate = null;
                                    @endphp
                                    @foreach($schedules->groupBy('date') as $date => $schedulesForDate)
                                        <div class="mt-6 flex-initial w-80 pt-4 px-2">
                                            @if($date !== $previousDate)
                                                    @php
                                                    // Parse the date string into a DateTime object
                                                    $dateTime = new DateTime($date);

                                                    // Format the date as desired
                                                    $formattedDate = $dateTime->format('jS F Y');
                                                @endphp
                                                <h2 class="font-black underline text-lg">{{ $formattedDate }}</h2>
                                                @php
                                                    $previousDate = $date;
                                                @endphp
                                            @endif
                                            @foreach($schedulesForDate->sortBy('time') as $schedule)
                                            <div class="px-4 py-2 ">
                                                <div class="w-full relative gallerSec">
                                                    <div
                                                        class="absolute galleryOverlay inset-0 bg-black opacity-0 transition-opacity duration-300">
                                                    </div> <!-- Black overlay -->
                                                        <p class="text-xl text-left pt-3 HaasGroteskDSPro-65Md" style="font-weight:800;">{{ $schedule->topic }} </p>
                                                        <p class="text-base text-left HaasGroteskDSPro-65Md" style="font-weight:800;">{{ $schedule->time }} </p>
                                                        <p class="text-base text-left HaasGroteskDSPro-65Md font-black" >{{ $schedule->venue }} </p>
                                                    <div class="absolute inset-0 flex justify-center items-center text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                                                        style="font-weight:800; background-color: rgba(0, 0, 0, 0.2);">
                                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'S{{ $schedule->id }}')"
                                                            class="text-sm py-2 underline DINAlternateBold mx-2 p-4 rounded-full bg-white text-black">EDIT</button>
                                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete{{ $schedule->id }}')"
                                                            class="text-sm py-2 underline DINAlternateBold  p-4 rounded-full bg-white text-black">Delete</button>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <x-modal name="S{{ $schedule->id }}" focusable>
                                                <!-- Modal Content -->
                                                <form method="post"
                                                    action="{{ route('schedule.update', $schedule->id) }}"
                                                    class="p-6 bg-emerald-500" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')

                                                    <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                                                        {{ __('Edit schedule Section') }} 
                                                    </h2>

                                                    <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                                                        {{ __('Edit the details for this section below') }}
                                                    </p>

                                                    <div class="mt-6 form-check">
                                                        <input type="checkbox" class="form-check-input" id="publishCheckbox" name="publish" {{ $schedule->publish ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="publishCheckbox">Publish</label>
                                                    </div>

                                                    <div class="mt-6 hidden">
                                                        <p class="orpheusproMedium" for="event_id" :value="__('event_id')">Event Id</p>
                                                        <x-text-input id="event_id" name="event_id" type="text" class="mt-1 block w-full"
                                                            :value="old('event_id', $schedule->event_id)" required autofocus autocomplete="event_id" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('event_id')" />
                                                    </div>

                                                    <div class="mt-6 ">
                                                        <p class="orpheusproMedium" for="topic" :value="__('topic')">Topic</p>
                                                        <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full"
                                                            :value="old('topic', $schedule->topic)" required autofocus autocomplete="topic" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('topic')" />
                                                    </div>

                                                    <div class="mt-6">
                                                        <p class="orpheusproMedium" for="date" :value="__('date')">Date</p>
                                                        <x-text-input id="date" name="date" type="date" class="mt-1 block w-full"
                                                            :value="old('date', $schedule->date)" required autofocus autocomplete="date" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('date')" />
                                                    </div>

                                                    <div class="mt-6 ">
                                                        <p class="orpheusproMedium" for="time" :value="__('time')">Time</p>
                                                        <x-text-input id="time" name="time" type="time" class="mt-1 block w-full"
                                                            :value="old('time', $schedule->time)" required autofocus autocomplete="time" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('time')" />
                                                    </div>

                                                    <div class="mt-6 ">
                                                        <p class="orpheusproMedium" for="venue" :value="__('venue')">Venue</p>
                                                        <x-text-input id="venue" name="venue" type="text" class="mt-1 block w-full"
                                                            :value="old('venue', $schedule->venue)" required autofocus autocomplete="venue" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('venue')" />
                                                    </div>

                                                    <div class="mt-6">
                                                        <label for="speaker" class="orpheusproMedium">{{ __('Speaker') }}</label>
                                                        <select  id="speaker_id" name="speaker_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-white dark:text-black focus:border-black dark:focus:border-black focus:ring-black dark:focus:ring-black rounded-md shadow-sm">
                                                            <option value="" {{ !$schedule->speaker_id ? 'selected' : '' }}>{{ __('Select Speaker') }}</option>
                                                            @foreach($speakers as $speaker)
                                                                <option value="{{ $speaker->id }}" {{ $schedule->speaker_id == $speaker->id ? 'selected' : '' }}>{{ $speaker->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error class="mt-2" :messages="$errors->get('speaker')" />
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
                                            

                                            <x-modal name="delete{{ $schedule->id }}" focusable>
                                                <!-- Modal Content -->
                                                <form method="post" action="{{ route('scheduleDelete.destroy', $schedule->id) }}" class="p-6 bg-emerald-500">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                                                        {{ __('Delete schedule') }} 
                                                    </h2>

                                                    <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                                                        {{ __('Are you sure you want to delete schedule') }}
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
                                            <hr>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </section>
            </div>
        </div>
    </div>


        <!-- MODALS MODALS MODALS MODALS -->
        <x-modal name="addSchedule" focusable>
            <!-- Modal Content -->
            <form method="post" action="{{ route('schedule.store') }}" class="p-6 bg-emerald-500"
                enctype="multipart/form-data">
                @csrf

                <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                    {{ __('Add a new Schedule ') }}
                </h2>


                <div class="mt-6 hidden">
                    <p class="orpheusproMedium" for="event_id" :value="__('event_id')">Id</p>
                    <x-text-input id="event_id"  name="event_id" type="text" class="mt-1 block w-full" required autofocus
                        autocomplete="event_id"  value="{{ $events->id }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('path')" />
                </div>

                <div class="mt-6 ">
                    <p class="orpheusproMedium" for="topic" :value="__('topic')">Topic</p>
                    <x-text-input id="topic" name="topic" type="text" class="mt-1 block w-full"  autofocus
                        autocomplete="topic" />
                    <x-input-error class="mt-2" :messages="$errors->get('topic')" />
                </div>

                <div class="mt-6 ">
                    <p class="orpheusproMedium" for="date" :value="__('date')">Date</p>
                    <x-text-input id="date" name="date" type="date" class="mt-1 block w-full"  autofocus
                        autocomplete="date" />
                    <x-input-error class="mt-2" :messages="$errors->get('date')" />
                </div>

                <div class="mt-6 ">
                    <p class="orpheusproMedium" for="time" :value="__('time')">Time</p>
                    <x-text-input id="time" name="time" type="time" class="mt-1 block w-full"  autofocus
                        autocomplete="time" />
                    <x-input-error class="mt-2" :messages="$errors->get('time')" />
                </div>

                <div class="mt-6 ">
                    <p class="orpheusproMedium" for="venue" :value="__('venue')">Venue</p>
                    <x-text-input id="venue" name="venue" type="text" class="mt-1 block w-full"  autofocus
                        autocomplete="venue" />
                    <x-input-error class="mt-2" :messages="$errors->get('venue')" />
                </div>

                <div class="mt-6">
                    <label for="speaker" class="orpheusproMedium">{{ __('Speaker') }}</label>
                    <select  id="speaker_id" name="speaker_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-white dark:text-black focus:border-black dark:focus:border-black focus:ring-black dark:focus:ring-black rounded-md shadow-sm">
                        <option value="" {{ !$schedule->speaker_id ? 'selected' : '' }}>{{ __('Select Speaker') }}</option>
                        @foreach($speakers as $speaker)
                            <option value="{{ $speaker->id }}" {{ $schedule->speaker_id == $speaker->id ? 'selected' : '' }}>{{ $speaker->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('speaker')" />
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

    <hr class="  border-black dark:border-black">


</x-admin-layout>
