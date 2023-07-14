@extends('front.layout.app')
@section('custom_css')
<style>
    .section-promo{
        background-repeat: no-repeat;
        background-position: center;
        height: 229px !important;
        width: 100%;
        position: relative;
        z-index: 3;
    }

    .get-blog h1{
        font-size: 10px;
    }
    
    .get-blog h2{
        font-size: 10px;
    }

    .get-blog h3{
        font-size: 10px;
    }

    .get-blog h4{
        font-size: 10px;
    }

    .get-blog h5{
        font-size: 10px;
    }

    .get-blog h6{
        font-size: 10px;
    }
</style>
@endsection

@section('btn-register')
<a href="{{ url('register/zero-service/' . encrypt(0)) }}"><img class="img-fluid rounded btn-reg" src="{{ asset('front/img/regnew.png') }}" style="width: 120px;" ></a>
@endsection

@section('header-carousel')
<div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="w-100" src="{{ asset($slide1->path . $slide1->gambar) }}" alt="Image">
            {{-- <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 900px;">
                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Creative & Innovative</h5>
                    <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
                    <a href="quote.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a>
                    <a href="" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                </div>
            </div> --}}
        </div>
        @foreach ($slider as $item)
        <div class="carousel-item">
            <img class="w-100" src="{{ asset($item->path . $item->gambar) }}" alt="Image">
        </div>    
        @endforeach
        
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endsection

@section('fact-count')
<!-- Facts Start -->
<div class="container-fluid facts py-5 pt-lg-0">
    <div class="container py-5 pt-lg-0">
        <div class="row gx-0">
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                <a href="{{ url('/cabang') }}">
                <div class="shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;background:#0545f5">
                    {{-- <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fas fa-clinic-medical" style="color:#0545f5"></i>    
                    </div> --}}
                    <img src="{{ asset('front/img/maps.png') }}" style="width: 90px;background: #fff;border-radius: 50%;padding: 5px;">
                    <div class="ps-4">
                        <h5 class="text-white mb-0">Klinik Kami</h5>
                        <h1 class="text-white mb-0" data-toggle="counter-up" id="countKlinik">0</h1>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                <a href="{{ url('/tim-dokter') }}">
                <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                    {{-- <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fas fa-user-md" style="color: #0545f5;"></i>
                    </div> --}}
                    <img src="{{ asset('front/img/dokter.png') }}" style="width: 90px;background: #b3b3c7;border-radius: 50%;padding: 5px;">
                    <div class="ps-4">
                        <h5 class="text-primary mb-0">Dokter Kami</h5>
                        <h1 class="mb-0" data-toggle="counter-up" id="countDokter">0</h1>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                <a href="{{ url('/layanan') }}">
                <div class="shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;background:#0545f5">
                    {{-- <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fa fa-award text-primary"></i>
                    </div> --}}
                    <img src="{{ asset('front/img/service.png') }}" style="width: 90px;background: #fff;border-radius: 50%;padding: 5px;">
                    <div class="ps-4">
                        <h5 class="text-white mb-0">Layanan</h5>
                        <h1 class="text-white mb-0" data-toggle="counter-up" id="countLayanan">0</h1>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Facts Start -->
@endsection

@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Kenapa Harus Dengan Kami ?</h5>
            <h1 class="mb-0">Kami disini siap membantu anda kapanpun</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="row g-5">
                    <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa fa-cubes text-white"></i>
                        </div>
                        <a href="{{ url('/fasilitas') }}"><h4>Fasilitas Lengkap</h4></a>
                        <p class="mb-0">Rasakan pengalaman berbeda pelayanan di klinik kami dengan berbagai fasilitas nyaman dan terbaik</p>
                    </div>
                    <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa fa-award text-white"></i>
                        </div>
                        <a href="{{ url('/layanan') }}"><h4>Layanan Terlengkap</h4></a>
                        <p class="mb-0">Dapatkan layanan yang cukup lengkap untuk perawatan dan solusi kesehatan gigi anda</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s" src="{{ asset('front/img/feature.jpg') }}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row g-5">
                    <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa fa-users-cog text-white"></i>
                        </div>
                        <a href="{{ url('/tim-dokter') }}"><h4>Professional Staff</h4></a>
                        <p class="mb-0">Kami memiliki tenaga ahli sesuai dengan kompetensi di bidangnya, para dokter spesialis dan paramedis terbaik yang siap membantu anda</p>
                    </div>
                    <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <a href="{{ url('/hubungi-kami') }}"><h4>24/7 Support</h4></a>
                        <p class="mb-0">Berbagai pertanyaan dan konsultasi, silahkan menghubungi kami</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Klinik Kami</h5>
            <h1 class="mb-0">Kami hadir di beberapa tempat untuk membantu anda</h1>
        </div>
        
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-shield-alt text-white"></i>
                    </div>
                    <h4 class="mb-3">Pusat</h4>
                    <p class="m-0">Jl. Pakuwon City</p>
                    <a class="btn btn-lg btn-primary rounded" href="{{ url('/layanan/klinik/pusat') }}">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-chart-pie text-white"></i>
                    </div>
                    <h4 class="mb-3">RS Lombok 22</h4>
                    <p class="m-0">Alamat jalan</p>
                    <a class="btn btn-lg btn-primary rounded" href="">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon">
                        <i class="fa fa-code text-white"></i>
                    </div>
                    <h4 class="mb-3">RS Muncar Medical Center (Banyuwangi)</h4>
                    <p class="m-0">Alamat Jalan</p>
                    <a class="btn btn-lg btn-primary rounded" href="">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- PROMO --}}
