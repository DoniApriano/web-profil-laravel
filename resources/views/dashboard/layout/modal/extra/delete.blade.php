<script>
    $('body').on('click', '#btn-delete', function() {
        let extra_id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");

        var deleteRoute = "{{ route('extra.delete', ['id' => ':extra_id']) }}";
        deleteRoute = deleteRoute.replace(':extra_id', extra_id);

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
                        $('#tbl-extra').DataTable().ajax.reload();
                    }
                });


            }
        })

    });
</script>
