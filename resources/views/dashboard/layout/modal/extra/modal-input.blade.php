<div class="modal fade" id="modal-input-extra" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Tambah Ekstrakurikuler
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="image" class="form-label">Lambang</label>
                    <input id="image" type="file" value="" name="image" class="form-control" autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image"></div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input id="name" type="text" value="{{ old('name') }}" name="name" class="form-control"
                        id="name" autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" type="text" name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-description"></div>
                </div>
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

        let formData = new FormData();
        formData.append('image', image);
        formData.append('name', $('#name').val());
        formData.append('description', $('#description').val());

        var createRoute = "{{ route('extra.store') }}";

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
                $('#description').val('');
                $('#image').val('');

                // reload tabel
                $('#tbl-extra').DataTable().ajax.reload();

                // Tutup
                $('#modal-input-extra').modal('hide');
            },

            error: function(error) {
                console.log(error.responseJSON);
                if (error.responseJSON.name) {
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');
                    $('#alert-name').html(error.responseJSON.name);
                }
                if (error.responseJSON.image) {
                    $('#alert-image').removeClass('d-none');
                    $('#alert-image').addClass('d-block');
                    $('#alert-image').html(error.responseJSON.image);
                }
                if (error.responseJSON.description) {
                    $('#alert-description').removeClass('d-none');
                    $('#alert-description').addClass('d-block');
                    $('#alert-description').html(error.responseJSON.description);
                }
            }
        });
    });
</script>
