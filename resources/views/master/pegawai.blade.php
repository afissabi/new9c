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
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <i class="fas fa-users-cog font-logo" ></i>
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">Daftar Pegawai</a>
                            <a href="#">
                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                        <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                        <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                    </svg>
                                </span>
                            </a>
                            {{-- <a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade to Pro</a> --}}
                        </div>
                    </div>
                    <div class="d-flex my-4">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                            <i class="fa fa-plus" style="color: #fff"></i> Pegawai
                        </button>
                    </div>
                </div>
                <div class="d-flex flex-wrap flex-stack">
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="d-flex flex-wrap">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calculator" style="margin-right: 10px;color: #009ef7;"></i>
                                    <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $total[0]->total }}" data-kt-countup-prefix="">0</div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">Total</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-toggle-on" style="margin-right: 10px;color: #00c94d;"></i>
                                    <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $total[0]->aktif }}">0</div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">Aktif</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-power-off" style="margin-right: 10px;color: #f70029;"></i>
                                    <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $total[0]->tidak_aktif }}" data-kt-countup-prefix="">0</div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">Tidak Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-flush shadow-sm">
    <div class="card-body py-5 table-responsive">
        <div class="row" id="jabatan">
            <div class="col-md-3 mb-5">
                <a href="#" class="tambah btn btn-info" data-bs-toggle="modal" data-bs-target="#kt_tambah_jabatan">
                    +
                </a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="card card-flush shadow-sm">
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    <th><center>Foto</center></th>
                    <th><center>NIK Pegawai</center></th>
                    <th><center>Nama Pegawai</center></th>
                    <th><center>Jabatan</center></th>
                    <th><center>Status</center></th>
                    <th><center>Klinik</center></th>
                    <th width="15%"><center>Detail</center></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH PEGAWAI--}}
<div class="modal fade" tabindex="-1" id="kt_modal_1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Tambah Pegawai</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">NIK Pegawai :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="nik" placeholder="NIK Pegawai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Pegawai :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="nama_pegawai" placeholder="Nama Pegawai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Jabatan :</label>
                        <div class="col-lg-5">
                            <select name="jabatan" id="jabatan" data-control="select2" data-dropdown-parent="#kt_modal_1" data-placeholder="Pilih Jabatan..." class="form-select form-select-solid">
                                <option value="">Pilih Jabatan...</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keahlian / Spesialis :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="spesialis" placeholder="Keahlian / Spesialis Pegawai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Foto Pegawai :</label>
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
                        <label class="col-lg-3 col-form-label text-lg-end required">Tanggal Lahir :</label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir Pegawai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Alamat :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control form-control-solid" rows="3" name="alamat" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Telp :</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="telp" placeholder="Telp">
                        </div>
                        <div class="col-lg-4">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Profil Dokter :</label>
                        <div class="col-lg-9">
                            <textarea name="profil" rows="4" class="form-control" id="profildok" placeholder="Profil Dokter"></textarea>
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

{{-- MODAL EDIT PEGAWAI--}}
<div class="modal fade" tabindex="-1" id="kt_modal_edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Edit Data Pegawai</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formedit">
                    <input type="hidden" class="form-control" id="id_pegawai" name="id_pegawai">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">NIK Pegawai :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="nik" id="nik_edit" placeholder="NIK Pegawai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Pegawai :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="nama_pegawai" id="nama_edit" placeholder="Nama Pegawai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Jabatan :</label>
                        <div class="col-lg-5">
                            <select name="jabatan" id="jabatan_edit" data-control="select2" data-dropdown-parent="#kt_modal_edit" data-placeholder="Pilih Jabatan..." class="form-select form-select-solid">
                                <option value="">Pilih Jabatan...</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id_jabatan }}">{{ $item->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keahlian / Spesialis :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="spesialis" id="spesialis_edit" placeholder="Keahlian / Spesialis Pegawai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Foto Pegawai :</label>
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
                        <label class="col-lg-3 col-form-label text-lg-end required">Tanggal Lahir :</label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir Pegawai">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Alamat :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control form-control-solid" rows="3" name="alamat" id="alamat_edit" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Telp :</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="telp" id="telp_edit" placeholder="Telp">
                        </div>
                        <div class="col-lg-4">
                            <input type="email" class="form-control" name="email" id="email_edit" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Profil Dokter :</label>
                        <div class="col-lg-9">
                            <textarea name="profil" rows="4" class="form-control" id="profiledit" placeholder="Profil Dokter"></textarea>
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

{{-- MODAL TAMBAH JABATAN --}}
<div class="modal fade" tabindex="-1" id="kt_tambah_jabatan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Tambah Jabatan</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="tambah_jabatan">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Jabatan :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Jabatan">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keterangan :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control form-control-solid" rows="3" name="keterangan" placeholder="Keterangan"></textarea>
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

