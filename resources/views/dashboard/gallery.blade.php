@extends('dashboard.layout.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Galeri</h4>
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-open-modal-input">Tambah
                    Galeri</a>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap ">
                    <table class="table table-hover" id="tbl-gallery">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ekstrakurikuler</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.layout.modal.gallery.modal-input')
    @include('dashboard.layout.modal.gallery.delete')
    <script>
        $('body').on('click', '#btn-open-modal-input', function() {
            $('#modal-input-gallery').modal('show');
        });
        $(document).ready(function() {
            $('#tbl-gallery').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('gallery.index') }}',
                createdRow: function(row, data, dataIndex) {
                    $(row).attr('id', 'index_' + data.id);
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'extra.name',
                        name: 'extra.name'
                    },
                    {
                        data: 'gallery.image',
                        name: 'gallery.image',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<img src="' + `/storage/gallery/${data}` +
                                '"  width="100" height="100">';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" id="btn-delete" data-id="' +
                            full
                                .id + '" class="btn btn-danger btn-sm">HAPUS</a>';
                        }
                    }

                ]
            });
        });
    </script>
@endsection
