<div class="modal fade" id="modal-edit-category" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Ubah Data Kategori Artikel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="category_id" id="category-id">
                <div class="mb-3">
                    <label for="name-edit" class="form-label">Nama</label>
                    <input id="name-edit" type="text" value="{{ old('name_edit') }}" name="name_edit"
                        class="form-control"autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>
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
        let category_id = $('#category-id').val();
        let formData = new FormData();
        formData.append('name_edit', $('#name-edit').val());
        formData.append('password_edit', $('#password-edit').val());
        formData.append('email_edit', $('#email-edit').val());
        formData.append('level', $('#level').val());
        let csrfToken = $("meta[name='csrf-token']").attr("content");

        var updateRoute = "{{ route('category.update', ['id' => ':category_id']) }}";
        updateRoute = updateRoute.replace(':category_id', category_id);
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

                $('#tbl-category').DataTable().ajax.reload();

                $('#modal-edit-category').modal('hide');
            },

            error: function(error) {
                console.log(error.responseJSON);
                if (error.responseJSON.name_edit) {
                    $('#alert-name-edit').removeClass('d-none');
                    $('#alert-name-edit').addClass('d-block');
                    $('#alert-name-edit').html(error.responseJSON.name_edit);
                }
            }
        });
    });
</script>
