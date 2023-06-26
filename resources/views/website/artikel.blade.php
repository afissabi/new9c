@extends('layouts.app')

@section('custom_css')
<style>
    .font-logo{
        font-size: 165px;
        text-align: center;
        color: #009ef7;
    }

    .bulat{
        background: #fff;
        color: #000;
        font-size: 20px;
        border-radius: 50%;
        width: 63px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tambah{
        width: 100%;
        font-size: 32px;
        text-align: center;
        display: block;
        background: #e3e3e357 !important;
        color: #7239ea !important;
        border: 2px dashed !important;
    }

    @media (min-width: 992px) {
        .tombol-hapus{
            display: inline-grid;
            margin-left: 90px;
        }    
    }

    @media (max-width: 576px) {
        .tombol-hapus{
            display: inline-grid;
            margin-left: 110px;
        }    
    }
</style>
@endsection

@section('content')
<input type="hidden" class="form-control" id="kategori" value="{{ $kategori }}">

<div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10" style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('assets/media/illustrations/unitedpalms-1/4.png')">
    <div class="card-header pt-10" style="background: #fff;">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-circle me-5">
                <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                    <span class="svg-icon svg-icon-2x svg-icon-primary">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="black" />
                            <path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="black" />
                        </svg> --}}
                        {{-- <img alt="Image" src="{{ asset('front/img/logo_transparant.png') }}" style="height: 30px;"> --}}
                    </span>
                </div>
            </div>
            <div class="d-flex flex-column">
                <h2 class="mb-1">Settings Artikel</h2>
                <div class="text-muted fw-bolder">
                    <a href="#">Artikel</a>
                    <span class="mx-3">|</span>
                    <a href="#">{{ $kategori }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pb-0" style="background: #fff;">
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_blog }}" href="{{ url('website/artikel/blog') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_press }}" href="{{ url('website/artikel/press') }}">Press Release</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_event }}" href="{{ url('website/artikel/event') }}">Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_fasilitas }}" href="{{ url('website/artikel/fasilitas') }}">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_sosial }}" href="{{ url('website/artikel/misi-sosial') }}">Misi Sosial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_acara }}" href="{{ url('website/artikel/acara') }}">Acara</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 {{ $active_galeri }}" href="{{ url('website/artikel/galeri') }}">Galeri</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card card-flush shadow-sm">
    <div class="card-header border-0 pt-6 justify-content-end ribbon ribbon-start">
        <div class="ribbon-label bg-danger" style="font-size: large;background-color:#d00 !important;">{{ ucfirst($kategori) }}</div>
        <div class="card-toolbar">
            <a href="{{ url('website/artikel/create/' . $kategori) }}" class="btn btn-sm btn-orange" style="background: #ff7c00;color: #fff;">
                <i class="fa fa-plus" style="color: #fff"></i> {{ $kategori }}
            </a>
        </div>
    </div>
    <div class="card-body py-5 table-responsive">
        <table id="table" class="table table-striped gy-5 gs-7 border rounded">
            <thead>
                <tr role="row">
                    <th width="2%"><center>NO</center></th>
                    {{-- <th><center>Kategori</center></th> --}}
                    <th><center>Jadwal Tayang</center></th>
                    <th><center>Status</center></th>
                    <th><center>Judul</center></th>
                    <th><center>Konten</center></th>
                    <th><center>Link</center></th>
                    <th><center>Gambar</center></th>
                    <th width="15%"><center>Detail</center></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Loading --}}
<div class="modal fade" tabindex="-1" id="loading" style="">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 85%;background-color: rgba(0,0,0,.0001) !important;box-shadow: none;">
            <div class="modal-body">
                <center>
                    <i class="fa fa-spinner fa-spin" style="font-size: 85px;color: cadetblue;"></i>
                    <br><br>
                    <h3 style="color: #ffffff;background: cadetblue;">Proses menyimpan data...</h3>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-inline.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-balloon.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-balloon-block.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-document.bundle.js') }}"></script>
<script>
    ClassicEditor
    .create(document.querySelector('#kt_docs_ckeditor_classic'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
</script>
<script>
    ClassicEditor
    .create(document.querySelector('#kt_docs_ckeditor_classic_edit'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
</script>
<script>
    var tabelData;

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
                url : "{{ url('website/artikel/datatable') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: function(data){
                    data.kategori  = $('#kategori').val();
                }
            },
            columnDefs: [{
                targets: [2, 3, 4],
                className: ''
            }]
        });
    })

    // VIEW EDIT KONTEN
    $('#table').on('click', '.edit', function (e) {
        var konten = $(this).data('id_konten_section');

        $.ajax({
            url: "{{ url('website/section/edit') }}",
            type: "post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                konten: konten,
            },
            success: function(msg){
                // Add response in Modal body
                if(msg){
                    $('#id_konten_section').val(msg.id_konten_section);
                    $('#kt_docs_ckeditor_classic_edit').val(msg.konten);
                    $('#section').val(msg.id_section).trigger("change");

                }
                // Display Modal
                $('#kt_modal_edit').modal('show');
            }
        });
    });


    // HAPUS KONTEN
    function hapusKonten(id_artikel) {
        swal.fire({
            title: "Apa Anda Yakin?",
            text: "Menghapus Data Tersebut",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "{{ url('website/artikel/destroy') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    data: {
                        id : id_artikel
                    }
                })
                .done(function(hasil) {
                    var tittle = "";
                    var icon = "";

                    if (hasil.status == true) {
                        title = "Berhasil!";
                        icon = "success";

                        swal.fire({
                            title: title,
                            text: hasil.pesan,
                            icon: icon,
                            button: "OK!",
                        }).then(function(result) {
                            load_data_table();
                        })
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
    }

    function load_data_table() {
        tabelData.ajax.reload(null, 'refresh');
    }

    function klinikAktif(id_data) {
        var checkBox = document.getElementById("is_aktif");
        
        if (checkBox.checked == true){
            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Mengubah Status Menjadi Tayang ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Ubah!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('website/artikel/aktif') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: {
                            id : id_data
                        }
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            }).then(function(result) {
                                load_data_table();
                            })
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
        } else {
            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Mengubah Status Menjadi Tidak Tayang ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Non Aktifkan!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('website/artikel/tidak-aktif') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        data: {
                            id : id_data
                        }
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";

                        if (hasil.status == true) {
                            title = "Berhasil!";
                            icon = "success";

                            swal.fire({
                                title: title,
                                text: hasil.pesan,
                                icon: icon,
                                button: "OK!",
                            }).then(function(result) {
                                load_data_table();
                            })
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
        }
    }
</script>
@endsection