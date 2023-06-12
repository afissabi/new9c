@extends('layouts.app')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row mb-3">
                <div class="col-md-6 col-lg-12 fv-row mb-2">
                    <div class="card">
                        <div class="card-body">
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
    $("#desa").chained("#kecamatan");
</script>
<script>
    $("#rw").chained("#desa");
</script>
<script>
    $("#rt").chained("#rw");
</script>
@endsection
