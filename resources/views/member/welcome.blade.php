@extends('member.app')

@section('custom_css')
    <style>
        .btn-icon{
            background: #ffffff;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            position: absolute;
            margin-top: -45px;
            margin-left: -30px;
            box-shadow: 0px 2px 2px 3px #b5b5b5d4;
        }
    </style>
@endsection

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row mb-3">
                <div class="col-md-6 fv-row mb-2">
                    <div class="card card-bordered">
                        <div class="card-header justify-content-end ribbon ribbon-start">
                            <div class="ribbon-label bg-primary">Riwayat Pendaftaran Terakhir</div>
                        </div>
                    
                        <div class="card-body" id="riwayat_registrasi">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_js')
<script>
    $(window).on('load', function() {
        LastReg();
    });

    function LastReg() {
        var need = 3;

        $.ajax({
            url: "{{ url('/last-register') }}",
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                need : need,
            },

            success: function(response){
                $('#riwayat_registrasi').html(response);
            }
        });
    }
</script>
@endsection
