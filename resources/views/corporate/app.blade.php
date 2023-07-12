<!DOCTYPE html>
<html lang="id">

<head>
    <base href="">
    <title>Klinik 9COrthodontics - Corporate Area</title>
    <meta charset="utf-8" />
    @include('corporate.header')

    @yield('custom_fonts')

    @yield('custom_css')
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('corporate.navbar')
                
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">
                            @yield('content')    
                        </div>
                    </div>
                </div>
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="order-2 order-md-1" style="color: #fff !important;">
                            <span class="fw-bold me-1">{{ date('Y') }}&nbsp;©&nbsp;Klinik 9COrthodontics</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('corporate.footer')
</body>
</html>