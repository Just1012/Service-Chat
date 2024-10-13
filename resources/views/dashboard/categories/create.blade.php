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
                                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <label for="titleEnTextarea" class="form-label">الوصف بالعربى</label>
                                                <textarea class="form-control" name="description_ar" placeholder="الوصف بالعربى" required id="titleEnTextarea">{{ isset($data->description_ar) ? $data->description_ar : old('description_ar') ?? '' }}</textarea>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="titleEnTextarea" class="form-label">الوصف بالنجليزى</label>
                                                <textarea class="form-control" name="description_en" placeholder="الوصف بالنجليزى" required id="titleEnTextarea">{{ isset($data->description_en) ? $data->description_en : old('description_en') ?? '' }}</textarea>
                                            </div>
                                        </div><!--end col-->



                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="colorInput" class="form-label"> اللون </label>
                                                    <input type="color" class="form-control" name="color"
                                                           value="{{ isset($data->color) ? $data->color : old('color') ?? '#000000' }}"
                                                           required id="colorInput">
                                                </div>
                                            </div><!--end col-->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="colorInput" class="form-label"> لون الخط </label>
                                                    <input type="color" class="form-control" name="text_color"
                                                           value="{{ isset($data->text_color) ? $data->text_color : old('text_color') ?? '#000000' }}"
                                                           required id="colorInput">
                                                </div>
                                            </div><!--end col-->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label">الصورة</label>
                                                    <input type="file" class="form-control" name="image"
                                                        value="{{ isset($data->image) ? $data->image : old('image') ?? '' }}"
                                                            id="address1ControlTextarea">
                                                    </div>
                                                </div><!--end col-->


                                            @if ($type_page == '')
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <img style="width: 200px; hieght:200px; border-radius: 10px;" src="{{ asset('images/' . $data->image) }}" alt="">
                                                    </div>
                                                </div><!--end col-->
                                            @endif

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
