@extends('Layouts.main')
@section('content')
    <h2 class="section-title">Data Improve </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Daftar Improve</h4>
                </div>
                <div class="card-body">
                    <div class="action-session" data-session="{{ session('success') }}"></div>

                    <table class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal Issue</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Data Table
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,

            ajax: "{{ url('getDataIssue') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tgl_issue',
                    name: 'Tanggal'
                },
                {
                    data: 'gambar',
                    name: 'Gambar'
                },
                {
                    data: 'deskripsi',
                    name: 'Deskripsi'
                },
                {
                    data: 'status',
                    name: 'Status'
                }, {
                    data: 'action',
                    name: "Action"
                }

            ],

        });
    </script>
@endpush
