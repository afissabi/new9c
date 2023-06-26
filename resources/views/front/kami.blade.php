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
{{-- <a href="{{ url('register/zero-service') }}"><img class="img-fluid rounded btn-reg" src="{{ asset('front/img/regnew.png') }}" style="width: 120px;" ></a> --}}
@endsection
@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-top :20px">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">Latar Belakang</h5>
                    <h1 class="mb-0">{{ $kami->judul }}</h1>
                </div>
                <p class="mb-4">{!! $kami->konten !!}</p>
                {{-- <div class="row g-0 mb-3">
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Award Winning</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Professional Staff</h5>
                    </div>
                    <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>24/7 Support</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Fair Prices</h5>
                    </div>
                </div> --}}
                <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Call to ask any question</h5>
                        <h4 class="text-primary mb-0">+62 818 0311 2017</h4>
                    </div>
                </div>
                {{-- <a href="quote.html" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Request A Quote</a> --}}
            </div>
            <div class="col-lg-5" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset($kami->path . $kami->gambar) }}" style="object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-lg-6">
                
            </div>
            <div class="col-lg-6">
                
            </div>
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
