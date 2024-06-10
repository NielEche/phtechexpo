<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl bg-emerald-500 dark:text-green-600 leading-tight MenloRegular ">
                PH TECH EXPO
            </h2>
        </div>
    </x-slot>


    @php( $aboutGallerys = \App\Models\AboutGallerys::orderBy('id', 'asc')->get())
    @php( $aboutUs = \App\Models\AboutUs::orderBy('id', 'asc')->get())

        <div class="container-fluid bg-white mx-auto px-6 lg:px-20 pt-12 pb-0">
            <div class="carousel pt-10">
            <div class="counter2 w-full z-50 MenloRegular font-bolder px-8"></div>
                <div class="carousel-inner2">
                    @foreach($aboutGallerys as $gallery)
                    <div class="carousel-item" data-title="Slide">
                        <img class="rounded-lg " src="public{{ $gallery->path }}" alt="">
                    </div>
                    @endforeach
                   
                </div>
                <button class="prev-btn2">Prev</button>
                <button class="next-btn2">Next</button>
            </div>
        </div>



    <div class="container bg-white mx-auto px-6 lg:px-20 py-2">
        <div class="">
        @foreach($aboutUs as $about)
            <div class=" my-4 py-12">
                <h2 class="MenloRegular py-4 font-bold text-black text-2xl">{{ $about->title }}</h2>
                <div class="MenloRegular text-sm text-black text-left aboutdata">
                    {!! $about->content  !!}
                </div>
            </div>
            <hr>
        @endforeach
        </div>
      
    </div>


    <!--<div class="container-fluid mx-auto px-6 lg:px-20 py-8" style="background-color:#23408f;">
        <div class="py-12 lg:flex justify-between">
            <div class="text-white py-4" style="min-width: 50vw;">
                <h2 class="MenloRegular text-4xl">ABOUT <span class="font-bold">RIVPRO</span><span class="blink"
                        style="color:white;">|</span></h2>
            </div>

            <div class="text-black py-4">
                <div>
                    <img class="w-24"
                        src="https://res.cloudinary.com/iamvocal/image/upload/v1708327637/rivprologo_vcxxpv.png" alt="">
                </div>
            </div>
        </div>
        <div class="lg:flex justify-between">
            <div class="lg:w-1/2 lg:pr-6 py-2">
                <p class="MenloRegular text-base text-white text-left list-disc">
                    The Rivers Professionals Group (RivPro) is a dynamic aggregation
                    of professionals in Rivers State, Nigeria, who have come together
                    with a common goal: to partner with the government in exploring
                    opportunities, pursuing possibilities, and driving development for the
                    benefit of all Rivers people. Through collaboration, capacity building,
                    and active participation in governance, RivPro aims to harness the
                    latent potential of its members and create platforms for talent and
                    resource exploration.
                    At RivPro, we firmly believe that the development of any region depends
                    on the collective efforts of its professionals. By leveraging our diverse
                    backgrounds, skills, and expertise, we strive to expose, activate, and
                    expand the untapped potential within us as a people. Through this
                    process, we aim to contribute significantly to the development and
                    growth of Rivers State.
                    Our primary focus is on human capital development. We understand
                    that investing in our people is the key to sustainable progress.
                    Therefore, RivPro serves as a vehicle for congregating professionals
                    who share a common vision and desire to expand their knowledge,
                    skills, and capabilities. We provide opportunities for capacity building,
                    professional networking, and collaboration, enabling our members to
                    thrive in their respective fields.
                    One of RivPro’s fundamental objectives is to encourage professionals to
                    actively participate in governance and the pursuit of development. We
                    firmly believe that professionals have a critical role to play in shaping
                    policies, driving innovation, and implementing sustainable solutions to
                    societal challenges. By actively engaging with government and other
                    stakeholders, RivPro aims to influence positive change and contribute
                    to the overall development of Rivers State.
                </p>
            </div>
            <div class="lg:w-1/2 lg:pl-6 py-2">
                <p class="MenloRegular text-base text-white text-left list-disc">
                    In line with our mission, RivPro strives to:
                </p>

                <ul class="MenloRegular text-base text-white text-left list-disc">
                    <li> 1. Foster Collaboration: We facilitate collaboration among professionals
                        from various sectors, fostering an environment of knowledge sharing,
                        idea generation, and collective problem-solving.</li>
                    <li> 2. Promote Continuous Learning: We provide opportunities for
                        professional development through workshops, training programs,
                        seminars, and other initiatives that enhance the skills and knowledge
                        of our members.</li>
                    <li>3. Advocate for Effective Governance: We actively engage with
                        government institutions, offering our expertise and insights to shape
                        policies, programs, and initiatives that drive sustainable development
                        in Rivers State.</li>
                    <li>4. Champion Social Responsibility: We encourage our members to
                        give back to society through corporate social responsibility initiatives,
                        volunteering, mentoring, and community development projects.
                        RivPro welcomes professionals from all fields who are passionate about
                        making a positive impact in Rivers State. Together, we can unlock the
                        full potential of our people, drive inclusive development, and create a
                        prosperous future for all.</li>
                </ul>

                <p class="MenloRegular text-base text-white text-left list-disc">
                    To learn more about RivPro and how you can get involved, please
                    visit our website or contact us at [contact information]. Join us on this
                    rewarding journey towards expanding human capital development
                    and driving the progress of Rivers State.
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid mx-auto px-6 lg:px-20 py-8" style="background-color:#40ae49;">
        <div class="py-12 lg:flex justify-between">
            <div class="text-white py-4" style="min-width: 50vw;">
                <h2 class="MenloRegular text-4xl">ABOUT <span class="font-bold">YOUNGPRO</span><span class="blink"
                        style="color:white;">|</span></h2>
            </div>

            <div class="text-black py-4">
                <div>
                    <img class="w-28"
                        src="https://res.cloudinary.com/iamvocal/image/upload/v1708328861/ypro_mp9rrl.png" alt="">
                </div>
            </div>
        </div>
        <div class="">
            <p class="MenloRegular text-base text-white text-left ">
                The Young Professionals Group (YoungPro) is an integral part of the
                Rivers Professionals Group (RivPro) and focuses on mentoring and
                grooming young professionals. The primary objective of YoungPro is
                to create a platform that facilitates the learning and growth of young
                individuals who have shown promise in their respective fields.
                YoungPro follows a “Learn-Gro” model, which emphasizes the
                development of a network comprising young and skilled professionals.
                This network aims to engage, connect, and inspire the future leaders
                by providing them with opportunities to learn and grow in their careers.
                The group strives to foster advancement and success in a relaxed yet
                sophisticated social environment. It aims to nurture young professionals
                while instilling high standards and values. Ultimately, YoungPro aims to
                make a positive contribution to the overall growth and development of
                society.
                By providing mentorship, guidance, and networking opportunities,
                YoungPro aims to support young professionals in their personal and
                professional development. The group recognizes the importance of
                mentorship and believes in the power of connecting experienced
                professionals with aspiring ones to foster growth and success.
                Through various initiatives, events, and programs, YoungPro aims to
                equip young professionals with the skills, knowledge, and resources
                they need to excel in their chosen paths. By providing a supportive
                community and access to valuable resources, YoungPro strives to
                empower young professionals and shape them into future leaders who
                can contribute meaningfully to society.
                Overall, YoungPro is a platform that recognizes the potential of young
                professionals and aims to provide them with the necessary tools and
                support to thrive in their careers while making a positive impact on
                society.
            </p>
        </div>
    </div>-->


        <style>
            .aboutdata p , .aboutdata li {
                font-size:0.875rem;
                line-height: 1.25rem;
                font-family: Menlo;
                text-align:left;
            }

            .caption {
                position: relative;
                bottom: 30%;
                left: 0; 
                text-align:left;
                background-color: rgba(0, 0, 0, 0.4);
                color: white;
                width:50%;
                padding: 10px 30px;
            }

           

            .carousel {
                position: relative;
                overflow: hidden;
                margin: 0 auto;
                width: 100%;
            }

            .carousel-inner2 {
                display: flex;
                transition: transform 0.5s ease;
            }

            .carousel-item {
                flex: 0 0 100%;
                width: 100%;
                height:100vh;
            }

            .carousel-item img {
                height:100vh;
                width:100%;
                object-fit: cover;
            }
            .prev-btn2, .next-btn2 {
                position: absolute;
                top: 60%;
                transform: translateY(-50%);
                padding: 10px;
                cursor: pointer;
                z-index: 1;
                background-color:rgb(16 185 129 / var(--tw-bg-opacity)) ;
            }

            .prev-btn2 {
                left: 0;
            }

                @media (max-width: 620px) {
                
                    .caption {
                        width:100%;
                        bottom: 35%;
                    }
                }

            .next-btn2 {
                right: 0;
            }


          
            .counter2 {
                display:flex;
                justify-content:space-between;
                text-align: center;
                margin-top: 10px;
                margin-bottom:20px;
            }

            .counter-number2 {
                display: inline-block;
                width: 40px;
                height: 40px;
                margin: 0 5px;
                cursor: pointer;
                border-radius: 50%;
                line-height: 20px;
                text-align: center;
                padding: 10px;
                color:black;
            }

            .counter-number2.active {
                background-color:rgb(16 185 129 / var(--tw-bg-opacity)) ;
                color: #000
            }

            .sticky-parent{
            height: 700vh;
            }

            .sticky{
            position: sticky;
            top: 0px;
            max-height: 100vh;
            overflow-x: hidden;
            overflow-y: hidden;
            }
            .dim{
            display: block;
            min-width: 70vw;
            height: 100vh;
            }
            .horizontal{
            display: flex;
            }
            .br{
            outline: solid;
            }

            @media (max-width: 620px) {
            .dim{
                display: block;
                min-width: 100vw;
                height: 100vh;
            }
            }

            p{
            font-size: 10em;
            text-align: center;
            }
            
            
        </style>



</x-app-layout>