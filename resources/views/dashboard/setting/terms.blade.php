@extends('layouts.web')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
@endpush
@section('title')
    سياسة الخصوصية
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="col-md-9 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title mb-0">سياسة الخصوصية</h4>
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

                                <form action="{{ route('terms.updateTerms') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="textAreaEn" class="form-label">سياسة الخصوصية</label>
                                                <textarea id="myeditorinstance" class="form-control" name="terms_ar" placeholder="برجاء ادخال سياسة الخصوصصية باللغه العربية"
                                                    id="textAreaEn">{{ $terms->terms_ar ?? '' }}</textarea>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="textAreaEn" class="form-label">Privacy Policy</label>
                                                <textarea id="myeditorinstance" class="form-control" name="terms_en" placeholder="Please Enter Privacy Policy in English"
                                                    id="textAreaEn">{{ $terms->terms_en ?? '' }}</textarea>
                                            </div>
                                        </div><!--end col-->

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
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
@endpush
