<div class="modal fade" id="modal-input-gallery" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
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
                    <label for="image" class="form-label">Gambar</label>
                    <input id="image" type="file" value="" name="image" class="form-control" autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image"></div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <select class="form-select form-select-md" name="extra" id="extra" required>
                        <option value=""  selected>Pilih Ekstrakurikuler</option>
                        @foreach ($extras as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-extra"></div>
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
        formData.append('extra', $('#extra').val());

        var createRoute = "{{ route('gallery.store') }}";

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
                $('#tbl-gallery').DataTable().ajax.reload();

                // Tutup
                $('#modal-input-gallery').modal('hide');
            },

            error: function(error) {
                console.log(error.responseJSON);
                if (error.responseJSON.extra) {
                    $('#alert-extra').removeClass('d-none');
                    $('#alert-extra').addClass('d-block');
                    $('#alert-extra').html(error.responseJSON.extra);
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
