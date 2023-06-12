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
                <div class="col-md-6 col-lg-12 fv-row mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="#" class="btn btn-info btn-hover-rotate-start">
                                        <span class="svg-icon svg-icon-1"><i class="fas fa-tooth" style="color: #000"></i></span>
                                        Riwayat Layanan
                                    </a>
                                    {{-- <a href="#" class="btn btn-block btn-hover-rotate-start">
                                        <div class="row">
                                            <div style="background: #cddc39;border-radius: 10px 0px 0px 10px;font-size: 15px;padding: 10px;">
                                                <div class="btn-text" style="">
                                                    RIWAYAT LAYANAN SAYA
                                                </div>
                                                
                                                <div class="btn-icon" style="">
                                                    <i class="fas fa-tooth"></i>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </a> --}}
                                </div>
                            </div>
                            <center>
                                <img alt="Logo" src="{{ asset('img/coming.png') }}" class="" style="">
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_js')
@endsection
