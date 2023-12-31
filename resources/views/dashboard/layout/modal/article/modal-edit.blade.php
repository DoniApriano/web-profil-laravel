<div class="modal fade" id="modal-edit-article" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Ubah Ekstrakurikuler
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="article_id" id="article-id">
                <div class="text-center">
                    <img id="image-edit-preview" src="" width="150" height="100">
                </div>
                <div class="mb-3">
                    <label for="image-edit" class="form-label">Gambar</label>
                    <input id="image-edit" type="file" value="" name="image_edit" class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="title-edit" class="form-label">Judul</label>
                    <input id="title-edit" type="text" value="{{ old('title-edit') }}" name="title_edit"
                        class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Kategori</label>
                    <select class="form-select form-select-md" name="category_id" id="category-edit">
                        <option value="" selected>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-category-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="content-edit" class="form-label">Isi Konten</label>
                    <textarea id="content-edit" type="text" rows="20" style="height:300px;" name="content_edit"
                        class="form-control">{{ old('content-edit') }}</textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-content-edit"></div>
                </div>
                <script>
                    CKEDITOR.replace('content-edit');
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-update">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-update').click(function(e) {
        e.preventDefault();
        let image_edit = $('#image-edit')[0].files[0];
        let article_id = $('#article-id').val();
        var editor_edit = CKEDITOR.instances['content-edit'];
        let formData = new FormData();
        formData.append('image_edit', image);
        formData.append('title_edit', $('#title-edit').val());
        formData.append('category_id_edit', $('#category-edit').val());
        formData.append('content_edit', editor_edit.getData());

        var updateRoute = "{{ route('article.update', ['id' => ':article_id']) }}";
        updateRoute = updateRoute.replace(':article_id', article_id);

        $.ajax({
            url: updateRoute,
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

                $('#tbl-article').DataTable().ajax.reload();

                $('#modal-edit-article').modal('hide');
            },

            error: function(error) {
                console.log(error.responseJSON);
                if (error.responseJSON.title_edit) {
                    $('#alert-title-edit').removeClass('d-none');
                    $('#alert-title-edit').addClass('d-block');
                    $('#alert-title-edit').html(error.responseJSON.title_edit);
                }
                if (error.responseJSON.image_edit) {
                    $('#alert-image-edit').removeClass('d-none');
                    $('#alert-image-edit').addClass('d-block');
                    $('#alert-image-edit').html(error.responseJSON.image_edit);
                }
                if (error.responseJSON.content_edit) {
                    $('#alert-content-edit').removeClass('d-none');
                    $('#alert-content-edit').addClass('d-block');
                    $('#alert-content-edit').html(error.responseJSON.content_edit);
                }
                if (error.responseJSON.category_id_edit) {
                    $('#alert-category-edit').removeClass('d-none');
                    $('#alert-category-edit').addClass('d-block');
                    $('#alert-category-edit').html(error.responseJSON.category_id_edit);
                }
            }
        });
    });
</script>
