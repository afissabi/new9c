@extends('member.app')
@section('custom_css')

@endsection

@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="border border-3 border-success" style="border-color: #0545f5 !important;"></div>
            <div class="card  bg-white shadow p-5">
                <div class="mb-4 text-center">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                        fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg> --}}
                    <img alt="Image" src="{{ asset('front/img/logo_transparant.png') }}" style="height: 100px;">
                </div>
                <div class="text-center">
                    <h1>Terima Kasih !</h1>
                    <p>Telah memberikan kepercayaan kepada kami untuk melayani anda...</p>
                    <a href="{{ url('member-area/layanan') }}" class="btn btn-outline-info">Kembali Ke Layanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')

@endsection
