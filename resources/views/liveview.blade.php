@extends('layouts.app')

@section('content')

<div class="row mb-3">
    <div class="col-md-6 fv-row mb-2">
        <div class="alert alert-dismissible bg-light-primary d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10" style="background: #a8cfff !important;">
            <button type="button" class="position-absolute top-0 end-0 m-2 btn btn-icon btn-icon-danger" data-bs-dismiss="alert">
                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </button>
            <i class="ki-duotone ki-information-5 fs-5tx text-danger mb-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            <div class="text-center">
                <h1 class="fw-bold mb-5">17.00 WIB</h1>
                <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
                <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column p-5 mb-10">
                    <center><h2 class="mb-1">NUR EVI AGUSTIN</h2></center>
                </div>
                <div class="mb-9 text-dark">
                    Saat ini sedang dilakukan treatment.
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 fv-row mb-2">
        <div class="alert alert-primary d-flex align-items-center p-5">
            <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
            <div class="row">
                <div class="col-md-2">
                    <i class="fas fa-arrow-circle-right" style="font-size: 65px;color: #0c4295;"></i>
                </div>
                <div class="col-md-10">
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark">JAM 18.00</h4>
                        <span style="font-size: 35px;">AFIS SABI' MASRURY</span>
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
                        <h2 class="mb-1">Daftar Pasien Hari Ini</h2>
                    </div>
                </div>
        
                <div class="card-toolbar">
                </div>
            </div>
            <div class="card-body py-5 table-responsive">
                <table id="table" class="table table-striped gy-5 gs-7 border rounded">
                    <thead>
                        <tr role="row">
                            <th width="2%"><center>NO</center></th>
                            <th><center>Nama Pasien</center></th>
                            <th><center>Layanan</center></th>
                            <th><center>Waktu</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
    </div>
</div>

@endsection

@section('custom_js')
<script src="{{ asset('assets/js/jquery.chained.min.js') }}"></script>
<script src="{{ asset('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script>
    $("#desa").chained("#kecamatan");
</script>
<script>
    $("#rw").chained("#desa");
</script>
<script>
    $("#rt").chained("#rw");
</script>
<script>
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
            url : "{{ url('data-registrasi/datatable/today') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            data: function(data){
                
            }
        },
    });
})
</script>
@endsection