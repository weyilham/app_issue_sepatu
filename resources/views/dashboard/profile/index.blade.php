@extends('Layouts.main')

@section('content')
    <h2 class="section-title">Profile Users</h2>

    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-users"></i> Detail Profile {{ $user->name }}</h4>
        </div>
        <div data-session="{{ session('passwordSuccess') }}"></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th width="150">Name</th>
                            <td width="10">:</td>
                            <td class="d-name"> {{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th width="150">Email</th>
                            <td width="10">:</td>
                            <td class="d-email"> {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th width="150">Username</th>
                            <td width="10">:</td>
                            <td class="d-username"> {{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th width="150">Role</th>
                            <td width="10">:</td>
                            <td> <span class="badge badge-danger d-role_id">{{ $user->role->name }}</span> </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <img src="{{ $user->image == 'default.jpg' ? asset('img/default.jpg') : asset('storage/' . $user->image) }}"
                        class="img-fluid img-thumbnail object-cover profile-img" width="200">
                    <br>
                    <br>
                    <button type="button" class="btn btn-primary btn-sm btn-profile" data-id="{{ $user->id }}"
                        data-toggle="modal" data-target="#formDetail"> <i class="fas fa-edit"></i> Edit
                        Profile</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formDetail" tabindex="-1" aria-labelledby="formDetailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formEditLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="{{ $user->id }}">
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $user->name }}">
                    </div>
                    @can('is_admin')
                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select class="form-control" id="role_id" name="role_id">
                                {{-- <option selected disabled>Pilih Role</option> --}}
                                @foreach ($role as $r)
                                    <option value={{ $r->id }} {{ $user->role_id == $r->name ? 'selected' : '' }}>
                                        {{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endcan

                    <input type="hidden" name="role_id" id="role_id" value="{{ $user->role->id }}">

                    <div class="form-group">
                        <label for="image">Gambar Profile</label>
                        <div class="mb-3">
                            <img src="{{ $user->image == 'default.jpg' ? asset('img/default.jpg') : asset('storage/' . $user->image) }}"
                                class="img-thumbnail gambar-profile" width="150" height="150" alt="">
                        </div>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger tombolClose" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update-profile">Update Data</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // alert(loginError);
            const passwordSuccess = $('div[data-session]').data('session');
            if (passwordSuccess) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "Password Berhasi di Ubah!"
                })
            }

            $(document).on('click', '.btn-profile', function() {
                $('.modal-backdrop').hide();
            })

            $(document).off('click', '.update-profile').on('click', '.update-profile', function(e) {
                e.preventDefault(); // Mencegah pengiriman form secara default
                const id = $('#id').val();
                // const name = $('#name').val();
                // const role_id = $('#role_id').val();
                // const image = $('#image')[0].files[0];
                let formData = new FormData();
                formData.append('id', id);
                formData.append('name', $('#name').val());
                formData.append('role_id', $('#role_id').val() == undefined ? $('#role').val() : $(
                        '#role_id')
                    .val());
                if ($('#image')[0].files.length > 0) {
                    formData.append('image', $('#image')[0]
                        .files[0]);
                }

                formData.append('_method', 'PUT');


                // Melakukan permintaan AJAX
                $.ajax({
                    type: "POST", // Menggunakan metode POST karena Laravel menggunakan metode spoofing untuk menangani PUT
                    url: "{{ url('profile') }}/" + id, // Mengkonstruksi URL secara dinamis
                    data: formData,
                    processData: false,
                    contentType: false,
                    //  Menggunakan objek FormData sebagai payload permintaan
                    success: function(response) {
                        // Menangani respons sukses
                        $('#formDetail').modal('hide');

                        Swal.fire({
                            title: "Updated!",
                            text: response.success,
                            icon: "success"
                        });

                        console.log(response);

                        if (response.user.role_id == 1) {
                            const role = 'Admin';
                        } else if (response.user.role_id == 2) {
                            const role = 'Laboratorium';
                        } else {
                            const role = 'Quality Control';
                        }

                        $('.d-name').html(response.user.name);
                        $('.avatar-name').html(response.user.name);
                        $('.d-role_id').html(role);
                        if (response.user.image == 'default.jpg') {
                            $('.profile-img').attr('src', 'http://127.0.0.1:8000/img/' +
                                response.user.image);
                            $('.gambar-profile').attr('src', 'http://127.0.0.1:8000/img/' +
                                response.user.image);
                            $('.avatar-img').attr('src', 'http://127.0.0.1:8000/img/' +
                                response.user.image);
                        } else {
                            $('.profile-img').attr('src', 'http://127.0.0.1:8000/storage/' +
                                response.user.image);
                            $('.gambar-profile').attr('src', 'http://127.0.0.1:8000/storage/' +
                                response.user.image);
                            $('.avatar-img').attr('src', 'http://127.0.0.1:8000/storage/' +
                                response.user.image);
                        }
                        $('#image').val(null);
                    },
                    error: function(xhr, status, error) {
                        // Menangani kesalahan yang terjadi selama permintaan
                        Swal.fire({
                            title: "Error!",
                            text: error,
                            icon: "error"
                        });
                        console.error('Kesalahan AJAX:', status, error);
                    }
                });
            });
        })
    </script>
@endpush
