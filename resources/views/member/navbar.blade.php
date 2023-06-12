<div id="kt_header" class="header align-items-stretch" style="background: #0545f5;position: fixed;">
    <div class="container-xxl d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
            <a href="" style="color: #fff;font-size: 20px;">
                <center><img alt="Logo" src="{{ asset('front/img/logo_transparant.png') }}" class="h-30px h-lg-50px" style="background: #fff;padding: 5px;border-radius: 10px;">
                    MEMBER AREA
                </center>
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <!--begin::Menu-->
                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
                        <div class="menu-item me-lg-1">
                            <a class="menu-link py-3" href="{{ url('home-member') }}">
                                <span class="menu-title" style="color: #fff;">Dashboard</span>
                            </a>
                        </div>
                        {{-- <div class="menu-item me-lg-1">
                            <a class="menu-link py-3" href="">
                                <span class="menu-title" style="color: #fff;">Dashboard</span>
                            </a>
                        </div> --}}
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu wrapper-->
            </div>
            <div class="d-flex align-items-stretch flex-shrink-0">
                <div class="topbar d-flex align-items-stretch flex-shrink-0">
                    <div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
                        <div class="topbar-item cursor-pointer symbol px-3 px-lg-5 me-n3 me-lg-n5 symbol-30px symbol-md-35px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                            <i class="fas fa-hospital-user" style="font-size: 33px;color: #ffffff;border-radius: 50%;border: 1px solid #fff;padding: 8px;"></i>
                        </div>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <div class="symbol symbol-50px me-5">
                                        {{-- <img alt="Logo" src="assets/media/avatars/150-26.jpg" /> --}}
                                        <i class="fas fa-hospital-user" style="font-size: 45px;color: #053e70;"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">{{Auth::user()->name}}
                                        <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Member</span></div>
                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{Auth::user()->detailUser->pasien->no_rm}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-5">
                                <a href="#" class="menu-link px-5">My Profile</a>
                            </div>
                            <div class="menu-item px-5 my-1">
                                <a href="#" class="menu-link px-5">Account Settings</a>
                            </div>
                            <div class="menu-item px-5">
                                <a href="javascript:void(0)" class="menu-link px-5 sign-out">Sign Out</a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Heaeder menu toggle-->
                    <div class="d-flex align-items-stretch d-lg-none px-3 me-n3" title="Show header menu">
                        <div class="topbar-item" id="kt_header_menu_mobile_toggle">
                            <i class="bi bi-text-left fs-1"></i>
                        </div>
                    </div>
                    <!--end::Heaeder menu toggle-->
                </div>
            </div>
        </div>
    </div>
</div>