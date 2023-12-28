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
                <h4>Tabel Pengguna</h4>
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-open-modal-input">Tambah Pengguna</a>
                @include('dashboard.layout.modal.contributor.modal-input')
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap ">
                    <table class="table table-hover" id="tbl-contributor">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
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
    @include('dashboard.layout.modal.contributor.modal-edit')

    <script>
        $('body').on('click', '#btn-edit', function() {
            //id
            let product_id = $(this).data('id');
            console.log(product_id);

            $.ajax({
                url: `/pengguna/${product_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    console.log(response);
                    $('#user-id').val(response.data.id);
                    $('#name-edit').val(response.data.name);
                    $('#email-edit').val(response.data.email);

                    //open modal
                    $('#modal-edit-contributor').modal('show');
                }
            });
        });
        $('body').on('click', '#btn-open-modal-input', function() {
            $('#modal-input-contributor').modal('show');
        });
        $(document).ready(function() {
            $('#tbl-contributor').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('contributor.index') }}',
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" id="btn-edit" data-id="' +
                                full.id + '" class="btn btn-primary btn-sm">EDIT</a> ' +
                                '<a href="javascript:void(0)" id="btn-delete" data-id="' +
                                full
                                .id + '" class="btn btn-danger btn-sm">DELETE</a>';
                        }
                    }

                ]
            });
        });
    </script>
    @include('dashboard.layout.modal.contributor.delete')
@endsection
