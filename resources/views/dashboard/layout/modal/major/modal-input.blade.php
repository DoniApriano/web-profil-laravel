<div class="modal fade" id="modal-input-major" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Tambah Kejuruan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input id="image" type="file" value="{{ old('image') }}" name="image"
                        class="form-control"autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image"></div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input id="name" type="text" value="{{ old('name') }}" name="name"
                        class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" type="text" value="{{ old('description') }}" name="description" class="form-control"></textarea>
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
        formData.append('name', $('#name').val());
        formData.append('image', image);
        formData.append('description', $('#description').val());

        var createRoute = "{{ route('major.store') }}";

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

                // reload tabel
                $('#tbl-major').DataTable().ajax.reload();

                // Tutup
                $('#modal-input-major').modal('hide');
            },

            error: function(error) {
                if (error.responseJSON.name) {
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');
                    $('#alert-name').html(error.responseJSON.name);
                }
                if (error.responseJSON.description) {
                    $('#alert-description').removeClass('d-none');
                    $('#alert-description').addClass('d-block');
                    $('#alert-description').html(error.responseJSON.description);
                }
                if (error.responseJSON.image) {
                    $('#alert-image').removeClass('d-none');
                    $('#alert-image').addClass('d-block');
                    $('#alert-image').html(error.responseJSON.image);
                }
            }
        });
    });
</script>
