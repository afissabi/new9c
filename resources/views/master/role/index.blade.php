@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                {{ $pageTitle }}
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <a href="{{ url('master/role/create') }}" class="btn btn-primary" data-bs-toogle="modal"
                        data-bs-target="#kt_modal_add_customer">
                        Tambah
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <table id="table-form" class="table table-striped gy-5 gs-7 border rounded">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Role</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        var tabelForm;

        $(function() {
            tabelForm = $('#table-form').DataTable({
                language: {
                    lengthMenu: "Show _MENU_",
                },
                dom: "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                ajax: {
                    url: "{{ url('master/role/datatable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    // data: function(data) {}
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]

            });
        })

        function hapus(id_data) {
            swal.fire({
                title: "Apa Anda Yakin?",
                text: "Menghapus Data Menu s",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                            type: "post",
                            url: "{{ url('master/form/destroy') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "json",
                            data: {
                                id: id_data
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
                                    if (result.value) {
                                        window.location.href = "{{ url('master/menu') }}"
                                    }
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
    </script>
@endsection
