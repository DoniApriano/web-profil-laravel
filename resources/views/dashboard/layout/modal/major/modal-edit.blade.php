<div class="modal fade" id="modal-edit-major" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Ubah Data Kejuruan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="major_id" id="major-id">
                <div class="text-center">
                    <img src="" alt="" id="image-edit-preview" class="img-fluid">
                </div>
                <div class="mb-3">
                    <label for="image-edit" class="form-label">Gambar</label>
                    <input id="image-edit" type="file" value="{{ old('image_edit') }}" name="image_edit"
                        class="form-control"autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="name-edit" class="form-label">Nama</label>
                    <input id="name-edit" type="text" value="{{ old('name_edit') }}" name="name_edit"
                        class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="description-edit" class="form-label">Deskripsi</label>
                    <textarea id="description-edit" type="text" value="{{ old('description_edit') }}" name="description_edit"
                        class="form-control"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-description-edit"></div>
                </div>
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
        let major_id = $('#major-id').val();
        let image = $('#image-edit')[0].files[0];
        let formData = new FormData();
        formData.append('name', $('#name-edit').val());
        formData.append('image', image);
        formData.append('description', $('#description-edit').val());
        let csrfToken = $("meta[name='csrf-token']").attr("content");

        var updateRoute = "{{ route('major.update', ['id' => ':major_id']) }}";
        updateRoute = updateRoute.replace(':major_id', major_id);
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
                $('#name-edit').val('');
                $('#email-edit').val('');
                $('#password-edit').val('');

                $('#tbl-major').DataTable().ajax.reload();

                $('#modal-edit-major').modal('hide');
            },

            error: function(error) {
                console.log(error.responseJSON);
                if (error.responseJSON.name) {
                    $('#alert-name-edit').removeClass('d-none');
                    $('#alert-name-edit').addClass('d-block');
                    $('#alert-name-edit').html(error.responseJSON.name);
                }
                if (error.responseJSON.description) {
                    $('#alert-description-edit').removeClass('d-none');
                    $('#alert-description-edit').addClass('d-block');
                    $('#alert-description-edit').html(error.responseJSON.description);
                }
                if (error.responseJSON.image) {
                    $('#alert-image-edit').removeClass('d-none');
                    $('#alert-image-edit').addClass('d-block');
                    $('#alert-image-edit').html(error.responseJSON.image);
                }
            }
        });
    });
</script>
