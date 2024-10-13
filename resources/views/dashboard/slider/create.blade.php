@extends('layouts.web')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endpush
@section('title')
    {{ $type_page == 'create' ? 'إنشاء إعلان' : 'تعديل إعلان' }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="col-md-9 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ $type_page == 'create' ? 'إنشاء إعلان' : 'تعديل إعلان' }}</h4>
                        <div class="card-body ">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a class="btn btn-success add-btn" id="create-btn"
                                                href="{{ route('slider.index') }}">العودة</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address1ControlTextarea" class="form-label">الصورة</label>
                                                <input type="file" class="dropify" data-height="100" name="image"
                                                    id="address1ControlTextarea"  @if($type_page == '') data-default-file="{{ asset('images/'.$data->image)}}" @endif>

                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-semibold">النوع</h6>
                                                <select class="js-example-basic-multiple" id="type_id" name="type"
                                                    onchange="type_fun()">
                                                    <optgroup label="النوع">
                                                        <option value="">
                                                            اختر</option>
                                                        <option value="0"
                                                            @if ($type_page == '') {{ $data->type == 0 ? 'selected' : '' }} @else {{ old('type') == 0 ? 'selected' : '' }} @endif>
                                                            لا يوجد</option>
                                                        <option value="1"
                                                            @if ($type_page == '') {{ $data->type == 1 ? 'selected' : '' }}@else {{ old('type') == 1 ? 'selected' : '' }} @endif>
                                                            فئه</option>
                                                        <option value="2"
                                                            @if ($type_page == '') {{ $data->type == 2 ? 'selected' : '' }} @else {{ old('type') == 2 ? 'selected' : '' }} @endif>
                                                            خدمة</option>
                                                        <option value="3"
                                                            @if ($type_page == '') {{ $data->type == 3 ? 'selected' : '' }} @else {{ old('type') == 3 ? 'selected' : '' }} @endif>
                                                            رابط</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6" style="display: none" id="services">
                                            <div class="mb-3">
                                                <h6 class="fw-semibold">services</h6>
                                                <select class="js-example-basic-multiple" required name="type_services">
                                                    <optgroup label="SubCategories select">
                                                        <option value="">Select services</option>
                                                        @foreach ($uniqueCategories as $item)
                                                            <option value="" disabled>{{ $item->category->name_ar }}
                                                            </option>
                                                            @foreach ($service as $subitem)
                                                                @if ($subitem->category_id === $item->category_id)
                                                                    <option value="{{ $subitem->id }}"
                                                                        @if ($type_page == '') {{ $data->type_id == $subitem->id ? 'selected' : '' }} @else {{ $subitem->id == old('type_services') ? 'selected' : '' }} @endif>
                                                                        &nbsp;&nbsp;&nbsp;{{ $subitem->name_ar }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div><!--end col-->


                                        <div class="col-md-6" id="category" style="display: none">
                                            <div class="mb-3">
                                                <h6 class="fw-semibold">category</h6>
                                                <select class="js-example-basic-multiple" required name="type_category">
                                                    <optgroup label="SubCategories select">
                                                        <option value="">Select category</option>
                                                        @foreach ($category as $subitem)
                                                            <option value="{{ $subitem->id }}"
                                                                @if ($type_page == '') {{ $data->type_id == $subitem->id ? 'selected' : '' }} @else {{ $subitem->id == old('type_category') ? 'selected' : '' }} @endif>
                                                                {{ $subitem->name_ar }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6" id="text" style="display: none">
                                            <div class="mb-3">
                                                <input type="text" placeholder="ادخل الرابط" name="type_text"
                                                    value="{{ isset($data->type_id) ? $data->type_id : old('type_text') ?? '' }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $type_page == 'create' ? 'إنشاء فئة' : 'تعديل فئة' }}</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
         $('.dropify').dropify();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('web/assets/js/pages/select2.init.js') }}"></script>
    <script async>
        function type_fun() {
            var select = document.getElementById("type_id");
            var services = document.getElementById("services");
            var category = document.getElementById("category");
            var text = document.getElementById("text");
            if (select.value === '1') {
                services.style.display = "none";
                category.style.display = "block";
                text.style.display = "none";
            } else if (select.value === '2') {
                services.style.display = "block";
                category.style.display = "none";
                text.style.display = "none";

            } else if (select.value === '3') {
                services.style.display = "none";
                category.style.display = "none";
                text.style.display = "block";

            } else {
                services.style.display = "none";
                category.style.display = "none";
                text.style.display = "none";
            }
        }
    </script>
    @if ($errors->any() || isset($data))
        <!-- Display validation errors here -->
        <script async>
            // Your JavaScript code for handling errors
            // This script will be included only if there are validation errors
            document.addEventListener("DOMContentLoaded", function() {
                // Your script logic here
                type_fun();

            });
        </script>
    @endif
@endpush
