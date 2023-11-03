@extends('member.app')

@section('custom_css')
<style>
    .navbar-custom {
        background-image: url(../../front/navbarcustom1.png) !important;
        background-size: 100% 229px;
        background-repeat: no-repeat;
        background-position: center;
        height: 229px !important;
        width: 100%;
        position: relative;
        z-index: 3;
    }
    /* .navbar-custom {
        background: #06A3DA;
    } */
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

    .service-item {
        position: relative;
        height: 300px;
        padding: 0 30px;
        transition: .5s;
    }
</style>
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5">
                <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                    <h5 class="fw-bold text-primary text-uppercase">Layanan Kami</h5>
                    <h1 class="mb-0">Pilih layanan yang anda butuhkan</h1>
                </div>
                <div class="col-lg-12">
                    <input id="pencarian_layanan" type="text" class="form-control" placeholder="Cari layanan di sini . ." style="border-radius: 20px;display:block">
                </div>
                @foreach ($layanan as $item)
                <div class="col-lg-4 col-md-6 v_cari" data-filter-name="{{ strtolower($item->nama_layanan) }}">
                    {{-- <img class="img-fluid rounded" src="{{ asset('front/img/gelombang.png') }}" style="position: absolute;z-index: 1;margin-top: -1px;margin-left: -1px;height: 70px;" > --}}
                    {{-- <img class="img-fluid rounded" src="{{ asset('front/img/logo_bulat.png') }}" style="height: 80px;position: absolute;z-index:1;border-radius: 50% !important;border: 2px dashed #00378b" > --}}
                    <div class="service-item rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #00378b;border-radius: 55px 30px !important;margin: 25px;">
                        <div class="service-icon" style="transform: none;">
                            <img src="{{ asset($item->path . $item->icon)}}" style="width: 100px;border-radius: 50%;">
                        </div>
                        <h4 class="mb-3" style="color: #fff;">{{ $item->nama_layanan }}</h4>
                        <a class="btn btn-lg btn-primary rounded" href="" style="left: -10%;width: fit-content;margin-top: 24px;position: absolute;margin-bottom: 50px;font-size: 10px;color: #fff;">
                            Rp {{ number_format($item->harga, 0,",",".") }},-
                        </a>
                        <p class="m-0" style="color: #d8ff00;">{{ $item->keterangan }}</p>
                        <a class="btn btn-lg btn-primary rounded" href="{{ url('member-area/register/' . $item->slug_layanan . '/' . encrypt($item->id_layanan)) }}" style="width: fit-content;margin-left: -50px;font-size: 16px;margin-bottom: 5px;">
                            <i class="bi bi-arrow-right"></i> Register
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    $("#pencarian_layanan").on('keyup', function() {
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
