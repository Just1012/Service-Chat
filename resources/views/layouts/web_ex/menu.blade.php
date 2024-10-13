<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img style="scale: 2" src="{{ asset('web/assets/images/unidy.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img style="scale: 5" src="{{ asset('web/assets/images/unidy.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img style="scale: 2" src="{{ asset('web/assets/images/unidy.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img style="scale: 5" src="{{ asset('web/assets/images/unidy.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">القائمة</span></li>

                {{-- Start Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards"> لوحة التحكم</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link"
                                    data-key="t-one-page">الرئيسية</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- End Dashboard --}}

                {{-- Start Orders --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#orders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="orders">
                        <i class='bx bx-cart' ></i> <span data-key="t-dashboards"> الطلبات</span>
                    </a>
                    <div class="collapse menu-dropdown" id="orders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('order.index') }}" class="nav-link"
                                    data-key="t-one-page">قائمة الطلبات</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- End Orders --}}

                {{-- Categories --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLanding">
                        <i class='bx bx-category-alt'></i> <span data-key="t-landing">الفئات
                            </span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}" class="nav-link"
                                        data-key="t-one-page">قائمة الفئات</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('category.create') }}" class="nav-link"
                                        data-key="t-nft-landing">إنشاء فئة جديدة</a>
                                </li>

                        </ul>
                    </div>
                </li>

                {{-- Fields --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#fields" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="fields">
                        <i class='bx bx-archive-in' ></i> <span data-key="t-landing">الحقول
                            </span>
                    </a>
                    <div class="collapse menu-dropdown" id="fields">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('field.index') }}" class="nav-link"
                                    data-key="t-one-page">قائمة الحقول</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('field.create') }}" class="nav-link"
                                    data-key="t-one-page">إضافة حقل</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Slider --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#slider" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="slider">
                        <i class='bx bx-spreadsheet' ></i> <span data-key="t-landing">الاعلانات
                            </span>
                    </a>
                    <div class="collapse menu-dropdown" id="slider">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('slider.index') }}" class="nav-link"
                                    data-key="t-one-page">قائمة الاعلانات</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('slider.create') }}" class="nav-link"
                                    data-key="t-one-page">إضافة إعلان</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- User --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#user" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="user">
                        <i class='bx bxs-user'></i> <span data-key="t-landing"> المستخدمين
                            </span>
                    </a>
                    <div class="collapse menu-dropdown" id="user">
                        <ul class="nav nav-sm flex-column">
                            @php
                                $data=DB::table('roles')->get();
                            @endphp
                            @foreach ($data as $roles)
                            <li class="nav-item">
                                <a href="{{ route('user.index',$roles->id) }}" class="nav-link"
                                    data-key="t-one-page">قائمة {{ $roles->name }}</a>
                            </li>
                            @endforeach

                            <li class="nav-item">
                                <a href="{{ route('user.create') }}" class="nav-link"
                                    data-key="t-one-page">إضافة مستخدم</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Setting --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#setting" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="setting">
                        <i class='bx bxs-cog'></i> <span data-key="t-landing">الاعدادات
                            </span>
                    </a>
                    <div class="collapse menu-dropdown" id="setting">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('setting.index') }}" class="nav-link"
                                    data-key="t-one-page">قائمة الاعدادات</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('terms.editTerms') }}" class="nav-link"
                                    data-key="t-one-page">سياسة الخصوصية</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
