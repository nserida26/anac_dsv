@extends('layouts.master')
@push('plugin-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/file-uploaders/dropzone.min.css">
@push('custom-styles')
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-file-uploader.css">
@endpush
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">File Uploader</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                    </li>
                                    <li class="breadcrumb-item active">File Uploader
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Dropzone section start -->
                <section id="dropzone-examples">
                    <!-- warnings and primary alerts starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-primary" role="alert">
                                <div class="alert-body">
                                    <strong>Info:</strong> Please check the
                                    <a href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-extensions.html#file-uploader" target="_blank" class="text-primary">DropzoneJS documentation</a>
                                    for more details and usage.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- warnings and primary alerts ends -->

                    <!-- single file upload starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Single File Upload</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        By default, dropzone is a multiple file uploader and does not have specific option allowing us to switch to
                                        single file uploading mode, but this functionality can be achieved by adding more options to the plugin
                                        settings, such as
                                        <code>maxfilesexceeded</code> callback and <code>maxFiles</code> option set to 1.
                                        <code>maxFiles: 1</code> is used to tell dropzone that there should be only one file.
                                    </p>
                                    <form action="#" class="dropzone dropzone-area" id="dpz-single-file">
                                        <div class="dz-message">Drop files here or click to upload.</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single file upload ends -->

                    <!-- multi file upload starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Multiple Files Upload</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        By default, dropzone is a multiple file uploader. User can either click on the dropzone area and select
                                        multiple files or just drop all selected files in the dropzone area. This example is the most basic setup
                                        for dropzone.
                                    </p>
                                    <form action="#" class="dropzone dropzone-area" id="dpz-multiple-files">
                                        <div class="dz-message">Drop files here or click to upload.</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- multi file upload ends -->

                    <!-- button file upload starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Use Button To Select Files</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        Using this method, user gets an option to select the files using a button instead dropping all the files
                                        after selected from the folders. Set <code>clickable</code> to match the button's id for button to work as
                                        file selector.
                                    </p>
                                    <button id="select-files" class="btn btn-outline-primary mb-1">
                                        <i data-feather="file"></i> Click me to select files
                                    </button>
                                    <form action="#" class="dropzone dropzone-area" id="dpz-btn-select-files">
                                        <div class="dz-message">Drop files here or click button to upload.</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- button file upload ends -->

                    <!-- limit file upload starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Limit File Size & No. Of Files</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        In many case user must be limited to upload certain no. of files. You can always set the
                                        <code>maxFiles</code> option to limit no. of upload files. <code>maxfilesexceeded</code> event will be
                                        called if uploads exceeds the limit. Also, if you want to limit the file size of uploads then set the
                                        <code>maxFilesize</code> option. Define the maximum file size to be uploded in MBs like <code>0.5</code> MB
                                        as is in this example. User can also define <code>maxThumbnailFilesize</code> in MB. When the uploaded file
                                        exceeds this limit, the thumbnail will not be generated.
                                    </p>
                                    <form action="#" class="dropzone dropzone-area" id="dpz-file-limits">
                                        <div class="dz-message">Drop files here or click to upload.</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- limit file upload ends -->

                    <!-- accepted file upload starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Accepted files</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        The default implementation of <code>accept</code> checks the file's mime type or extension against this
                                        list. This is a comma separated list of mime types or file extensions. Eg.:
                                        <code>image/*,application/pdf,.psd</code>. If the Dropzone is <code>clickable</code> this option will be
                                        used as <code>accept</code> parameter on the hidden file input as well.
                                    </p>
                                    <form action="#" class="dropzone dropzone-area" id="dpz-accept-files">
                                        <div class="dz-message">Drop files here or click to upload.</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- accepted file upload ends -->

                    <!-- remove thumbnail file upload starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Remove Thumbnail</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        This example allows user to remove any file out of all uploaded files. This will add a link to every file
                                        preview to remove or cancel (if already uploading) the file. The <code>dictCancelUpload</code>,
                                        <code>dictCancelUploadConfirmation</code> and <code>dictRemoveFile</code> options are used for the wording.
                                    </p>
                                    <form action="#" class="dropzone dropzone-area" id="dpz-remove-thumb">
                                        <div class="dz-message">Drop files here or click to upload.</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- remove thumbnail file upload ends -->

                    <!-- remove all thumbnails file upload starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Remove All Thumbnails</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        This example allows user to create a button that will remove all files from a dropzone. Hear for the
                                        button's click event and then call <code>removeAllFiles</code> method to remove all the files from the
                                        dropzone.
                                    </p>
                                    <button id="clear-dropzone" class="btn btn-outline-primary mb-1">
                                        <i data-feather="trash" class="me-25"></i>
                                        <span class="align-middle">Clear Dropzone</span>
                                    </button>
                                    <form action="#" class="dropzone dropzone-area" id="dpz-remove-all-thumb">
                                        <div class="dz-message">Drop files here or click to upload.</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- remove all thumbnails file upload ends -->
                </section>
                <!-- Dropzone section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@push('plugin-js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
@endpush
@push('custom-js')
    <!-- BEGIN: Page JS-->
    <script src="/app-assets/js/scripts/forms/form-file-uploader.js"></script>
@endpush