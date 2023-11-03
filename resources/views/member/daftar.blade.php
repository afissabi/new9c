@extends('member.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 fv-row mb-2">
                    <div class="card">
                        <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
                            <div class="ribbon-label bg-danger" style="font-size: large;background-color:#d00 !important;">RIWAYAT PENDAFTARAN SAYA</div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="datas" class="table table-striped gy-5 gs-7 border rounded">
                                <thead>
                                    <tr role="row" class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th width="2%"><center>NO</center></th>
                                        <th><center>Tanggal Daftar</center></th>
                                        <th><center>Klinik</center></th>
                                        <th><center>Waktu Treatment</center></th>
                                        <th><center>Nama Layanan</center></th>
                                        <th><center>Status</center></th>
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
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    var tabelData;
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
                url : "{{ url('member-area/all-daftar') }}",
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
    }
</script>
@endsection
