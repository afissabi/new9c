<div id="kt_header" class="header align-items-stretch flex-column">
    <!--begin::Marquee Text-->
        <div class="d-flex align-items-stretch">
        <!--begin::Brand-->
        <div class="header-brand" style="">
            <div class="div_mobile">
                <!--begin::Logo-->
                <div class="d-flex align-items-center">
                    <a href="" style="color: #fff;font-size: 18px;">
                        <center><img alt="Logo" src="{{ asset('front/img/logo_transparant.png') }}" class="h-30px h-lg-50px" style="background: #fff;padding: 5px;border-radius: 10px;">
                            WEB ADMIN
                        </center>
                    </a>
                </div>
                <!--end::Logo-->
                <!--begin::Aside minimize-->
                <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr092.svg-->
                    <span class="svg-icon svg-icon-1 me-n1 minimize-default">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="8.5" y="11" width="12" height="2" rx="1" fill="black" />
                            <path d="M10.3687 11.6927L12.1244 10.2297C12.5946 9.83785 12.6268 9.12683 12.194 8.69401C11.8043 8.3043 11.1784 8.28591 10.7664 8.65206L7.84084 11.2526C7.39332 11.6504 7.39332 12.3496 7.84084 12.7474L10.7664 15.3479C11.1784 15.7141 11.8043 15.6957 12.194 15.306C12.6268 14.8732 12.5946 14.1621 12.1244 13.7703L10.3687 12.3073C10.1768 12.1474 10.1768 11.8526 10.3687 11.6927Z" fill="black" />
                            <path opacity="0.5" d="M16 5V6C16 6.55228 15.5523 7 15 7C14.4477 7 14 6.55228 14 6C14 5.44772 13.5523 5 13 5H6C5.44771 5 5 5.44772 5 6V18C5 18.5523 5.44771 19 6 19H13C13.5523 19 14 18.5523 14 18C14 17.4477 14.4477 17 15 17C15.5523 17 16 17.4477 16 18V19C16 20.1046 15.1046 21 14 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H14C15.1046 3 16 3.89543 16 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
                    <span class="svg-icon svg-icon-1 minimize-active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black" />
                            <path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black" />
                            <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside minimize-->
                <!--begin::Aside toggle-->
                <div class="d-flex align-items-center overflow-auto pt-3 pt-lg-0" id="view_mobile">
                    <div class="d-flex align-items-center mx-4">
                        <!--begin::Label-->
                        <span class="fs-7 fw-bolder pe-3 d-none d-xxl-block" style="color:#001e5c;">{{Auth::user()->name}}</span>
                        <!--end::Label-->
                        <!--begin::Actions-->
                        <div class="d-flex">
                            <!--begin::Quick links-->
                            <div class="d-flex align-items-center">
                                <!--begin::Menu wrapper-->
                                <a href="#" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black" />
                                            <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black" />
                                            <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black" />
                                            <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('assets/media/misc/pattern-1.jpg')">
                                        <!--begin::Title-->
                                        <h3 class="text-white fw-bold mb-3">{{Auth::user()->name}}</h3>
                                        <!--end::Title-->
                                        <!--begin::Status-->
                                        <span class="badge bg-primary py-2 px-3"></span>
                                        <!--end::Status-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin:Nav-->
                                    <div class="row g-0">
                                        <!--begin:Item-->
                                        <div class="col-6">
                                            {{-- <a href="{{ url('/update-profile') }}" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom"> --}}
                                            <a href="#" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg-->
                                                <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                                        <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <span class="fs-5 fw-bold text-gray-800 mb-0">Profile</span>
                                                <span class="fs-7 text-gray-400">Setting</span>
                                            </a>
                                        </div>
                                        <!--end:Item-->
                                        <!--begin:Item-->
                                        <div class="col-6">
                                            <a href="javascript:void(0)" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom sign-out">
                                                <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                                <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <span class="fs-5 fw-bold text-gray-800 mb-0">Sign Out</span>
                                                <span class="fs-7 text-gray-400">Keluar</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!--end:Nav-->
                                    <!--end::View more-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::Quick links-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>

                </div>
            </div>
                
            <!--end::Action group-->
            <!--end::Aside toggle-->
        </div>

        <!--end::Brand-->
        <div class="toolbar">
            <!--begin::Toolbar-->
            <div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column me-5">
                    <!--begin::Title-->
                    <h1 class="d-flex flex-column fw-bolder fs-3 my-auto" style="color: #001e5c !important;">{{$pageTitle}}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    {{-- <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo8/dist/index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Default</li>
                        <!--end::Item-->
                    </ul> --}}
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Action group-->
                <div class="d-flex align-items-center overflow-auto pt-3 pt-lg-0" id="view_pc">
                    <div class="d-flex align-items-center">
                        <!--begin::Label-->
                        <span class="fs-7 fw-bolder pe-3 d-none d-xxl-block" style="color:#001e5c;">{{Auth::user()->name}}</span>
                        <!--end::Label-->
                        <!--begin::Actions-->
                        <div class="d-flex">
                            <!--begin::Quick links-->
                            <div class="d-flex align-items-center">
                                <!--begin::Menu wrapper-->
                                <a href="#" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#001e5c">
                                            <path d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black" />
                                            <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black" />
                                            <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black" />
                                            <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('assets/media/misc/pattern-1.jpg')">
                                        <!--begin::Title-->
                                        <h3 class="text-white fw-bold mb-3">{{Auth::user()->name}}</h3>
                                        <!--end::Title-->
                                        <!--begin::Status-->
                                        <span class="badge bg-primary py-2 px-3"></span>
                                        <!--end::Status-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin:Nav-->
                                    <div class="row g-0">
                                        <!--begin:Item-->
                                        <div class="col-6">
                                            <a href="#" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg-->
                                                <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                                        <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <span class="fs-5 fw-bold text-gray-800 mb-0">Profile</span>
                                                <span class="fs-7 text-gray-400">Setting</span>
                                            </a>
                                        </div>
                                        <!--end:Item-->
                                        <!--begin:Item-->
                                        <div class="col-6">
                                            <a href="javascript:void(0)" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom sign-out">
                                                <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                                <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <span class="fs-5 fw-bold text-gray-800 mb-0">Sign Out</span>
                                                <span class="fs-7 text-gray-400">Keluar</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!--end:Nav-->
                                    <!--end::View more-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::Quick links-->
                        </div>
                        <!--end::Actions-->
                    </div>

                </div>
                <!--end::Action group-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
</div>
