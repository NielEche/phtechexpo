<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight NHaasGroteskDSPro-65Md">
            Admin Home
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




    <div class="container-fluid mx-auto pt-6  bg-SelectColor">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0 relative z-10">
            <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                Homepage Header</h3>
        </div>
        <hr class="  border-black dark:border-black">
        <div class="flex items-center px-6 py-6">
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addSlider')" id="add-slider-button"
                class="ml-auto text-xl py-4 underline DINAlternateBold  p-6  text-black">
                Add Image
            </button>
        </div>
        <div class=" flex flex-wrap">
            @foreach($homeGallerys as $gallery)
                <div class="flex lg:w-1/3 w-1/2 flex-wrap">
                    <div class="w-full relative gallerSec">
                        <div
                            class="absolute galleryOverlay inset-0 bg-black opacity-40 transition-opacity duration-300">
                        </div> <!-- Black overlay -->
                        <img alt="gallery image" class="block h-80 w-full object-cover object-center"
                            src="public{{ $gallery->path }}" />
                        <div class="absolute inset-0 flex justify-center items-center text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                            style="font-weight:800; background-color: rgba(0, 0, 0, 0.8);">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'Slider{{ $gallery->id }}')"
                                class="text-xl py-4 underline DINAlternateBold border p-6 rounded-full bg-white text-black">EDIT</button>
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteSlider{{ $gallery->id }}')"
                                class="text-xl py-4 underline DINAlternateBold mx-2 p-6 rounded-full bg-white text-black">Delete</button>

                        </div>
                    </div>
                </div>
                <x-modal name="Slider{{ $gallery->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('home_gallerys.update', $gallery->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Slider Section') }} Image {{ $gallery->id }}
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Edit the details for this section below') }}
                        </p>

                        <div class="mt-6">
                            <p for="path" :value="__('path')">Image</p>
                            <input type="file" name="path" id="path" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('path')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="header" :value="__('header')">Header</p>
                            <x-text-input id="header" name="header" type="text" class="mt-1 block w-full"
                                :value="old('header', $gallery->header)" autofocus autocomplete="header" />
                            <x-input-error class="mt-2" :messages="$errors->get('header')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="caption" :value="__('Caption')">Caption</p>
                            <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full"
                                :value="old('caption', $gallery->caption)" autofocus autocomplete="caption" />
                            <x-input-error class="mt-2" :messages="$errors->get('caption')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="button" :value="__('button')">Button Text</p>
                            <x-text-input id="button" name="button" type="text" class="mt-1 block w-full"
                                :value="old('button', $gallery->button)" autofocus autocomplete="button" />
                            <x-input-error class="mt-2" :messages="$errors->get('button')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="embed" :value="__('embed')">Button Link</p>
                            <x-text-input id="embed" name="embed" type="text" class="mt-1 block w-full"
                                :value="old('embed', $gallery->embed)" autofocus autocomplete="embed" />
                            <x-input-error class="mt-2" :messages="$errors->get('embed')" />
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

                <x-modal name="deleteSlider{{ $gallery->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('galleryDelete.destroy', $gallery->id) }}"
                        class="p-6 bg-emerald-500">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Delete Gallery') }} Image
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
    <hr class="my-4 border-black dark:border-black">

    <div class="container-fluid mx-auto pt-6  bg-SelectColor">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0 relative z-10">
            <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                Homepage About</h3>
            <p class="text-lg leading-none pb-2 font-semibold text-black">Let's Talk About The Future</p>
        </div>
        <hr class="  border-black dark:border-black">
     
        <div class=" flex flex-wrap">
            @foreach($homeAbouts as $about)
                <div class="lg:px-24 p-0 py-2 relative">
                    <div class="w-full relative">
                        <p class="text-base text-black">{{ $about->details }}</p> 
                        <div class=" inset-0 flex justify-end items-end text-white">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', '{{ $about->id }}')"
                                class="text-xl py-4 underline  text-black">EDIT</button>
                           

                        </div>
                    </div>
                </div>
                <x-modal name="{{ $about->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('home_abouts.update', $about->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Home About Section') }}
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Edit the details for this section below') }}
                        </p>

                   
                        <div class="mt-6 ">
                            <p for="details" :value="__('details')">Details</p>
                            <textarea id="details" name="details"
                                class=" border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                                required autofocus
                                autocomplete="details">{{ old('details', $about->details) }}</textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('details')" />
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
     <hr class="my-4 border-black dark:border-black">


     <div class="container-fluid mx-auto pt-6  bg-SelectColor">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0 relative z-10">
            <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                Homepage Programs</h3>
        </div>
        <hr class="  border-black dark:border-black">
        <div class="flex items-center px-6 py-6">
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addProgram')" id="add-service-button"
                class="ml-auto text-xl py-4 underline  p-6  text-black">
                Add Program
            </button>
        </div>
        <div class=" flex flex-wrap">
            @foreach($programs as $program)
                <div class="flex lg:w-1/3 w-1/2 flex-wrap">
                    <div class="w-full relative gallerSec">
                        <div
                            class="absolute galleryOverlay inset-0 bg-black opacity-40 transition-opacity duration-300">
                        </div> <!-- Black overlay -->
                        <img alt="gallery image" class="block h-80 w-full object-cover object-center"
                            src="public{{ $program->path }}" />
                        <p>{{ $program->header }}</p>

                        <div class="absolute inset-0 flex justify-center items-center text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                            style="font-weight:800; background-color: rgba(0, 0, 0, 0.8);">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'program{{ $program->id }}')"
                                class="text-xl py-4 underline border p-6 rounded-full bg-white text-black">EDIT</button>
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteP{{ $program->id }}')"
                                class="text-xl py-4 underline  mx-2 p-6 rounded-full bg-white text-black">Delete</button>

                        </div>
                    </div>
                </div>
                <x-modal name="program{{ $program->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('programs.update', $program->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Schedule Section') }}
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Edit the details for this section below') }}
                        </p>

                        <div class="mt-6">
                            <p for="path" :value="__('path')">Image</p>
                            <input type="file" name="path" id="path" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('path')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="header" :value="__('header')">Header</p>
                            <x-text-input id="header" name="header" type="text" class="mt-1 block w-full"
                                :value="old('header', $program->header)" required autofocus autocomplete="header" />
                            <x-input-error class="mt-2" :messages="$errors->get('header')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="caption" :value="__('caption')">Caption</p>
                            <textarea id="caption" name="caption"
                                class=" border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                                 autofocus
                                autocomplete="caption">{{ old('caption', $program->caption) }}</textarea>

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

                <x-modal name="deleteP{{ $program->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('programDelete.destroy', $program->id) }}"
                        class="p-6 bg-emerald-500">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Delete schedule') }} 
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Are you sure you want to delete ') }}
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

            @foreach($ExplorePrograms as $eprogram)
                <div class="flex lg:w-1/3 w-1/2 flex-wrap">
                    <h3 class="text-xl font-black p-4">Explore Schedule</h3>
                    <div class="w-full relative gallerSec">
                        <div
                            class="absolute galleryOverlay inset-0 bg-black opacity-40 transition-opacity duration-300">
                        </div> <!-- Black overlay -->
                        <img alt="gallery image" class="block h-80 w-full object-cover object-center"
                            src="public{{ $eprogram->path }}" />
                        <p>{{ $eprogram->header }}</p>

                        <div class="absolute inset-0 flex justify-center items-center text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                            style="font-weight:800; background-color: rgba(0, 0, 0, 0.8);">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'eprogram{{ $eprogram->id }}')"
                                class="text-xl py-4 underline border p-6 rounded-full bg-white text-black">EDIT</button>

                        </div>
                    </div>
                </div>
                <x-modal name="eprogram{{ $eprogram->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('eprograms.update', $eprogram->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Explore Section') }}
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Edit the details for this section below') }}
                        </p>

                        <div class="mt-6">
                            <p for="path" :value="__('path')">Image</p>
                            <input type="file" name="path" id="path" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('path')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="header" :value="__('header')">Header</p>
                            <x-text-input id="header" name="header" type="text" class="mt-1 block w-full"
                                :value="old('header', $eprogram->header)" required autofocus autocomplete="header" />
                            <x-input-error class="mt-2" :messages="$errors->get('header')" />
                        </div>

                       
                        <div class="mt-6 ">
                            <p for="button" :value="__('button')">Button text</p>
                            <x-text-input id="button" name="button" type="text" class="mt-1 block w-full"
                                :value="old('button', $eprogram->button)" required autofocus autocomplete="button" />
                            <x-input-error class="mt-2" :messages="$errors->get('button')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="link" :value="__('link')">Url</p>
                            <x-text-input id="link" name="link" type="text" class="mt-1 block w-full"
                                :value="old('link', $eprogram->link)" required autofocus autocomplete="link" />
                            <x-input-error class="mt-2" :messages="$errors->get('link')" />
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
    <hr class="my-4 border-black dark:border-black">


    <div class="container-fluid mx-auto pt-6  bg-SelectColor">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0 relative z-10">
            <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                Homepage Services</h3>
        </div>
        <hr class="  border-black dark:border-black">
        <div class="flex items-center px-6 py-6">
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addService')" id="add-service-button"
                class="ml-auto text-xl py-4 underline  p-6  text-black">
                Add Service
            </button>
        </div>
        <div class=" flex flex-wrap">
            @foreach($homeServices as $service)
                <div class="flex lg:w-1/3 w-1/2 flex-wrap">
                    <div class="w-full relative gallerSec">
                        <div
                            class="absolute galleryOverlay inset-0 bg-black opacity-40 transition-opacity duration-300">
                        </div> <!-- Black overlay -->
                        <img alt="gallery image" class="block h-80 w-full object-cover object-center"
                            src="public{{ $service->path }}" />
                        <p>{{ $service->title }}</p>

                        <div class="absolute inset-0 flex justify-center items-center text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                            style="font-weight:800; background-color: rgba(0, 0, 0, 0.8);">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'service{{ $service->id }}')"
                                class="text-xl py-4 underline border p-6 rounded-full bg-white text-black">EDIT</button>
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteS{{ $service->id }}')"
                                class="text-xl py-4 underline  mx-2 p-6 rounded-full bg-white text-black">Delete</button>

                        </div>
                    </div>
                </div>
                <x-modal name="service{{ $service->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('home_services.update', $service->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Services Section') }}
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Edit the details for this section below') }}
                        </p>

                        <div class="mt-6">
                            <p for="path" :value="__('path')">Image</p>
                            <input type="file" name="path" id="path" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('path')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="title" :value="__('title')">Title</p>
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title', $service->title)" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="details" :value="__('details')">Details</p>
                            <textarea id="details" name="details"
                                class=" border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                                required autofocus
                                autocomplete="details">{{ old('details', $service->details) }}</textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('details')" />
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

                <x-modal name="deleteS{{ $service->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('homeServicesDelete.destroy', $service->id) }}"
                        class="p-6 bg-emerald-500">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Delete Service') }} 
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Are you sure you want to delete ') }}
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
    <hr class="my-4 border-black dark:border-black">


    <div class="container-fluid mx-auto pt-6  bg-SelectColor">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0 relative z-10">
            <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                Homepage Videos</h3>
        </div>
        <hr class="  border-black dark:border-black">
        <div class="flex items-center px-6 py-6">
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addVideo')" id="add-service-button"
                class="ml-auto text-xl py-4 underline  p-6  text-black">
                Add Video
            </button>
        </div>
        <div class=" flex flex-wrap">
            @foreach($HomeVideos as $video)
                <div class="flex lg:w-1/3 w-1/2 flex-wrap">
                    <div class="w-full relative gallerSec">
                        <iframe style="height:300px;" class=" w-full h-full" src="{{ $video->embed }}" frameborder="0" allow="accelerometer;" allowfullscreen></iframe>
                        <p>{{ $video->caption }}</p>

                        <div class=" justify-center items-center text-white "
                            style="font-weight:800; ">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'video{{ $video->id }}')"
                                class="text-xl py-4 underline  p-4 text-black">EDIT</button>
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteV{{ $video->id }}')"
                                class="text-xl py-4 underline  mx-2 p-4 text-black">Delete</button>

                        </div>
                    </div>
                </div>
                <x-modal name="video{{ $video->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('home_videos.update', $video->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Video Section') }}
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Edit the details for this section below') }}
                        </p>

                        <div class="mt-6 form-check">
                            <input type="checkbox" class="form-check-input" id="publishCheckbox" name="publish" {{ $video->publish ? 'checked' : '' }}>
                            <label class="form-check-label" for="publishCheckbox">Publish</label>
                        </div>

                        <div class="mt-6 ">
                             <p class="font-bold" for="embed" :value="__('embed')">Embed code</p>
                            <p class="text-xs">copy only url in src from embed code in youtube </p>
                            <x-text-input id="embed" name="embed" type="text" class="mt-1 block w-full"
                                :value="old('embed', $video->embed)" required autofocus autocomplete="embed" />
                            <x-input-error class="mt-2" :messages="$errors->get('embed')" />
                        </div>

                        <div class="mt-6 ">
                            <p for="caption" :value="__('caption')">Caption</p>
                            <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full"
                                :value="old('caption', $video->caption)"  autofocus autocomplete="caption" />
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

                <x-modal name="deleteV{{ $video->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('homeVideosDelete.destroy', $video->id) }}"
                        class="p-6 bg-emerald-500">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Delete Video') }} 
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Are you sure you want to delete ') }}
                        </p>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>


                            <x-danger-button class="ml-3">
                                {{ __('Delete Video') }}
                            </x-danger-button>
                        </div>
                    </form>

                </x-modal>
            @endforeach

        </div>
    </div>
    <hr class="my-4 border-black dark:border-black">


    <!-- MODALS MODALS MODALS MODALS -->
    <x-modal name="addSlider" focusable>
        <!-- Modal Content -->
        <form method="post" action="{{ route('GalleryImage.store') }}" class="p-6 bg-emerald-500"
            enctype="multipart/form-data">
            @csrf


            <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                {{ __('Add a new Slider ') }}
            </h2>


            <div class="mt-6">
                <p for="path">File*</p>
                <input type="file" name="path" id="path" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('path')" />
            </div>

            <div class="mt-6 ">
                <p for="header">Header</p>
                <x-text-input id="header" name="header" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="header" />
                <x-input-error class="mt-2" :messages="$errors->get('header')" />
            </div>

            <div class="mt-6 ">
                <p for="caption">Caption</p>
                <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="caption" />
                <x-input-error class="mt-2" :messages="$errors->get('caption')" />
            </div>


            <div class="mt-6 ">
                <p  for="button">Button Text</p>
                <x-text-input id="button" name="button" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="button" />
                <x-input-error class="mt-2" :messages="$errors->get('button')" />
            </div>


            <div class="mt-6 ">
                <p for="embed">Button Link</p>
                <x-text-input id="embed" name="embed" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="embed" />
                <x-input-error class="mt-2" :messages="$errors->get('emebed')" />
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


    <x-modal name="addService" focusable>
        <!-- Modal Content -->
        <form method="post" action="{{ route('HomeService.store') }}" class="p-6 bg-emerald-500"
            enctype="multipart/form-data">
            @csrf


            <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                {{ __('Add a new Service ') }}
            </h2>


            <div class="mt-6">
                <p for="path" :value="__('path')">File*</p>
                <input type="file" name="path" id="path" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('path')" />
            </div>

            <div class="mt-6 ">
                <p for="title" :value="__('title')">Title</p>
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>


            <div class="mt-6 ">
                <p for="details" :value="__('details')">Details</p>
                <textarea id="details" name="details"
                    class="HalyardDisplay border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                    required autofocus autocomplete="details" value="null"></textarea>

                <x-input-error class="mt-2" :messages="$errors->get('details')" />
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

    <x-modal name="addProgram" focusable>
        <!-- Modal Content -->
        <form method="post" action="{{ route('programs.store') }}" class="p-6 bg-emerald-500"
            enctype="multipart/form-data">
            @csrf

            <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                {{ __('Add a new Program ') }}
            </h2>


            <div class="mt-6">
                <p for="path" :value="__('path')">File*</p>
                <input type="file" name="path" id="path" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('path')" />
            </div>

            <div class="mt-6 ">
                <p for="header" :value="__('header')">Header</p>
                <x-text-input id="header" name="header" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="header" />
                <x-input-error class="mt-2" :messages="$errors->get('header')" />
            </div>

            <div class="mt-6 ">
                <p for="caption" :value="__('caption')">Caption</p>
                <textarea id="caption" name="caption"
                    class="HalyardDisplay border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                     autofocus autocomplete="caption" value="null"></textarea>
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


    <x-modal name="addVideo" focusable>
        <!-- Modal Content -->
        <form method="post" action="{{ route('HomeVideo.store') }}" class="p-6 bg-emerald-500"
            enctype="multipart/form-data">
            @csrf


            <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                {{ __('Add a new Video ') }}
            </h2>


            <div class="mt-6 ">
                <p class="font-bold" for="embed" :value="__('embed')">Embed code</p>
                <p class="text-xs">copy only url in src from embed code in youtube </p>
                <x-text-input id="embed" name="embed" type="text" class="mt-1 block w-full" required autofocus
                    autocomplete="embed" />
                <x-input-error class="mt-2" :messages="$errors->get('embed')" />
            </div>

            <div class="mt-6 ">
                <p class="font-bold" for="caption" :value="__('caption')">Caption</p>
                <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="caption" />
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
</x-admin-layout>