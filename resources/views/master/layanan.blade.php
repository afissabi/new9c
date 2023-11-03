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
<input type="hidden" class="form-control" id="kategori" value="">

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
                <h2 class="mb-1">Data Layanan Klinik</h2>
            </div>
        </div>

        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-orange" data-bs-toggle="modal" data-bs-target="#kt_modal_1" style="background: #ff7c00;color: #fff;">
                <i class="fa fa-plus" style="color: #fff"></i> Layanan
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
                    <th><center>Icon</center></th>
                    <th><center>Nama Layanan</center></th>
                    <th><center>Status</center></th>
                    <th><center>Harga / Tarif</center></th>
                    <th><center>Metode Bayar</center></th>
                    <th><center>Mapping</center></th>
                    <th><center>Tipe</center></th>
                    <th><center>Estimasi Waktu (Menit)</center></th>
                    <th width="15%"><center>Detail</center></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH LAYANAN--}}
<div class="modal fade" tabindex="-1" id="kt_modal_1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Tambah Layanan</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Tipe Layanan :</label>
                        <div class="col-lg-6">
                            <select name="tipe" data-control="select2" data-dropdown-parent="#kt_modal_1" data-placeholder="Pilih Tipe Layanan..." class="form-select form-select-solid" required>
                                <option value="">Pilih Tipe...</option>
                                <option value="UMUM">UMUM</option>
                                <option value="REKANAN">REKANAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Layanan :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="nama_layanan" placeholder="Nama Layanan">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Icon Layanan :</label>
                        <div class="col-lg-4">
                            <div class="mt-1">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('img/web/default.jpg' )}})">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url()"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="gambar" id="addgambar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="gambar_remove"/>
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batalkan">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            @error('image')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keterangan :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control form-control-solid" rows="3" name="keterangan" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Estimasi Waktu :</label>
                        <div class="col-lg-6">
                            <input type="number" class="form-control price" name="estimasi_waktu" placeholder="Estimasi Waktu (dalam menit)">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Tarif Layanan :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control price" name="harga" placeholder="Tarif Layanan">
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
                    <input type="hidden" class="form-control" id="id_layanan" name="id_layanan">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Tipe Layanan :</label>
                        <div class="col-lg-6">
                            <select name="tipe" id="tipe" data-control="select2" data-dropdown-parent="#kt_modal_edit" data-placeholder="Pilih Tipe Layanan..." class="form-select form-select-solid" required>
                                <option value="">Pilih Tipe...</option>
                                <option value="UMUM">UMUM</option>
                                <option value="REKANAN">REKANAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Layanan :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="nama_layanan" id="nama_layanan" placeholder="Nama Layanan">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Icon Layanan :</label>
                        <div class="col-lg-4">
                            <div class="mt-1">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('img/web/default.jpg' )}})">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url()"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="gambar" id="addgambar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="gambar_remove"/>
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batalkan">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            @error('image')
                                <div class="form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keterangan :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control form-control-solid" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Estimasi Waktu :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="estimasi_waktu" id="estimasi_waktu" placeholder="Estimasi Waktu (dalam menit)">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Tarif Layanan :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control price" id="harga" name="harga" placeholder="Tarif Layanan">
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

{{-- MODAL MAPPING KLINIK--}}
<div class="modal fade" tabindex="-1" id="kt_klinik" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Mapping Layanan Klinik</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formklinik">
                    <input type="hidden" class="form-control" id="id_layanan_klinik" name="id_layanan">
                    <div class="row mb-10" id="klinik">
                        
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

{{-- MODAL MAPPING DOKTER--}}
<div class="modal fade" tabindex="-1" id="kt_dokter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Mapping Layanan Dokter</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formdokter">
                    <input type="hidden" class="form-control" id="id_layanan_dokter" name="id_layanan">
                    <div class="row mb-10" id="dokter">
                        
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

{{-- MODAL METODE PEMBAYARAN --}}
<div class="modal fade" tabindex="-1" id="kt_metode" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Metode Pembayaran</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formbayar">
                    <input type="hidden" class="form-control" id="id_layanan_bayar" name="id_layanan">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Metode Pembayaran :</label>
                        <div class="col-lg-5">
                            <select name="jenis_pembayaran" id="jenis_pembayaran" data-control="select2" data-dropdown-parent="#kt_metode" data-placeholder="Pilih Metode Pembayaran..." class="form-select form-select-solid">
                                <option value="">Pilih Metode...</option>
                                <option value="CASH">CASH</option>
                                <option value="CICILAN">CICILAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10" id="cicilan" style="display: none">
                        <label class="col-lg-3 col-form-label text-lg-end required">DP/Tenor/Cicilan :</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control price" name="dp" placeholder="DP">
                        </div>
                        <div class="col-lg-2">
                            <input type="number" class="form-control" name="tenor" placeholder="Tenor">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control price" name="cicilan" placeholder="Cicilan">
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


