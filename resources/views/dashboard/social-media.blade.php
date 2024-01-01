@extends('dashboard.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Social Media Sekolah</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input id="instagram" type="text" name="instagram" class="form-control" value="{{ old('instagram',$socialMedia->instagram) }}" >
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-instagram"></div>
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input id="facebook" type="text" name="facebook" class="form-control" value="{{ old('facebook',$socialMedia->facebook) }}" >
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-facebook"></div>
                </div>
                <div class="mb-3">
                    <label for="youtube" class="form-label">YouTube</label>
                    <input id="youtube" type="text" name="youtube" class="form-control" value="{{ old('youtube',$socialMedia->youtube) }}" >
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-youtube"></div>
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
            formData.append('instagram', $('#instagram').val());
            formData.append('facebook', $('#facebook').val());
            formData.append('youtube', $('#youtube').val());
            console.log($('#text').val());

            var createRoute = "{{ route('social-media.store') }}";

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
                        timer: 3000,
                    });
                },

                error: function(error) {
                    console.log(error.responseJSON);
                    if (error.responseJSON.instagram) {
                        $('#alert-instagram').removeClass('d-none');
                        $('#alert-instagram').addClass('d-block');
                        $('#alert-instagram').html(error.responseJSON.instagram);
                    }
                    if (error.responseJSON.facebook) {
                        $('#alert-facebook').removeClass('d-none');
                        $('#alert-facebook').addClass('d-block');
                        $('#alert-facebook').html(error.responseJSON.facebook);
                    }
                    if (error.responseJSON.youtube) {
                        $('#alert-youtube').removeClass('d-none');
                        $('#alert-youtube').addClass('d-block');
                        $('#alert-youtube').html(error.responseJSON.youtube);
                    }
                }
            });
        });
    </script>
@endsection
