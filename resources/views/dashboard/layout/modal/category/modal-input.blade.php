<div class="modal fade" id="modal-input-category" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Tambah Kategori Artikel
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

        var createRoute = "{{ route('category.store') }}";

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
                $('#tbl-category').DataTable().ajax.reload();

                // Tutup
                $('#modal-input-category').modal('hide');
            },

            error: function(error) {
                if (error.responseJSON.name) {
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');
                    $('#alert-name').html(error.responseJSON.name);
                }
            }
        });
    });
</script>
