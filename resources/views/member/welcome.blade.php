@extends('member.app')

@section('custom_css')
    <style>
        .btn-icon{
            background: #ffffff;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            position: absolute;
            margin-top: -45px;
            margin-left: -30px;
            box-shadow: 0px 2px 2px 3px #b5b5b5d4;
        }

        @media (max-width: 991.98px){
            .header-tablet-and-mobile-fixed.toolbar-tablet-and-mobile-fixed .wrapper {
                padding-top: calc(0px + var(--kt-toolbar-height-tablet-and-mobile));
            }
        }
        
        #picture__input {
            display: none; 
        }
    
        .picture {
            width: 300px;
            aspect-ratio: 16/9;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            border: 2px dashed currentcolor;
            cursor: pointer;
            font-family: sans-serif;
            transition: color 300ms ease-in-out, background 300ms ease-in-out;
            outline: none;
            overflow: hidden;
        }
    
        .picture:hover {
            color: #777;
            background: #ccc;
        }
    
        .picture:active {
            border-color: turquoise;
            color: turquoise;
            background: #eee;
        }
    
        .picture:focus {
            color: #777;
            background: #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    
        .picture__img {
            max-width: 100%;
        }
    </style>
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row mb-3">
                <div class="col-md-6 fv-row mb-2">
                    <div class="card card-bordered">
                        <div class="card-header justify-content-end ribbon ribbon-start">
                            <div class="ribbon-label bg-primary">Riwayat Pendaftaran Terakhir</div>
                        </div>
                    
                        <div class="card-body" id="riwayat_registrasi">
                            
                        </div>
                        <div class="card-footer" style="padding: 0px;">
                            <a href="{{ url('member-area/riwayat-pendaftaran') }}" class="btn btn-block btn-info" style="width: -webkit-fill-available;margin: 0px;border-radius: 0px;"><i class="fas fa-eye"></i> Detail Riwayat Pendaftaran</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 fv-row mb-2">
                    <div class="card card-bordered">
                        <div class="card-header justify-content-end ribbon ribbon-start" style="background: #005c47;">
                            <div class="ribbon-label bg-primary" style="background: #d1f700 !important;color: #000;">Pembayaran</div>
                        </div>
                    
                        <div class="card-body">
                            <div id="pembayaran">

                            </div>
                            <div id="cicilan">
                                
                            </div>
                        </div>

                        <div class="card-footer" style="padding: 0px;">
                            <a href="{{ url('member-area/riwayat-pembayaran') }}" class="btn btn-block btn-info" style="width: -webkit-fill-available;margin: 0px;border-radius: 0px;"><i class="fas fa-eye"></i> Detail Pembayaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- MODAL PEMBAYARAN--}}
<div class="modal fade" tabindex="-1" id="kt_modal_edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Lakukan Pembayaran</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                {{-- <form method="post" class="kt-form kt-form--label-right" id="formedit"> --}}
                    <input type="hidden" class="form-control" id="id_pembayaran" name="id_pembayaran">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nominal Tagihan :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control price" name="nominal" id="nominal" placeholder="Nominal" placeholder>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Catatan :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="catatan" id="catatan" placeholder="Catatan">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Qris :</label>
                        <div class="col-lg-6" style="">
                            <img src="{{ asset('front/img/qris.png') }}" style="width: 100%;margin: auto;border: 1px dashed;"><br>
                            <a href="{{ asset('front/img/qris.png') }}" download="Qris Klinik 9C ORTHODONTI" class="btn btn-success" style="padding: 5px;font-size: 9px;color: #000;"><i class="fa fa-download text-dark"></i> Qris</a>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Transfer :</label>
                        <div class="col-lg-4" style="border: 1px dashed;border-radius: 5px;padding: 10px;">
                            Mandiri <br>
                            Ac. 1420.59090.9999 <br>
                            An PT Nancy Sinergy Group <br>
                            <input type="text" class="form-control" id="rekMandiri" value="1420590909999" style="display: none">
                            <button class="btn btn-success" onclick="copyMandiri()" style="padding: 5px;font-size: 9px;color: #000;">Copy Rekening Mandiri</button>
                        </div>
                        <div class="col-lg-4" style="border: 1px dashed;border-radius: 5px;padding: 10px;">
                            BCA <br>
                            010-2341226 <br>
                            An NANCY SINERGI GRUP PT<br>
                            <input type="text" class="form-control" id="rekBca" value="0102341226" style="display: none">
                            <button class="btn btn-success" onclick="copyBca()" style="padding: 5px;font-size: 9px;color: #000;">Copy Rekening BCA</button>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button> --}}
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>


