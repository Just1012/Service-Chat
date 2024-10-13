@extends('layouts.web')
@push('css')
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Bootstrap Css -->
@endpush
@section('title')
    قائمة الفئات
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                
                                <h5 class="card-title mb-0 col-sm-8 col-md-10">{{$data['name_ar']}} </h5>
                                
                                <!-- Load More Buttons -->
                                <div class="hstack flex-wrap gap-2   mb-lg-0 mb-0 col-sm-2 col-md-1">
                                    <a class="btn btn-success add-btn" id="create-btn"
                                        href="{{ route('order.index') }}">العودة</a>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" style="overflow:auto">
                            <table id="alternative-pagination"
                                class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                style="width:100%;overflow: scroll">
                                <thead>
                                    <tr class="text-center">
                                        <th>#SSL</th>
                                        <th>اسم الحقل عربي</th>
                                        <th>اسم الحقل انجليزى</th>
                                        <th colspan="3">القيمة</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    
                                    @foreach ($data['service_fields'] as $key => $serviceField)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $serviceField->field->name }}</td>
                                            <td>{{ $serviceField->field->name_en }}</td>
                                            @if ($serviceField->field->type == 5 && isset($serviceField->field->value))
                                                <td style="max-width: 300px; overflow-x: auto;" colspan="3">
                                                    <a target="_blank"
                                                        href="https://maps.google.com?q={{ json_decode($serviceField->field->value)[0] }},{{ json_decode($serviceField->field->value)[1] }}">{{ json_decode($serviceField->field->value)[2] }}</a>
                                                </td>
                                            @elseif ($serviceField->field->type == 4)
                                                @php
                                                    $value = \App\Models\FieldOption::where('id', '=', $serviceField->field->value)->first();
                                                @endphp
                                                <td>{{ $value->option }}</td>
                                            @else
                                                <td colspan="3">{{ $serviceField->field->value }}</td>
                                            @endif

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
@endsection
@push('js')
@endpush
