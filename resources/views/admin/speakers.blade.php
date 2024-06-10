<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight NHaasGroteskDSPro-65Md">
            Admin Issue
        </h2>
    </x-slot>



        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
            .post_list_ul {
                margin: 0px;
                padding: 5px;
            }

            .post_list_ul li {
                list-style: none;
                padding: 5px 10px 5px 30px;
                background: #fff;
                box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.3);
                margin-bottom: 10px;
                cursor: move;
                position: relative;
                font-size: 16px;
            }


            .post_list_ul li .pos_num {
                display: inline-block;
                padding: 2px 5px;
                /* width: 30px; */
                height: 20px;
                line-height: 17px;
                background: rgb(6, 160, 65);
                color: #fff;
                text-align: center;
                border-radius: 5px;
                position: absolute;
                left: -5px;
                top: 6px;
            }

            .post_list_ul li:hover {
                list-style: none;
                background: #7a49eb;
                color: #fff;
            }

            .post_list_ul li.ui-state-highlight {
                padding: 20px;
                background-color: #eaecec;
                border: 1px dotted #ccc;
                cursor: move;
                margin-top: 12px;
            }

            .post_list_ul .btn_move {
                display: inline-block;
                cursor: move;
                background: #ededed;
                border-radius: 2px;
                width: 30px;
                height: 30px;
                text-align: center;
                line-height: 30px;
            }
        </style>

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

            <div class="p-4 sm:p-8 bg-SelectColor">
                    <section>
                        <div class="h-full w-full ">
                            @if($speakers->isEmpty())
                                <div class="lg:w-1/2 lg:px-4 w-full h-full flex items-center justify-center  bg-SelectColor">
                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addSpeaker')" id="add-issue-button"
                                        class="fixed mt-16 top-4 right-4 bg-black  underline text-white px-4 py-2 rounded">
                                        Add Speaker
                                    </button>
                                    <div class="text-center text-black lg:px-32 p-10 relative z-10">
                                        <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">
                                           Theres No speaker for this event yet </h3>
                                    </div>
                                </div>
                            @else
                            <div class="lg:px-10 container-fluid ">
                                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'addSpeaker')" id="add-issue-button"
                                    class="fixed mt-16 top-4 right-4 bg-black  underline text-white px-4 py-2 rounded">
                                    Add Speaker
                                </button>
                             
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <ul id="post_sortable" class="post_list_ul">
                                                    @foreach ($speakers as $speakers)
                                                           
                                                        <li class="ui-state-default" data-id="{{ $speakers->id }}">
                                                            @if($speakers->keynote == 1)
                                                            <h2 class="MenloRegular text-sm">Keynote<span class="text-black"> Address</span><span class="blink" style="color:black;">|</span></h2>
                                                            @endif
                                                            <span class="pos_num">{{ $loop->index + 1 }}</span>
                                                            <span><img alt="speaker" class="block w-16 h-full object-cover object-center" src="/public{{ $speakers->path }}" /></span>
                                                            <span>{{ $speakers->name }}</span>
                                                            <span>
                                                                <div class="absolute inset-0 flex justify-center items-center text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                                                                style="font-weight:800; background-color: rgba(0, 0, 0, 0.2);">
                                                                    <a href="{{ route('speaker.edit', $speakers->id) }}" class="text-sm py-2 underline DINAlternateBold  p-4 rounded-full bg-white text-black">EDIT</a>
                                                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete{{ $speakers->id }}')"
                                                                        class="text-sm py-2 underline DINAlternateBold  p-4 rounded-full bg-white text-black">Delete</button>
                                                                </div> 
                                                            </span>
                                                        </li>
                                                

                                                        <x-modal name="delete{{ $speakers->id }}" focusable>
                                                            <!-- Modal Content -->
                                                            <form method="post" action="{{ route('speakersDelete.destroy', $speakers->id) }} " class="p-6 bg-emerald-500">
                                                                @csrf
                                                                @method('delete')

                                                                <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                                                                    {{ __('Delete speakers') }} 
                                                                </h2>

                                                                <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                                                                    {{ __('Are you sure you want to delete speakers') }}
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
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        
                    </section>
            </div>
        </div>
    </div>


        <!-- MODALS MODALS MODALS MODALS -->
        <x-modal name="addSpeaker" focusable>
            <!-- Modal Content -->
            <form method="post" action="{{ route('speakers.store') }}" class="p-6 bg-emerald-500"
                enctype="multipart/form-data">
                @csrf

                <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                    {{ __('Add a new Speaker ') }}
                </h2>


                <div class="mt-6 hidden">
                    <p class="orpheusproMedium" for="event_id" :value="__('event_id')">Id</p>
                    <x-text-input id="event_id"  name="event_id" type="text" class="mt-1 block w-full" required autofocus
                        autocomplete="event_id"  value="{{ $events->id }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('path')" />
                </div>

                <div class="mt-6">
                    <p class="orpheusproMedium" for="path" :value="__('path')">Image</p>
                    <input type="file" name="path" id="path" class="mt-1 block w-full" required/>
                    <x-input-error class="mt-2" :messages="$errors->get('path')" />
                </div>

                <div class="mt-6 ">
                    <p class="orpheusproMedium" for="name" :value="__('Name')">Name</p>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  autofocus
                        autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mt-6 ">
                    <p class="orpheusproMedium" for="profession" :value="__('profession')">Profession</p>
                    <x-text-input id="profession" name="profession" type="text" class="mt-1 block w-full"  autofocus
                        autocomplete="profession" />
                    <x-input-error class="mt-2" :messages="$errors->get('profession')" />
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
                 <p class="orpheusproMedium" for="bio" :value="__('bio')">Bio</p>
                <textarea name="bio" class="editor" id="editor"></textarea>
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

                <div class="mt-6 form-check">
                    <input type="checkbox" class="form-check-input" id="keynoteCheckbox" name="keynote">
                    <label class="form-check-label" for="keynoteCheckbox">Keynote ?</label>
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


    <script>
        $(document).ready(function() {
            $("#post_sortable").sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    //var data = $(this).sortable('toArray');

                    var post_order_ids = new Array();
                    $('#post_sortable li').each(function() {
                        post_order_ids.push($(this).data("id"));
                    });

                    console.log(post_order_ids);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('post.order_change') }}",
                        dataType: "json",
                        data: {
                            order: post_order_ids,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            $('#post_sortable li').each(function(index) {
                                $(this).find('.pos_num').text(index + 1);

                                //console.log(index);
                            });

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</x-admin-layout>
