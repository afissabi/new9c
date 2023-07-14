@extends('front.layout.app')
@section('custom_css')

@endsection

{{-- @section('header-carousel')
<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
    <div class="row py-5">
        <div class="col-12 pt-lg-5 mt-lg-5 text-center">
            <h1 class="display-4 text-white animated zoomIn">LAYANAN KLINIK PUSAT</h1>
        </div>
    </div>
</div>

@endsection --}}
@section('btn-register')
<a href="{{ url('register/zero-service/' . encrypt(0)) }}"><img class="img-fluid rounded btn-reg" src="{{ asset('front/img/regnew.png') }}" style="width: 120px;" ></a>
@endsection
@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-top :20px">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Klinik Kami</h5>
            <h1 class="mb-0"></h1>
        </div>
        <div class="row g-5">
            @foreach ($klinik as $item)
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #2F3A60 !important;color: #fff;">
                        <div class="">
                            <img src="{{ asset('front/img/maps.png') }}" style="width: 90px;background: #fff;border-radius: 50%;">
                        </div>
                        <h4 class="mb-3" style="color:#fff">{{ $item->nama }}</h4>
                        <p class="m-0">{{ $item->alamat }}<br>{{ $item->kota }}</p>
                        <a class="btn btn-lg btn-primary rounded" href="{{ url('cabang/' . encrypt($item->id_klinik)) }}" data-id_klinik="" data-id_promo="" style="width: -webkit-fill-available !important;border-radius: 40px 0px 0px 40px !important;">
                            <i class="bi bi-arrow-right"></i> Lihat
                        </a>
                    </div>
                    <svg viewBox="0 0 500 200">
                        <path d="M 0 30 C 150 100 280 0 500 20 L 500 0 L 0 0" fill="#2F3A60"></path>
                    </svg>
                </div>
            @endforeach
        </div>
    </div>
</div>


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
<script>
    $(window).on('load', function() {
        blog();
    });

    function blog() {
        var need = 8;

        $.ajax({
            url: "{{ url('/all-blog') }}",
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
</script>
@endsection
