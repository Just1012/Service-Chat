@extends('layouts.web')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
@endpush
@section('title')
    {{ $type_page == 'create' ? 'إنشاء حقل' : 'تعديل حقل' }}
@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="col-md-9 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ $type_page == 'create' ? 'إنشاء حقل' : 'تعديل حقل' }}</h4>
                        <div class="card-body ">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a class="btn btn-success add-btn" id="create-btn"
                                                href="{{ route('field.index') }}">العودة</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('field.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">الاسم بالعربى</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="الاسم بالعربى"
                                                    value="{{ isset($data->name) ? $data->name : old('name') ?? '' }}"
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
                                                <h6 class="fw-semibold">النوع</h6>
                                                <select class="js-example-basic-multiple" name="type">
                                                    <optgroup label="النوع">
                                                        @foreach ($fieldType as $val)
                                                            <option value="{{ $val->id }}"
                                                                @if ($type_page == '') {{ $val->id == $data->type ? 'selected' : '' }} @endif>
                                                                {{ $val->name }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="fw-semibold">التحقق</h6>
                                                <select class="js-example-basic-multiple" name="type_validation">
                                                    <optgroup label="التحقق">
                                                        <option
                                                            value="0"@if ($type_page == '') {{ $data->type_validation == 0 ? 'selected' : '' }} @endif>
                                                            اختيارى</option>
                                                        <option
                                                            value="1"@if ($type_page == '') {{ $data->type_validation == 1 ? 'selected' : '' }} @endif>
                                                            مطلوب</option>

                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $type_page == 'create' ? 'إنشاء حقل' : 'تعديل حقل' }}</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('web/assets/js/pages/select2.init.js') }}"></script>
@endpush
