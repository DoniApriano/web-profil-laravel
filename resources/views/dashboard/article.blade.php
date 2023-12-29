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
                                <th>Isi Konten</th>
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
    @include('dashboard.layout.modal.article.modal-input')
    @include('dashboard.layout.modal.article.delete')
    @include('dashboard.layout.modal.article.modal-edit')
    <script>
        $('body').on('click', '#btn-open-modal-input', function() {
            $('#modal-input-article').modal('show');
        });
        $('body').on('click', '#btn-edit', function() {
            //id
            let article = $(this).data('id');
            var editor = CKEDITOR.instances['content-edit'];

            var showRoute = "{{ route('article.show', ['id' => ':article']) }}";
            showRoute = showRoute.replace(':article', article);

            $.ajax({
                url: showRoute,
                type: "GET",
                cache: false,
                success: function(response) {
                    console.log(response);
                    $('#article-id').val(response.data.id);
                    $('#title-edit').val(response.data.title);
                    $('#name-edit').val(response.data.name);
                    editor.setData(response.data.content);
                    $('#category-edit').empty();
                    $('#image-edit-preview').attr('src', `/storage/article/${response.data.image}`);

                    $('#category-edit').append('<option value="" selected>Pilih Kategori</option>');

                    response.categories.forEach(c => {
                        let isSelected = c.id == response.data.category.id ? 'selected' : '';
                        let option = `<option value="${c.id}" ${isSelected}>${c.name}</option>`;
                        $('#category-edit').append(option);
                    });

                    //open modal
                    $('#modal-edit-article').modal('show');
                }
            });
        });
        $(document).ready(function() {
            $('#tbl-article').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('article.index') }}',
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
                        data: 'content',
                        name: 'content',
                        render: function(data, type, row) {
                            return data.length > 50 ? data.substr(0, 50) + '...' : data;
                        }
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