{{-- MODAL EDIT JABATAN--}}
<div class="modal fade" tabindex="-1" id="kt_jabatan_edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Edit Jenis Jabatan</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formedit_jabatan">
                    <input type="hidden" class="form-control" id="id_jabatan" name="id_jabatan">
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Nama Jabatan :</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="nama_jabatan" name="nama" placeholder="Nama Jabatan">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-3 col-form-label text-lg-end required">Keterangan :</label>
                        <div class="col-lg-9">
                            <textarea class="form-control form-control-solid" rows="3" name="keterangan" id="ket_jabatan" placeholder="Keterangan"></textarea>
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
                <h5 class="modal-title">Mapping Pegawai Klinik</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formklinik">
                    <input type="hidden" class="form-control" id="id_pegawai_klinik" name="id_pegawai">
                    <input type="hidden" class="form-control" id="id_jabatan_klinik" name="id_jabatan">
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


{{-- Modal Loading --}}
{{-- <div class="modal fade" tabindex="-1" id="loading" style="">
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
</div> --}}
@endsection

@section('custom_js')
<script>
    ClassicEditor
    .create(document.querySelector('#profildok'), {
        removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
    })
    .catch(error => {
        console.error(error);
    });

    // ClassicEditor
    // .create(document.querySelector('#edit_keterangan'), {
    //     removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
    // })
    // .catch(error => {
    //     console.error(error);
    // });
</script>
<script>
    var tabelData;
    jabatan();

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
                url : "{{ url('master/pegawai/datatable') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                }
            },
            columnDefs: [{
                targets: [2, 3, 4],
                className: ''
            }]
        });
    })

    function jabatan() {
        $.ajax({
            url: "{{ url('master/jabatan') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                
            },
            success: function(response){
                $('#jabatan').html(response);
            }
        });
    }

    // $("#loading").hide();

    // POST TAMBAH PEGAWAI
    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Data Pegawai ?",
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
                        url: "{{ url('master/pegawai/store') }}",
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

    // VIEW EDIT PEGAWAI
    $('#table').on('click', '.edit', function (e) {
        var pegawai = $(this).data('id_pegawai');

        $.ajax({
            url: "{{ url('master/pegawai/edit') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                pegawai: pegawai,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_pegawai').val(msg.id_pegawai);
                    $('#nik_edit').val(msg.nik_pegawai);
                    $('#nama_edit').val(msg.nama_pegawai);
                    $('#jabatan_edit').val(msg.jabatan).trigger("change");
                    $('#spesialis_edit').val(msg.spesialis);
                    $('#tgl_lahir').val(msg.tgl_lahir);
                    $('#alamat_edit').val(msg.alamat_pegawai);
                    $('#telp_edit').val(msg.telp);
                    $('#email_edit').val(msg.email);
                    $('#profiledit').val(msg.profil);

                }
                // Display Modal
                $('#kt_modal_edit').modal('show');
            }
        });
    });

    // POST EDIT PEGAWAI
    $(function () {
        $("#formedit").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Merubah Data Pegawai ?",
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
                        url: "{{ url('master/pegawai/ubah') }}",
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
                                jabatan();
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

    // HAPUS JABATAN
    function hapusPegawai(id_pegawai) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menghapus Data Pegawai Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('master/pegawai/destroy') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_pegawai
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
                            jabatan();
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



    // POST TAMBAH JABATAN
    $(function () {
        $("#tambah_jabatan").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Master Jabatan ?",
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
                        url: "{{ url('master/jabatan/store') }}",
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
                                $('#kt_tambah_jabatan').modal('hide');
                                jabatan();
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

    // HAPUS JABATAN
    function hapusJabatan(id_jabatan) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menghapus Jabatan Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('master/jabatan/destroy') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_jabatan
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
                            jabatan();
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

    // VIEW EDIT JABATAN
    $('#jabatan').on('click', '.edit', function (e) {
        var jabatan = $(this).data('id_jabatan');

        $.ajax({
            url: "{{ url('master/jabatan/edit') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                jabatan: jabatan,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_jabatan').val(msg.id_jabatan);
                    $('#nama_jabatan').val(msg.nama_jabatan);
                    $('#ket_jabatan').val(msg.keterangan);
                    
                    // $('#aktif_menu').val(msg.status_menu).trigger("change");
                }
                // Display Modal
                $('#kt_jabatan_edit').modal('show');
            }
        });
    });

    // POST EDIT JABATAN
    $(function () {
        $("#formedit_jabatan").submit(function(e) {
            e.preventDefault();

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Merubah jabatan tersebut",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Yakin!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('master/jabatan/ubah') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: $('#formedit_jabatan').serialize()
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
                                $('#kt_jabatan_edit').modal('hide');
                                jabatan();
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


    // VIEW MAPPING KLINIK
    $('#table').on('click', '.klinik', function (e) {
        var pegawai = $(this).data('id_pegawai');

        $.ajax({
            url: "{{ url('master/pegawai/klinik') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                pegawai: pegawai,
            },
            success: function(response){
                // Add response in Modal body
                if(response){
                    $('#klinik').html(response.html);
                    $('#id_pegawai_klinik').val(response.id_pegawai);
                    $('#id_jabatan_klinik').val(response.id_jabatan);
                }
                // Display Modal
                $('#kt_klinik').modal('show');
            }
        });
    });

    $(function () {
        $("#formklinik").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menambah Pegawai ke Klinik Tersebut ?",
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
                        url: "{{ url('master/pegawai/mapping-klinik') }}",
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
                                jabatan();
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

</script>
@endsection