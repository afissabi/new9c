<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
        </svg>
    </span>
</div>
<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js') }}"></script>
<script>
    function buttonProcess(isProcess = true) {
        const btnSimpanWithProcess = document.querySelector('.label-btn-simpan');
        if (isProcess) {
            if(btnSimpanWithProcess){
                btnSimpanWithProcess.style.setProperty('display', 'none');
                document.querySelector('.wait-save').style.setProperty('display', 'block');
                const button = document.querySelector('.btn-simpan');
                button.disabled = true;
            }
        } else {
            if(btnSimpanWithProcess){
                btnSimpanWithProcess.style.setProperty('display', 'block');
                document.querySelector('.wait-save').style.setProperty('display', 'none');
                const button = document.querySelector('.btn-simpan');
                button.disabled = false;
            }
        }
    }

    function swalWithConfirmation(title, text, confirmButton, fn, titleSuccess, textSuccess, callURL = false) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButton
        }).then((result) => {
            if (result.isConfirmed) {
                if (!callURL) {
                    fn();
                    swalConfirmOK(titleSuccess, textSuccess, false)
                }
                if (callURL) {
                    (async () => {
                        buttonProcess();
                        let response = await fn();
                        if (response.success) {
                            let nextUrl = response.data.nextURL ?? null
                            buttonProcess(false);
                            swalConfirmOK(titleSuccess, textSuccess, true, nextUrl)
                        } else {
                            buttonProcess(false);
                            if (response.code == 422) {
                                swalFailedOK("Gagal", response.message, response.data, true)
                            } else {
                                swalFailedOK("Gagal", response.message, null)
                            }
                        }
                    })()
                }
            }
        })
    }

    function swalConfirmOK(titleSuccess, textSuccess, refreshPage = true, nextUrl = null) {
        Swal.fire({
            title: titleSuccess,
            text: textSuccess,
            icon: 'success',
        }).then((result) => {
            if (result.isConfirmed) {
                if (nextUrl === null && refreshPage) {
                    location.assign(window.location.href);
                } else if (nextUrl !== null && refreshPage) {
                    location.assign(nextUrl);
                }
            }
        })
    }

    function swalFailedOK(titleFailed, textFailed, data, isValidation = false) {
        Swal.fire({
            title: titleFailed,
            text: textFailed,
            icon: 'error',
        }).then((result) => {
            if (result.isConfirmed) {
                if (data !== null && isValidation) {
                    showErrorForm(data)
                }
            }
        })
    }

    function swalWarningOK(titleWarning, textWarning) {
        Swal.fire({
            title: titleWarning,
            text: textWarning,
            icon: 'warning',
        }).then((result) => {
        })
    }

    function showErrorForm(dataValidation) {
        // for (var i = 0; i < dataValidation.length; i++) {
        //     console.log(dataValidation[i]);
        // }
        // let el = document.querySelector(`[name=${index}]`)
        //     el.classList.add('is-invalid');
        //     el.afer(`<div class="invalid-feedback">${data[0]}</div>`)
    }
</script>
<script>
    async function serviceKeluar() {
        try {
            const token = "{{ csrf_token() }}"
            const response = await fetch(
                "{{ url('logout-member') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                });
            const data = await response.json();
            return data;
        } catch (err) {
            console.log(err);
        }
    }

    document.querySelector('.sign-out').addEventListener('click', async (event) => {
        event.preventDefault();
        swalWithConfirmation("Keluar?",
            "Apakah Anda Yakin Keluar?",
            "Ya, Keluar",
            serviceKeluar,
            "Berhasil", "", true);

    });
    document.querySelector('#view_pc .sign-out').addEventListener('click', async (event) => {
        event.preventDefault();
        swalWithConfirmation("Keluar?",
            "Apakah Anda Yakin Keluar?",
            "Ya, Keluar",
            serviceKeluar,
            "Berhasil", "", true);

    });
</script>

{{-- <script>
    var current = window.location.href;
    console.log(current);
    // if (current === ""){
    //     return ""
    // };
    var menuItems = document.querySelectorAll('.menu-item a');
    for (var i = 0, len = menuItems.length; i < len; i++) {
        if (menuItems[i].getAttribute("href").indexOf(current) !== -1) {
            menuItems[i].className += " active";
            document.querySelector('.active').closest('.menu-accordion').classList.add('here');
            document.querySelector('.active').closest('.menu-accordion').classList.add('show');
        }
    }
</script> --}}
@yield('custom_js')
@stack('scripts')
<!--end::Javascript-->
