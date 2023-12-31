@extends('dashboard.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Artikel</h4>
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-open-modal-input">Tambah Artikel</a>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap ">
                    <table class="table table-hover" id="tbl-article">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Pengirim</th>
                                <th>Kategori</th>
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
    @include('dashboard.layout.modal.all-article.delete')
    @include('dashboard.layout.modal.all-article.modal-show')
    <script>
        $('body').on('click', '#btn-show', function() {
            //id
            let article = $(this).data('id');

            var showRoute = "{{ route('all-article.show', ['id' => ':article']) }}";
            showRoute = showRoute.replace(':article', article);

            $.ajax({
                url: showRoute,
                type: "GET",
                cache: false,
                success: function(response) {
                    console.log(response);
                    $('#title').html(response.data.title);
                    $('#content').html(response.data.content);
                    $('#user').html(response.data.user.name);
                    $('#image').attr('src', `/storage/article/${response.data.image}`);
                    //open modal
                    $('#modal-show-article').modal('show');
                }
            });
        });
        $(document).ready(function() {
            $('#tbl-article').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('all-article.index') }}',
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
                            return '<img src="' + `/storage/article/${data}` +
                                '"  width="160" height="100">';
                        }
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'category.name',
                        name: 'category.name'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" id="btn-show" data-id="' +
                                full.id + '" class="btn btn-primary btn-sm">DETAIL</a> ' +
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
