@extends('layouts.app')

@section('content')
<div class="card bgi-no-repeat bgi-position-x-end bgi-size-cover" style="background-color: #19335c;background-size: auto 100%; background-image: url({{ asset('img/taieri.svg') }})">
    <div class="card-body container-xxl pt-10 pb-8">
        <div class="row mb-3" style="background: #ffffff82;border-radius: 5px;padding: 10px;">
            <div class="col-md-3 fv-row mb-2">
                <label class="fs-5 fw-bold mb-2">Tanggal Awal</label>
                <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
            </div>
            <div class="col-md-3 fv-row mb-2">
                <label class="fs-5 fw-bold mb-2">Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
            </div>
            <input type="hidden" value="1" id="filter">
            <div class="col-md-2 fv-row mb-2">
                <button type="button" class="btn btn-block btn-info" onclick="cariByPeriode()" style="margin-top: 30px;">Filter</button>
            </div>
        </div>
    </div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 fv-row mb-2">
                    <div class="card">
                        <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
                            <div class="ribbon-label bg-danger" style="font-size: large;background-color:#d00 !important;">REKAP PROMO</div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="datas" class="table table-striped gy-5 gs-7 border rounded">
                                <thead>
                                    <tr role="row" class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th width="2%" valign="middle" rowspan="2"><center>NO</center></th>
                                        <th rowspan="2" valign="middle"><center>PROMO</center></th>
                                        <th colspan="4"><center>TOTAL REGISTER</center></th>
                                    </tr>
                                    <tr>
                                        <th style="background: #46a3d194;"><center>MENUNGGU</center></th>
                                        <th style="background: #54d14694;"><center>DITERIMA</center></th>
                                        <th style="background: #d1464694;"><center>DITOLAK</center></th>
                                        <th style="background: #ced30394;"><center>TOTAL</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 fv-row mb-2">
                    <div class="card">
                        <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
                            <div class="ribbon-label bg-danger" style="font-size: large;background-color:#d00 !important;">REKAP LAYANAN UMUM</div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataslayanan" class="table table-striped gy-5 gs-7 border rounded">
                                <thead>
                                    <tr role="row" class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th width="2%" valign="middle" rowspan="2"><center>NO</center></th>
                                        <th rowspan="2" valign="middle"><center>NAMA LAYANAN</center></th>
                                        <th colspan="4"><center>TOTAL REGISTER</center></th>
                                    </tr>
                                    <tr>
                                        <th style="background: #46a3d194;"><center>MENUNGGU</center></th>
                                        <th style="background: #54d14694;"><center>DITERIMA</center></th>
                                        <th style="background: #d1464694;"><center>DITOLAK</center></th>
                                        <th style="background: #ced30394;"><center>TOTAL</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_js')
<script src="{{ asset('assets/js/jquery.chained.min.js') }}"></script>
<script src="{{ asset('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script>
    var tabelData;
    var tabelLayanan;
    var filter_filter  = null;
    var filter_tglawal  = null;
    var filter_tglakhir  = null;

    $(function () {
        tabelData = $('#datas').DataTable({
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
                url : "{{ url('dashboard/promo') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                    data.filter   = filter_filter;
                    data.tglawal  = filter_tglawal;
                    data.tglakhir = filter_tglakhir;
                }
            },
            // columnDefs: [{
            //     targets: [2, 3, 4],
            //     className: ''
            // }]
        });
    })

    $(function () {
        tabelLayanan = $('#dataslayanan').DataTable({
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
                url : "{{ url('dashboard/layanan') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                    data.filter   = filter_filter;
                    data.tglawal  = filter_tglawal;
                    data.tglakhir = filter_tglakhir;
                }
            },
            // columnDefs: [{
            //     targets: [2, 3, 4],
            //     className: ''
            // }]
        });
    })

    function cariByPeriode() {
        filter_filter = $('#filter').val();
        filter_tglawal = $('#tgl_awal').val();
        filter_tglakhir = $('#tgl_akhir').val();
        
        tabelData.ajax.reload(null, 'refresh');
        tabelLayanan.ajax.reload(null, 'refresh');
    }
</script>
@endsection
