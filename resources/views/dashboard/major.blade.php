@extends('dashboard.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            @if (Session::has('success'))
                <div id="myalert" class="alert alert-success alert-dismissible" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-header">
                <h4>Tabel Kejuruan</h4>
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-open-modal-input">Tambah
                    Kejuruan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap ">
                    <table class="table table-hover" id="tbl-major">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
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

    @include('dashboard.layout.modal.major.modal-edit')
    @include('dashboard.layout.modal.major.delete')
    @include('dashboard.layout.modal.major.modal-input')

    <script>
        $('body').on('click', '#btn-open-modal-input', function() {
            $('#modal-input-major').modal('show');
        });
        $('body').on('click', '#btn-edit', function() {
            //id
            let major_id = $(this).data('id');
            console.log(major_id);

            var showRoute = "{{ route('major.show', ['id' => ':major_id']) }}";
            showRoute = showRoute.replace(':major_id', major_id);

            $.ajax({
                url: showRoute,
                type: "GET",
                cache: false,
                success: function(response) {
                    console.log(response);
                    $('#image-edit-preview').attr('src', `/storage/major-image/${response.data.image}`);
                    $('#major-id').val(response.data.id);
                    $('#name-edit').val(response.data.name);
                    $('#description-edit').val(response.data.description);

                    //open modal
                    $('#modal-edit-major').modal('show');
                }
            });
        });
        $(document).ready(function() {
            $('#tbl-major').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('major.index') }}',
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
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<img src="' + `/storage/major-image/${data}` +
                                '"  width="100" height="100">';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        render: function(data, type, row) {
                            return data.length > 50 ? data.substr(0, 50) + '...' : data;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" id="btn-edit" data-id="' +
                                full.id + '" class="btn btn-primary btn-sm">UBAH</a> ' +
                                '<a href="javascript:void(0)" id="btn-delete" data-id="' +
                                full
                                .id + '" class="btn btn-danger btn-sm">HAPUS</a>';
                        }
                    }

                ]
            });
        });
    </script>
@endsection
