@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body text-sm">
            <h2 class="mb-4">Daftar Pengajuan Magang</h2>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center" id="table_pengajuan">
                    <thead>
                        <tr>
                            <th class="text-start">No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Judul Lowongan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataPengajuan;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            dataPengajuan = $('#table_pengajuan').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('pengajuan/list') }}",
                    type: "POST",
                    dataType: "json",
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "mahasiswa",
                        className: "text-center"
                    },
                    {
                        data: "lowongan",
                        className: "text-center"
                    },
                    {
                        data: "tanggal_pengajuan_mulai",
                        className: "text-center"
                    },
                    {
                        data: "tanggal_pengajuan_selesai",
                        className: "text-center"
                    },
                    {
                        data: "status_pengajuan",
                        className: "text-center"
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data.replace(
                                /<a href="([^"]+)" class="btn btn-info btn-sm">Detail<\/a>/,
                                '<button class="btn btn-info btn-sm" onclick="modalAction(\'$1\')">Detail</button>'
                            );
                        }
                    }
                ],
                language: {
                    search: "", // Kosongkan default label
                    searchPlaceholder: "Cari Pengajuan...",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    zeroRecords: "Tidak ditemukan pengajuan yang sesuai",
                    info: "Menampilkan _START_-_END_ dari _TOTAL_ entri",
                    infoEmpty: "Data tidak tersedia",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                    paginate: {
                        first: "<i class='fas fa-angle-double-left'></i>",
                        last: "<i class='fas fa-angle-double-right'></i>",
                        next: "<i class='fas fa-angle-right'></i>",
                        previous: "<i class='fas fa-angle-left'></i>"
                    },
                    processing: '<div class="d-flex justify-content-center"><i class="fas fa-spinner fa-pulse fa-2x fa-fw text-primary"></i><span class="ms-2">Memuat data...</span></div>'
                },
            });
        });
    </script>
@endpush
