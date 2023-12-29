@extends('dashboard.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Kategori Artikel</h4>
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-open-modal-input">Tambah
                    Kategori Artikel</a>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap ">
                    <table class="table table-hover" id="tbl-category">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
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
    @include('dashboard.layout.modal.category.modal-input')
    @include('dashboard.layout.modal.category.delete')
    @include('dashboard.layout.modal.category.modal-edit')
    <script>
        $('body').on('click', '#btn-open-modal-input', function() {
            $('#modal-input-category').modal('show');
        });
        $('body').on('click', '#btn-edit', function() {
            //id
            let category = $(this).data('id');
            console.log(category);

            var showRoute = "{{ route('category.show', ['id' => ':category']) }}";
            showRoute = showRoute.replace(':category', category);

            $.ajax({
                url: showRoute,
                type: "GET",
                cache: false,
                success: function(response) {
                    console.log(response);
                    $('#category-id').val(response.data.id);
                    $('#name-edit').val(response.data.name);

                    //open modal
                    $('#modal-edit-category').modal('show');
                }
            });
        });
        $(document).ready(function() {
            $('#tbl-category').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('category.index') }}',
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
                        data: 'name',
                        name: 'name'
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
