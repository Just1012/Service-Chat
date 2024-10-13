@extends('layouts.web')
@section('title')
    {{ $type_page == 'create' ? 'انشاء اختيار' : 'تعديل اختيار' }}
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
@endpush
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex mx-1 align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> {{ $type_page == 'create' ? 'انشاء اختيار' : 'تعديل اختيار' }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('field.index') }}">الفئات</a>
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
                            {{ $type_page == 'create' ? 'انشاء اختيار' : 'تعديل اختيار' }}
                        </h4>
                        <div class="card-body ">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a class="btn btn-success add-btn" id="create-btn" href="">العودة</a>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('fieldOption.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">الاختيار بالعربى</label>
                                                <input type="text" class="form-control" name="option"
                                                    placeholder="الاختيار بالعربى"
                                                    value="{{ isset($data->option) ? $data->option : old('option') ?? '' }}"
                                                    id="firstNameinput">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">الاختيار بالانجليزى</label>
                                                <input type="text" class="form-control" name="option_en"
                                                    placeholder="الاختيار بالانجليزى"
                                                    value="{{ isset($data->option_en) ? $data->option_en : old('option_en') ?? '' }}"
                                                    required id="firstNameinput">
                                            </div>
                                        </div><!--end col-->
                                        <input type="hidden" name="field_id" value="{{$field->id ?? '' }}">
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
