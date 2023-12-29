@extends('dashboard.layout.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Tulisan Pada Halaman Utama</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-center">
                        <img id="image-preview" src="/storage/home/{{ $mainPage->image }}" alt="Halaman Utama">
                    </div>
                    <label for="image" class="form-label">Gambar</label>
                    <input id="image" type="file" value="{{ $mainPage->image }}" name="image" class="form-control"
                        autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image"></div>
                </div>
                <div class="mb-3">
                    <label for="primary-quote" class="form-label">Tulisan Utama</label>
                    <input id="primary-quote" type="text" name="primary_quote" value="{{ $mainPage->primary_quote }}"
                        class="form-control" autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-primary-quote"></div>
                </div>
                <div class="mb-3">
                    <label for="secondary-quote" class="form-label">Tulisan Utama</label>
                    <textarea id="secondary-quote" type="text" name="secondary_quote" class="form-control" autofocus>{{ $mainPage->secondary_quote }}</textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-secondary-quote"></div>
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

            let image = $('#image')[0].files[0];

            let formData = new FormData();
            formData.append('primary_quote', $('#primary-quote').val());
            formData.append('secondary_quote', $('#secondary-quote').val());
            formData.append('image', image);

            var createRoute = "{{ route('home.store') }}";

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
                    $('#image-preview').attr('src', '/storage/home/' + response.data.image);
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
                    console.log(error);
                    if (error.responseJSON.primary_quote) {
                        $('#alert-primary-quote').removeClass('d-none');
                        $('#alert-primary-quote').addClass('d-block');
                        $('#alert-primary-quote').html(error.responseJSON.primary_quote);
                    }
                    if (error.responseJSON.secondary_quote) {
                        $('#alert-secondary-quote').removeClass('d-none');
                        $('#alert-secondary-quote').addClass('d-block');
                        $('#alert-secondary-quote').html(error.responseJSON.secondary_quote);
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
@endsection
