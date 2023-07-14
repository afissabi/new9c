@extends('front.layout.app')
@section('custom_css')
<style>
    .get-blog h3 {
        font-size: 10px;
    }

    .get-blog h1 {
        font-size: 10px;
    }

    .get-blog h2 {
        font-size: 10px;
    }

    /* Start Gallery CSS */
    .thumb {
        margin-bottom: 15px;
    }
    .thumb:last-child {
        margin-bottom: 0;
    }
    /* CSS Image Hover Effects: https://www.nxworld.net/tips/css-image-hover-effects.html */
    .thumb 
    figure img {
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
    -webkit-transition: .3s ease-in-out;
    transition: .3s ease-in-out;
    }
    .thumb 
    figure:hover img {
    -webkit-filter: grayscale(0);
    filter: grayscale(0);
    }
</style>
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
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-top:10px">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Fasilitas Kami</h5>
            <p>Rasakan pengalaman pelayanan di klinik kami dengan fasilitas terbaik</p>
        </div>
        <div class="row g-5">
            @foreach ($artikel as $item)
                <div class="col-md-3">
                    <img class="img-fluid img-thumbnail" src="{{ asset($item->path . $item->gambar) }}" alt="Random Image">
                    <h6><center>{{ $item->judul }}</center></h6>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('custom_js')

@endsection
