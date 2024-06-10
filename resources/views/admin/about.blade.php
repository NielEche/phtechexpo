<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight NHaasGroteskDSPro-65Md">
            Admin About
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
                About Header</h3>
        </div>
        <hr class="  border-black dark:border-black">
        <div class="flex items-center px-6 py-6">
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addSlider')" id="add-slider-button"
                class="ml-auto text-xl py-4 underline DINAlternateBold  p-6  text-black">
                Add Image
            </button>
        </div>
        <div class=" flex flex-wrap">
            @foreach($aboutGallerys as $gallery)
                <div class="flex lg:w-1/3 w-1/2 flex-wrap">
                    <div class="w-full relative gallerSec">
                        <div
                            class="absolute galleryOverlay inset-0 bg-black opacity-40 transition-opacity duration-300">
                        </div> <!-- Black overlay -->
                        <img alt="gallery image" class="block h-80 w-full object-cover object-center"
                            src="public{{ $gallery->path }}" />
                        <div class="absolute inset-0 flex justify-center items-center text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                            style="font-weight:800; background-color: rgba(0, 0, 0, 0.8);">
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'G{{ $gallery->id }}')"
                                class="text-xl py-4 underline DINAlternateBold border p-6 rounded-full bg-white text-black">EDIT</button>
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'deleteG{{ $gallery->id }}')"
                                class="text-xl py-4 underline DINAlternateBold mx-2 p-6 rounded-full bg-white text-black">Delete</button>

                        </div>
                    </div>
                </div>
                <x-modal name="G{{ $gallery->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('about_gallerys.update', $gallery->id) }}"
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
                            <p class="orpheusproMedium" for="path" :value="__('path')">Image</p>
                            <input type="file" name="path" id="path" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('path')" />
                        </div>

                        <div class="mt-6 ">
                            <p class="orpheusproMedium" for="caption" :value="__('Caption')">Caption</p>
                            <x-text-input id="caption" name="caption" type="text" class="mt-1 block w-full"
                                :value="old('caption', $gallery->caption)" required autofocus autocomplete="caption" />
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

                <x-modal name="deleteG{{ $gallery->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('aboutGalleryDelete.destroy', $gallery->id) }}"
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
    <hr>   



    <div class="container-fluid mx-auto pt-6  bg-SelectColor">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0 relative z-10">
            <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                About Section</h3>
        </div>
        <hr class="  border-black dark:border-black">
        <div class="flex items-center px-6 py-6">
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addPara')" id="add-slider-button"
                class="ml-auto text-xl py-4 underline DINAlternateBold  p-6  text-black">
                Add Paragraph
            </button>
        </div>
        <div class=" flex flex-wrap">
            @foreach($aboutUs as $about)
                <div class="flex lg:w-1/3 w-1/2 flex-wrap">
                    <div class="lg:px-24 p-0 py-2 relative relative">
                      
                        <h4 class="font-bold text-2xl">{{ $about->title }}</h4>
                        <!--<p class="text-base text-black">{!! $about->content !!}</p>-->
                        <div class=" inset-0 flex justify-start items-end text-white">
                            <a href="{{ route('about.edit', $about->id) }}" 
                                class="text-base py-4 underline  text-black">EDIT</a>
                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete{{ $about->id }}')"
                                class="text-base py-4 underline  mx-2 p-6 rounded-full bg-SelectRed text-black">Delete</button>
                        </div>
                      
                    </div>
                </div> 
                <x-modal name="delete{{ $about->id }}" focusable>
                    <!-- Modal Content -->
                    <form method="post"
                        action="{{ route('aboutParagraphDelete.destroy', $about->id) }}"
                        class="p-6 bg-emerald-500">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                            {{ __('Delete paragraph') }} 
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
        <x-modal name="addSlider" focusable>
            <!-- Modal Content -->
            <form method="post" action="{{ route('AboutGalleryImage.store') }}" class="p-6 bg-emerald-500"
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
                    <p class="orpheusproMedium" for="caption" :value="__('Caption')">Caption</p>
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


    <x-modal name="addPara" focusable>
        <!-- Modal Content -->
        <form method="post" action="{{ route('AboutParagraph.store') }}" class="p-6 bg-emerald-500"
            enctype="multipart/form-data">
            @csrf


            <h2 class="text-lg text-black dark:text-black">
                {{ __('Add a new paragraph ') }}
            </h2>

            <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                {{ __('Please add details of paragraph') }}
            </p>


            <div class="mt-6 ">
                <p class="orpheusproMedium" for="title" :value="__('Name')">Title</p>
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus
                    autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <style>
                .ck-editor__editable[role="textbox"] {
                    /* editing area */
                    min-height: 200px;
                }

                .ck-content .image {
                    /* block images */
                    max-width: 80%;
                    margin: 20px auto;
                }

            </style>

            <div class="mt-6" id="container">
                <p class="orpheusproMedium" for="content" :value="__('content')">Content</p>

                <textarea name="content" class="editor" id="editor"></textarea>
            </div>
            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>

            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            // Update the hidden textarea with CKEditor data
                            document.querySelector('textarea[name="editorData"]').value = editor.getData();
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });

            </script>
            <script>
                // This sample still does not showcase all CKEditor&nbsp;5 features (!)
                // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
                CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                    toolbar: {
                        items: [
                            'exportPDF', 'exportWord', '|',
                            'findAndReplace', 'selectAll', '|',
                            'heading', '|',
                            'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                            'superscript', 'removeFormat', '|',
                            'bulletedList', 'numberedList', 'todoList', '|',
                            'outdent', 'indent', '|',
                            'undo', 'redo',
                            '-',
                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                            'alignment', '|',
                            'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                            'htmlEmbed', '|',
                            'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                            'textPartLanguage', '|',
                            'sourceEditing'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    // Changing the language of the interface requires loading the language file using the <script> tag.
                    // language: 'es',
                    list: {
                        properties: {
                            styles: true,
                            startIndex: true,
                            reversed: true
                        }
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading1',
                                view: 'h1',
                                title: 'Heading 1',
                                class: 'ck-heading_heading1'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Heading 2',
                                class: 'ck-heading_heading2'
                            },
                            {
                                model: 'heading3',
                                view: 'h3',
                                title: 'Heading 3',
                                class: 'ck-heading_heading3'
                            },
                            {
                                model: 'heading4',
                                view: 'h4',
                                title: 'Heading 4',
                                class: 'ck-heading_heading4'
                            },
                            {
                                model: 'heading5',
                                view: 'h5',
                                title: 'Heading 5',
                                class: 'ck-heading_heading5'
                            },
                            {
                                model: 'heading6',
                                view: 'h6',
                                title: 'Heading 6',
                                class: 'ck-heading_heading6'
                            }
                        ]
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                    placeholder: 'add content here',
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                    fontFamily: {
                        options: [
                            'BaskervilleBT',
                            'Arial, Helvetica, sans-serif',
                            'Courier New, Courier, monospace',
                            'Georgia, serif',
                            'Lucida Sans Unicode, Lucida Grande, sans-serif',
                            'Tahoma, Geneva, sans-serif',
                            'Times New Roman, Times, serif',
                            'Trebuchet MS, Helvetica, sans-serif',
                            'Verdana, Geneva, sans-serif'
                        ],
                        supportAllValues: true
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                    fontSize: {
                        options: [10, 12, 14, 'BaskervilleBT', 18, 20, 22],
                        supportAllValues: true
                    },
                    // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                    htmlSupport: {
                        allow: [{
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }]
                    },
                    // Be careful with enabling previews
                    // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                    htmlEmbed: {
                        showPreviews: true
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                    link: {
                        decorators: {
                            addTargetToExternalLinks: true,
                            defaultProtocol: 'https://',
                            toggleDownloadable: {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'file'
                                }
                            }
                        }
                    },
                    // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                    mention: {
                        feeds: [{
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                                '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                                '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                                '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }]
                    },
                    // The "super-build" contains more premium features that require additional configuration, disable them below.
                    // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                    removePlugins: [
                        // These two are commercial, but you can try them out without registering to a trial.
                        // 'ExportPdf',
                        // 'ExportWord',
                        'CKBox',
                        'CKFinder',
                        'EasyImage',
                        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                        // Storing images as Base64 is usually a very bad idea.
                        // Replace it on production website with other solutions:
                        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                        // 'Base64UploadAdapter',
                        'RealTimeCollaborativeComments',
                        'RealTimeCollaborativeTrackChanges',
                        'RealTimeCollaborativeRevisionHistory',
                        'PresenceList',
                        'Comments',
                        'TrackChanges',
                        'TrackChangesData',
                        'RevisionHistory',
                        'Pagination',
                        'WProofreader',
                        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                        // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                        'MathType',
                        // The following features are part of the Productivity Pack and require additional license.
                        'SlashCommand',
                        'Template',
                        'DocumentOutline',
                        'FormatPainter',
                        'TableOfContents',
                        'PasteFromOfficeEnhanced'
                    ]
                });

            </script>

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