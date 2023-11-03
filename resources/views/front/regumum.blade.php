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
        border-color: #2F3A60 !important;
        background-color: #2F3A60 !important;
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

    .bg-yellow-turquoise {
        border-color: #ffe425 !important;
        background-image: none !important;
        background-color: #ffc107 !important;
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
{{-- <a href="{{ url('/register') }}"><img class="img-fluid rounded btn-reg" src="{{ asset('front/img/regnow.png') }}" style="width: 125px;" ></a> --}}
@endsection
@section('content')

<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;border: 1px dashed #3ebcec;margin-top: 10px;padding: 20px;background: #06a3da14;">
            <i class="fas fa-clipboard-check" style="font-size: 35px;color: #06a3da;"></i>
            <h5 class="fw-bold text-primary text-uppercase">HALAMAN REGISTRASI PASIEN </h5>
            <input type="hidden" value="{{ $id_layanan }}" id="layanan" >
        </div>
        
        <div class="row g-5" id="pilihklinik">
            <center><h4 class="mb-3" style="font-family: inherit;">PILIH KLINIK</h4><p>Pilih Klinik Tempat Anda Melalukan Perawatan</p><center>
            <div class="row g-5" id="klinik">                
            
            </div>
        </div>

        <div id="pilihlayanan">
            <div id="kembali_layanan" class="mb-3"></div>
            <center><h4 class="mb-3" style="font-family: inherit;">PILIH LAYANAN</h4><p>Pilih Layanan Yang Sesuai Kebutuhan Anda</p><center>
            <div class="row g-0" id="layananList" style="margin-left: 20px;">
            
            </div>
        </div>

        <div id="pilihtanggal">
            <div id="kembali_tanggal" class="mb-3"></div>
            <center><h4 class="mb-3" style="font-family: inherit;">PILIH TANGGAL</h4><p>Pilih Tanggal Untuk Melakukan Perawatan</p>
                <div style="font-size: 20px;margin-top: -20px;margin-bottom: 20px;font-weight: bold;" id="rawat"></div>
            <center>
            <div class="row g-0" id="tanggal" style="margin-left: 20px;">
            
            </div>
        </div>
        <div id="pilihjam">
            <div id="kembali_jam" class="mb-3"></div>
            <center><h4 class="mb-3" style="font-family: inherit;">PILIH JAM</h4><p>Pilih Jam Untuk Melakukan Perawatan</p>
                <div style="font-size: 20px;margin-top: -20px;margin-bottom: 20px;font-weight: bold;" id="rawatjam"></div>
            <center>
            <div class="row g-0" id="jam" style="margin-left: 20px;">
            
            </div>
        </div>
        <div id="regform">
            <div id="kembali_form" class="mb-3"></div>
            <center><h4 class="mb-3" style="font-family: inherit;">FORM PENDAFTARAN PASIEN</h4><p>Masukkan Informasi Data Diri Anda...</p><center>
            <div class="row g-0" style="margin-left: 20px;">
                <div id="tabel" class="table-responsive"></div>
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    {{ csrf_field() }}
                    <div id="register"></div>
                    <a href="{{ url('') }}" class="btn btn-warning">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Loading Klinik--}}
<div class="modal fade" tabindex="-1" id="loading_klinik" style="">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-body">
                <center>
                    <i class="fa fa-spinner fa-spin" style="font-size: 85px;color: cadetblue;"></i>
                    <br><br>
                    <h3 style="color: #ffffff;background: cadetblue;">Mencari Klinik...</h3>
                </center>
            </div>
        </div>
    </div>
</div>

