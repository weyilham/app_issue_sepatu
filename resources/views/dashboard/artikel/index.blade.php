@extends('Layouts.main')


@section('content')
    <h2 class="section-title">Data Artikel </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Daftar Artikel</h4>
                </div>
                <div class="card-body">
                    <a href="/artikel/create" class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data Artikel</a>
                    <div class="action-session" data-session="{{ session('success') }}"></div>
                    <table class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Sepatu</th>
                                <th>Nama Artikel</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($artikels as $artikel)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $artikel->sepatu->nama_merk }}</td>
                                    <td>{{ $artikel->nama_artikel }}</td>
                                    <td>{{ $artikel->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('artikel.edit', $artikel->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> </a>
                                        <button type="button" data-id="{{ $artikel->id }}"
                                            class="btn btn-danger btn-sm btn-hapus"> <i class="fas fa-trash"></i> </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            const success = $('.action-session').data('session');
            if (success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "Data Berhasili di Tambah!"
                })
            }


            $(document).on('click', '.btn-hapus', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Data Akan di Hapus?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: `{{ url('artikel') }}/${id}`,
                            data: {
                                'id': id
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.success,
                                    icon: "success"
                                });
                                location.reload();
                                // $('#myTable').DataTable().ajax.reload();
                                // $('#myTable').DataTable().ajax.reload();
                            }
                        });
                    }
                })
            })

        })
    </script>
@endpush
