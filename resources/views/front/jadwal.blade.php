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

@section('content')

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="tile bg-red-turquoise jadwal" style="background: #8ACCFF; width:110px; height:110px;" data-tanggal="" data-disabled="">
            <div class="corner" style="float: left; font-weight: bold; color:#fff">
                <span>Senin</span>
            </div>
            <div class="corner" style="float: right; font-weight: bold; color:#fff">
                <span>2</span>
            </div>
            <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                <i style="font-style:normal;">2</i>
            </div>
            <div class="tile-object">
                <div class="name">bulan</div>
                <div class="number">tahun</div>
            </div>
        </div>
        <div class="tile bg-red-turquoise jadwal" style="background: #8ACCFF; width:110px; height:110px;" data-tanggal="" data-disabled="">
            <div class="corner" style="float: left; font-weight: bold; color:#fff">
                <span>Senin</span>
            </div>
            <div class="corner" style="float: right; font-weight: bold; color:#fff">
                <span>2</span>
            </div>
            <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                <i style="font-style:normal;">2</i>
            </div>
            <div class="tile-object">
                <div class="name">bulan</div>
                <div class="number">tahun</div>
            </div>
        </div>
        <div class="tile bg-red-turquoise jadwal" style="background: #8ACCFF; width:110px; height:110px;" data-tanggal="" data-disabled="">
            <div class="corner" style="float: left; font-weight: bold; color:#fff">
                <span>Senin</span>
            </div>
            <div class="corner" style="float: right; font-weight: bold; color:#fff">
                <span>2</span>
            </div>
            <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                <i style="font-style:normal;">2</i>
            </div>
            <div class="tile-object">
                <div class="name">bulan</div>
                <div class="number">tahun</div>
            </div>
        </div>
        <div class="tile bg-red-turquoise jadwal" style="background: #8ACCFF; width:110px; height:110px;" data-tanggal="" data-disabled="">
            <div class="corner" style="float: left; font-weight: bold; color:#fff">
                <span>Senin</span>
            </div>
            <div class="corner" style="float: right; font-weight: bold; color:#fff">
                <span>2</span>
            </div>
            <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                <i style="font-style:normal;">2</i>
            </div>
            <div class="tile-object">
                <div class="name">bulan</div>
                <div class="number">tahun</div>
            </div>
        </div>
        <div class="tile bg-red-turquoise jadwal" style="background: #8ACCFF; width:110px; height:110px;" data-tanggal="" data-disabled="">
            <div class="corner" style="float: left; font-weight: bold; color:#fff">
                <span>Senin</span>
            </div>
            <div class="corner" style="float: right; font-weight: bold; color:#fff">
                <span>2</span>
            </div>
            <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                <i style="font-style:normal;">2</i>
            </div>
            <div class="tile-object">
                <div class="name">bulan</div>
                <div class="number">tahun</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
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
