<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>9C Orthodontics</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="9cOrthodontics" name="keywords">
    <meta content="9cOrthodontics" name="description">
    <link rel="icon" href="{{ asset('front/img/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/lib/animate/animate.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    @yield('custom_fonts')

    @yield('custom_css')
    <style>
    .navbar-custom {
        background-image: url(../front/navbarcustom1.png);
        background-size: 100% 229px;
        background-repeat: no-repeat;
        background-position: center;
        height: 229px !important;
        width: 100%;
        position: relative;
        z-index: 3;
    }

    .btn-reg{
        z-index: 1000;
        /* margin-top: 250px; */
        bottom: 100px;
        position: fixed;
        right: -6px;
    }
    
    @media (max-width: 991.98px){
        .navbar-brand-img img{
            content: url({{ asset('front/img/logo_white.png') }});
        }
    }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <i class="fa fa-map-marker-alt me-2" style="color: #fff;"></i><small class="me-3 text-light" style="font-size: 10px;">Ruko Pakuwon Town Square Blok AA-2/25<br> Surabaya, Jawa Timur Indonesia</small>
                    <i class="fa fa-phone-alt me-2" style="color: #fff;"></i><small class="me-3 text-light" style="font-size: 10px;">031-59177353 <br> +6281 8031 12017</small>
                    <i class="fa fa-envelope-open me-2" style="color: #fff;"></i><small class="text-light" style="font-size: 10px;">info.orthodontics.9c@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://twitter.com/9orthodontics" target="_blank"><i class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.facebook.com/9Corthodontics" target="_blank"><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.instagram.com/9corthodontics/" target="_blank"><i class="fab fa-instagram fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href="https://www.youtube.com/@9corthodontics" target="_blank"><i class="fab fa-youtube fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="{{ url('/') }}" class="navbar-brand p-0">
                {{-- <h3 class="m-0" style="color: #122d76;"><i class="fa fa-user-tie me-2"></i>CONGKRONG</h3> --}}
                <div class="navbar-brand-img">
                    <img alt="Image" src="{{ asset('front/img/logo_transparant.png') }}" class="logo-navbar" style="">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                {{-- <span class="fa fa-bars"></span> --}}
                <span class="fas fa-ellipsis-v"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    {!! App\Helpers\Helper::menuFront(); !!}
                    
                    {{-- <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Services</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Blog</a>
                        <div class="dropdown-menu m-0">
                            <a href="blog.html" class="dropdown-item">Blog Grid</a>
                            <a href="detail.html" class="dropdown-item">Blog Detail</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="price.html" class="dropdown-item">Pricing Plan</a>
                            <a href="feature.html" class="dropdown-item">Our features</a>
                            <a href="team.html" class="dropdown-item">Team Members</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="quote.html" class="dropdown-item">Free Quote</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a> --}}
                </div>
                <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
                <a href="{{ url('register/zero-service') }}" class="btn btn-primary py-2 px-4 ms-3" style="background: #263b73;border-radius: 25px;border: 1px solid;">Daftar Sekarang</a>
            </div>
        </nav>
        @yield('btn-register')
        
        

        @yield('header-carousel')
        
    </div>
    <!-- Navbar & Carousel End -->

    @yield('fact-count')

    @yield('content')
    

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 footer-about">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                        <a href="{{ url('/') }}" class="navbar-brand">
                            {{-- <h1 class="m-0 text-white"><i class="fa fa-user-tie me-2"></i>9C Orthodontics</h1> --}}
                            <img alt="Image" src="{{ asset('front/img/logo_transparant.png') }}" class="logo-front" style="height: 100px;">
                        </a>
                        <p class="mt-3 mb-4">Ingin menjadi mitra kami ? Tawarkan bentuk kerja sama yang anda ajukan dengan mengirimkan email kepada kami di bawah ini...</p>
                        <form action="">
                            <p class="mt-3 mb-4">MITRA BISNIS</p>
                            <div class="input-group">
                                <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                                <button class="btn btn-dark">Kirim Email</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-6 col-md-12 pt-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Hubungi Kami</h3>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <p class="mb-0">Ruko Pakuwon Town Square Blok AA-2/25, Surabaya, Jawa Timur, Indonesia</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">info.orthodontics.9c@gmail.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">031-59177353 <br> +6281 8031 12017</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-primary btn-square me-2" href="https://twitter.com/9orthodontics" target="_blank"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="https://www.facebook.com/9Corthodontics" target="_blank"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="https://www.youtube.com/@9corthodontics" target="_blank"><i class="fab fa-youtube fw-normal" target="_blank"></i></a>
                                <a class="btn btn-primary btn-square" href="https://www.instagram.com/9corthodontics/" target="_blank"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 pt-0 pt-lg-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Quick Links</h3>
                            </div>
                            <div class="link-animated d-flex flex-column justify-content-start">
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Klinik</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Tim Dokter</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Layanan</a>
                                <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Hubungi Kami</a>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Popular Links</h3>
                            </div>
                            <div class="link-animated d-flex flex-column justify-content-start">
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The Team</a>
                                <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                                <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white" style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-end">
                <div class="col-lg-8 col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                        <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">9Corthodontics</a>. All Rights Reserved. 
                        
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Developed By <a class="text-white border-bottom" href="">Najah Tech</a></p></a>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
    
    <!-- Footer End -->

    {{-- MENU BAWAH MOBILE --}}
    <div class="mobile_bottom_navigation">
        <div class="div_bottom_navigation">
            <div class="div_navigation">
                <a href="{{ url('/') }}" class="nav_item" id="home">
                    <i class="fas fa-home"></i>
                    <h5>Home</h5>
                </a>
                <a style="position: relative;" href="{{ url('layanan') }}" class="nav_item masuk" id="home">
                    <i class="fas fa-tooth"></i>
                    <h5>Layanan</h5>
                    <div id="cart-counter-menu_mobile_bottom"> <span></span></div>
                </a>
                <div class="kosongan"></div>
                <a href="{{ url('promo') }}" class="nav_item" style="margin-left: 50px;">
                    <i class="fas fa-grin-stars"></i>
                    <h5>Promo</h5>
                </a>
                <a href="javascript:void(0)" class="nav_item" class="nav_item" id="pop_up_profile" onclick=showLogin()>
                    <i class="fas fa-sign-in-alt"></i>
                    <h5>Member</h5>
                </a>
            </div>
            <div class="floating_nav" onclick="toggle_mobile_wa()">
                <div class="floating_nav_wa">
                    <img src="{{ asset('front/img/wa.svg') }}">
                </div>
                <div class="floating_nav_close">
                    
                    <img src="{{ asset('front/img/down.svg') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="mobile_floating_nav" style="display: none">
        <div class="floating_content">
            <a href="https://wa.me/628113119965/?text=Saya+ingin+informasi+lebih+lanjut" target="blank" class="item_floating_nav animate__animated" id="item_floating_nav_1">
                <i class="fab fa-whatsapp"></i>
                <h5>Klinik<br>Utama</h5>
            </a>
            <a href="https://wa.me/6287781199997/?text=Saya+ingin+informasi+lebih+lanjut" target="blank" class="item_floating_nav animate__animated" id="item_floating_nav_2">
                <i class="fab fa-whatsapp"></i>
                <h5>Surabaya<br>Pusat</h5>
            </a>
            <a href="https://wa.me/6282142942954/?text=Saya+ingin+informasi+lebih+lanjut" target="blank" class="item_floating_nav animate__animated" id="item_floating_nav_3">
                <i class="fab fa-whatsapp"></i>
                <h5>Banyu<br>wangi</h5>
            </a>
        </div>
    </div>
    <!-- Back to Top -->
    {{-- <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a> --}}

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);" >
                        <input type="text" id="kata_kunci" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4" onclick="cariSlug()"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="" style="margin-top: 180px;position: absolute;left: 34%;" id="hasil_pencarian">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('front/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('front/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Template Javascript -->
    <script src="{{ asset('front/js/main.js') }}"></script>
    <script>
        function toggle_mobile_wa() {
            if ($('.item_floating_nav').css('opacity') == 0) {
                $('.mobile_floating_nav').css('z-index', '10799999');
                $('.mobile_floating_nav').css('opacity', '1');
                $('.mobile_floating_nav').css('display', 'block');

                $('#item_floating_nav_1').removeClass('animate__fadeOutDown');
                $('#item_floating_nav_1').addClass('animate__fadeInUp');

                setTimeout(() => {
                    $('#item_floating_nav_2').removeClass('animate__fadeOutDown');
                    $('#item_floating_nav_2').addClass('animate__fadeInUp');
                }, 200);
                setTimeout(() => {
                    $('#item_floating_nav_3').removeClass('animate__fadeOutDown');
                    $('#item_floating_nav_3').addClass('animate__fadeInUp');
                }, 400);

                $('.floating_nav_wa').hide();
                $('.floating_nav_close').fadeIn();
            } else {
                $('#item_floating_nav_1').removeClass('animate__fadeInUp');
                $('#item_floating_nav_1').addClass('animate__fadeOutDown');

                setTimeout(() => {
                    $('#item_floating_nav_2').removeClass('animate__fadeInUp');
                    $('#item_floating_nav_2').addClass('animate__fadeOutDown');
                }, 200);
                setTimeout(() => {
                    $('#item_floating_nav_3').removeClass('animate__fadeInUp');
                    $('#item_floating_nav_3').addClass('animate__fadeOutDown');
                }, 400);

                $('.floating_nav_close').hide();
                $('.floating_nav_wa').fadeIn();

                setTimeout(() => {
                    $('.mobile_floating_nav').css('z-index', '-1');
                }, 1000);
            }
        }

        function cariSlug() {
            $.ajax({
                url: "{{ url('/pencarian-kata-kunci') }}",
                type: "get",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    kata : $('#kata_kunci').val(),
                },

                success: function(response){
                    $('#hasil_pencarian').html(response);
                }
            });
        }
        
    </script>
    <script>
        $(function () { 
            $(window).scroll(function () {
                if ($(this).scrollTop() > 40) { 
                    $('.navbar-brand-img img').attr('src','../front/img/logo_white.png');
                }
                if ($(this).scrollTop() < 40) { 
                    $('.navbar-brand-img img').attr('src','../front/img/logo_transparant.png');
                }
            })
        });
    </script>
    @yield('custom_js')
</body>

</html>
