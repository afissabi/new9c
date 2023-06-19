@extends('layouts.app')

@section('custom_css')
<style>
    #picture__input {
        display: none; 
    }

    .picture {
        width: 300px;
        aspect-ratio: 16/9;
        background: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        border: 2px dashed currentcolor;
        cursor: pointer;
        font-family: sans-serif;
        transition: color 300ms ease-in-out, background 300ms ease-in-out;
        outline: none;
        overflow: hidden;
    }

    .picture:hover {
        color: #777;
        background: #ccc;
    }

    .picture:active {
        border-color: turquoise;
        color: turquoise;
        background: #eee;
    }

    .picture:focus {
        color: #777;
        background: #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .picture__img {
        max-width: 100%;
    }
</style>
@endsection

@section('content')
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
<?php
    $opsi = ['Tidak','Ya'];
?>
<div class="card card-flush">
    <div class="card-header pt-8">
        <div class="card-title">
            <h2 style="color:#fff">Edit artikel terkait {{ $kategori }}</h2>
        </div>
    </div>
    <div class="card-body">
        <form class="form" id="form" method="post">
            <input type="hidden" class="form-control" name="artikel" value="{{ $artikel->id_artikel }}">
            <input type="hidden" class="form-control" name="kategori" value="{{ $kategori }}">
            <div class="fv-row row mb-15">
                <div class="col-md-3">
                    <label class="fs-6 fw-bold">Judul</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="judul" placeholder="Judul" value="{{ $artikel->judul }}">
                </div>
            </div>
            @if($kategori == 'galeri')
            <div class="fv-row row mb-15">
                <div class="col-md-3">
                    <label class="fs-6 fw-bold mt-2">Peruntukan</label>
                    <div class="text-muted fs-7">Pilih Galeri Akan Tampil Dimana...</div>
                </div>
                <div class="col-md-9">
                    <select name="kategori_galeri" id="kategori_galeri" data-control="select2" class="form-select mb-2">
                        <option value="MISOL">MISI SOSIAL</option>
                        <option value="EVENT">EVENT</option>
                    </select>
                </div>
            </div>
            @endif
            <div class="fv-row row mb-15">
                <div class="col-md-3">
                    <label class="fs-6 fw-bold">Gambar</label>
                </div>
                <div class="col-md-4">
                    <label class="picture" for="picture__input" tabIndex="0">
                        <span class="picture__image"></span>
                    </label>
                    <input type="file" name="gambar" id="picture__input" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset($artikel->path . $artikel->gambar)}}" style="width: 160px;border: 1px dashed;">
                </div>
            </div>
            <div class="fv-row row mb-15">
                <div class="col-md-3">
                    <label class="fs-6 fw-bold mt-2">Isi Konten</label>
                    <div class="text-muted fs-7">Tuliskan isi konten anda disini</div>
                </div>
                <div class="col-md-9">
                    <textarea name="konten" id="kt_docs_ckeditor_classic">{{ $artikel->konten }}</textarea>
                </div>
            </div>
            <div class="fv-row row mb-15">
                <div class="col-md-3">
                    <label class="fs-6 fw-bold mt-2">Link</label>
                    <div class="text-muted fs-7">Tuliskan link disini</div>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="link" id="link" value="{{ $artikel->link }}" data-placeholder="Input link...">
                </div>
            </div>
            <div class="fv-row row mb-15">
                <div class="col-md-3">
                    <label class="fs-6 fw-bold mt-2">Terjadwal</label>
                    <div class="text-muted fs-7">Jika konten akan ditampilkan sesuai jadwal pilih Ya...</div>
                </div>
                <div class="col-md-9">
                    <select name="is_jadwal" id="is_jadwal" aria-label="Select a date format" data-hide-search="true" data-control="select2" data-placeholder="Pilih penjadwalan..." class="form-select mb-2">
                        @foreach($opsi as $key => $value)
                            <option value="{{ $key }}" {{ $key == $artikel->is_jadwal ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($artikel->is_jadwal == 1)
            <div class="fv-row row mb-15" id="jadwal">
            @else
            <div class="fv-row row mb-15" style="display:none" id="jadwal">
            @endif
                <div class="col-md-3">
                    <label class="fs-6 fw-bold">Tanggal Tayang</label>
                </div>
                <div class="col-md-9">
                    <input type="date" class="form-control" name="jadwal" value="{{ $artikel->jadwal }}" data-placeholder="Pilih tanggal tayang...">
                </div>
            </div>
            <div class="row mt-12">
                <div class="col-md-9 offset-md-3">
                    <a href="{{ url('website/artikel/' . $kategori) }}" class="btn btn-warning me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary" id="kt_file_manager_settings_submit">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </form>
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
    const inputFile = document.querySelector("#picture__input");
    const pictureImage = document.querySelector(".picture__image");
    const pictureImageTxt = "Pilih Gambar";
    pictureImage.innerHTML = pictureImageTxt;

    inputFile.addEventListener("change", function (e) {
    const inputTarget = e.target;
    const file = inputTarget.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function (e) {
        const readerTarget = e.target;

        const img = document.createElement("img");
        img.src = readerTarget.result;
        img.classList.add("picture__img");

        pictureImage.innerHTML = "";
        pictureImage.appendChild(img);
        });

        reader.readAsDataURL(file);
    } else {
        pictureImage.innerHTML = pictureImageTxt;
    }
    });

</script>
<script>
    $("#is_jadwal").change(function() {
	    if ( $(this).val() == "1") {
            $("#jadwal").show();
        }else{
            $("#jadwal").hide();
        }
	});
    // POST TAMBAH KONTEN
    $(function () {
        $("#form").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menyimpan perubahan tersebut ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Yakin!",
                closeOnConfirm: false,
                allowOutsideClick: false,
            }).then(function(result) {
                $('#loading').modal({backdrop:'static', keyboard:false});
                $('#loading').modal('show');
                if (result.value) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url: "{{ url('website/artikel/ubah') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                    })
                    .done(function(hasil) {
                        var tittle = "";
                        var icon = "";
                        $('#loading').modal('hide');

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
                                $('#loading').modal('hide');
                                window.location.href = `{{ url('website/artikel') }}/${hasil.kategori}`
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
@endsection