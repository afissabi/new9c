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
<input type="hidden" class="form-control" id="klinik" value="{{ $klinik->id_klinik }}">

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
                <h2 class="mb-1">DAFTAR LAYANAN DI KLINIK </h2>
                <div class="text-muted fw-bolder">
                    <a href="#">{{ $klinik->tipe }}</a>
                    <span class="mx-3">|</span>
                    <a href="#">{{ $klinik->nama }}</a>
                    <span class="mx-3">|</span>
                    <a href="#">{{ $klinik->alamat }}</a>
                </div>
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-orange" data-bs-toggle="modal" data-bs-target="#kt_modal_1" style="background: #ff7c00;color: #fff;">
                <i class="fa fa-plus" style="color: #fff"></i> Layanan Klinik
            </button>
        </div>
    </div>
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Nama Layanan</center></th>
                    <th><center>Dokter Penyelia</center></th>
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
                        <label class="col-lg-3 col-form-label text-lg-end required">PILIH LAYANAN :</label>
                        <div class="col-lg-5">
                            {{-- <select name="jabatan" id="jabatan" data-control="select2" data-dropdown-parent="#kt_modal_1" data-placeholder="Pilih Jabatan..." class="form-select form-select-solid">
                                <option value="">Pilih Layanan...</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Dokter Penyelia :</label>
                        <div class="col-lg-5">
                            {{-- <input type="text" class="form-control" name="spesialis" placeholder="Keahlian / Spesialis Pegawai"> --}}
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
    // load_data_table();

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
                url : "{{ url('klinik/detail/data-layanan') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                    data.klinik = $('#klinik').val();
                }
            },
            // columnDefs: [{
            //     targets: [2, 3, 4],
            //     className: ''
            // }]
        });
    })

    function load_data_table() {
        tabelData.ajax.reload(null, 'refresh');
    }
</script>

@endsection