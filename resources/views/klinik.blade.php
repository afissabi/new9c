@extends('layouts.app')

@section('custom_css')
<style>
    .btn-tambah{
        width: -webkit-fill-available;
    }
</style>
@endsection

@section('content')
<div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mb-4">
    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
        <i class="fas fa-clinic-medical" style="color: #009ef7;font-size: 45px;"></i>
    </span>
    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
        <div class="mb-3 mb-md-0 fw-bold">
            <h4 class="text-gray-900 fw-bolder">Data Klinik</h4>
            <div class="fs-6 text-gray-700 pe-7">Berikut adalah daftar klinik dari 9CORTHODONTICS</div>
        </div>
        {{-- <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap">Withdraw Money</a> --}}
    </div>
</div>

<div class="card card-flush shadow-sm">
    <div class="card-body py-5">
        <div class="row" id="listing">
            <div class="col-md-4">
                <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-info btn-active-light-info btn-tambah" data-bs-toggle="modal" data-bs-target="#kt_modal_1" style="height:385px;">
                    <i class="fas fa-plus" style="color: #7239eb;"></i><br>
                    Klinik
                </button>
            </div>
            @foreach ($datas as $value)
                <div class="col-md-4">
                    <div class="card card-xl-stretch mb-xl-8" style="min-height:385px;">
                        <div class="card-body">
                            <div class="d-flex flex-stack">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-60px me-5">
                                        <span class="symbol-label bg-danger-light">
                                            @if($value->is_aktif)
                                                <i class="fas fa-clinic-medical" style="color: #f70000;font-size: 35px;" class="h-80 align-self-center"></i><br>
                                            @else
                                                <i class="fas fa-clinic-medical" style="color: #009ef7;font-size: 35px;" class="h-80 align-self-center"></i>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-5">{{ $value->nama }}</a>
                                        <span class="text-muted fw-bold">{{ $value->tipe }}</span>
                                        @if($value->is_aktif)
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @else
                                            <span class="badge badge-primary">Aktif</span>
                                        @endif
                                        <span class="text-muted fw-bold">{{ $value->kota }} {{ $value->prov }}</span>
                                    </div>
                                </div>
                                <div class="ms-1">
                                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                        <div class="separator mb-3 opacity-75"></div>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="jam menu-link px-3" data-id_klinik="{{$value->id_klinik}}">Jam Operasional</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="galeri menu-link px-3" data-id_klinik="{{$value->id_klinik}}">Galeri Klinik</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="dokter menu-link px-3" data-id_klinik="{{$value->id_klinik}}">Dokter</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Pegawai</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="layanan menu-link px-3" data-id_klinik="{{$value->id_klinik}}">Layanan</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Reservasi</a>
                                        </div>
                                        <div class="menu-item px-3 mb-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">Action</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <div class="menu-item px-3">
                                                    <a href="javascript:void(0)" class="edit menu-link px-3" data-id_klinik="{{$value->id_klinik}}">Edit</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3">
                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                            <span class="form-check-label text-muted fs-6">Tidak Aktif</span>
                                                                {{-- <input type="checkbox" onClick="klinikAktif({{ $value->id_klinik }})" id="is_aktif"> --}}
                                                                @if($value->is_aktif)
                                                                    <input class="form-check-input w-30px h-20px" type="checkbox" onClick="klinikAktif({{ $value->id_klinik }})" id="is_aktif"/>
                                                                @else
                                                                    <input class="form-check-input w-30px h-20px" type="checkbox" onClick="klinikAktif({{ $value->id_klinik }})" checked="true" id="is_aktif"/>
                                                                @endif
                                                            <span class="form-check-label text-muted fs-6">Aktif</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#!" onClick="hapus({{ $value->id_klinik }})" class="menu-link px-3">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <div class="text-dark me-2 fw-bolder pb-4"></div>
                                <div class="d-flex text-muted">
                                    <table>
                                        <tr>
                                            <td valign="top">Alamat</td>
                                            <td valign="top">:</td>
                                            <td>{{ $value->alamat}}</td>
                                        </tr>
                                        <tr>
                                            <td>Telp</td>
                                            <td>:</td>
                                            <td>{{$value->telp}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{$value->email}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex flex-column mb-2">
                                <div class="text-dark me-2 fw-bolder pb-4">Jam Operasional</div>
                                <div class="d-flex">
                                    <ul>
                                        <li>Senin - Jumat | 08:00 - 16:00 WIB</li>
                                        <li>Sabtu - Minggu | 08:00 - 16:00 WIB</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" tabindex="-1" id="kt_modal_1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Tambah Klinik</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="form">
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Type Klinik :</label>
                        <div class="col-lg-4">
                            <select name="tipe" data-dropdown-parent="#kt_modal_1" class="form-select form-select-solid">
                                <option value=""> - Pilih Jenis - </option>
                                <option value="UTAMA">Utama</option>
                                <option value="CABANG">Cabang</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Klinik">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Alamat :</label>
                        <div class="col-lg-10">
                            <textarea class="form-control form-control-solid" rows="3" name="alamat" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Prov / Kota :</label>
                        <div class="col-lg-5">
                            <select name="provinsi" id="provinsi" data-placeholder="Pilih Provinsi..." class="form-select form-select-solid">
                                <option value="">Pilih Provinsi...</option>
                                @foreach ($prov as $item)
                                    <option value="{{ $item->id_m_setup_prop }}">{{ $item->nm_prop }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <select name="kota" id="kota" data-control="select2" data-dropdown-parent="#kt_modal_1" data-placeholder="Pilih Kota..." class="form-select form-select-solid">
                                <option value="">Pilih Kota...</option>
                                @foreach ($kota as $item)
                                    <option value="{{ $item->id_kab }}" class="{{ $item->id_m_setup_prop }}">{{ $item->nm_kab }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Telp :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="telp" placeholder="Telp">
                        </div>
                        <div class="col-lg-5">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">No. WA Admin Klinik :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="admin" placeholder="No.WA Admin Klinik">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end">Url Maps :</label>
                        <div class="col-lg-10 col-xl-8">
                            <input type="text" class="form-control" name="maps" placeholder="Maps">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end">Catatan Tambahan :</label>
                        <div class="col-lg-10">
                            <textarea class="form-control form-control-solid" rows="3" name="catatan" placeholder="Catatan Tambahan"></textarea>
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

{{-- MODAL EDIT --}}
<div class="modal fade" tabindex="-1" id="kt_modal_edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Edit Klinik</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formedit">
                    <input type="hidden" class="form-control" id="id_klinik" name="id_klinik">
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Type Klinik :</label>
                        <div class="col-lg-4">
                            <select name="tipe" id="tipe_edit" data-dropdown-parent="#kt_modal_edit" class="form-select form-select-solid">
                                <option value=""> - Pilih Jenis - </option>
                                <option value="UTAMA">Utama</option>
                                <option value="CABANG">Cabang</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="nama" id="nama_edit" placeholder="Nama Klinik">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Alamat :</label>
                        <div class="col-lg-10">
                            <textarea class="form-control form-control-solid" rows="3" name="alamat" id="alamat_edit" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Prov / Kota :</label>
                        <div class="col-lg-5">
                            <select name="provinsi" id="provinsi_edit" onchange="pilihKota();" data-placeholder="Pilih Provinsi..." class="form-select form-select-solid">
                                <option value="">Pilih Provinsi...</option>
                                @foreach ($prov as $item)
                                    <option value="{{ $item->id_m_setup_prop }}">{{ $item->nm_prop }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <select name="kota" id="kota_edit" data-control="select2" data-kt-menu-placement="right-end" data-dropdown-parent="#kt_modal_edit" data-placeholder="Pilih Kota..." class="form-select form-select-solid">
                                <option value="">Pilih Kota...</option>
                                @foreach ($kota as $item)
                                    <option value="{{ $item->id_kab }}" class="{{ $item->id_m_setup_prop }}">{{ $item->nm_kab }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Telp :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="telp" id="telp_edit" placeholder="Telp">
                        </div>
                        <div class="col-lg-5">
                            <input type="email" class="form-control" name="email" id="email_edit" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">No. WA Admin Klinik :</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" name="admin" id="admin" placeholder="No.WA Admin Klinik">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end">Url Maps :</label>
                        <div class="col-lg-10 col-xl-8">
                            <input type="text" class="form-control" name="maps" id="maps_edit" placeholder="Maps">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end">Catatan Tambahan :</label>
                        <div class="col-lg-10">
                            <textarea class="form-control form-control-solid" rows="3" name="catatan" id="catatan_edit" placeholder="Catatan Tambahan"></textarea>
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

{{-- MODAL JAM OPERASIONAL --}}
<div class="modal fade" tabindex="-1" id="kt_modal_jam" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Jam Operasional Klinik</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" class="kt-form kt-form--label-right" id="formjam">
                    <input type="hidden" class="form-control" id="id_klinik_jam" name="id_klinik">
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end required">Hari :</label>
                        <div class="col-lg-4">
                            <select name="hari" data-dropdown-parent="#kt_modal_jam" class="form-select form-select-solid">
                                <option value=""> - Pilih Hari - </option>
                                <option value="SENIN">Senin</option>
                                <option value="SELASA">Selasa</option>
                                <option value="RABU">Rabu</option>
                                <option value="KAMIS">Kamis</option>
                                <option value="JUMAT">Jum'at</option>
                                <option value="SABTU">Sabtu</option>
                                <option value="MINGGU">Minggu</option>
                                <option value="LIBNAS">Hari Libur Nasional</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <select name="status" id="status_operasi" data-dropdown-parent="#kt_modal_jam" class="form-select form-select-solid">
                                <option value=""> - Pilih Status Operasional - </option>
                                <option value="BUKA">BUKA</option>
                                <option value="TUTUP">TUTUP</option>
                                <option value="APPOINTMENT">APPOINTMENT</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10" id="pilihjam" style="display:none">
                        <label class="col-lg-2 col-form-label text-lg-end required">Jam Buka - Tutup :</label>
                        <div class="col-lg-4">
                            <input type="time" class="form-control" name="jam_buka" placeholder="Jam Buka">
                        </div>
                        <div class="col-lg-4">
                            <input type="time" class="form-control" name="jam_tutup" placeholder="Jam Tutup">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <label class="col-lg-2 col-form-label text-lg-end">Catatan Tambahan :</label>
                        <div class="col-lg-10">
                            <textarea class="form-control form-control-solid" rows="3" name="catatan" placeholder="Catatan Tambahan"></textarea>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-lg-8"></div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="row mb-10" id="daftar-jam">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL DOKTER --}}
<div class="modal fade" tabindex="-1" id="kt_modal_dokter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Dokter Klinik</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <div class="row mb-10" id="daftar-dokter">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL LAYANAN --}}
<div class="modal fade" tabindex="-1" id="kt_modal_layanan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Layanan Klinik</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <div class="row mb-10" id="daftar-layanan">
                    
                </div>
            </div>
            <div class="modal-footer">
                <a href="" id="layanan-dokter" class="btn btn-info"><i class="fas fa-eye"></i> Tambah Layanan</a>
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL GALERI --}}
<div class="modal fade" tabindex="-1" id="kt_modal_galeri" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content" style="width: 125%;">
            <div class="modal-header" style="background: #f1faff;">
                <h5 class="modal-title">Galeri Klinik</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>
            <div class="modal-body">
                <form class="form" id="formgaleri" method="post">
                    <input type="hidden" class="form-control" name="klinik" id="klinik_galeri">
                    <div class="fv-row row mb-15">
                        <div class="col-md-5">
                            <label class="fs-6 fw-bold">Gambar :</label>
                            <label class="picture" for="picture__input" tabIndex="0">
                                <span class="picture__image"></span>
                            </label>
                            <input type="file" name="gambar" id="picture__input" accept="image/png, image/gif, image/jpeg" style="border: 1px dashed;padding: 6px;margin-top: 8px;">
                        </div>
                        <div class="col-md-5">
                            <label class="fs-6 fw-bold mt-2">Keterangan :</label>
                            <input type="text" class="form-control" name="keterangan" data-placeholder="">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" id="kt_file_manager_settings_submit" style="margin-top:29px">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row mb-10" id="daftar-galeri">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>

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
<script src="{{ asset('assets/js/jquery.chained.min.js') }}"></script>
<script>
    $("#kota").chained("#provinsi");
</script>

<script>
$("#status_operasi").change(function() {
    if ( $(this).val() == "BUKA") {
        $("#pilihjam").show();
    }else{
        $("#pilihjam").hide();
    }
});
// list();

// function list() {
//     $.ajax({
//         url: "{{ url('klinik/list') }}",
//         type: "post",
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//         data: {
//             // kejadian : $('#kejadian_id').val(),
//         },
//         success: function(response){
//             $('#listing').html(response);
//         }
//     });
// }

$(function () {
    $("#form").submit(function(e) {
        e.preventDefault();

        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menambah Klinik Baru",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Tambah!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('klinik/simpan') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: $('#form').serialize()
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
                            $('#kt_modal_1').modal('hide');
                            // list();
                            window.location.href = "{{ url('klinik') }}"
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

$('#listing').on('click', '.edit', function (e) {
    var klinik = $(this).data('id_klinik');

    $.ajax({
        url: "{{ url('klinik/edit') }}",
        type: "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            klinik: klinik,
        },
        success: function(msg){
            // Add response in Modal body
            if(msg){
                $('#id_klinik').val(msg.id_klinik);
                $('#tipe_edit').val(msg.tipe).trigger("change");
                $('#nama_edit').val(msg.nama);
                $('#alamat_edit').val(msg.alamat);
                $('#provinsi_edit').val(msg.id_prov).trigger("change");
                $('#kota_edit').val(msg.id_kota).trigger("change");
                $('#telp_edit').val(msg.telp);
                $('#email_edit').val(msg.email);
                $('#catatan_edit').val(msg.catatan);
                $('#maps_edit').val(msg.maps);
                
                // $('#aktif_menu').val(msg.status_menu).trigger("change");
            }
            // Display Modal
            $('#kt_modal_edit').modal('show');
        }
    });
});

$('#listing').on('click', '.jam', function (e) {
    var klinik = $(this).data('id_klinik');

    $.ajax({
        url: "{{ url('klinik/jam-operasional') }}",
        type: "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            klinik: klinik,
        },
        success: function(msg){
            // Add response in Modal body
            if(msg){
                $('#id_klinik_jam').val(msg.id_klinik);
                // $('#tipe_edit').val(msg.tipe).trigger("change");
                // $('#nama_edit').val(msg.nama);
                // $('#alamat_edit').val(msg.alamat);
                // $('#provinsi_edit').val(msg.id_prov).trigger("change");
                // $('#kota_edit').val(msg.id_kota).trigger("change");
                // $('#telp_edit').val(msg.telp);
                // $('#email_edit').val(msg.email);
                // $('#catatan_edit').val(msg.catatan);
                // $('#maps_edit').val(msg.maps);
                
                // $('#aktif_menu').val(msg.status_menu).trigger("change");
                $('#daftar-jam').html(msg.html);
            }
            // Display Modal
            $('#kt_modal_jam').modal('show');
        }
    });
});

$('#listing').on('click', '.dokter', function (e) {
    var klinik = $(this).data('id_klinik');

    $.ajax({
        url: "{{ url('klinik/dokter') }}",
        type: "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            klinik: klinik,
        },
        success: function(msg){
            // Add response in Modal body
            if(msg){
                $('#daftar-dokter').html(msg.html);
            }
            // Display Modal
            $('#kt_modal_dokter').modal('show');
        }
    });
});

$('#listing').on('click', '.layanan', function (e) {
    var klinik = $(this).data('id_klinik');

    $.ajax({
        url: "{{ url('klinik/layanan') }}",
        type: "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            klinik: klinik,
        },
        success: function(msg){
            var idklinik = msg.id_klinik
            // Add response in Modal body
            if(msg){
                $('#daftar-layanan').html(msg.html);
                document.getElementById("layanan-dokter").href = `{{ url('klinik/detail-layanan/${idklinik}') }}`;
            }
            // Display Modal
            $('#kt_modal_layanan').modal('show');
        }
    });
});

$('#listing').on('click', '.galeri', function (e) {
    var klinik = $(this).data('id_klinik');

    $.ajax({
        url: "{{ url('klinik/galeri') }}",
        type: "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            klinik: klinik,
        },
        success: function(msg){
            // Add response in Modal body
            if(msg){
                $('#klinik_galeri').val(msg.id_klinik);
                $('#daftar-galeri').html(msg.html);
            }
            // Display Modal
            $('#kt_modal_galeri').modal('show');
        }
    });
});



function pilihKota() {
    $.ajax({
        url: "{{ url('klinik/pilih-kota') }}",
        type: "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            prov : $('#provinsi_edit').val(),
            klinik : $('#id_klinik').val(),
        },
        success: function(response){
            $('#kota_edit').html(response);
        }
    });
}

$(function () {
    $("#formedit").submit(function(e) {
        e.preventDefault();

        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Merubah data klinik tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Yakin!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('klinik/ubah') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: $('#formedit').serialize()
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
                            $('#edit').modal('hide');
                            // list();
                            window.location.href = "{{ url('klinik') }}"
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
    $("#formjam").submit(function(e) {
        e.preventDefault();

        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menyimpan jam operasional tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Yakin!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('klinik/tambah-jam') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: $('#formjam').serialize()
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
                            $('#kt_modal_jam').modal('hide');
                            // list();
                            window.location.href = "{{ url('klinik') }}"
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

function hapus(id_data) {
    swal.fire({
        title: "Apa Anda Yakin?",
        text: "Menghapus Data Klinik Tersebut",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "{{ url('klinik/destroy') }}",
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
                        window.location.href = "{{ url('klinik') }}"
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

function hapusjam(id_jam) {
    swal.fire({
        title: "Apa Anda Yakin?",
        text: "Menghapus Jam Operasional Klinik Tersebut",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "{{ url('klinik/destroy-jam') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                data: {
                    id : id_jam
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
                        window.location.href = "{{ url('klinik') }}"
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

function klinikAktif(id_data) {
    var checkBox = document.getElementById("is_aktif");
    
    if (checkBox.checked == true){
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Mengubah Status Klinik Menjadi Aktif ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Aktifkan!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('klinik/aktif') }}",
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
                            window.location.href = "{{ url('klinik') }}"
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
            text: "Mengubah Status Klinik Menjadi Tidak Aktif ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Non Aktifkan!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('klinik/tidak-aktif') }}",
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
                            window.location.href = "{{ url('klinik') }}"
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

// POST TAMBAH GALERI KLINIK
$(function () {
    $("#formgaleri").submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menambah Gambar Untuk Klinik ?",
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
                    url: "{{ url('klinik/simpan-galeri') }}",
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
                            $('#kt_modal_galeri').modal('hide');
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

function hapusGaleri(id_galeri) {
    swal.fire({
        title: "Apa Anda Yakin?",
        text: "Menghapus Galeri Klinik Tersebut",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "{{ url('klinik/destroy-galeri') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                data: {
                    id : id_galeri
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
                        $('#kt_modal_galeri').modal('hide');
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