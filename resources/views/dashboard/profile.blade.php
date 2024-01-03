@extends('dashboard.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Tentang Website</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Sekolah</label>
                    <input id="name" type="text" name="name" class="form-control"
                        value="{{ old('name', $profile->name) }}">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                </div>
                <div class="mb-3">
                    <label for="accreditation" class="form-label">Akreditasi Sekolah</label>
                    <input id="accreditation" type="text" name="accreditation" class="form-control"
                        value="{{ old('accreditation', $profile->accreditation) }}">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-accreditation"></div>
                </div>
                <div class="mb-3">
                    <label for="npsn" class="form-label">NPSN Sekolah</label>
                    <input id="npsn" type="text" name="npsn" class="form-control"
                        value="{{ old('npsn', $profile->npsn) }}">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-npsn"></div>
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
            formData.append('name', $('#name').val());
            formData.append('accreditation', $('#accreditation').val());
            formData.append('npsn', $('#npsn').val().toString());
            console.log(typeof $('#npsn').val());
            var createRoute = "{{ route('profil.store') }}";

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
                    if (error.responseJSON.name) {
                        $('#alert-name').removeClass('d-none');
                        $('#alert-name').addClass('d-block');
                        $('#alert-name').html(error.responseJSON.name);
                    }
                    if (error.responseJSON.accreditation) {
                        $('#alert-accreditation').removeClass('d-none');
                        $('#alert-accreditation').addClass('d-block');
                        $('#alert-accreditation').html(error.responseJSON.accreditation);
                    }
                    if (error.responseJSON.npsn) {
                        $('#alert-npsn').removeClass('d-none');
                        $('#alert-npsn').addClass('d-block');
                        $('#alert-npsn').html(error.responseJSON.npsn);
                    }
                }
            });
        });
    </script>
@endsection
