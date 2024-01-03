@extends('public.layout.app')
@section('content')
    <div class="hero overlay inner-page">
        <img src="{{ asset('financing/images/blob.svg') }}" alt="" class="img-fluid blob">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center pt-5">
                <div class="col-lg-6">
                    <h1 class="heading text-white mb-3" data-aos="fade-up">Profil Sekolah</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="section ">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-6 col-md-6 p-3">
                    <div class="text-center">
                        <img src="/storage/icon/{{ $configuration->icon }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 p-3">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <td class="fw-bold fs-5">NPSN</td>
                                <td class="fs-5">{{ $profile->npsn }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-5">Nama</td>
                                <td class="fs-5">{{ $profile->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-5">Akreditasi</td>
                                <td class="fs-5">{{ $profile->accreditation }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-5">Alamat</td>
                                <td class="fs-5">{{ $configuration->address }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-5">Email</td>
                                <td class="fs-5">{{ $configuration->email }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-5">Nomor Telepon</td>
                                <td class="fs-5">{{ $configuration->phone_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
