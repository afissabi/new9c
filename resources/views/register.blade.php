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
<div class="card bgi-no-repeat bgi-position-x-end bgi-size-cover" style="background-color: #19335c;background-size: auto 100%; background-image: url({{ asset('img/taieri.svg') }})">
    <div class="card-body container-xxl pt-10 pb-8">
        <div class="row mb-3" style="background: #ffffff82;border-radius: 5px;padding: 10px;">
            <div class="col-md-3 fv-row mb-2">
                <label class="fs-5 fw-bold mb-2">Pilih Tipe</label>
                <select name="tipe" id="tipe" class="form-select form-select-solid" required>
                    <option value="">- PILIH TIPE -</option>
                    <option value="LAYANAN">LAYANAN</option>
                    <option value="PROMO">PROMO</option>
                </select>
            </div>
            <div class="col-md-5 fv-row mb-2">
                <label class="fs-5 fw-bold mb-2">Pilih Jenis Tipe</label>
                <select name="jenis_tipe" id="jenis_tipe" class="form-select form-select-solid">
                    <option value="">- PILIH JENIS TIPE -</option>
                </select>
            </div>
            <div class="col-md-3 fv-row mb-2">
                <label class="fs-5 fw-bold mb-2">STATUS</label>
                <select name="status" id="status" class="form-select form-select-solid">
                    <option value="">SEMUA</option>
                    <option value="0">MENUNGGU</option>
                    <option value="1">DITERIMA</option>
                    <option value="2">DITOLAK</option>
                </select>
            </div>
            <input type="hidden" value="1" id="filter">
            <div class="col-md-2 fv-row mb-2">
                <button type="button" class="btn btn-block btn-info" onclick="cariByPeriode()" style="margin-top: 30px;">Filter</button>
            </div>
        </div>
    </div>
</div>
<div class="card card-flush shadow-sm">
    <div class="card-header pt-10" style="background: #fff;">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-circle me-5">
                <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                    <span class="svg-icon svg-icon-2x svg-icon-primary">
                        <img alt="Image" src="{{ asset('front/img/logo_transparant.png') }}" style="height: 30px;">
                    </span>
                </div>
            </div>
            <div class="d-flex flex-column">
                <h2 class="mb-1">Data Register Pasien</h2>
            </div>
        </div>

        <div class="card-toolbar">
            {{-- <button type="button" class="btn btn-sm btn-orange" data-bs-toggle="modal" data-bs-target="#kt_modal_1" style="background: #ff7c00;color: #fff;">
                <i class="fa fa-plus" style="color: #fff"></i> Promo
            </button> --}}
        </div>
    </div>
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Tipe Pendaftaran</center></th>
                    <th><center>Klinik</center></th>
                    <th><center>Tanggal Daftar</center></th>
                    <th><center>Layanan/Promo</center></th>
                    <th><center>Waktu</center></th>
                    <th><center>Pasien</center></th>
                    <th><center>Metode Pembayaran yang dipilih</center></th>
                    <th><center>Status</center></th>
                    <th width="15%"><center>Detail</center></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL RESCHEDULE--}}
<div class="modal fade" tabindex="-1" id="kt_rejadwal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Jadwal Ulang Pasien</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formrejadwal">
                    <input type="hidden" class="form-control" id="id_reg" name="id_register">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Pasien:</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="nama_pasien" name="nama" placeholder="Nama Pasien" readonly>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Jadwal Sebelumnya :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="klinik_saat_ini" name="" placeholder="Klinik" readonly>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Jadwal Sebelumnya :</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" id="tgl_saat_ini" name="" placeholder="Tanggal" readonly>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" id="jam_saat_ini" name="" placeholder="Jam" readonly>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Jadwal Baru :</label>
                        <div class="col-lg-9">
                            <select data-control="select2" name="klinik" id="klinik" data-dropdown-parent="#kt_rejadwal" data-placeholder="Pilih Klinik..." class="form-select form-select-solid">
                                @foreach ($klinik as $item)
                                    <option value="{{ $item->id_klinik }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Jadwal Baru :</label>
                        <div class="col-lg-3">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal">
                        </div>
                        <div class="col-lg-3">
                            <input type="time" class="form-control" id="jam" name="jam" placeholder="Jam">
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
@endsection

@section('custom_js')
<script>
    var tabelData;
    var filter_tipe = null;
    var filter_jenis  = null;
    var filter_status  = null;
    var filter_filter  = null;

    $("#tipe").change(function() {
        if ( $(this).val() == "LAYANAN") {
            $.ajax({
                url: "{{ url('master/layanan/select-layanan') }}",
                type: "get",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    
                },

                success: function(response){
                    $('#jenis_tipe').html(response);
                }
            });
        }else{
            $.ajax({
                url: "{{ url('promo-master/select-promo') }}",
                type: "get",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    
                },

                success: function(response){
                    $('#jenis_tipe').html(response);
                }
            });
        }
    });

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
                url : "{{ url('data-registrasi/datatable') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                    data.tipe   = filter_tipe;
                    data.jenis  = filter_jenis;
                    data.status = filter_status;
                    data.filter = filter_filter;
                }
            },
            columnDefs: [{
                targets: [2, 3, 4],
                className: ''
            }]
        });
    })

    function Terima(id_reg) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menerima Pendaftaran Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Terima!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('data-registrasi/terima') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_reg
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

    function Tolak(id_reg) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menolak Pendaftaran Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Tolak!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('data-registrasi/tolak') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_reg
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

    function Hapus(id_reg) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menghapus Pendaftaran Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('data-registrasi/hapus') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_reg
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

    // VIEW EDIT PEGAWAI
    $('#table').on('click', '.rejadwal', function (e) {
        var reg = $(this).data('id_reg');

        $.ajax({
            url: "{{ url('data-registrasi/reschedule') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                reg: reg,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_reg').val(msg.cek.id_t_register);
                    $('#nama_pasien').val(msg.nama);
                    $('#klinik_saat_ini').val(msg.klinik);
                    $('#tgl_saat_ini').val(msg.tanggal);
                    $('#jam_saat_ini').val(msg.jam);
                    $('#klinik').val(msg.cek.id_klinik).trigger("change");
                    $('#jam').val(msg.cek.jam);
                    $('#tanggal').val(msg.cek.tanggal);

                }
                // Display Modal
                $('#kt_rejadwal').modal('show');
            }
        });
    });

    // POST EDIT JABATAN
    $(function () {
        $("#formrejadwal").submit(function(e) {
            e.preventDefault();

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Mereschedule Jadwal tersebut",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Yakin!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('data-registrasi/simpan-reschedule') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: $('#formrejadwal').serialize()
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
                            }).then(function() {
                                $('#kt_rejadwal').modal('hide');
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

    function load_data_table() {
        tabelData.ajax.reload(null, 'refresh');
    }

    function cariByPeriode() {
        filter_tipe  = $('#tipe').val();
        filter_jenis  = $('#jenis_tipe').val();
        filter_status = $('#status').val();
        filter_filter = $('#filter').val();
        
        tabelData.ajax.reload(null, 'refresh');
    }
</script>
@endsection