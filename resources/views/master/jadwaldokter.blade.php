@extends('layouts.app')

@section('custom_css')
<style>
    .font-logo{
        font-size: 165px;
        text-align: center;
        color: #009ef7;
    }

    .bulat{
        background: #fff;
        color: #000;
        font-size: 20px;
        border-radius: 50%;
        width: 63px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tambah{
        width: 100%;
        font-size: 32px;
        text-align: center;
        display: block;
        background: #e3e3e357 !important;
        color: #7239ea !important;
        border: 2px dashed !important;
    }

    @media (min-width: 992px) {
        .tombol-hapus{
            display: inline-grid;
            margin-left: 90px;
        }    
    }

    @media (max-width: 576px) {
        .tombol-hapus{
            display: inline-grid;
            margin-left: 110px;
        }    
    }
</style>
@endsection

@section('content')
<input type="hidden" value="{{ $pegawai->id_pegawai }}" id="pegawai">
<input type="hidden" value="{{ $klinik->id_klinik }}" id="klinik">

<div class="card card-flush shadow-sm">
    <div class="card-header pt-10" style="background: #fff;">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-circle me-5">
                <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                    <span class="svg-icon svg-icon-2x svg-icon-primary">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="black" />
                            <path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="black" />
                        </svg> --}}
                        <img alt="Image" src="{{ asset('front/img/logo_transparant.png') }}" style="height: 30px;">
                    </span>
                </div>
            </div>
            <div class="d-flex flex-column">
                <h2 class="mb-1">Daftar Jadwal Dokter {{ $pegawai->nama_pegawai }} <br>di {{ $klinik->nama }}</h2>
            </div>
        </div>

        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-orange" data-bs-toggle="modal" data-bs-target="#kt_modal_1" style="background: #ff7c00;color: #fff;">
                <i class="fa fa-plus" style="color: #fff"></i> Jadwal
            </button>
        </div>
    </div>
    {{-- <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        <div class="ribbon-label bg-danger" style="font-size: large;background-color:#d00 !important;">Master Layanan</div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-orange" data-bs-toggle="modal" data-bs-target="#kt_modal_1" style="background: #ff7c00;color: #fff;">
                <i class="fa fa-plus" style="color: #fff"></i> Layanan
            </button>
        </div>
    </div> --}}
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Hari</center></th>
                    <th><center>Jam Mulai</center></th>
                    <th><center>Jam Selesai</center></th>
                    <th><center>Estimasi Pengerjaan</center></th>
                    <th width="15%"><center>Detail</center></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH JADWAL DOKTER--}}
<div class="modal fade" tabindex="-1" id="kt_modal_1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Tambah Jadwal</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <input type="hidden" value="{{ $pegawai->id_pegawai }}" name="id_pegawai">
                    <input type="hidden" value="{{ $klinik->id_klinik }}" name="id_klinik">
                    <div class="row mb-10">
                        <label class="col-lg-4 col-form-label text-lg-end required">Hari :</label>
                        <div class="col-lg-6">
                            <select name="hari" data-dropdown-parent="#kt_modal_1" class="form-select form-select-solid">
                                <option value=""> - Pilih Hari - </option>
                                <option value="SENIN">Senin</option>
                                <option value="SELASA">Selasa</option>
                                <option value="RABU">Rabu</option>
                                <option value="KAMIS">Kamis</option>
                                <option value="JUMAT">Jum'at</option>
                                <option value="SABTU">Sabtu</option>
                                <option value="MINGGU">Minggu</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10" id="pilihjam" nama="pilihjam">
                        <label class="col-lg-4 col-form-label text-lg-end required">Jam Praktek :</label>
                        <div class="col-lg-4">
                            <input type="time" class="form-control" name="jam_buka" placeholder="Jam Mulai">
                        </div>
                        <div class="col-lg-4">
                            <input type="time" class="form-control" name="jam_tutup" placeholder="Jam Selesai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-4 col-form-label text-lg-end required">Estimasi Pengerjaan Per Pasien (Menit) :</label>
                        <div class="col-lg-4">
                            <input type="number" class="form-control" name="estimasi" placeholder="Estimasi (contoh : 60 Menit)">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT LAYANAN--}}