{{-- Modal Loading Tanggal--}}
<div class="modal fade" tabindex="-1" id="loading_tanggal" style="">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-body">
                <center>
                    <i class="fa fa-spinner fa-spin" style="font-size: 85px;color: cadetblue;"></i>
                    <br><br>
                    <h3 style="color: #ffffff;background: cadetblue;">Mencari Tanggal...</h3>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(window).on('load', function() {
        klinik();
    });

    $("#pencarian_layanan").on('keyup', function() {
        var term = $(this).val().toLowerCase();
        console.log(term);
        if (term != '') {
            $('.v_cari_layanan').each(function(){
                if ($(this).filter('[data-filter-name *= ' + term + ']').length > 0 || term.length < 1) {
                    console.log('muncul');
                    $(this).show(500);
                } else {
                    console.log('hilang');
                    $(this).hide(500);
                }
            });                    
        } else {
            $('.v_cari_layanan').each(function(){
                    console.log('muncul');
                    $(this).show(500);
            });
        }

        $('body,html').animate({
            scrollTop: 0
        }, 100);
    });
    
    function klinik() {
        $('#pilihklinik').show();
        $('#pilihlayanan').hide();
        $('#pilihtanggal').hide();
        $('#pilihjam').hide();
        $('#regform').hide();
        // $('#loading_klinik').modal('show');
        $.ajax({
            url: "{{ url('/get-reg-klinik') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                layanan : $('#layanan').val()
            },

            success: function(response){
                $('#klinik').html(response);
                $('#loading_klinik').modal('hide');
            }
        });
    }

    $('#pilihklinik').on('click', '.layanan', function (e) {
        var klinik = $(this).data('id_klinik');
        $('#pilihklinik').hide();
        $('#pilihlayanan').show();
        $('#pilihtanggal').hide();
        $('#pilihjam').hide();
        $('#regform').hide();
        // $('#loading_tanggal').modal({backdrop:'static', keyboard:false});
        // $('#loading_tanggal').modal('show');
        $.ajax({
            url: "{{ url('get-reg-layanan') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                klinik : klinik,
            },
            success: function(response){
                // $('#loading_tanggal').modal('hide');
                $('#layananList').html(response.html);
                $('#kembali_layanan').html(response.kembali);
            }
        });
    });

    $('#pilihklinik').on('click', '.tanggal', function (e) {
        var klinik = $(this).data('id_klinik');
        var layanan = $(this).data('id_layanan');
        $('#pilihklinik').hide();
        $('#pilihlayanan').hide();
        $('#pilihtanggal').show();
        $('#pilihjam').hide();
        $('#regform').hide();
        // $('#loading_tanggal').modal({backdrop:'static', keyboard:false});
        // $('#loading_tanggal').modal('show');
        $.ajax({
            url: "{{ url('get-reg-tanggal') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                klinik : klinik,
                layanan : layanan,
            },
            success: function(response){
                // $('#loading_tanggal').modal('hide');
                $('#tanggal').html(response.html);
                $('#rawat').html(response.rawat);
                $('#kembali_tanggal').html(response.kembali);
            }
        });
    });

    $('#pilihlayanan').on('click', '.tanggal', function (e) {
        var klinik = $(this).data('id_klinik');
        var layanan = $(this).data('id_layanan');

        $('#pilihklinik').hide();
        $('#pilihlayanan').hide();
        $('#pilihtanggal').show();
        $('#pilihjam').hide();
        $('#regform').hide();
        // $('#loading_tanggal').modal({backdrop:'static', keyboard:false});
        // $('#loading_tanggal').modal('show');
        $.ajax({
            url: "{{ url('get-reg-tanggal') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                klinik : klinik,
                layanan : layanan,
            },
            success: function(response){
                // $('#loading_tanggal').modal('hide');
                $('#tanggal').html(response.html);
                $('#rawat').html(response.rawat);
                $('#kembali_tanggal').html(response.kembali);
            }
        });
    });

    $('#pilihtanggal').on('click', '.jam', function (e) {
        var layanan = $(this).data('id_layanan');
        var klinik = $(this).data('id_klinik');
        var tanggal = $(this).data('tanggal');
        var hari = $(this).data('hari');

        $('#pilihklinik').hide();
        $('#pilihlayanan').hide();
        $('#pilihtanggal').hide();
        $('#pilihjam').show();
        $('#regform').hide();
        // $('#loading_tanggal').modal({backdrop:'static', keyboard:false});
        // $('#loading_tanggal').modal('show');
        $.ajax({
            url: "{{ url('get-reg-jam') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                klinik : klinik,
                layanan : layanan,
                tanggal : tanggal,
                hari : hari,
            },
            success: function(response){
                // $('#loading_tanggal').modal('hide');
                $('#jam').html(response.html);
                $('#rawatjam').html(response.rawat);
                $('#kembali_jam').html(response.kembali);
            }
        });
    });

    $('#pilihjam').on('click', '.register', function (e) {
        var layanan = $(this).data('id_layanan');
        var klinik = $(this).data('id_klinik');
        var tanggal = $(this).data('tanggal');
        var jam = $(this).data('jam');

        $('#pilihklinik').hide();
        $('#pilihlayanan').hide();
        $('#pilihtanggal').hide();
        $('#pilihjam').hide();
        $('#regform').show();
        // $('#loading_tanggal').modal({backdrop:'static', keyboard:false});
        // $('#loading_tanggal').modal('show');
        $.ajax({
            url: "{{ url('get-layanan-register') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                layanan : layanan,
                klinik : klinik,
                tanggal : tanggal,
                jam : jam,
            },
            success: function(response){
                // $('#loading_tanggal').modal('hide');
                $('#tabel').html(response.tabel);
                $('#register').html(response.html);
                $('#kembali_form').html(response.kembali);
            }
        });
    });

    function pilihMetode() {
        $.ajax({
            url: "{{ url('get-metode-bayar-layanan') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                tipe : $('#tipe_bayar').val(),
            },
            success: function(response){
                $('#total_bayar').html(response);
            }
        });
    }
    
    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Anda akan mendaftar",
                text: "Untuk Layanan tersebut ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Daftar!",
                closeOnConfirm: false,
                allowOutsideClick: false,
            }).then(function(result) {
                // $('#loading').modal({backdrop:'static', keyboard:false});
                // $('#loading').modal('show');
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url: "{{ url('simpan-register/layanan') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";
                        $('#loading').modal('hide');

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                                allowOutsideClick: false,
                            }).then(function() {
                                window.location.href = `{{ url('thanks') }}`
                            });
                        } else {
                            title = "Gagal!";
                            icon = "error";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            })
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        errorNotification();
                    });
                }
            });
        });
    })
</script>
@endsection
