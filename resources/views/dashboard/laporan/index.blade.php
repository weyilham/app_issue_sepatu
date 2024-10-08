@extends('Layouts.main')

@section('content')
    <h2 class="section-title">Laporan </h2>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Laporan Data Issue</h4>
                </div>
                <div class="card-body">

                    <div class="form-cari mb-3">

                        <div class="form-row">
                            <div class="col">
                                <input type="date" class="form-control form-control-sm" id="awal"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col">
                                <input type="date" class="form-control form-control-sm" id="akhir"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-primary cariData"> <i
                                        class="fas fa-search"></i>
                                    Cari Data</button>
                                <button type="button" class="btn btn-sm btn-success tombolExport d-none" data-awal=""
                                    data-akhir=""> <i class="fas fa-file"></i>
                                    Export Excel</button>
                                <button type="button" class="btn btn-sm btn-warning tombolExportPDF d-none" data-awal=""
                                    data-akhir=""> <i class="fas fa-print"></i>
                                    Export PDF</button>
                            </div>

                        </div>

                    </div>


                    <div class="table-laporan d-none">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Artikel</th>
                                    <th>Tanggal Issue</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Estimasi Perbaikan</th>
                                    <th>Catatan</th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                </tr>
                            <tbody>
                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const awal = document.getElementById('awal');
            const akhir = document.getElementById('akhir');
            // Set nilai minimum dari input tanggal kedua berdasarkan input tanggal pertama
            awal.addEventListener('change', function() {
                akhir.min = awal.value;
            });
            // Pastikan nilai awal juga disetel ketika halaman dimuat
            akhir.min = awal.value;
            $('.cariData').off('click').on('click', function() {
                const WaktuAwal = $('#awal').val()
                const WaktuAkhir = $('#akhir').val()

                $.ajax({
                    type: "get",
                    url: "{{ url('laporan/getIssue') }}",
                    data: {
                        'WaktuAwal': WaktuAwal,
                        'WaktuAkhir': WaktuAkhir
                    },
                    success: function(response) {
                        $('.table-laporan').removeClass('d-none');

                        $('.table-laporan tbody').empty();
                        // $(tBody).html(response);
                        // console.log(response)
                        response.data.forEach((element, index) => {
                            // console.log(element);

                            $('.table-laporan tbody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${response.artikel.find(artikel => artikel.id == element.artikel_id).nama_artikel || element.artikel_id}</td>
                                <td>${element.tgl_issue}</td>
                                <td>${element.tgl_selesai ? element.tgl_selesai : '-'}</td>
                                <td>${element.estimasi ? element.estimasi + ' Hari' : '-'}</td>
                                <td>${element.catatan ? element.catatan : '-'}</td>
                                <td><img src="{{ asset('storage') }}/${element.gambar}" width="50px" height="50px"></td>
                                <td>${element.deskripsi}</td>
                                <td><p class="badge ${element.status === 'Selesai' ? 'badge-success' : 'badge-danger'}">${element.status}</p></td>
                            </tr>
                            `)

                            $('.tombolExport').removeClass('d-none');
                            $('.tombolExport').attr('data-awal', WaktuAwal);
                            $('.tombolExport').attr('data-akhir', WaktuAkhir);

                            $('.tombolExportPDF').removeClass('d-none');
                            $('.tombolExportPDF').attr('data-awal', WaktuAwal);
                            $('.tombolExportPDF').attr('data-akhir', WaktuAkhir);
                        })
                    }
                })
            })

            $('.tombolExport').off('click').on('click', function() {
                const awal = $(this).data('awal');
                const akhir = $(this).data('akhir');
                window.open(`{{ url('laporan/export_issue') }}?awal=${awal}&akhir=${akhir}`, '_blank');
            })

            $('.tombolExportPDF').off('click').on('click', function() {
                const awal = $(this).data('awal');
                const akhir = $(this).data('akhir');
                // console.log(awal, akhir)
                window.open(`{{ url('dashboard/downloadPdf') }}?awal=${awal}&akhir=${akhir}`, '_blank');
            })
        });
    </script>
@endpush
