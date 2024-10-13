@extends('layouts.web')
@section('title')
    الرئيسية
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <h4 class="fs-16 mb-1">مرحباً {{ auth()->user()->name }} 👋</h4>
                                        </div>
                                        <div class="mt-3 mt-lg-0">
                                            <form action="javascript:void(0);">
                                                <div class="row g-3 mb-0 align-items-center">
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">

                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-auto">
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-auto">

                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </form>
                                        </div>
                                    </div><!-- end card header -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="row">
                                <div class="col-xl-6 col-md-12">
                                    <!-- card -->
                                    <div class="card card-animate bg-primary">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                        الفئات</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-white fs-14 mb-0">

                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                            class="counter-value" data-target="{{ $categories->count() }}">0</span>
                                                    </h4>
                                                    <a href="{{ route('category.index') }}" class="text-decoration-underline text-white-50">عرض كل الفئات</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-white bg-opacity-10 rounded fs-3">
                                                        <i class='bx bxs-package text-white' ></i>

                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-12">
                                    <!-- card -->
                                    <div class="card card-animate bg-secondary">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                        الطلبات</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-white fs-14 mb-0">

                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                            class="counter-value" data-target="{{ $orders->count() }}">0</span></h4>
                                                    <a href="{{ route('order.index') }}" class="text-decoration-underline text-white-50">عرض كل الطلبات</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-white bg-opacity-10 rounded fs-3">
                                                        <i class="bx bx-shopping-bag text-white"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-12">
                                    <!-- card -->
                                    <div class="card card-animate bg-success">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                        المستخدمين</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-white fs-14 mb-0">
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                            class="counter-value" data-target="{{ $users->count() }}">0</span>
                                                    </h4>
                                                    <a href="users/index/1" class="text-decoration-underline text-white-50">عرض كل المستخدمين</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-white bg-opacity-10 rounded fs-3">
                                                        <i class="bx bx-user-circle text-white"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-6 col-md-12">
                                    <!-- card -->
                                    <div class="card card-animate bg-info">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                        السائقين</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-white fs-14 mb-0">

                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                            class="counter-value" data-target="{{ $delivery->count() }}">0</span>
                                                    </h4>
                                                    <a href="users/index/4"
                                                        class="text-decoration-underline text-white-50">عرض كل السائقين</a>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-white bg-opacity-10 rounded fs-3">
                                                        <i class='bx bxs-car-mechanic text-white'></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div> <!-- end row-->

                        </div> <!-- end .h-100-->
                    </div> <!-- end col -->
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
@endsection
