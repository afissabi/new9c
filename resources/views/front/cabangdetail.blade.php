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
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">{{ $klinik->nama }}</h5>
            <h4 class="mb-0">Jika Anda Memiliki Pertanyaan, Jangan Ragu Untuk Menghubungi Kami</h4>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Telp</h5>
                        <h6 class="text-primary mb-0">{{ $klinik->telp }} | {{ $klinik->admin }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Email</h5>
                        <h6 class="text-primary mb-0" style="font-size: 13px;">{{ $klinik->email }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Alamat</h5>
                        <h6 class="text-primary mb-0" style="font-size: 13px;">{{ $klinik->alamat }} {{ $klinik->kota }} {{ $klinik->prov }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                    <h5 class="fw-bold text-primary text-uppercase">Foto Klinik</h5>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp gallery" data-wow-delay="0.6s" id="testimoni">
                    @foreach ($galeri as $item)
                        <div class="testimonial-item bg-light my-4" >
                            <div class="align-items-center thumb" >
                                <a href="">
                                    <img class="img-fluid img-thumbnail" src="{{ asset('img/klinik/' . $item->gambar) }}" alt="Random Image">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                <table class="table table-bordered">
                    <thead>
                        <tr style="background: #2F3A60;color: #fff;">
                            <th scope="col"><center>Hari</center></th>
                            <th scope="col"><center>Keterangan</center></th>
                            <th scope="col"><center>Jam</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jam as $item)
                        <tr>
                            <td scope="col"><center>{{ $item->hari }}</center></td>
                            <td scope="col"><center>{{ $item->status }}</center></td>
                            <td scope="col"><center>{{ substr($item->jam_buka, 0, 5) }} - {{ substr($item->jam_tutup, 0, 5) }}</center></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                <iframe src="{{ $klinik->maps }}" width="600" height="328" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')

@endsection
