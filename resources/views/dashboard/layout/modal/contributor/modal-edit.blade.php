<div class="modal fade" id="modal-edit-contributor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Modal title
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name-edit" class="form-label">Nama</label>
                    <input id="name-edit" type="text" value="{{ old('name_edit') }}" name="name_edit"
                        class="form-control"autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="email-edit" class="form-label">Email</label>
                    <input id="email-edit" type="email" value="{{ old('email_edit') }}" name="email_edit"
                        class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email-edit"></div>
                </div>
                <div class="mb-3">
                    <label for="password-edit" class="form-label">Kata Sandi</label>
                    <input id="password-edit" type="password" value="{{ old('password_edit') }}" name="password_edit"
                        class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password-edit"></div>
                </div>
                <input id="level" type="hidden" name="level" value="contributor">
                <input id="user-id" type="hidden" name="user_id">
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
        let user_id = $('#user-id').val();
        let formData = new FormData();
        formData.append('name_edit', $('#name-edit').val());
        formData.append('password_edit', $('#password-edit').val());
        formData.append('email_edit', $('#email-edit').val());
        formData.append('level', $('#level').val());
        let csrfToken = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/pengguna/update/${user_id}`,
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

                $('#tbl-contributor').DataTable().ajax.reload();

                $('#modal-edit-contributor').modal('hide');
            },

            error: function(error) {
                console.log(error.responseJSON);
            }
        });
    });
</script>
