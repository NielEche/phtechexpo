<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>



    <div class="container mx-auto">
        <div class="row">
            <div class="">
                   

            <!-- Content to capture -->
                <div id="capture" class="text-center">
                
                    <div class="id-card-tag"></div>
                        <div class="id-card-tag-strip"></div>
                        <div class="id-card-hook"></div>
                        <div class="id-card-holder">
                            <div class="id-card">
                                <div class="header">
                                    <img id="imagePreview" style=" width: 160px; height:160px; object-fit:cover;"  src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713867464/360_F_514184651_W5rVCabKKRH6H3mVb62jYWfuXio8c8si_uqv4hb.jpg" alt="Employee_ID">

                                    <div style="position: absolute; top:45%;" class="left-1/2">
                                        <div class="flex items-center">
                                            <input type="file" id="imageUpload" name="imageUpload" class="sr-only" required>
                                            <label for="imageUpload" class="absolute  w-full h-full flex items-center justify-center cursor-pointer">
                                                <span class=" flex items-center justify-center text-sm font-medium text-gray-700 opacity-50  hover:opacity-75 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                    <img style="max-width:20px;" src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713867876/992651_i8n1kj.png" alt="">
                                                </span>
                                            
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="photo">
                                    <img class="w-36 mt-2" src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713867812/logo_xq2cbs.png" alt="">
                                </div>
                                <x-text-input id="name" name="name" style=" text-transform: uppercase;
                                letter-spacing: 2px;
                                font-weight: 400;
                                text-align: center;
                                font-size: 10px;
                                border:none !important;
                                background:transparent;
                                --tw-ring-color: transparent !important;" type="text" class="focus:ring-transparent block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                               
                                <h3>
                                    @if($user->role === 'user')
                                        Attendee
                                    @else
                                        {{ $user->role }}
                                    @endif
                                </h3>
                                <hr>
                                <p><strong>PHTECHEXPO 2024</strong> Horlikins Events Place <p>
                                <p>Port Harcourt Nigeria <strong>24th-26th April</strong></p>
                                <p>www.phtechexpo.com</p>

                            </div>
                        </div>
                </div>

                 <!-- Btn to trigger action -->
                 <div class="flex justify-center py-6">
                    <a href="#" class="bg-emerald-500 px-4 py-2 rounded" id="btnDownload">Download</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Noto+Sans:400,700');

            #capture{
            margin: 0 auto;
            width: 100%;
            height: 500px;
            }

            textarea{
            width: 100%;
            padding: 2rem .5rem;
            background: transparent;
            border: 0;
            text-align: center;
            color: #fff;
            font-family: 'Noto Sans', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            resize: none;
            overflow: hidden;
            max-height: 100%;
            min-height: 100%;
            }

            body{
            background: #b696d7;
            }

    
        .id-card-holder {
                    width: 225px;
                    padding: 4px;
                    margin: 0 auto;
                    background-color: #1f1f1f;
                    border-radius: 5px;
                    position: relative;
                }

        .id-card {
                    
                    background-color: #fff;
                    padding: 10px;
                    border-radius: 10px;
                    text-align: center;
                    box-shadow: 0 0 1.5px 0px #b9b9b9;
                }
        .id-card img {
                    margin: 0 auto;
                }
        .header img {
                    width: 100px;
                    margin-top: 15px;
                }
        .photo img {
                    width: 120px;
                    margin-top: 15px;
                }
        h2 {
                    font-size: 15px;
                    margin: 5px 0;
                }
        h3 {
                    font-size: 12px;
                    margin: 2.5px 0;
                    font-weight: 300;
                }
        .qr-code img {
                    width: 50px;
                }
        p {
                    font-size: 5px;
                    margin: 2px;
                }
        .id-card-hook {
                    background-color: black;
                    width: 70px;
                    margin: 0 auto;
                    height: 15px;
                    border-radius: 5px 5px 0 0;
                }

        .id-card-tag-strip {
                    width: 45px;
                    height: 40px;
                    background-color: #d9300f;
                    margin: 0 auto;
                    border-radius: 5px;
                    position: relative;
                    top: 9px;
                    z-index: 1;
                    border: 1px solid #a11a00;
                }

        .id-card-tag {
                    width: 0;
                    height: 0;
                    border-left: 100px solid transparent;
                    border-right: 100px solid transparent;
                    border-top: 100px solid #d9300f;
                    margin: -10px auto -30px auto;
            
        }

    </style>

    <script>
        function download(url){
        var a = $("<a style='display:none' id='js-downloder'>")
        .attr("href", url)
        .attr("download", "PHTECHEXPOID.png")
        .appendTo("body");

        a[0].click();

        a.remove();
        }

      function saveCapture(element) {
            html2canvas(element, {
                useCORS: true // Allow loading external images
            }).then(function(canvas) {
                download(canvas.toDataURL("image/png"));
            });
        }

        $('#btnDownload').click(function(){
        var element = document.querySelector("#capture");
        saveCapture(element)
        })
    </script>




    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>



 
</x-app-layout>
