@extends('Layouts.main')

@section('content')
    <h2 class="section-title">Dashboard Pengaduan Layanan Sepatu </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4><i class="fas fa-home px-2"></i>Company Profile</h4>
                </div>
                <div class="card-body">

                    <table class="table">
                        <tr>
                            <td width="150" rowspan="4">
                                <img src="{{ asset('img/logo.png') }}" alt="" width="150">
                            </td>
                        </tr>
                        <tr>
                            <th width="200">Nama Perusahaaan</th>
                            <td width="10">:</td>
                            <td>PT. PARKLAND WORLD INDONESIA PLANT-2</td>
                        </tr>
                        <tr>
                            <th width="200">Alamat</th>
                            <td width="10">:</td>
                            <td>Jl. Raya Gorda KM 6. Kecamatan Cikande, Kelurahan Julang, 42186. Kabupaten Serang Banten
                                Indonesia</td>
                        </tr>
                        <tr>
                            <th width="200">Phone</th>
                            <td width="10">:</td>
                            <td>(0254) 402301</td>
                        </tr>
                    </table>

                    <div class="row">
                        <div class="col-md-12 px-0">
                            <marquee behavior="scroll" direction="" class="">
                                <p class="text-mute mb-0"> <span class="text-danger"> <i
                                            class="fas fa-info-circle"></i></span>
                                    Jangan lupa untuk
                                    <b>LOGOUT</b> apabila telah
                                    selesai menggunakan aplikasi.
                                    Apabila mengalami masalah dalam penggunaan, silahkan hubungi Administrator aplikasi /
                                    Departemen IT
                                </p>
                            </marquee>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
