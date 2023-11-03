<!DOCTYPE html>
<html lang="id">
<!--begin::Head-->

<head>
    <base href="">
    <title>Klinik 9COrthodontics - Web Admin</title>
    <meta charset="utf-8" />
    @include('layouts.header')

    @yield('custom_fonts')

    @yield('custom_css')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            @include('layouts.sidebar')
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                @include('layouts.navbar')
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl" style="max-width: none;">
                            @yield('content')
                        </div>
                    </div>
                </div>

                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="order-2 order-md-1" style="color: #fff !important;">
                            <span class="fw-bold me-1">{{ date('Y') }}&nbsp;©&nbsp;Klinik 9COrthodontics</span>
                        </div>
                        <!--end::Copyright-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>

    @include('layouts.footer')
</body>

</html>
