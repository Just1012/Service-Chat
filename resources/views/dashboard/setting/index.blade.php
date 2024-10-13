@extends('layouts.web')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endpush
@section('title')
    معلومات النظام
@endsection
<style>
    .dropify-wrapper .dropify-message p {
        font-size: 16px;
    }

    .dropify-wrapper .dropify-message .dropify-error {
        font-size: 16px;
    }

    .dropify-wrapper .dropify-clear,
    .dropify-wrapper .dropify-preview .dropify-render .dropify-infos .dropify-infos-inner .dropify-filename,
    .dropify-wrapper .dropify-preview .dropify-render .dropify-infos .dropify-infos-inner .dropify-infos-message {
        font-size: 16px;
    }

    textarea {
        height: 150px;
    }

    img {
        max-width: 200px;
    }
</style>
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="col-md-9 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title mb-0"> معلومات النظام</h4>
                        <div class="card-body ">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a class="btn btn-success add-btn" id="create-btn"
                                                href="{{ route('home') }}">Back</a>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('setting.updateAllSystemInfo') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="slug_ar" class="form-label">الشعار</label>
                                                <input type="text" class="form-control" name="slug_ar"
                                                    value="{{ $systemInfo->slug_ar ?? '' }}" placeholder="" id="slug_ar"
                                                    required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="slug_ar" class="form-label">Slug</label>
                                                <input type="text" class="form-control" name="slug_en"
                                                    value="{{ $systemInfo->slug_en ?? '' }}" placeholder="" id="slug_en"
                                                    required>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="phone1" class="form-label">رقم الهاتف</label>
                                                <input type="number" class="form-control" name="phone1"
                                                    value="{{ $systemInfo->phone1 ?? '' }}"
                                                    placeholder="Phone No: +966557052333" id="phone1" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="phone2" class="form-label">رقم الهاتف</label>
                                                <input type="number" class="form-control" name="phone2"
                                                    value="{{ $systemInfo->phone2 ?? '' }}"
                                                    placeholder="Phone No: +966557052333" id="phone2" required>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="whatsapp" class="form-label">رقم الواتساب</label>
                                                <input type="number" class="form-control" name="whatsapp"
                                                    value="{{ $systemInfo->whatsapp ?? '' }}"
                                                    placeholder="Phone No: +966557052333" id="whatsapp" required>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="titleEnTextarea" class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email"
                                                    value="{{ $systemInfo->email ?? '' }}" placeholder="Email"
                                                    id="titleEnTextarea" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="titleEnTextarea" class="form-label">Facebook</label>
                                                <input type="text" class="form-control" name="facebook"
                                                    value="{{ $systemInfo->facebook ?? '' }}" placeholder="Facebook"
                                                    id="titleEnTextarea" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="titleEnTextarea" class="form-label">Instagram</label>
                                                <input type="text" class="form-control" name="instagram"
                                                    value="{{ $systemInfo->instagram ?? '' }}" placeholder="Instagram"
                                                    id="titleEnTextarea" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="video_link" class="form-label">Youtube Video Link</label>
                                                <input type="text" class="form-control" name="video_link"
                                                    value="{{ $systemInfo->video_link ?? '' }}" placeholder=""
                                                    id="video_link" required>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="imageInput" class="form-label">PDF</label>
                                                <input type="file"
                                                    data-default-file="{{ $systemInfo ? asset('images/' . $systemInfo->pdf) : '' }}"
                                                    class="form-control dropify" data-height="100" id="imageInput"
                                                    accept="application/pdf" name="pdf">
                                            </div>
                                            <small style="color: red;">
                                                Please upload a PDF file. The maximum file size is 10 MB
                                            </small>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div><!--end col-->
                                    </div>
                                </form>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('web/assets/js/pages/select2.init.js') }}"></script>
    <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happened.'
            }
        });
    </script>
@endpush
