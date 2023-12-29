<div class="modal fade" id="modal-input-contributor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Tambah Pengguna
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input id="name" type="text" value="{{ old('name') }}" name="name" class="form-control"
                        id="name" autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" value="{{ old('email') }}" name="email" class="form-control"
                        id="email">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input id="password" type="password" value="{{ old('password') }}" name="password"
                        class="form-control" id="password">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password"></div>
                </div>
                <input id="level" type="hidden" name="level" value="contributor">
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

        let formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('password', $('#password').val());
        formData.append('email', $('#email').val());
        formData.append('level', $('#level').val());
        let csrfToken = $("meta[name='csrf-token']").attr("content");

        var createRoute = "{{ route('contributor.store') }}";

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
                $('#name').val('');
                $('#email').val('');
                $('#password').val('');
                $('#conf_password').val('');

                // reload tabel
                $('#tbl-contributor').DataTable().ajax.reload();

                // Tutup
                $('#modal-input-contributor').modal('hide');
            },

            error: function(error) {
                if (error.responseJSON.name) {
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');
                    $('#alert-name').html(error.responseJSON.name);
                }
                if (error.responseJSON.email) {
                    $('#alert-email').removeClass('d-none');
                    $('#alert-email').addClass('d-block');
                    $('#alert-email').html(error.responseJSON.email);
                }
                if (error.responseJSON.password) {
                    $('#alert-password').removeClass('d-none');
                    $('#alert-password').addClass('d-block');
                    $('#alert-password').html(error.responseJSON.password);
                }
            }
        });
    });
</script>
