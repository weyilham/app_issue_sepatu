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
                    <button class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data Users</button>

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
                                    <td>{{ $user->level }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"> <i
                                                class="fas fa-edit"></i> </a>
                                        <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-sm"> <i
                                                class="fas fa-trash"></i> </a>
                                        <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-success btn-sm"> <i
                                                class="fas fa-eye"></i> </a>

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
