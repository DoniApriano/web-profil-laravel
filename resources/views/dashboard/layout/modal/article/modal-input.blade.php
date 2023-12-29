<div class="modal fade" id="modal-input-article" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Tambah Artikel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input id="image" type="file" value="" name="image" class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image"></div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input id="title" type="text" value="{{ old('title') }}" name="title"
                        class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Kategori</label>
                    <select class="form-select form-select-md" name="category_id" id="category">
                        <option value="" selected>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-category"></div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Isi Konten</label>
                    <textarea id="content" type="text" rows="20" style="height:300px;" name="content" class="form-control">{{ old('content') }}</textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-content"></div>
                </div>
                <script>
                    CKEDITOR.replace('content');
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-store">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-store').click(function(e) {
        e.preventDefault();

        let image = $('#image')[0].files[0];
        var editor = CKEDITOR.instances['content'];
        console.log(editor);

        let formData = new FormData();
        formData.append('image', image);
        formData.append('title', $('#title').val());
        formData.append('category_id', $('#category').val());
        formData.append('content', editor.getData());

        var createRoute = "{{ route('article.store') }}";

        $.ajax({
            url: createRoute,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                console.log(response);
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                $('#title').val('');
                $('#image').val('');
                $('#category_id').val('');
                editor.setData('');

                // reload tabel
                $('#tbl-article').DataTable().ajax.reload();

                // Tutup
                $('#modal-input-article').modal('hide');
            },

            error: function(error) {
                console.log(error.responseJSON);
                if (error.responseJSON.title) {
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');
                    $('#alert-title').html(error.responseJSON.title);
                }
                if (error.responseJSON.image) {
                    $('#alert-image').removeClass('d-none');
                    $('#alert-image').addClass('d-block');
                    $('#alert-image').html(error.responseJSON.image);
                }
                if (error.responseJSON.content) {
                    $('#alert-content').removeClass('d-none');
                    $('#alert-content').addClass('d-block');
                    $('#alert-content').html(error.responseJSON.content);
                }
                if (error.responseJSON.category_id) {
                    $('#alert-category').removeClass('d-none');
                    $('#alert-category').addClass('d-block');
                    $('#alert-category').html(error.responseJSON.category_id);
                }
            }
        });
    });
</script>
