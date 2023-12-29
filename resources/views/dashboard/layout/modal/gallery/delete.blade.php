<script>
    $('body').on('click', '#btn-delete', function() {
        let gallery_id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");

        var deleteRoute = "{{ route('gallery.delete', ['id' => ':gallery_id']) }}";
        deleteRoute = deleteRoute.replace(':gallery_id', gallery_id);

        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteRoute,
                    type: "DELETE",
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success: function(response) {

                        //show success message
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        // reload tabel
                        $('#tbl-gallery').DataTable().ajax.reload();
                    }
                });


            }
        })

    });
</script>