{{-- MODAL MAPPING ESTIMASI WAKTU DAN DENTAL UNIT--}}
<div class="modal fade" tabindex="-1" id="kt_waktu" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Mapping Waktu dan Dental Unit</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formwaktu">
                    <input type="hidden" class="form-control" id="id_layanan_waktu" name="id_layanan">
                    <div class="row mb-10">
                        <label class="col-lg-4 col-form-label text-lg-end required">Pilih Klinik :</label>
                        <div class="col-lg-6" id="kliniknya">
                            
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-4 col-form-label text-lg-end required">Estimasi Waktu (Menit) :</label>
                        <div class="col-lg-6">
                            <input type="number" class="form-control price" name="estimasi_waktu" placeholder="Estimasi Waktu">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-4 col-form-label text-lg-end required">Jumlah DU tersedia :</label>
                        <div class="col-lg-6">
                            <input type="number" class="form-control price" name="jumlah_du" placeholder="Jumlah Dental Unit">
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
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-inline.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-balloon.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-balloon-block.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-document.bundle.js') }}"></script>
<script type="text/javascript">
    $("#jenis_pembayaran").change(function() {
        if ( $(this).val() == "CICILAN") {
            $("#cicilan").show();
        }else{
            $("#cicilan").hide();
        }
    });

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
    ClassicEditor
    .create(document.querySelector('#kt_docs_ckeditor_classic'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
</script>d
<script>
    ClassicEditor
    .create(document.querySelector('#kt_docs_ckeditor_classic_edit'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
</script>
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
                url : "{{ url('master/layanan/datatable') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                    // data.kategori  = $('#kategori').val();
                }
            },
            columnDefs: [{
                targets: [2, 3, 4],
                className: ''
            }]
        });
    })

    // POST TAMBAH LAYANAN
    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Layanan ?",
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
                        url: "{{ url('master/layanan/store') }}",
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
        var layanan = $(this).data('id_layanan');

        $.ajax({
            url: "{{ url('master/layanan/edit') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                layanan: layanan,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_layanan').val(msg.edit.id_layanan);
                    $('#nama_layanan').val(msg.edit.nama_layanan);
                    $('#keterangan').val(msg.edit.keterangan);
                    $('#harga').val(msg.harga);
                    $('#estimasi_waktu').val(msg.estimasi_waktu);
                    $('#tipe').val(msg.edit.tipe).trigger("change");

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
                text: "Merubah Data Layanan ?",
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
                        url: "{{ url('master/layanan/ubah') }}",
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
    function hapusLayanan(id_layanan) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menghapus Layanan Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('master/layanan/destroy') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_layanan
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

    // VIEW MAPPING KLINIK
    $('#table').on('click', '.klinik', function (e) {
        var layanan = $(this).data('id_layanan');

        $.ajax({
            url: "{{ url('master/layanan/klinik') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                layanan: layanan,
            },
            success: function(response){
                // Add response in Modal body
                if(response){
                    $('#klinik').html(response.html);
                    $('#id_layanan_klinik').val(response.id_layanan);
                }
                // Display Modal
                $('#kt_klinik').modal('show');
            }
        });
    });

    // VIEW MAPPING DOKTER
    $('#table').on('click', '.dokter', function (e) {
        var layanan = $(this).data('id_layanan');

        $.ajax({
            url: "{{ url('master/layanan/dokter') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                layanan: layanan,
            },
            success: function(response){
                // Add response in Modal body
                if(response){
                    $('#dokter').html(response.html);
                    $('#id_layanan_dokter').val(response.id_layanan);
                }
                // Display Modal
                $('#kt_dokter').modal('show');
            }
        });
    });

    // VIEW METODE BAYAR
    $('#table').on('click', '.metode', function (e) {
        var layanan = $(this).data('id_layanan');

        $.ajax({
            url: "{{ url('master/layanan/edit') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                layanan: layanan,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_layanan_bayar').val(msg.edit.id_layanan);
                }
                // Display Modal
                $('#kt_metode').modal('show');
            }
        });
    });

    // VIEW MAPPING WAKTU
    $('#table').on('click', '.waktu', function (e) {
        var layanan = $(this).data('id_layanan');

        $.ajax({
            url: "{{ url('master/layanan/klinik') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                layanan: layanan,
            },
            success: function(response){
                // Add response in Modal body
                if(response){
                    $('#kliniknya').html(response.klinik);
                    $('#id_layanan_waktu').val(response.id_layanan);
                }
                // Display Modal
                $('#kt_waktu').modal('show');
            }
        });
    });

    $(function () {
        $("#formklinik").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Layanan ke Klinik Tersebut ?",
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
                        url: "{{ url('master/layanan/mapping-klinik') }}",
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
                                $('#kt_klinik').modal('hide');
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

    $(function () {
        $("#formdokter").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Layanan ke Dokter Tersebut ?",
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
                        url: "{{ url('master/layanan/mapping-dokter') }}",
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
                                $('#kt_dokter').modal('hide');
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

    // POST EDIT METODE BAYAR
    $(function () {
        $("#formbayar").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menembah Metode Pembayaran ?",
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
                        url: "{{ url('master/layanan/tambah-metode-bayar') }}",
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
                                $('#kt_metode').modal('hide');
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

    // HAPUS METODE
    function hapusMetode(id_metode) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menghapus Metode Pembayaran Layanan Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('master/layanan/destroyMetode') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_metode
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

    function layananAktif(id_data) {
        var checkBox = document.getElementById("is_aktif");
        
        if (checkBox.checked == true){
            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Mengubah Status Menjadi Aktif ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Ubah!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('master/layanan/aktif') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: {
                            id : id_data
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
        } else {
            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Mengubah Status Menjadi Tidak Aktif ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Non Aktifkan!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('master/layanan/tidak-aktif') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: {
                            id : id_data
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
    }


    // POST MAPPING WAKTU DAN DENTAL UNIT
    $(function () {
        $("#formwaktu").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambahkan Mapping Tersebut ?",
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
                        url: "{{ url('master/layanan/tambah-estimasi-waktu') }}",
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
                                $('#kt_waktu').modal('hide');
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

    // HAPUS WAKTU
    function hapusWaktu(id_estimasi) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menghapus Mapping Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('master/layanan/destroyEstimasi') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_estimasi
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
</script>
@endsection