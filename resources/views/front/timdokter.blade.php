@extends('front.layout.app')
@section('custom_css')
<style>
    /* .navbar-custom {
        background-image: url(../../front/navbarcustom1.png);
        background-size: 100% 229px;
        background-repeat: no-repeat;
        background-position: center;
        height: 229px !important;
        width: 100%;
        position: relative;
        z-index: 3;
    } */
    .navbar-custom {
        background: #06A3DA;
    }
</style>
<style>
    .tile {
        display: block;
        letter-spacing: 0.02em;
        float: left;
        height: 135px;
        width: 135px;
        cursor: pointer;
        text-decoration: none;
        color: #ffffff;
        position: relative;
        font-weight: 300;
        font-size: 12px;
        letter-spacing: 0.02em;
        line-height: 20px;
        overflow: hidden;
        border: 4px solid transparent;
        margin: 0 10px 10px 0;
    }

    .bg-green-turquoise {
        border-color: #8ACCFF !important;
        background-image: none !important;
        background-color: #8ACCFF !important;
        color: white !important;
        border-radius: 6px;
    }

    .active, .bg-green-turquoise:hover {
        border-color: #00924b !important;
        background-color: #00924b !important;
        border-radius: 6px;
        color: white !important;
    }

    .bg-yellow-turquoise {
        border-color: #FFCC00 !important;
        background-image: none !important;
        background-color: #FFCC00 !important;
        color: white !important;
        border-radius: 6px;
    }

    .bg-red-turquoise {
        border-color: #FF4141 !important;
        background-image: none !important;
        background-color: #FF4141 !important;
        color: white !important;
        border-radius: 6px;
    }

    .tile:after, .tiles .tile:before {
        content: "";
        float: left;
    }

    .tile .tile-body {
        height: 100%;
        vertical-align: top;
        padding: 10px 10px;
        overflow: hidden;
        position: relative;
        font-weight: 400;
        font-size: 12px;
        color: #000000;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .tile .tile-body {
        margin-bottom: 0 !important;
    }

    .tile .tile-body > i {
        margin-top: 10px;
        display: block;
        font-size: 50px;
        line-height: 56px;
        text-align: center;
        color: #fff;
    }

    .tile .tile-object {
        position: absolute;
        bottom: 0 !important;
        left: 0;
        right: 0;
        min-height: 30px;
        *zoom: 1;
        background-color: #00000066;
    }

    .tile .tile-object:before, .tiles .tile .tile-object:after {
        display: table;
        content: "";
    }

    .tile .tile-object > .name {
        position: absolute;
        bottom: 0;
        left: 0;
        margin-bottom: 5px;
        margin-left: 10px;
        margin-right: 15px;
        font-weight: 400;
        font-size: 13px;
        color: #ffffff;
    }

    .tile .tile-object > .number {
        position: absolute;
        bottom: 0;
        right: 0;
        margin-bottom: 0;
        color: #ffffff;
        text-align: center;
        font-weight: 600;
        font-size: 14px;
        letter-spacing: 0.01em;
        line-height: 14px;
        margin-bottom: 8px;
        margin-right: 10px;
    }

    .tile .tile-object:after {
        clear: both;
    }

    .tile:after, .tiles .tile:before {
        content: "";
        float: left;
    }

    #pop-up-hjks .modal-content{
        background-color: transparent;
        border: none;
    }

    #pop-up-hjks .modal-header{
        border-bottom: none;
    }

    #pop-up-hjks .modal-header .close{
        color: #fc0000;
        opacity: 1;
    }

    #pop-up-hjks .modal-header .close::before{
        font-size: 2.5rem;
    }

    #pop-up-hjks .modal-body img{
        width: 100%;
    }

    #pop-up-hjks .modal-footer{
        border-top: none;
        justify-content: center;
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
<a href="{{ url('register/zero-service') }}"><img class="img-fluid rounded btn-reg" src="{{ asset('front/img/regnew.png') }}" style="width: 120px;" ></a>
@endsection
@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Tim Dokter</h5>
            <h3 class="mb-0">Kami Memiliki Tim Dokter Professional yang Siap Membantu Anda</h3>
        </div>
        <div class="row g-5">
            @foreach ($dokter as $item)
                <div class="col-lg-3 wow slideInUp" data-wow-delay="0.3s">
                    <img class="img-fluid rounded" src="{{ asset('front/img/logo_bulat.png') }}" style="height: 70px;position: absolute;margin-top: -19px;border-radius: 50% !important;border: 3px dashed #1574c0;" >
                    {{-- <div class="team-item rounded overflow-hidden" style="background-image: url('{{ asset('front/img/bg-team.png') }}');background-size: cover;background-repeat: no-repeat;"> --}}
                    <div class="team-item rounded overflow-hidden" style="background-image: linear-gradient(180deg, #1575c1, #163284);border-radius: 80px 0px 0px 0px !important;background-size: cover;background-repeat: no-repeat;">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset($item->path . $item->foto) }}" alt="">
                            <div class="team-social">
                                <a class="btn btn-lg btn-primary btn-lg-square rounded" href="{{ url('tim-dokter/jadwal/' . $item->slug) }}" data-id_klinik="" style="width: -webkit-fill-available;"><i class="fas fa-calendar-alt"></i> Jadwal Praktek</a>
                            </div>
                        </div>
                        <div class="text-center py-4" style="font-size: 10px;max-height: 115px;min-height: 115px;">
                            {{-- <a href="#"> --}}
                                <h4 class="text-primary" style="font-size: 15px;">{{ $item->nama_pegawai }}</h4>
                            {{-- </a> --}}
                            <p class="text-uppercase m-0">{{ $item->spesialis }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5 mb-5">
        <div class="bg-white">
            <div class="owl-carousel vendor-carousel">
                @foreach ($vendor as $item)
                    <img src="{{ asset($item->path . $item->gambar) }}" alt="">    
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
{{-- <script>
    // Fungsi untuk mengambil data halaman melalui Ajax
    function getData(page) {
        // Menggunakan jQuery Ajax untuk melakukan permintaan Ajax ke server
        $.ajax({
            url: "{{ route('get-dokter') }}",
            method: "GET",
            data: { 
                page: page 
            },
            success: function(response) {
                // Memperbarui konten halaman dengan data yang diterima
                $('#dokter').html(response.dokter);

                // Memperbarui tautan pagination
                $('#pagination').html(response.pagination);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Fungsi untuk menangani klik pada tautan pagination
    function handlePaginationClick(event) {
        event.preventDefault();

        // Mengambil nomor halaman dari atribut data
        var page = $(this).data('page');

        // Memanggil fungsi getData dengan nomor halaman yang diperoleh
        getData(page);
    }

    // Menambahkan event listener ke tautan pagination
    $(document).on('click', '#pagination a', handlePaginationClick);

    // Memanggil fungsi getData untuk menampilkan konten halaman pertama
    getData(1);
</script> --}}
<script>
    $("#pencarian").on('keyup', function() {
        var term = $(this).val().toLowerCase();
        console.log(term);
        if (term != '') {
            $('.v_cari').each(function(){
                if ($(this).filter('[data-filter-name *= ' + term + ']').length > 0 || term.length < 1) {
                    console.log('muncul');
                    $(this).show(500);
                } else {
                    console.log('hilang');
                    $(this).hide(500);
                }
            });                    
        } else {
            $('.v_cari').each(function(){
                    console.log('muncul');
                    $(this).show(500);
            });
        }


        $('body,html').animate({
            scrollTop: 0
        }, 100);
    });
    
</script>
@endsection
