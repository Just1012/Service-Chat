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
    قائمة الخدمات
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex mx-1 align-items-center justify-content-between">
                        <h4 class="mb-sm-0"></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('fieldOption.index', $field->id) }}">الفئات</a>
                                </li>
                                <li class="breadcrumb-item active">الخدمات</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">

                                <h5 class="card-title mb-0 col-sm-8 col-md-10">قائمة الخدمات ({{ $field->name }})</h5>

                                <!-- Load More Buttons -->
                                <div class="hstack flex-wrap gap-2   mb-lg-0 mb-0 col-sm-2 col-md-1">
                                    <a href="{{ route('fieldOption.create', $field->id) }}"
                                        class="btn btn-outline-secondary btn-load">
                                        <span class="d-flex align-items-center">
                                            <span class="spinner-grow flex-shrink-0" role="status">
                                                <span class="visually-hidden">+</span>
                                            </span>
                                            <span class="flex-grow-1 ms-2">
                                                +
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <button type="submit"
                                    class="btn btn-outline-primary mb-0 col-sm-2 col-md-1 btn-icon waves-effect waves-light"
                                    id="refresh"><i class="ri-24-hours-fill"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow:auto">
                            <table id="alternative-pagination"
                                class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                style="width:100%;overflow: scroll">
                                <thead>
                                    <tr>
                                        <th>#SSL</th>
                                        <th>الاختيار</th>
                                        <th>تعديل</th>
                                        <th>تم الانشاء فى</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

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
    <script>
        var locale = '{{ App::getLocale() }}';

        var table = $('#alternative-pagination').DataTable({

           
             ajax: {
                url: '{{ route('fieldOption.datatable', $field->id) }}',
                 error: function(xhr, error, thrown) {
                    if (xhr.status === 401) {
                        // Session expired, redirect to login
                        window.location.href = '/login';
                    } else {
                        // Handle other errors
                        console.error('AJAX error: ', error);
                    }
                }
            },
            columns: [
                {
                    'data': null,
                    render: function(data, type, row, meta) {
                        // 'meta.row' is the index number
                        return meta.row + 1;
                    }
                },

             

                {
                    'data': null,
                    render: function(data) {
                        // Choose the appropriate name based on the selected language
                        var name = '{{ App::getLocale() == 'ar' ? 'option' : 'option_en' }}';
                        return data[name];
                    }
                },

                {
                    'data': null,
                    render: function(data) {
                        var url = '{{ route('fieldOption.edit', ':id') }}';
                        url = url.replace(':id', data.id);
                        return '<a href="' + url + '"> <i class="bx bxs-edit btn btn-warning"></i></a>';
                    }
                },

                {
                    'data': 'created_at',
                    render: function(data, type, row) {
                        // Parse the date string
                        var date = new Date(data);

                        // Check if the date is valid
                        if (!isNaN(date.getTime())) {
                            // Format the date as 'YYYY-MM-DD'
                            var year = date.getFullYear();
                            var month = (date.getMonth() + 1).toString().padStart(2,
                                '0'); // Months are zero-based
                            var day = date.getDate().toString().padStart(2, '0');

                            return year + '-' + month + '-' + day;
                        } else {
                            return 'لا يوجد بيانات'; // Handle invalid date strings
                        }
                    }
                },
            ]
        });
    </script>
    <script>
        function openFullScreen(image) {
            var fullScreenContainer = document.createElement('div');
            fullScreenContainer.className = 'fullscreen-image';

            var fullScreenImage = document.createElement('img');
            fullScreenImage.src = image.src;

            fullScreenContainer.appendChild(fullScreenImage);
            document.body.appendChild(fullScreenContainer);

            fullScreenContainer.addEventListener('click', function() {
                document.body.removeChild(fullScreenContainer);
            });
        }
    </script>
@endpush
