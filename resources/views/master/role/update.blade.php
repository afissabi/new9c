@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                Form Ubah Role
            </div>
        </div>
        <div class="card-body pt-0">
            <form id="form">
                <div class="mb-10" style="margin-top: 22px;">
                    <label for="form_name" class="required form-label">
                        Nama Role
                    </label>
                    <input type="text" class="form-control form-control-solid" placeholder="Nama Role" name="name"
                        value="{{ $role->name }}">
                </div>
                <div class="mb-10">
                    <label for="form_name" class="required form-label">
                        Permission
                    </label>
                    <div class="d-flex justify-content-end mb-3" data-kt-customer-table-toolbar="base">
                        <input type="text" class="form-control h-40px" name="search" placeholder="Cari ..."
                            data-kt-search-element="input" id="search">
                    </div>
                    <div class="row">
                        @foreach ($permission as $item)
                            <div class="col-md-3 mb-5 v_cari" data-filter-name="{{ strtolower($item->name) }}">
                                <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="flexCheckDefault"
                                    name="permission[]" {{ in_array($item->id, $rolePermissions) ? 'checked' : '' }} />
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $item->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-10">
                    <label for="form_name" class="required form-label">
                        Menu By Role
                    </label>
                    <div class="d-flex justify-content-end mb-3" data-kt-customer-table-toolbar="base">
                        <input type="text" class="form-control h-40px" name="search" placeholder="Cari ..."
                            data-kt-search-element="input" id="search">
                    </div>
                    <div class="row">
                        @foreach ($menuRole as $item)
                            <div class="col-md-3 mb-5 v_cari" data-filter-name="{{ strtolower($item->nama_role) }}">
                                <input class="form-check-input" type="checkbox" value="{{$item->id_menu}}" id="flexCheckDefault"
                                    name="menu[]" {{ $item->id_menu == $item->menu_id ? 'checked' : '' }} />
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $item->nama_menu }} | ({{ $item->tipe }})
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-md-6 text-center text-sm-center text-md-end text-lg-end mb-3">
                        <a href="{{ url('master/role') }}" class="btn btn-warning btn-block"><i
                                class="fas fa-arrow-circle-left"></i>Kembali</a>
                    </div>
                    <div class="col-md-6 text-center text-sm-center text-md-start text-lg-start">
                        <button type="submit" class="btn btn-success btn-block btn-simpan"><i class="fas fa-save"></i>
                            SIMPAN</button>
                    </div>
                </div>
            </form>
            {{-- <div class="table-responsive">
                <table class="table table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th>
                                Layanan
                            </th>
                            <th>
                                Form Name
                            </th>
                            <th>
                                Form Type
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        $("#search").bind('keyup', function() {
            var term = $(this).val().toLowerCase();
            $('.v_cari').each(function() {
                if ($(this).filter(`[data-filter-name*="${term}"]`).length > 0 || term.length < 1) {
                    $(this).show(500);
                } else {
                    $(this).hide(500);
                }
            });
        });

        async function serviceSimpan() {
            try {
                const form = document.querySelector('#form');
                let formData = new FormData(form);
                const token = "{{ csrf_token() }}"
                const response = await fetch(
                    "{{ url('/master/role/update', $role->id) }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": token
                        },
                        body: formData
                    });
                const data = await response.json();
                return data;
            } catch (err) {
                console.log(err);
            }
        }

        document.querySelector('#form').addEventListener('submit', async (event) => {
            event.preventDefault();
            swalWithConfirmation("Simpan?",
                "Apakah Anda Yakin Simpan?",
                "Ya, Simpan",
                serviceSimpan,
                "Berhasil", "", true);
        });
    </script>
@endsection
