@extends('Layouts.main')


@section('content')
    <h2 class="section-title">Data Users </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Daftar Users</h4>
                </div>
                <div class="card-body">
                    <a href="/users/create" class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data Users</a>
                    <div class="action-session" data-session="{{ session('success') }}"></div>
                    <table class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"> <i
                                                class="fas fa-edit"></i> </a>
                                        <button type="button" class="btn btn-danger btn-sm btn-hapus"
                                            data-id="{{ $user->id }}"> <i class="fas fa-trash"></i> </button>

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
                            url: `{{ url('users') }}/${id}`,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // console.log(response)
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.success,
                                    icon: "success"
                                });
                                location.reload();
                            }
                        });
                    }
                })
            })

        })
    </script>
@endpush
