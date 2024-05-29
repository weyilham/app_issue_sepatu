@extends('Layouts.main')

@section('content')
    <h2 class="section-title">Dashboard Pengaduan Layanan Sepatu </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Laporan Pengaduan</h4>
                </div>
                <div class="card-body">
                    <div class="group-button">
                        <button type="button" class="btn btn-danger">Jumlah Sepatu Cacat <span
                                class="badge badge-transparent">4</span></button>
                        <button type="button" class="btn btn-warning">Jumlah Impoved <span
                                class="badge badge-transparent">4</span></button>
                        <button type="button" class="btn btn-success">Jumlah Sepatu Yang Sudah di Perbaiki <span
                                class="badge badge-transparent">4</span></button>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection