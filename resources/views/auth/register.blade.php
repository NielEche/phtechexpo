<x-guest-layout>
    <div class="flex justify-center py-4">
        <a href="/"> <img class="w-12"
                src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713590106/logophtech_faclfs_1_sn2ceq.png" alt=""></a>
    </div>

    <div class="text-black py-4" style="min-width: 50vw;">
        <h2 class="MenloRegular text-4xl">REGISTRATION <span class="text-red-500">CLOSED</span><span class="blink" style="color:rgb(16 185 129 / var(--tw-bg-opacity));">|</span></h2>
     </div>


    <form id="registrationForm" class="MenloRegular hidden" method="POST" action="{{ route('register') }}">
        @csrf

        <div id="section1">
            <!-- Section 1: First Name, Last Name, Email, and Job Title -->
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Your Full Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Preferred Email Address')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="role" :value="__('Registering as')" />
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" id="role" name="role" required autofocus onchange="toggleBoothSizeSelect(); toggleAgeAndGender();">
                    <option value="user">Attendee</option>
                    <option value="exhibitor">Exhibitor</option>
                </select>
            </div>

            <div id="boothSizeSelect" class="mt-4" style="display: none;">
                <x-input-label for="booth_size" :value="__('Booth Category')" />
                <x-input-error :messages="$errors->get('booth_size')" class="mt-2" />
                <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" id="booth" name="booth">
                    <option value="N1,000,000 ( 3m x 3m)">N1,000,000 ( 3m x 3m)</option>
                    <option value="N500,000 (2m x 2m )">N500,000 (2m x 2m )</option>
                    <option value="N250,000 (1m x1m)">N250,000 (1m x1m)</option>
                    <option value="N50,000 (ONLINE EXHIBITION)">N50,000 (ONLINE EXHIBITION)</option>
                </select>
            </div>

            <script>
                function toggleBoothSizeSelect() {
                    var roleSelect = document.getElementById('role');
                    var boothSizeSelect = document.getElementById('boothSizeSelect');

                    if (roleSelect.value === 'exhibitor') {
                        boothSizeSelect.style.display = 'block';
                    } else {
                        boothSizeSelect.style.display = 'none';
                    }
                }
            </script>

        <script>
            function toggleAgeAndGender() {
                var roleSelect = document.getElementById('role');
                var ageSelect = document.getElementById('age');
                var genderSelect = document.getElementById('gender');
                var ageSelect2 = document.getElementById('age1');
                var genderSelect2 = document.getElementById('gender1');

                // Check if exhibitor is selected
                if (roleSelect.value === 'exhibitor') {
                    // Hide age and gender fields
                    ageSelect.style.display = 'none';
                    genderSelect.style.display = 'none';
                    ageSelect2.style.display = 'none';
                    genderSelect2.style.display = 'none';
                    // Set their values to null
                    ageSelect.value = null;
                    genderSelect.value = null;
                } else {
                    // Show age and gender fields
                    ageSelect.style.display = 'block';
                    genderSelect.style.display = 'block';
                    ageSelect2.style.display = 'block';
                    genderSelect2.style.display = 'block';
                }
            }
        </script>


            <div class="mt-4">
                <x-input-label for="job" :value="__('Job Title')" />
                <x-text-input id="job" class="block mt-1 w-full" type="text" name="job" :value="old('job')" required
                    autofocus autocomplete="job" />
                <x-input-error :messages="$errors->get('job')" class="mt-2" />
            </div>


            <div class="mt-4">
                <x-input-label for="industry"
                    :value="__('Please indicate the primary industry your business operates in')" />
            
                <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" id="industry" required autofocus name="industry">
                    <option value="" disabled selected>Select an industry</option>
                    <optgroup label="Agriculture and Natural Resources">
                        <option value="agriculture">Agriculture</option>
                        <option value="forestry">Forestry</option>
                        <option value="fishing">Fishing</option>
                        <option value="mining">Mining</option>
                    </optgroup>
                    <optgroup label="Automotive and Transportation">
                        <option value="automotive">Automotive</option>
                        <option value="aerospace">Aerospace</option>
                        <option value="logistics">Logistics</option>
                        <option value="shipping">Shipping</option>
                    </optgroup>
                    <optgroup label="Construction and Engineering">
                        <option value="construction">Construction</option>
                        <option value="architecture">Architecture</option>
                        <option value="engineering">Engineering</option>
                        <option value="real_estate">Real Estate</option>
                    </optgroup>
                    <optgroup label="Education and Training">
                        <option value="education">Education</option>
                        <option value="training">Training</option>
                        <option value="e_learning">E-learning</option>
                    </optgroup>
                    <optgroup label="Finance and Banking">
                        <option value="banking">Banking</option>
                        <option value="insurance">Insurance</option>
                        <option value="investment">Investment</option>
                        <option value="accounting">Accounting</option>
                    </optgroup>
                    <optgroup label="Healthcare and Pharmaceuticals">
                        <option value="healthcare">Healthcare</option>
                        <option value="pharmaceuticals">Pharmaceuticals</option>
                        <option value="biotechnology">Biotechnology</option>
                    </optgroup>
                    <optgroup label="Hospitality and Tourism">
                        <option value="hospitality">Hospitality</option>
                        <option value="tourism">Tourism</option>
                        <option value="restaurants">Restaurants</option>
                        <option value="hotels">Hotels</option>
                    </optgroup>
                    <optgroup label="Information Technology">
                        <option value="software">Software</option>
                        <option value="hardware">Hardware</option>
                        <option value="telecommunications">Telecommunications</option>
                        <option value="internet">Internet</option>
                    </optgroup>
                    <optgroup label="Manufacturing and Production">
                        <option value="manufacturing">Manufacturing</option>
                        <option value="textiles">Textiles</option>
                        <option value="electronics">Electronics</option>
                        <option value="chemicals">Chemicals</option>
                    </optgroup>
                    <optgroup label="Media and Entertainment">
                        <option value="media">Media</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="advertising">Advertising</option>
                        <option value="publishing">Publishing</option>
                    </optgroup>
                    <optgroup label="Retail and Consumer Goods">
                        <option value="retail">Retail</option>
                        <option value="wholesale">Wholesale</option>
                        <option value="consumer_goods">Consumer Goods</option>
                    </optgroup>
                    <optgroup label="Other">
                        <option value="other">Other</option>
                    </optgroup>
                </select>
            </div>


            <div class="mt-4">
                <x-input-label for="address" :value="__(' Where do you currently live')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                    required autofocus autocomplete="address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('What is your mobile number')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                    required autofocus autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div id="gender1"  class="mt-4">
                <x-input-label for="gender" :value="__('Gender')" />
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" id="gender" name="gender" autofocus >
                    <option value="" selected disabled>Your Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div id="age1" class="mt-4">
                <x-input-label for="age" :value="__('Age range')" />
                <x-input-error :messages="$errors->get('age')" class="mt-2" />
                <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" id="age" name="age" autofocus >
                    <option value="" selected disabled>Select Age Range</option>
                    <option value="13 - 17 Years">13 - 17 Years</option>
                    <option value="18 - 29 Years">18 - 29 Years</option>
                    <option value="30 - 39 Years">30 - 39 Years</option>
                    <option value="40 - 49 Years">40 - 49 Years</option>
                    <option value="50 - 59 Years">50 - 59 Years</option>
                    <option value="60 and Above">60 and Above</option>
                </select>
            </div>
        </div>

    
        <div id="section2" style="display: none;">

            <div class="mt-4">
                <x-input-label for="referral" :value="__('How did you hear about Ph Tech Expo')" />
                <x-input-error :messages="$errors->get('referral')" class="mt-2" />
                <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" id="referral" name="referral" required autofocus >
                    <option value="website">Website</option>    
                    <option value="social_media">Social Media</option>
                    <option value="press">Press</option>
                    <option value="friend">From a friend</option>
                    <option value="search_engine">Search Engine</option>
                    <option value="event">Event</option>
                    <option value="advertisement">Advertisement</option>
                    <option value="email">Email</option>
                </select>
            </div>

            <div class="mt-4 ">
                <x-input-label for="reasons_attending" :value="__('What are your reasons to attend')" />
                <textarea id="reasons_attending" name="reasons_attending"
                    class="bg-black text-white border-b-2 border-black dark:border-black my-3 focus:border-black dark:focus:border-black focus:ring-black dark:focus:ring-black rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                    required autofocus autocomplete="reasons_attending"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('reasons_attending')" />
            </div>

            <div class="mt-4">
                <x-input-label for="interest" :value="__('What topics, product sectors are you most interested in')" />
                <textarea id="interest" name="interest"
                    class="bg-black text-white border-b-2 border-black dark:border-black my-3 focus:border-black dark:focus:border-black focus:ring-black dark:focus:ring-black rounded-md shadow-sm mt-1 block w-full h-40 resize-y"
                    required autofocus autocomplete="interest"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('interest')" />
            </div>



            <!-- Password -->


            <div class="mt-4 relative">
                <x-input-label for="password" :value="__('Password')" />
                <div class="flex items-center">
                    <x-text-input id="password" class="block pr-10 mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                    <!-- Eye icon for toggling password visibility -->
                    <div class="absolute right-0 pr-3 flex items-center">
                        <button id="togglePassword" type="button"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-xs text-white">The password field must be at least 8 characters</p>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 relative">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <div class="flex items-center">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <!-- Eye icon for toggling password visibility -->
                    <div class="absolute right-0 pr-3 flex items-center">
                        <button id="toggleConPassword" type="button"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
              
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
           
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

            <script>
                const togglePassword = document.getElementById('togglePassword');
                const passwordField = document.getElementById('password');

                togglePassword.addEventListener('click', function () {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                });

            </script>

            <script>
                const toggleConPassword = document.getElementById('toggleConPassword');
                const conPasswordField = document.getElementById('password_confirmation');

                toggleConPassword.addEventListener('click', function () {
                    const type = conPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    conPasswordField.setAttribute('type', type);
                });

            </script>
        </div>

         <!-- Loader element -->
         <div id="loader" class="hidden animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-gray-900"></div>
    </form>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-white dark:text-white hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

    <!-- Next and Prev Buttons -->
    <div id="navigationButtons" style="padding-top:20px; font-weight:900;">
        <button id="prevButton" style="display: none;">Prev</button>
        <button id="nextButton">Next</button>
    </div>

    <script>
        const section1 = document.getElementById('section1');
        const section2 = document.getElementById('section2');
        const nextButton = document.getElementById('nextButton');
        const prevButton = document.getElementById('prevButton');
        const navigationButtons = document.getElementById('navigationButtons');

        nextButton.addEventListener('click', () => {
            section1.style.display = 'none';
            section2.style.display = 'block';
            prevButton.style.display = 'block';
            nextButton.style.display = 'none';
        });

        prevButton.addEventListener('click', () => {
            section1.style.display = 'block';
            section2.style.display = 'none';
            prevButton.style.display = 'none';
            nextButton.style.display = 'block';
        });

    </script>

    <script>
        // Get form, button, and loader elements
        const registerForm = document.getElementById('registrationForm');
        const registerButton = document.getElementById('registerButton');
        const loader = document.getElementById('loader');

        // Add event listener to form submit
        registerForm.addEventListener('submit', function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Show loader and disable button
            loader.classList.remove('hidden');
            registerButton.disabled = true;

            // Submit the form
            this.submit();
        });
    </script>

</x-guest-layout>
