
<!DOCTYPE html>

<html lang="en">

<head>
    <base href="../../../">
    <title>9Corthodontics Member-Area</title>
    <meta charset="utf-8" />
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
</style>

<body id="kt_body" class="bodycolor" style="justify-content: center;background-image:url({{ asset('img/bg-member.png') }})">
<div class="container">
    <div class="d-flex flex-column flex-root ilus">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="max-width: 100%">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="background: #ffffff78;padding: 15px;border-radius: 10px;">
                    <div class="mb-10" style="justify-content: center; text-align: center;">
                        <h5>- MEMBER KLINIK 9CORTHODONTICS -</h5>
                    </div>
                    <form class="form w-100" id="form">
                        @csrf
                        <div class="fv-row mb-2">
                            <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                            <input class="form-control form-control-lg form-control-solid" name="username" type="text" placeholder="Username" style="border-color: #0f4162;"/>
                        </div>
                        <div class="fv-row mb-10">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            </div>
                            <input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="Password" style="border-color: #0f4162;"/>
                        </div>
                        <div class="fv-row mb-10">
                            {!! NoCaptcha::display() !!}
                            {!! NoCaptcha::renderJs() !!}
                            @error('g-recaptcha-response')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row" style="text-align: center;">
                            <div class="col-md-6">
                                <a href="{{ url('/member-area/forget-password') }}" class="btn btn-block btn-active-warning btn-hover-rise" style="width: 100%;">Lupa Password ?</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" id="kt_sign_in_submit" style="width: 100%;" class="btn btn-hover-rise btn-block btn-active-primary">
                                    <span class="indicator-label btn-login">Log in</span>
                                    <span class="indicator-progress wait-login">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <p><center>Klinik 9COrthodontics {{ date('Y') }}</center></p>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>



    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script>
        async function postData(url, formData, token) {
            try {
                const response = await fetch(
                    url, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": token
                        },
                        body: formData
                    });
                if(response.status === 200){
                    const data = await response.json();
                    return data;
                }else if(response.status === 429){
                    return {"code" : 199, "message" : "Oops, Anda melakukan request yang tidak wajar"}
                }else if(response.status === 419){
                    return {"code" : 199, "message" : "Silahkan refresh ulang browser dan lakukan login kembali"}
                }

            } catch (err) {
                console.log(err);
            }
        }
        const saveData = document.querySelector("#kt_sign_in_submit");
        
        if (saveData) {
            document.querySelector('#form').addEventListener('submit', async (event) => {
                event.preventDefault();
                document.querySelector('.btn-login').style.setProperty('display', 'none');
                document.querySelector('.wait-login').style.setProperty('display', 'block');
                const button = document.querySelector('button');
                button.disabled = true;

                const queryForm = document.querySelector('form');
                let dataForm = new FormData(queryForm);
                const dataToken = document.querySelector('input[name=_token]')
                let post = await postData("{{ route('login-member') }}", dataForm, dataToken);
                if (post.code == 222) {
                    location.assign(post.data.url);
                } else {
                    Swal.fire({
                        text: post.message,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn"
                        },
                    });
                    document.querySelector('.btn-login').style.setProperty('display', 'block');
                    document.querySelector('.wait-login').style.setProperty('display', 'none');
                    button.disabled = false;

                }

            });
        }
    </script>
    <script>
        AOS.init();
    </script>

</body>

</html>