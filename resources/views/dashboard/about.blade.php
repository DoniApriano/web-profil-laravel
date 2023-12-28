@extends('dashboard.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Tentang Website</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="text" class="form-label">Tulisan</label>
                    <textarea id="text" type="text" name="text" class="form-control" autofocus>{{ $about->text }}</textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-text"></div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success" id="btn-store">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#btn-store').click(function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('text', $('#text').val());
            console.log($('#text').val());

            $.ajax({
                url: `/dashboard/tentang/store`,
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
                        timer: 3000,
                    });
                },

                error: function(error) {
                    console.log(error.responseJSON);
                    if (error.responseJSON.text) {
                        $('#alert-text').removeClass('d-none');
                        $('#alert-text').addClass('d-block');
                        $('#alert-text').html(error.responseJSON.text);
                    }
                }
            });
        });
    </script>
@endsection
