@extends('layouts.web')
@section('title')
    {{ $type_page == 'create' ? 'انشاء خدمة' : 'تعديل خدمة' }}
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endpush
@section('content')
    <style>
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__display {
            color: #000;
        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex mx-1 align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> {{ $type_page == 'create' ? 'انشاء خدمة' : 'تعديل خدمة' }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">الفئات</a>
                                </li>
                                <li class="breadcrumb-item active">الخدمات</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-9 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            {{ $type_page == 'create' ? 'انشاء خدمة' : 'تعديل خدمة' }}
                        </h4>
                        <div class="card-body ">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a class="btn btn-success add-btn" id="create-btn"
                                                href=" {{ isset($category->id) == null ? route('service.index', $data->category_id) : route('service.index', $category->id) }}">العودة</a>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">الاسم بالعربى</label>
                                                <input type="text" class="form-control" name="name_ar"
                                                    placeholder="الاسم بالعربى"
                                                    value="{{ isset($data->name_ar) ? $data->name_ar : old('name_ar') ?? '' }}"
                                                    id="firstNameinput">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">الاسم بالانجليزى</label>
                                                <input type="text" class="form-control" name="name_en"
                                                    placeholder="الاسم بالانجليزى"
                                                    value="{{ isset($data->name_en) ? $data->name_en : old('name_en') ?? '' }}"
                                                    required id="firstNameinput">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">السعر</label>
                                                <input type="number" class="form-control" name="price"
                                                    placeholder="السعر"
                                                    value="{{ isset($data->price) ? $data->price : old('price') ?? '' }}"
                                                    id="firstNameinput">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">الخصم</label>
                                                <input type="number" class="form-control" name="discount"
                                                    placeholder="الخصم"
                                                    value="{{ isset($data->discount) ? $data->discount : old('discount') ?? '' }}"
                                                    id="firstNameinput">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="titleEnTextarea" class="form-label">الوصف باللغة العربية</label>
                                                <textarea class="form-control" name="description_ar" placeholder="الوصف باللغة العربية" required id="titleEnTextarea">{{ isset($data->description_ar) ? $data->description_ar : old('description_ar') ?? '' }}</textarea>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="titleEnTextarea" class="form-label">الوصف باللغة
                                                    الانجليزية</label>
                                                <textarea class="form-control" name="description_en" placeholder="الوصف باللغة الانجليزية" required
                                                    id="titleEnTextarea">{{ isset($data->description_en) ? $data->description_en : old('description_en') ?? '' }}</textarea>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address1ControlTextarea" class="form-label">الصورة
                                                    الرئيسية</label>
                                                <input type="file" class="form-control dropify" name="image"
                                                    data-default-file="{{ isset($data->image) ? asset('images/' . $data->image) : '' }}"
                                                    id="address1ControlTextarea">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address1ControlTextarea" class="form-label">إضافة العديد من
                                                    الصور الفرعية</label>
                                                <input multiple type="file" class="form-control dropify" name="multiImages[]"
                                                    value="{{ isset($data->multiImages) ? $data->multiImages : old('multiImages') ?? '' }}"
                                                    id="address1ControlTextarea">
                                            </div>
                                        </div><!--end col-->

                                        @if ($type_page == '')
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">الفئات</h6>
                                                    <select class="js-example-basic-multiple" name="category_id">
                                                        <optgroup label="الفئات">
                                                            @foreach ($category as $val)
                                                                <option
                                                                    value="{{ $val->id }}"{{ $val->id == $data->category_id ? 'selected' : '' }}>
                                                                    {{ $val->name_ar }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>

                                                </div>
                                            </div><!--end col-->
                                        @else
                                            <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}">
                                        @endif
                                        @if ($type_page == '')
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">الحقول</h6>
                                                    <select class="js-example-basic-multiple" multiple name="select[]">
                                                        <optgroup label="اختر حقل">
                                                            @foreach ($fields as $val)
                                                                <option value="{{ $val->id }}"
                                                                    {{ $serviceField->contains('field_id', $val->id) ? 'selected' : '' }}>
                                                                    {{ $val->name }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div><!--end col-->
                                        @else
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">الحقول</h6>
                                                    <select class="js-example-basic-multiple" multiple name="select[]">
                                                        <optgroup label="اختر حقل">
                                                            @foreach ($fields as $val)
                                                                <option value="{{ $val->id }}"
                                                                    {{ collect(old('select'))->contains($val->id) ? 'selected' : '' }}>
                                                                    {{ $val->name }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div><!--end col-->
                                        @endif

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-semibold">النوع</h6>
                                                <select class="js-example-basic-multiple" name="type" id="type">
                                                    <option value="" disabled selected>-- اختر النوع --</option>
                                                    <option value="1"
                                                        {{ $type_page == '' && $data->type == 1 ? 'selected' : '' }}>منتج
                                                    </option>
                                                    <option value="0"
                                                        {{ $type_page == '' && $data->type == 0 ? 'selected' : '' }}>
                                                        استشارة</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3" id="attachment" style="display: none;">
                                                <label for="address1ControlTextarea" class="form-label">ملحقات
                                                    المنتج</label>
                                                <input type="file" class="form-control dropify" name="attachmentUrl"
                                                    id="address1ControlTextarea"
                                                    data-default-file="{{ isset($data->attachmentUrl) ? asset('images/' . $data->attachmentUrl) : '' }}">
                                            </div>
                                        </div><!--end col-->



                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ $type_page == 'create' ? 'انشاء' : 'تعديل' }}</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div>
                        </div><!-- end card -->
                        @if ($type_page == '')
                            <div class="col-md-12">
                                <div class="row">

                                    <h3 class="text-center my-2">صور الخدمة</h3>
                                    
                                    @if ($data->multiImages != 'null')
                                    @foreach (json_decode($data->multiImages) as $image)
                                            <div class="col-md-6 col-lg-3">
                                                <div class="mb-3">
                                                    <img style="width: 200px; height: 200px; border-radius: 10px;"
                                                        src="{{ asset('images/' . $image) }}" alt="">
                                                    <form action="{{ route('deleteImage') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="image"
                                                            value="{{ $image }}">
                                                        <input type="hidden" name="service_id"
                                                            value="{{ $data->id ?? '' }}">
                                                        <button class="btn btn-danger btn-sm mt-1"
                                                            type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                        @endif
                    </div><!--end col-->
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
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

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
    <script>
        $(document).ready(function() {
            var select = $("#type");
            var attachment = $("#attachment");

            function type_fun() {
                if (select.val() === '0') {
                    attachment.hide();
                } else if (select.val() === '1') {
                    attachment.show();
                }
            }

            // Initial call to set the correct display state on page load
            type_fun();

            // Add event listener to call type_fun whenever the select value changes
            select.on('change', type_fun);
        });
    </script>
@endpush
