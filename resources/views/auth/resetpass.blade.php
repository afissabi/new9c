
<!DOCTYPE html>

<html lang="en">

<head>
    <base href="../../../">
    <title>9Corthodontics Member-Area</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('front/img/logo.png') }}" />
    <meta name="description" content="Klinik Gigi 9COrthodontics"/>
    <meta name="keywords" content="Klinik Gigi 9COrthodontics" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" /> --}}
    <link rel="shortcut icon" href="{{ asset('img/svg/icon_page.svg') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/vendor/dist/aos.css')}}" rel="stylesheet">
	<script src="{{asset('assets/vendor/dist/aos.js')}}"></script>
</head>

<style>
    .bodycolor {
        background: #788f9d;
        /* background-image: url('{{ asset('img/png/bg-login.png') }}'); */
        background-repeat: no-repeat;
        background-size: cover;
        }

    .container {
        margin-right: auto;
        margin-left: auto;
        padding-right: 15px;
        padding-left: 15px;
        width: 100%;
        display: flex;
    }

    .log1 {
		position: absolute;
		z-index: 6;
        animation-name: log1;
  		animation-duration: 5s;
		animation-iteration-count: infinite;
    }

    .log2 {
		position: absolute;
		z-index: 3;
        animation-name: log2;
  		animation-duration: 5s;
		animation-iteration-count: infinite;
    }

    .log3 {

		position: absolute;
		z-index: 5;
        animation-name: log3;
  		animation-duration: 4s;
		animation-iteration-count: infinite;
    }

    .log4 {
		position: absolute;
		z-index: 4;
        animation-name: log3;
  		animation-duration: 5s;
		animation-iteration-count: infinite;
    }

    .log5 {
		position: absolute;
		z-index: 2;
        animation-name: log5;
  		animation-duration: 6s;
		animation-iteration-count: infinite;
    }
    .log6 {
		position: absolute;
		z-index: 1;
        animation-name: log6;
  		animation-duration: 6s;
		animation-iteration-count: infinite;
    }
 
    .btn.btn-primary, .swal2-confirm {
        color: #fff;
        background-color: #9955AF;
    }

    .btn.btn-primary:hover:not(.btn-active), .swal2-confirm:hover {
        color: #fff;
        background-color: #4435AD !important;
    }

    @keyframes log1 {
		0% {transform: scale(0.98);}
  		25% {transform: translateZ(0) scale(1);}
		50% {transform: scale(0.98);}
  		75% {transform: translateZ(0) scale(1);}
  		100% {transform: scale(0.98);}
	}
	@keyframes log2 {
		0% {transform: scale(1);}
  		25% {transform: translateZ(0) scale(0.97);}
		50% {transform: scale(1);}
  		75% {transform: translateZ(0) scale(0.97);}
  		100% {transform: scale(1);}
	}
	@keyframes log3 {
		0% {transform: scale(0.95);}
  		25% {transform: translateZ(0) scale(1);}
		50% {transform: scale(0.95); }
  		75% {transform: translateZ(0) scale(1);}
  		100% {transform: scale(0.95);}
	}
    @keyframes log4 {
		0% {transform: scale(1);}
  		25% {transform: translateZ(0) scale(0.95);}
		50% {transform: scale(1);}
  		75% {transform: translateZ(0) scale(0.95);}
  		100% {transform: scale(1);}
	}
	@keyframes log5 {
		0% {transform: scale(0.95);}
  		25% {transform: translateZ(0) scale(1);}
		50% {transform: scale(0.95);}
  		75% {transform: translateZ(0) scale(1);}
  		100% {transform: scale(0.95);}
	}
    @keyframes log6 {
		0% {transform: scale(1);}
  		25% {transform: translateZ(0) scale(0.95);}
		50% {transform: scale(1);}
  		75% {transform: translateZ(0) scale(0.95);}
  		100% {transform: scale(1);}
	}

    @media only screen and (max-width: 767px)
        {
            .ilus
            {
                padding: 15px 0;
                width: 95%;
                justify-content: center;
                align-items: center;
                position: relative;
            }

			#gambar{
				display: none !important;
			}

            .mobile {
                min-height: 100%
            }

        }
    

    #password-strength-status {
        padding: 5px 10px;
        color: #FFFFFF;
        border-radius: 4px;
        margin-top: 5px;
    }

    .medium-password {
        background-color: #b7d60a;
        border: #BBB418 1px solid;
    }

    .weak-password {
        background-color: #ce1d14;
        border: #AA4502 1px solid;
    }

    .strong-password {
        background-color: #12CC1A;
        border: #0FA015 1px solid;
    }
</style>

<body id="kt_body" class="bodycolor" style="justify-content: center;background-image:url({{ asset('img/bg-member.png') }})">
<div class="container">
    <div class="d-flex flex-column flex-root ilus">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="max-width: 100%">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="background: #ffffff78;padding: 15px;border-radius: 10px;">
                    <div class="mb-10" style="justify-content: center; text-align: center;">
                        <h5>- MEMBER KLINIK 9CORTHODONTICS -</h5>
                    </div>
                    <form class="form w-100" id="form">
                        @csrf
                        <div class="row mb-10">
                            <input name="email" value="{{ $email }}" type="hidden" >
                            <label class="col-lg-4 col-form-label text-lg-end required">Password Baru :</label>
                            <div class="col-lg-6">
                                <input name="password" id="passworde" type="password" placeholder="Masukkan Password" class="form-control">
                                <div id="password-strength-status"></div> 
                            </div>
                        </div>
                        <div class="row mb-10">
                            <label class="col-lg-4 col-form-label text-lg-end required">Ulangi Password Baru :</label>
                            <div class="col-lg-6">
                                <input name="password_confirm" type="password" placeholder="Masukkan Konfirmasi Password" class="form-control" data-parsley-equalto="#passworde">
                            </div>
                        </div>
                        <div class="row" style="text-align: center;">
                            <div class="col-md-12">
                                <button type="submit" id="kt_sign_in_submit" style="width: 100%;" class="btn btn-hover-rise btn-block btn-active-primary">
                                    <span class="indicator-label btn-login">Simpan Password</span>
                                    <span class="indicator-progress wait-login">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <p><center>Klinik 9COrthodontics {{ date('Y') }}</center></p>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('assets/js/parsley.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        $('#form').parsley();
    });
</script>
<script>
    $(document).ready(function () {
        $("#passworde").on('keyup', function(){
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if ($('#passworde').val().length < 8) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Sangat Lemah (gunakan setidaknya 8 karakter.)");
            } else {
                if ($('#passworde').val().match(number) && $('#passworde').val().match(alphabets) && $('#passworde').val().match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Kuat");
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html("Lemah (Harus terdiri dari huruf besar, nomor dan spesial karakter sebagai kombinasi)");
                }
            }
        });
    }); 

    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menyimpan Password Baru Anda ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Yakin!",
                closeOnConfirm: false,
                allowOutsideClick: false,
            }).then(function(result) {
                // $('#loading').modal({backdrop:'static', keyboard:false});
                // $('#loading').modal('show');
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url: "{{ url('member-area/simpan-password') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";
                        // $('#loading').modal('hide');

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
                                window.location.href = `{{ url('member-area') }}`
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
</script>
</body>

</html>