@extends('Layouts.main')

@section('content')
    <h2 class="section-title">Tambah Data Users </h2>

    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Form Data User </h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="action-session" data-session="{{ session('error_password') }}"></div>

                    <form method="post" action="{{ route('users.store') }}" id="registrationForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username" value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email') }}">
                            <p class="email-error text-danger d-none">Email Sudah tersedia</p>
                            @error('email')
                                <div class="invalid-feedback email-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select class="form-control @error('role_id') is-invalid @enderror" id="role_id"
                                name="role_id">
                                <option selected disabled>Pilih Role</option>
                                @foreach ($level as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach

                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            const error = $('.action-session').data('session');

            if (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Password Tidak Sesuai!"
                })
            }

            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func.apply(this, args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            function checkEmail() {
                let email = $('#email').val();
                if (email) {
                    $.ajax({
                        url: '{{ route('check.email') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            email: email
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#email').addClass('is-invalid');
                                $('.email-error').removeClass('d-none');
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('.email-error').addClass('d-none');
                            }
                        }
                    });
                } else {
                    $('#email').removeClass('is-invalid');
                    $('.email-error').addClass('d-none');
                }
            }




            $('#email').on('input', debounce(checkEmail, 500));
            $('#registrationForm').on('submit', function(event) {
                if ($('.email-error').is(':visible')) {
                    event.preventDefault();
                }
            });



        })
    </script>
@endpush
