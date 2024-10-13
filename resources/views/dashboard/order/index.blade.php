@extends('layouts.web')

@push('css')
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush

@section('title')
    قائمة الطلبات
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <h5 class="card-title mb-0 col-sm-8 col-md-10">قائمة الطلبات</h5>

                                <button type="button"
                                    class="btn btn-outline-primary mb-0 col-sm-2 col-md-1 btn-icon waves-effect waves-light"
                                    id="refresh"><i class="ri-24-hours-fill"></i></button>

                                <div class="alert alert-secondary col-md-7 mx-auto alert-border-left alert-dismissible fade show"
                                    role="alert" id="alert" style="display: none">
                                    <i class="ri-check-double-line me-3 align-middle"></i> <strong id="strong"></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" style="overflow:auto">
                            <table id="alternative-pagination"
                                class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                style="width:100%;overflow: scroll">
                                <thead>
                                    <tr>
                                        <th>#SSL</th>
                                        <th>ID</th>
                                        <th>الخدمة</th>
                                        <th>طالب الخدمة</th>
                                        <th>تم القبول بواسطة</th>
                                        <th>الحالة</th>
                                        <th>تفاصيل الطلب</th>
                                        <th>تم الانشاء فى</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <!-- DataTables will populate this -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Pass authenticated user ID to JavaScript -->
    <script>
        var authUserId = {{ auth()->user()->id }};
    </script>

    <script>
        var table;
        var authUserId = {{ auth()->user()->id }};
        var authUserRole = {{ auth()->user()->role_id }};
        $(document).ready(function() {
            // Initialize DataTable
            table = $('#alternative-pagination').DataTable({
                ajax: {
                    url: '{{ route('order.admin.datatable') }}',
                    error: function(xhr, error, thrown) {
                        if (xhr.status === 401) {
                            window.location.href = '/login';
                        } else {
                            console.error('AJAX error: ', error);
                        }
                    }
                },
                columns: [{
                        'data': null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        'data': 'id'
                    },
                    {
                        'data': null,
                        render: function(data) {
                            return data.services ? data.services.name_ar : 'N/A';
                        }
                    },
                    {
                        'data': null,
                        render: function(data) {
                            return data.users_order ? data.users_order.email : 'N/A';
                        }
                    },
                    {
                        'data': null,
                        render: function(data) {
                            return data.delivary ? data.delivary.name : 'N/A';
                        }
                    },


                    {
                        'data': null,
                        render: function(data) {

                            var disabled = (data.delivary && data.delivary.id !== authUserId &&
                                    authUserRole != 2) ?
                                'disabled' : '';

                            if ((data.status == 1 || data.status == 3) && data.services.type == 0) {
                                return `<button class="btn btn-success open-chat" data-id="${data.id}" ${disabled}><i class="bx bx-chat"></i> Chat</button>`;
                            } else {
                                return `
                                <select class="status-dropdown btn btn-info btn-sm" data-id="${data.id}">
                                    <option value="0" ${data.status == 0 ? 'selected' : ''}>قيد الانتظار</option>
                                    <option value="1" ${data.status == 1 ? 'selected' : ''}>قبول</option>
                                    <option value="2" ${data.status == 2 ? 'selected' : ''}>رفض</option>
                                    <option value="3" ${data.status == 3 ? 'selected' : ''}>تم الانتهاء</option>
                                </select>
                            `;
                            }
                        }
                    },
                    {
                        'data': null,
                        render: function(data) {
                            var url = '{{ route('order.admin.from_data', ':id') }}';
                            url = url.replace(':id', data.id);
                            return '<a href="' + url +
                                '"> <i class="bx bx-table btn btn-warning"></i></a>';
                        }
                    },
                    {
                        'data': 'created_at',
                        render: function(data) {
                            var date = new Date(data);
                            if (!isNaN(date.getTime())) {
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2, '0');
                                var day = date.getDate().toString().padStart(2, '0');
                                var hours = date.getHours().toString().padStart(2, '0');
                                var minutes = date.getMinutes().toString().padStart(2, '0');
                                var seconds = date.getSeconds().toString().padStart(2, '0');
                                return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                    minutes + ':' + seconds;
                            } else {
                                return 'لا يجود بيانات';
                            }
                        }
                    }
                ]
            });

            // Refresh Button Click Event
            $('#refresh').on('click', function() {
                $('#alert').css('display', 'none');
                table.ajax.reload();
            });
        });

        // Status Dropdown Change Event
        $(document).on('change', '.status-dropdown', function() {
            var url = '{{ route('order.admin.status', ':id') }}';
            var orderId = $(this).data('id');
            var newStatus = $(this).val();
            url = url.replace(':id', orderId);

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    status: newStatus
                },
                success: function(response) {
                    toastr.success(response.message, 'تم بنجاح');
                    table.ajax.reload(); // Reload the table to reflect changes
                },
                error: function() {
                    toastr.error('أعد المحاولة', 'خطأ !');
                    table.ajax.reload(); // Reload the table on error
                }
            });
        });



        // Chat Button Click Event
        $(document).on('click', '.open-chat', function() {
            var chatUrl = '{{ route('chat.index', ':id') }}';
            var orderId = $(this).data('id');
            chatUrl = chatUrl.replace(':id', orderId);
            window.location.href = chatUrl;
        });
    </script>
@endpush
