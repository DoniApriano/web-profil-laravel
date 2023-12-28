<div class="modal fade" id="modal-edit-extra" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Modal title
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="text-center">
                        <img id="image-edit-preview" src="" width="150">
                    </div>
                    <input type="hidden" name="extra_id" id="extra-id">
                    <label for="image-edit" class="form-label">Lambang</label>
                    <input id="image-edit" type="file" value="" name="image_edit" class="form-control"
                        autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="name-edit" class="form-label">Nama</label>
                    <input id="name-edit" type="text" value="{{ old('name-edit') }}" name="name-edit"
                        class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="description-edit" class="form-label">Deskripsi</label>
                    <textarea id="description-edit" type="text" name="description-edit" class="form-control">{{ old('description-edit') }}</textarea>
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
        let image_edit = $('#image-edit')[0].files[0];
        let extra_id = $('#extra-id').val();
        let formData = new FormData();
        formData.append('name_edit', $('#name-edit').val());
        formData.append('description_edit', $('#description-edit').val());
        formData.append('image_edit', image_edit);
        let csrfToken = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/dashboard/ekstrakurikuler/update/${extra_id}`,
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

                $('#tbl-extra').DataTable().ajax.reload();

                $('#modal-edit-extra').modal('hide');
            },

            error: function(error) {
                console.log(error.responseJSON);
                if (error.responseJSON.name_edit) {
                    $('#alert-name-edit').removeClass('d-none');
                    $('#alert-name-edit').addClass('d-block');
                    $('#alert-name-edit').html(error.responseJSON.name_edit);
                }
                if (error.responseJSON.image_edit) {
                    $('#alert-image-edit').removeClass('d-none');
                    $('#alert-image-edit').addClass('d-block');
                    $('#alert-image-edit').html(error.responseJSON.image_edit);
                }
                if (error.responseJSON.description_edit) {
                    $('#alert-description-edit').removeClass('d-none');
                    $('#alert-description-edit').addClass('d-block');
                    $('#alert-description-edit').html(error.responseJSON.description_edit);
                }
            }
        });
    });
</script>