<div class="container-fluid py-5 wow fadeInUp justify-content-center" data-wow-delay="0.1s" style="background-image: url({{ asset('front/img/bg-section1.png') }});border-radius: 120px 0px 120px 0px;">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            {{-- <h5 class="fw-bold text-text-uppercase" style="color: #fff">Promo Saat Ini</h5> --}}
            <h1 class="mb-0" style="color: #fff">Nikmati promo yang kami siapkan khusus untuk anda</h1>
        </div>
        <div class="row g-0" id="promo">
            
        </div>
    </div>
</div>

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Sharing Experience</h5>
            <h4 class="mb-0">Pengalaman pasien treatment di klinik 9C Orthodontics?</h4>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s" id="testimoni">
            @foreach ($testi as $item)
                <div class="testimonial-item bg-light my-4" style="border-radius: 85px 0px 85px 0px;border: 2px dashed #0545f5;margin-right: 10px;margin-left: 10px;">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5" >
                        <img class="img-fluid" src="{{ asset($item->path . $item->gambar) }}" style="width: 150px;height: 150px;margin-top: -89px;margin-left: -65px;">
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">{{ $item->judul }}</h4>
                            {{-- <small class="text-uppercase">Profession</small> --}}
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5" style="max-height: 200px;min-height: 200px;font-size:12px;">
                        <i class="fas fa-quote-left"></i> {!! $item->konten !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="background: #0044ff14;border-radius: 0px 120px 0px 120px;">
    <img class="img-fluid rounded" src="{{ asset('front/img/isolasi.png') }}" style="height: 80px;position: absolute;margin-top: -77px;transform: rotate(-10deg);" >
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Artikel Terbaru</h5>
            <h1 class="mb-0">Baca artikel terbaru dari kami</h1>
        </div>
        <div class="row g-5" id="blog">
            
        </div>
    </div>
</div>

{{-- PARTNER KAMI --}}
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5 mb-5">
        {{-- <h5 class="fw-bold text-primary text-uppercase"><u>Partner Kami</u></h5> --}}
        <div class="bg-white">
            <div class="owl-carousel vendor-carousel" >
                @foreach ($vendor as $item)
                    <img src="{{ asset($item->path . $item->gambar) }}" alt="">    
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_js')
{{-- <script type="text/javascript">
    $(window).on('load', function() {
        $('#kt_modal_1').modal({backdrop:'static', keyboard:false});
        $('#kt_modal_1').modal('show');
    });
</script> --}}
<script>
$(window).on('load', function() {
    Front();
    blog();
    promo();
});

function Front() {
    $.ajax({
        url: "{{ url('/summary-group') }}",
        type: "get",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            
        },
        success: function(response){
            $('#countKlinik').html(response.klinik);
            $('#countLayanan').html(response.layanan);
            $('#countDokter').html(response.dokter);
            // $('#testimoni').html(response.testimoni);
        }
    });
}

function blog() {
    var need = 3;

    $.ajax({
        url: "{{ url('/get-blog') }}",
        type: "get",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            need : need,
        },

        success: function(response){
            $('#blog').html(response);
        }
    });
}

function promo() {
    var need = 3;

    $.ajax({
        url: "{{ url('/get-promo') }}",
        type: "get",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            need : need,
        },

        success: function(response){
            $('#promo').html(response);
        }
    });
}

// function vendor() {
//     $.ajax({
//         url: "{{ url('/get-vendor') }}",
//         type: "get",
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//         data: {

//         },

//         success: function(response){
//             $('#vendor').html(response);
//         }
//     });
// }
</script>
@endsection
