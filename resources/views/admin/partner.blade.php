<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight NHaasGroteskDSPro-65Md">
            Admin Partner
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
                Partners</h3>
        </div>
        <hr class="  border-black dark:border-black">
        <div class="flex items-center px-6 py-6">
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addPartner')" id="add-slider-button"
                class="ml-auto text-xl py-4 underline DINAlternateBold  p-6  text-black">
                Add partner
            </button>
        </div>
        <div class=" flex flex-wrap">
            @foreach($partners as $partner)
                <div class="flex lg:w-1/3 flex-wrap">
                    <div class="w-full relative gallerSec">
                        
                        <img alt="partner image" class="block h-56 w-full object-cover object-center"
                            src="public{{ $partner->path }}" />
                        <div class="absolute inset-0 flex justify-center items-center text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                            style="font-weight:800; background-color: rgba(0, 0, 0, 0.8);">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', '{{ $partner->id }}')"
                                class="text-xl py-4 underline DINAlternateBold border p-6 rounded-full bg-white text-black">EDIT</button>
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete{{ $partner->id }}')"
                                class="text-xl py-4 underline DINAlternateBold mx-2 p-6 rounded-full bg-white text-black">Delete</button>

                        </div>
                    </div>
                </div>
                
                <x-modal name="{{ $partner->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('partners.update', $partner->id) }}"
                        class="p-6 bg-emerald-500" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Edit Partner Section') }} 
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
                            <p class="orpheusproMedium" for="name" :value="__('Name')">Name</p>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $partner->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type" :value="__('Partner type')" />
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" id="type" name="type" required autofocus>
                                <option value="Sponsors" {{ $partner->type == 'Sponsors' ? 'selected' : '' }}>Sponsors</option>
                                <option value="Partners" {{ $partner->type == 'Partners' ? 'selected' : '' }}>Partners</option>
                                <option value="Supporters" {{ $partner->type == 'Supporters' ? 'selected' : '' }}>Supporters</option>
                            </select>
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

                <x-modal name="delete{{ $partner->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('partnersDelete.destroy', $partner->id) }}"
                        class="p-6 bg-emerald-500">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Delete partner') }} Image
                        </h2>

                        <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                            {{ __('Are you sure you want to delete') }}
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
    <hr>  


      <!-- MODALS MODALS MODALS MODALS -->
      <x-modal name="addPartner" focusable>
        <!-- Modal Content -->
        <form method="post" action="{{ route('partners.store') }}" class="p-6 bg-emerald-500"
            enctype="multipart/form-data">
            @csrf


            <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                {{ __('Add a new Partner ') }}
            </h2>


            <div class="mt-6">
                <p class="orpheusproMedium" for="path" :value="__('path')">File*</p>
                <input type="file" name="path" id="path" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('path')" />
            </div>

            <div class="mt-6 ">
                <p class="orpheusproMedium" for="name" :value="__('Name')">Name</p>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  autofocus
                    autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mt-4">
                <x-input-label for="role" :value="__('Partner type')" />
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" id="type" name="type" required autofocus>
                    <option value="Sponsors">Sponsors</option>
                    <option value="Partners">Partners</option>
                    <option value="Supporters">Supporters</option>
                </select>
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