@extends('layouts.web')
@push('css')
@endpush
@section('title')
    {{ $type_page == 'create' ? 'إنشاء فئة' : 'تعديل فئة' }}
@endsection
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="col-md-9 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ $type_page == 'create' ? 'إنشاء فئة' : 'تعديل فئة' }}</h4>
                        <div class="card-body ">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a class="btn btn-success add-btn" id="create-btn"
                                                href="{{ route('category.index') }}">العودة</a>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <label for="firstNameinput" class="form-label">القيمة بالعربى</label>
                                                <input type="text" class="form-control" name="value_ar"
                                                    placeholder="القيمة بالعربى"
                                                    value="{{ isset($data->value_ar) ? $data->value_ar : old('value_ar') ?? '' }}"
                                                    id="firstNameinput">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">القيمة بالانجليزى</label>
                                                <input type="text" class="form-control" name="value_en"
                                                    placeholder="القيمة بالانجليزى"
                                                    value="{{ isset($data->value_en) ? $data->value_en : old('value_en') ?? '' }}"
                                                    required id="firstNameinput">
                                            </div>
                                        </div><!--end col-->

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
@endpush
