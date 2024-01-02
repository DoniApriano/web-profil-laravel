@extends('dashboard.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Tentang Website</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-center">
                        <img class="img-fluid" id="welcome-text-image-preview"
                            src="/storage/welcome-image/{{ $welcomeText->image }}" alt="{{ $welcomeText->title }}">
                    </div>
                    <label for="image" class="form-label">Gambar</label>
                    <input id="image" type="file" value="{{ $welcomeText->image }}" name="image"
                        class="form-control" autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-image"></div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input id="title" type="text" value="{{ $welcomeText->title }}" name="title"
                        class="form-control" autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Sambutan</label>
                    <textarea id="text" type="text" name="text" class="form-control" autofocus>{{ $welcomeText->text }}</textarea>
                    <script>
                        CKEDITOR.replace('text');
                    </script>
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

            let image = $('#image')[0].files[0];
            var editor = CKEDITOR.instances['text'];

            let formData = new FormData();
            formData.append('text', editor.getData());
            formData.append('title', $('#title').val());
            formData.append('image', image);

            var createRoute = "{{ route('welcome-text.store') }}";

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
                    console.log(response.data);
                    $('#welcome-text-image-preview').attr('src', '/storage/welcome-image/' + response.data.image);
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
                    if (error.responseJSON.title) {
                        $('#alert-title').removeClass('d-none');
                        $('#alert-title').addClass('d-block');
                        $('#alert-title').html(error.responseJSON.title);
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
