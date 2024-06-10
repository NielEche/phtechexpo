<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight NHaasGroteskDSPro-65Md">
            Admin Feature
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
            <a class=" m-4 NHaasGroteskDSPro-65Md border-b border-black"
                href="{{ route('admin.about') }}">BACK TO ABOUT</a>

            <div class="p-4 sm:p-8 bg-SelectColor">
                <section>
                   

                    <div class="h-full w-full flex justify-between flex-col sm:flex-row">
                        <form method="post"
                            action="{{ route('about_paragraph.update', $about->id) }}"
                            class="p-6 bg-emerald-500" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <h2 class="text-lg NHaasGroteskDSPro-65Md text-black dark:text-black">
                                {{ __('Edit About Section') }}
                            </h2>

                            <p class="mt-1 HalyardDisplay text-sm text-black dark:text-black">
                                {{ __('Edit the details for this section below') }}
                            </p>


                            <div class="mt-6 ">
                                <p class="orpheusproMedium" for="title" :value="__('title')">Title</p>
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    :value="old('title', $about->title)" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div class="mt-6" id="container">
                                <p class="orpheusproMedium" for="credit" :value="__('credit')">Content</p>

                                <textarea name="content"
                                    class="editor alyardDisplay border-b-2 border-black dark:border-black my-3 focus:border-white dark:focus:border-white focus:ring-white dark:focus:ring-white rounded-md shadow-sm mt-1 block w-full resize-y"
                                    id="editor">{{ $about->content }}</textarea>
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

                            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>

                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#editor'))
                                    .then(editor => {
                                        editor.model.document.on('change:data', () => {
                                            // Update the hidden textarea with CKEditor data
                                            document.querySelector('textarea[name="editorData"]').value =
                                                editor.getData();
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
                                            'bold', 'italic', 'strikethrough', 'underline', 'code',
                                            'subscript',
                                            'superscript', 'removeFormat', '|',
                                            'bulletedList', 'numberedList', 'todoList', '|',
                                            'outdent', 'indent', '|',
                                            'undo', 'redo',
                                            '-',
                                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                                            'highlight', '|',
                                            'alignment', '|',
                                            'link', 'insertImage', 'blockQuote', 'insertTable',
                                            'mediaEmbed', 'codeBlock',
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
                                                '@apple', '@bears', '@brownie', '@cake', '@cake',
                                                '@candy',
                                                '@canes', '@chocolate', '@cookie', '@cotton',
                                                '@cream',
                                                '@cupcake', '@danish', '@donut', '@dragée',
                                                '@fruitcake',
                                                '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                                '@liquorice', '@macaroon', '@marzipan', '@oat',
                                                '@pie', '@plum',
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

                    </div>


                </section>
            </div>
        </div>
    </div>




    <hr class="  border-black dark:border-black">


</x-admin-layout>
