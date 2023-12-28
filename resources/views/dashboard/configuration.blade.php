@extends('dashboard.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Konfigurasi Website</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-center">
                        <img id="config-icon" src="/storage/icon/{{ $config->icon }}" alt="{{ $config->title }}">
                    </div>
                    <label for="icon" class="form-label">Gambar</label>
                    <input id="icon" type="file" value="{{ $config->icon }}" name="icon" class="form-control"
                        autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input id="title" type="text" value="{{ $config->title }}" name="title" class="form-control"
                        autofocus>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Nomor Telepon</label>
                    <input id="phone_number" type="text" value="{{ $config->phone_number }}" name="phone_number"
                        class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-phone-number"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" value="{{ $config->email }}" name="email" class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input id="address" type="text" value="{{ $config->address }}" name="address" class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-address"></div>
                </div>
                <div class="mb-3">
                    <label for="open_hours" class="form-label">Jam Buka</label>
                    <input id="open_hours" type="text" value="{{ $config->open_hours }}" name="open_hours"
                        class="form-control">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-open-hours"></div>
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

            let icon = $('#icon')[0].files[0];

            let formData = new FormData();
            formData.append('title', $('#title').val());
            formData.append('icon', icon);
            formData.append('email', $('#email').val());
            formData.append('phone_number', $('#phone_number').val());
            formData.append('address', $('#address').val());
            formData.append('open_hours', $('#open_hours').val());

            var createRoute = "{{ route('configuration.store') }}";

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
                    $('#config-icon').attr('src', '/storage/icon/' + response.data.icon);
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
                    if (error.responseJSON.title) {
                        $('#alert-title').removeClass('d-none');
                        $('#alert-title').addClass('d-block');
                        $('#alert-title').html(error.responseJSON.title);
                    }

                    if (error.responseJSON.icon) {
                        $('#alert-icon').removeClass('d-none');
                        $('#alert-icon').addClass('d-block');
                        $('#alert-icon').html(error.responseJSON.icon);
                    }

                    if (error.responseJSON.address) {
                        $('#alert-address').removeClass('d-none');
                        $('#alert-address').addClass('d-block');
                        $('#alert-address').html(error.responseJSON.address);
                    }

                    if (error.responseJSON.phone_number) {
                        $('#alert-phone-number').removeClass('d-none');
                        $('#alert-phone-number').addClass('d-block');
                        $('#alert-phone-number').html(error.responseJSON.phone_number);
                    }

                    if (error.responseJSON.open_hours) {
                        $('#alert-open-hours').removeClass('d-none');
                        $('#alert-open-hours').addClass('d-block');
                        $('#alert-open-hours').html(error.responseJSON.open_hours);
                    }

                    if (error.responseJSON.email) {
                        $('#alert-email').removeClass('d-none');
                        $('#alert-email').addClass('d-block');
                        $('#alert-email').html(error.responseJSON.email);
                    }
                }
            });
        });
    </script>
@endsection