<div class="modal fade" tabindex="-1" id="kt_modal_edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Edit Layanan</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formedit">
                    <input type="hidden" class="form-control" id="id_jadwal" name="id_jadwal">
                    <input type="hidden" value="{{ $pegawai->id_pegawai }}" name="id_pegawai">
                    <input type="hidden" value="{{ $klinik->id_klinik }}" name="id_klinik">
                    <div class="row mb-10">
                        <label class="col-lg-4 col-form-label text-lg-end required">Hari :</label>
                        <div class="col-lg-6">
                            <select name="hari" id="hari" data-dropdown-parent="#kt_modal_edit" class="form-select form-select-solid">
                                <option value=""> - Pilih Hari - </option>
                                <option value="SENIN">Senin</option>
                                <option value="SELASA">Selasa</option>
                                <option value="RABU">Rabu</option>
                                <option value="KAMIS">Kamis</option>
                                <option value="JUMAT">Jum'at</option>
                                <option value="SABTU">Sabtu</option>
                                <option value="MINGGU">Minggu</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10" nama="pilihjam">
                        <label class="col-lg-4 col-form-label text-lg-end required">Jam Praktek :</label>
                        <div class="col-lg-4">
                            <input type="time" class="form-control" name="jam_buka" id="buka" placeholder="Jam Mulai">
                        </div>
                        <div class="col-lg-4">
                            <input type="time" class="form-control" name="jam_tutup" id="tutup" placeholder="Jam Selesai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-4 col-form-label text-lg-end required">Estimasi Pengerjaan Per Pasien (Menit) :</label>
                        <div class="col-lg-4">
                            <input type="number" class="form-control" name="estimasi" id="estimasi" placeholder="Estimasi (contoh : 60 Menit)">
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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
<script>
    var tabelData;

    $(function () {
        tabelData = $('#table').DataTable({
            language: {
                lengthMenu: "Show _MENU_",
            },
            dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">",
            ajax: {
                url : "{{ url('klinik/jadwal/dokter') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                    data.pegawai  = $('#pegawai').val();
                    data.klinik  = $('#klinik').val();
                }
            }
        });
    })

    // POST TAMBAH JADWAL
    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Jadwal Dokter ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Tambah!",
                closeOnConfirm: false,
                allowOutsideClick: false,
            }).then(function(result) {
                $('#loading').modal({backdrop:'static', keyboard:false});
                $('#loading').modal('show');
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url: "{{ url('klinik/jadwal/store') }}",
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
                                $('#kt_modal_1').modal('hide');
                                load_data_table();
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

    // VIEW EDIT LAYANAN
    $('#table').on('click', '.edit', function (e) {
        var jadwal = $(this).data('id_jadwal');

        $.ajax({
            url: "{{ url('klinik/jadwal/edit') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                jadwal: jadwal,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_jadwal').val(msg.id_jadwal_dokter);
                    $('#hari').val(msg.hari).trigger("change");;
                    $('#buka').val(msg.jam_buka);
                    $('#tutup').val(msg.jam_tutup);
                    $('#estimasi').val(msg.estimasi);

                }
                // Display Modal
                $('#kt_modal_edit').modal('show');
            }
        });
    });

    // POST EDIT LAYANAN
    $(function () {
        $("#formedit").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Merubah Jadwal Dokter ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Yakin!",
                closeOnConfirm: false,
                allowOutsideClick: false,
            }).then(function(result) {
                $('#loading').modal({backdrop:'static', keyboard:false});
                $('#loading').modal('show');
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url: "{{ url('klinik/jadwal/ubah') }}",
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
                                $('#kt_modal_edit').modal('hide');
                                load_data_table();
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

    // HAPUS LAYANAN
    function hapusJadwal(id_jadwal) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menghapus Jadwal Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('klinik/jadwal/hapus') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_jadwal
                    }
                })
                .done(function(hasil) {
                    var tittle = "";
                    var icon = "";

                    if (hasil.status == true) {
                        title = "Berhasil!";
                        icon = "success";

                        swal.fire({
                            title: title,
                            text: hasil.pesan,
                            icon: icon,
                            button: "OK!",
                        }).then(function(result) {
                            load_data_table();
                        })
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
    }


    function load_data_table() {
        tabelData.ajax.reload(null, 'refresh');
    }
</script>
@endsection