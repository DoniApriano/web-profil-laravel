<script>
    $('body').on('click', '#btn-delete', function() {
        let user_id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                var deleteRoute = "{{ route('contributor.delete', ['id' => ':user_id']) }}";
                deleteRoute = deleteRoute.replace(':user_id', user_id);
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
                        $('#tbl-contributor').DataTable().ajax.reload();
                    }
                });


            }
        })

    });
</script>