{{-- MODAL KONFIRMASI PEMBAYARAN--}}
<div class="modal fade" tabindex="-1" id="kt_modal_konfirm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formkonfirm">
                    <input type="hidden" class="form-control" id="id_pembayaran_konfirm" name="id_pembayaran">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Tanggal Pembayaran/Transfer :</label>
                        <div class="col-lg-9">
                            <input type="date" class="form-control" name="tgl_bayar" id="tgl_bayar_konfirm" placeholder="Tanggal Bayar" required>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nominal :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control price" name="nominal" id="nominal_konfirm" placeholder="Nominal" readonly>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Catatan :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="catatan" id="catatan_konfirm" placeholder="Catatan" readonly>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end">Upload Bukti Transfer :</label>
                        <div class="col-lg-6" style="">
                            <label class="picture" for="picture__input" tabIndex="0">
                                <span class="picture__image"></span>
                            </label>
                            <input type="file" name="gambar" id="picture__input" accept="image/png, image/gif, image/jpeg" required>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Loading --}}
<div class="modal fade" tabindex="-1" id="loading" style="">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 85%;background-color: rgba(0,0,0,.0001) !important;box-shadow: none;">
            <div class="modal-body">
                <center>
                    <i class="fa fa-spinner fa-spin" style="font-size: 85px;color: cadetblue;"></i>
                    <br><br>
                    <h3 style="color: #ffffff;background: cadetblue;">Proses menyimpan data...</h3>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script type="text/javascript">
    $(function(){
        $('input.price').keyup(function(event) {
            //$(this).val(formatNumber($(this).val()));
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            });
        })
    })
</script>
<script>
    const inputFile = document.querySelector("#picture__input");
    const pictureImage = document.querySelector(".picture__image");
    const pictureImageTxt = "Pilih Gambar";
    pictureImage.innerHTML = pictureImageTxt;

    inputFile.addEventListener("change", function (e) {
    const inputTarget = e.target;
    const file = inputTarget.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function (e) {
        const readerTarget = e.target;

        const img = document.createElement("img");
        img.src = readerTarget.result;
        img.classList.add("picture__img");

        pictureImage.innerHTML = "";
        pictureImage.appendChild(img);
        });

        reader.readAsDataURL(file);
    } else {
        pictureImage.innerHTML = pictureImageTxt;
    }
    });

</script>
<script>
    function copyMandiri() {
        var copyText = document.getElementById("rekMandiri");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        alert("Copied : " + copyText.value);
    }

    function copyBca() {
        var copyText = document.getElementById("rekBca");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        alert("Copied : " + copyText.value);
    }

    $(window).on('load', function() {
        LastReg();
        LastPay();
    });

    function LastReg() {
        var need = 3;

        $.ajax({
            url: "{{ url('member-area/last-register') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                need : need,
            },

            success: function(response){
                $('#riwayat_registrasi').html(response);
            }
        });
    }

    function LastPay() {
        $.ajax({
            url: "{{ url('member-area/last-pay') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                
            },

            success: function(response){
                $('#pembayaran').html(response.last);
                $('#cicilan').html(response.cicil);
            }
        });
    }

    $('#pembayaran').on('click', '.bayar', function (e) {
        var id = $(this).data('id_pembayaran');

        $.ajax({
            url: "{{ url('member-area/bayar') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                id: id,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_pembayaran').val(msg.id_pembayaran);
                    $('#nominal').val(msg.nilai);
                    $('#catatan').val(msg.keterangan);

                }
                // Display Modal
                $('#kt_modal_edit').modal('show');
            }
        });
    });

    $('#pembayaran').on('click', '.konfirm', function (e) {
        var id = $(this).data('id_pembayaran');

        $.ajax({
            url: "{{ url('member-area/bayar') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                id: id,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_pembayaran_konfirm').val(msg.id_pembayaran);
                    $('#nominal_konfirm').val(msg.nilai);
                    $('#catatan_konfirm').val(msg.keterangan);

                }
                // Display Modal
                $('#kt_modal_konfirm').modal('show');
            }
        });
    });

    $('#cicilan').on('click', '.bayar', function (e) {
        var id = $(this).data('id_pembayaran');

        $.ajax({
            url: "{{ url('member-area/bayar') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                id: id,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_pembayaran').val(msg.id_pembayaran);
                    $('#nominal').val(msg.nilai);
                    $('#catatan').val(msg.keterangan);

                }
                // Display Modal
                $('#kt_modal_edit').modal('show');
            }
        });
    });

    $('#cicilan').on('click', '.konfirm', function (e) {
        var id = $(this).data('id_pembayaran');

        $.ajax({
            url: "{{ url('member-area/bayar') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                id: id,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_pembayaran_konfirm').val(msg.id_pembayaran);
                    $('#nominal_konfirm').val(msg.nilai);
                    $('#catatan_konfirm').val(msg.keterangan);

                }
                // Display Modal
                $('#kt_modal_konfirm').modal('show');
            }
        });
    });

    // POST TAMBAH KONTEN
    $(function () {
        $("#formkonfirm").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Mengkonfirmasi pembayaran tersebut ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Yakin!",
                closeOnConfirm: false,
                allowOutsideClick: false,
            }).then(function(result) {
                // $('#loading').modal({backdrop:'static', keyboard:false});
                $('#loading').modal('show');
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url: "{{ url('konfirmasi-pembayaran/konfirmasi-pembayaran') }}",
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
                                $('#loading').modal('hide');
                                $('#kt_modal_konfirm').modal('hide');
                                window.location.href = `{{ url('/home-member') }}`
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
